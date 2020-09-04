<?php
use Illuminate\Support\Facades\DB;
use App\Employeer;
use App\Models\Ebook;
use Carbon\Carbon;
use App\Service\NotificationService;
use App\Service\PaymentSwitchService;
use Illuminate\Http\Request;

function calculateEbookPriceWithValidate($ebooks, Request $request)
{
    $dataEbooks = Ebook::whereIn('id', $ebooks)->get();
    $totalPriceEbook = 0;

    foreach($dataEbooks as $ebook) {
        if($ebook->is_promotion && $ebook->register_promotion) {
            if(count($dataEbooks) >= $ebook->minimum_product && count($dataEbooks) <= $ebook->maximum_product) {
                $totalPriceEbook += ((int) $ebook->price - (int) $ebook->total_price_discount);

                if($request->input('selected_ebook')) {
                    if($ebook->allow_merge_discount == 0 && (int) $ebook->id != (int) $request->input('selected_ebook')) {
                        $totalPriceEbook += (int) $ebook->total_price_discount;
                    }
                }
            } else {
                $totalPriceEbook += (int) $ebook->price;
            }
        } else {
            $totalPriceEbook += (int) $ebook->price;
        }
    }

    return (int) $totalPriceEbook;
}

function getNotif(){
    return NotificationService::getNotification();
}

function getCurrentPaymentMethod()
{
    return PaymentSwitchService::getCurrentPaymentMethod();
}

function getJmlNotif(){
    return NotificationService::getTotalNotif();
}

function checkImageHof($image) {
    if(!file_exists(public_path($image))) {
        return asset('assets3/img/favicon.png');
    }

    return asset($image);
}

function isSelfRequest() {
    $referer = parse_url(\request()->headers->get('referer'), PHP_URL_HOST);
    $host = parse_url(\request()->getHttpHost(), PHP_URL_HOST);

    if($referer != $host) {
        return false;
    }

    return true;
}

function invoiceNumbering(){
      $dateNow = date('ym');
      $lastInvoiceNo = Employeer::pluck('id_member')->last();
      $lastInvoiceDate = substr($lastInvoiceNo, 0, -4);
      $increment = (int)substr($lastInvoiceNo, -4) + 1;
      $increment = sprintf("%06d", $increment);
      return 'M'.$dateNow.$increment;
}

function memberIdGenerate(){
      $dateNow = date('ym');
      $lastInvoiceNo = Employeer::pluck('id_member')->last();
      $lastInvoiceDate = substr($lastInvoiceNo, 0, -4);
      $increment = (int)substr($lastInvoiceNo, -4) + 1;
      $increment = sprintf("%06d", $increment);
      return 'M'.$dateNow.$increment;
}

// function currency($value)
// {
//     if (is_decimal($value)) {
//         return 'Rp. ' . number_format($value, 2).',-';
//     }
//     return 'Rp. ' . number_format($value, 0).',-';
// }

function currency($value)
{
    if (is_decimal($value)) {
        return 'Rp. ' . str_replace(",",".", number_format($value, 2)).',-';
    }
    return 'Rp. ' . str_replace(",",".", number_format($value, 0)).',-';
}

function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

function findChild($id, $sponsor, $data){
    $idMember = invoiceNumbering();
    $isHaveChild = Employeer::where('parent_id',$id)->select('position')->get();
    if (count($isHaveChild) == 3) {
        $pv = DB::table('pv_rank')->where('id_member',$id)->select('pv_left', 'pv_midle', 'pv_right')->first();
        if($pv != null){
            if ($pv->pv_left <= $pv->pv_midle and $pv->pv_left <= $pv->pv_right) {
                $child = Employeer::where('parent_id',$id)->where('position',0)->select('id')->first();
                findChild($child->id, $sponsor, $data);
            }elseif ($pv->pv_midle < $pv->pv_left and $pv->pv_midle <= $pv->pv_right) {
                $child = Employeer::where('parent_id',$id)->where('position',1)->select('id')->first();
                findChild($child->id, $sponsor, $data);
            }else {
                $child = Employeer::where('parent_id',$id)->where('position',2)->select('id')->first();
                findChild($child->id, $sponsor, $data);
            }
        }else{
            $child = Employeer::where('parent_id',$id)->where('position',0)->select('id')->first();
            findChild($child->id, $sponsor, $data);
        }
    }elseif (count($isHaveChild)==0) {
        $member = [
            'id_member' => $idMember,
            'username' => $data->username,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
            'birthdate' => $data->birth_date,
            'gender' => 0,
            'position' => 0,
            'parent_id' => $id,
            'sponsor_id' => $sponsor,
            'bitrex_cash' => 0,
            'bitrex_points' => 0,
            'pv' => 0,
            'nik' => $data->nik,
            'expired_at' => Carbon::now()->addYears(1)
        ];
        Employeer::create($member);
    }else{
        $left = false;
        $midle = false;
        $right = false;
        foreach ($isHaveChild as $key => $child) {
            if ($child->position == 0) {
                $left = true;
            }elseif ($child->position == 1) {
                $midle = true;
            }elseif ($child->position == 2) {
                $right = true;
            }
        }
        if (!$left) {
            $member = [
                'id_member' => $idMember,
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birth_date,
                'gender' => 0,
                'position' => 0,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->nik,
                'expired_at' => Carbon::now()->addYears(1)
            ];
            Employeer::create($member);
        }elseif (!$midle) {
            $member = [
                'id_member' => $idMember,
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birth_date,
                'gender' => 0,
                'position' => 1,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->nik,
                'expired_at' => Carbon::now()->addYears(1)
            ];
            Employeer::create($member);
        }else {
            $member = [
                'id_member' => $idMember,
                'username' => $data->username,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
                'birthdate' => $data->birth_date,
                'gender' => 0,
                'position' => 2,
                'parent_id' => $id,
                'sponsor_id' => $sponsor,
                'bitrex_cash' => 0,
                'bitrex_points' => 0,
                'pv' => 0,
                'nik' => $data->nik,
                'expired_at' => Carbon::now()->addYears(1)
            ];
            Employeer::create($member);
        }
    }
    return Employeer::where('id_member', $idMember)->first();
}

// function registerAuto($request){
//     $sponsor = Employeer::where('id',$request->referal)->select('id')->first();
//     $isHaveChild = Employeer::where('parent_id',$sponsor->id)->select('position')->get();
//     if (count($isHaveChild) == 3) {
//         $pv = DB::table('pv_rank')->where('id_member',$sponsor->id)->select('pv_left', 'pv_midle', 'pv_right')->first();
//         if($pv != null){
//             if ($pv->pv_left <= $pv->pv_midle and $pv->pv_left <= $pv->pv_right) {
//                 $child = Employeer::where('parent_id',$sponsor->id)->where('position',0)->select('id')->first();
//                 findChild($child->id, $sponsor->id, $request);
//             }elseif ($pv->pv_midle < $pv->pv_left and $pv->pv_midle <= $pv->pv_right) {
//                 $child = Employeer::where('parent_id',$sponsor->id)->where('position',1)->select('id')->first();
//                 findChild($child->id, $sponsor->id, $request);
//             }else {
//                 $child = Employeer::where('parent_id',$sponsor->id)->where('position',2)->select('id')->first();
//                 findChild($child->id, $sponsor->id, $request);
//             }
//         }else{
//             $child = Employeer::where('parent_id',$sponsor->id)->where('position',0)->select('id')->first();
//             findChild($child->id, $sponsor->id, $request);
//         }
//     }elseif (count($isHaveChild)==0) {
//         $member = [
//             'id_member' => invoiceNumbering(),
//             'username' => $request->username,
//             'first_name' => $request->first_name,
//             'last_name' => $request->last_name,
//             'email' => $request->email,
//             'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
//             'birthdate' => $request->birth_date,
//             'gender' => 0,
//             'position' => 0,
//             'parent_id' => $sponsor->id,
//             'sponsor_id' => $sponsor->id,
//             'bitrex_cash' => 0,
//             'bitrex_points' => 0,
//             'pv' => 0,
//             'nik' => $request->passport ?? $request->nik,
//             'expired_at' => Carbon::now()->addMonths(2)
//         ];
//         Employeer::create($member);
//     }else{
//         $left = false;
//         $midle = false;
//         $right = false;
//         foreach ($isHaveChild as $key => $child) {
//             if ($child->position == 0) {
//                 $left = true;
//             }elseif ($child->position == 1) {
//                 $midle = true;
//             }elseif ($child->position == 2) {
//                 $right = true;
//             }
//         }
//         if (!$left) {
//             $member = [
//                 'id_member' => invoiceNumbering(),
//                 'username' => $request->username,
//                 'first_name' => $request->first_name,
//                 'last_name' => $request->last_name,
//                 'email' => $request->email,
//                 'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
//                 'birthdate' => $request->birthdate,
//                 'gender' => 0,
//                 'position' => 0,
//                 'parent_id' => $sponsor->id,
//                 'sponsor_id' => $sponsor->id,
//                 'bitrex_cash' => 0,
//                 'bitrex_points' => 0,
//                 'pv' => 0,
//                 'nik' => $request->passport,
//                 'expired_at' => Carbon::now()->addMonths(2)
//             ];
//             Employeer::create($member);
//         }elseif (!$midle) {
//             $member = [
//                 'id_member' => invoiceNumbering(),
//                 'username' => $request->username,
//                 'first_name' => $request->first_name,
//                 'last_name' => $request->last_name,
//                 'email' => $request->email,
//                 'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
//                 'birthdate' => $request->birthdate,
//                 'gender' => 0,
//                 'position' => 1,
//                 'parent_id' => $sponsor->id,
//                 'sponsor_id' => $sponsor->id,
//                 'bitrex_cash' => 0,
//                 'bitrex_points' => 0,
//                 'pv' => 0,
//                 'nik' => $request->passport,
//                 'expired_at' => Carbon::now()->addMonths(2)
//             ];
//             Employeer::create($member);
//         }else {
//             $member = [
//                 'id_member' => invoiceNumbering(),
//                 'username' => $request->username,
//                 'first_name' => $request->first_name,
//                 'last_name' => $request->last_name,
//                 'email' => $request->email,
//                 'password' => bcrypt('password'),//bcrypt('Mbitrex'.rand(100,1000)),
//                 'birthdate' => $request->birthdate,
//                 'gender' => 0,
//                 'position' => 2,
//                 'parent_id' => $sponsor->id,
//                 'sponsor_id' => $sponsor->id,
//                 'bitrex_cash' => 0,
//                 'bitrex_points' => 0,
//                 'pv' => 0,
//                 'nik' => $request->passport,
//                 'expired_at' => Carbon::now()->addMonths(2)
//             ];
//             Employeer::create($member);
//         }
//     }
//     return true;
// }
