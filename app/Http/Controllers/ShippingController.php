<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Steevenz\Rajaongkir;


class ShippingController extends Controller
{
    public function getProvince(Request $req)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        $id = $req->input('id');
        $rajaongkir = new Rajaongkir($config);

        $data = $id ? $rajaongkir->getProvince($id) : $rajaongkir->getProvinces();

        return $data;
    }
    
    public function getCity(Request $req)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        $id = $req->input('id');
        $provinceId = $req->input('province_id') ? $req->input('province_id') : null;
        $rajaongkir = new Rajaongkir($config);

        $data = $id ? $rajaongkir->getCity($id) : $rajaongkir->getCities($provinceId);

        return $data;
    }

    public function getSubDistrict(Request $req)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        $id = $req->input('id');
        $cityId = $req->input('city_id');

        if($cityId || $id) {

            $rajaongkir = new Rajaongkir($config);

            $data = $id ? $rajaongkir->getSubdistrict($id) : $rajaongkir->getSubdistricts($cityId);

            return $data;
        }  

        return response()->json([
            'success' => false,
            'message' => 'City id needed !!'
        ], 400);
    }

    public function getCost(Request $req)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        // $originID = $req->input('origin_id'); 
        // Origin id di set 2127(Kode District Penjaringan)

        // $kurir = $req->input('kurir');
        // Kurir untuk sementara hanya available dengan JNE

        // Berate satuan gram;

        $originID = 2127;
        $kurir = 'jne';
        $destID = $req->input('dest_id');
        $berat = $req->input('berat');
        

        $rajaongkir = new Rajaongkir($config);


        if ($originID && $destID && $berat && $kurir) {

            $data =  $rajaongkir->getCost(['subdistrict' => $originID], ['subdistrict' => $destID], $berat, $kurir);

            return $data;
        }

        return response()->json([
            'success' => false,
            'message' => 'Mohon lengkapi data, Data Origin, Data Tujuan, Derat, dan Kurir'
        ], 400);
    


    }
}
