<?php
namespace App\Service;

use DB;

class LotCommissionQualifiedService {
  private static $url = 'https://startpro.co.id/api';
  private $listIdMember = array();

  private function getIdList() {
    $path = '/qualified/list_member';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$url.$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
		));

		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output,true);
		$this->listIdMember = $result['data'];
  }

  private function getIdtrading($idmember) {
    $path = '/qualified/detail_id_trading';
    $data = array(
      'idmember' => $idmember
    );
    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$url.$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($ch, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POSTFIELDS => http_build_query($data),
		));

		$output = curl_exec($ch);
    curl_close($ch);

		return json_decode($output,true)['data'];
  }

  public function _start() {
    $this->getIdList();

    foreach($this->listIdMember as $data) {
      $response = [];
      $status = 'qualified';
      $detail = [];

      if ($data['ID_M'] == "" or $data['ID_M'] == "M1601000000") {
      } else {
        $member = DB::table('employeers')->where('id_member', $data['ID_M'])->first();
        $idtrading = $this->getIdtrading($data['ID_M']);

        if ($member == null) {
          $status = 'unqualified';
        } else {
          $detail['status_member_aktif'] = $member->status;
          if ($member->status == 0) {
            $status = 'unqualified';
          }
        }

        

        if (sizeof($idtrading) == 0 || array_key_exists(0,$idtrading) != TRUE) {
          $detail['have_id_trading'] = array_key_exists(0,$idtrading);
          $status = 'unqualified';
        } else {
          $pure_id_trading = array_slice($idtrading,0,-2);

          $detail['type_special_or_not'] = intval($idtrading[0]['TYPE_MEMBER']);
          $detail['total_id_trading'] = intval($idtrading['TOTAL_ID_TRADING']);
          $detail['total_lot'] = intval($idtrading['SUM_T_LAST_MONTH_F']);

          if ($idtrading[0]['TYPE_MEMBER'] == 0) {
            if (intval($idtrading['TOTAL_ID_TRADING']) == 1) {
              if (floatval($idtrading['SUM_T_LAST_MONTH_F']) < 0.95) {
                $status = 'unqualified';
              } else {
                  $last_action = strtotime($pure_id_trading[0]['LAST_ACTION_F']);
                  $endTimeStamp = strtotime(date('Y/m/d'));
                  $timeDiff = $endTimeStamp - $last_action;
                  $numberDays = $timeDiff/86400;  // 86400 seconds in one day
  
                  // and you might want to convert to integer
                  $numberDays = intval($numberDays);
                  $detail['type_id_trading'] = intval($idtrading[0]['TYPE']) == 1 ? 'ROBOT' : 'MANUAL OR UNDEFINED';
                  $detail['status_id_trading'] = intval($idtrading[0]['STATUS']) == 1 ? 'ON' : 'OFF OR UNDEFINED';
                  $detail['days_on'] = $numberDays;

                if (intval($pure_id_trading[0]['TYPE']) != 1) {
                  $status = 'unqualified';
                }
  
                if (intval($pure_id_trading[0]['STATUS']) != 1) {
                  $status = 'unqualified';
                }
  
                if ($numberDays < 10) {
                  $status = 'unqualified';
                }
              }
            } else if (intval($idtrading['TOTAL_ID_TRADING']) > 1) {
              if (floatval($idtrading['SUM_T_LAST_MONTH_F']) < 0.95) {
                $status = 'unqualified';
              } 
            } else {
              $status = 'unqualified';
            }
            
          }
        }

      }
      $response['data'][$data['ID_M']] = array(
        'status_komisi' => $status,
        'detail' => $detail
      );

      $this->store($response);

    }

  }

  public function store($response) {
    $path = '/qualified/store';
    $data = array(
      'report' => json_encode($response)
    );
    
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$url.$path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($ch, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POSTFIELDS => http_build_query($data),
		));

		$output = curl_exec($ch);
    curl_close($ch);

  }

}

?>