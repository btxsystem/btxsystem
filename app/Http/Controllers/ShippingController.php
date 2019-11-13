<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Steevenz\Rajaongkir;


class ShippingController extends Controller
{
    public function getProvince()
    {
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$config['api_key']
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = [];
        if ($err) {
            $data = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data = $result['rajaongkir']['results'];
            } else {
                $data = $result['rajaongkir']['status']['description'];
            }
        }
        $prov = [];
        foreach ($data as $key => $province) {
            $prov[$key]['id'] = $province['province_id'];
            $prov[$key]['text'] = $province['province'];
        }
        return $prov;
    }

    public function getCity($id)
    {
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=&province=".$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$config['api_key']
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = [];
        $city = [];
        if ($err) {
            $data = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data = $result['rajaongkir']['results'];
            } else{
                $data = $result['rajaongkir']['status']['description'];
            }
        }
        foreach ($data as $key => $cities) {
            $city[$key]['id'] = $cities['city_id'];
            $city[$key]['text'] = $cities['type'].' '.$cities['city_name'];
        }
        return $city;
    }

    public function getSubDistrict($id)
    {
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$config['api_key']
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = [];
        $subdistrict = [];
        if ($err) {
            $data = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data = $result['rajaongkir']['results'];
            } else{
                $data = $result['rajaongkir']['status']['description'];
            }
        }
        foreach ($data as $key => $subdistricts) {
            $subdistrict[$key]['id'] = $subdistricts['subdistrict_id'];
            $subdistrict[$key]['text'] = $subdistricts['subdistrict_name'];
        }
        return $subdistrict;
    }

    public function getCost($id)
    {
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
        $curl = curl_init();
        $origin = 2127;
        $berat = 1000;
        $kurir = array(
            'jne' => 'jne' ,
            'jnt' => 'jnt'
        );

        foreach ($kurir as $key => $kur) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=".$origin."&originType=subdistrict&destination=".$id."&destinationType=subdistrict&weight=".$berat."&courier=".$kur,
                CURLOPT_HTTPHEADER => array(
                  "key: ".$config['api_key']
                ),
              ));
              $response[$key] = curl_exec($curl);
        }

        $kur2 = ['jne', 'jnt'];
        $idx = 0;
        $result = [];
        foreach ($response as $key => $respon) {
            $tmp = json_decode($response[$kur2[$idx]], true);
            $result[$idx] = $tmp['rajaongkir']['results'][0];
            $idx++;
        }

        $data_cost = [];
        $idx = 0;
        foreach ($result as $key => $res) {
            foreach ($res['costs'] as $key => $cost) {
               $data_cost[$idx]['id'] = $cost['cost'][0]['value'];
               $data_cost[$idx]['text'] = $res['code'].' '.$cost['service'].' ('.$cost['cost'][0]['etd'].' day) '.$cost['cost'][0]['value'];
               $idx++;
            }
        }


        return($data_cost);
    }
}
