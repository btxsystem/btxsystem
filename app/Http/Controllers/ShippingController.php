<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Steevenz\Rajaongkir;


class ShippingController extends Controller
{
    public function getProvince()
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        $rajaongkir = new Rajaongkir($config);

        $data = [];

        foreach ($rajaongkir->getProvinces() as $key => $province) {
           $data[$key]['id'] = $province['province_id'];
           $data[$key]['text'] = $province['province'];
        }
        return $data;
    }

    public function getCity($id)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';
        $provinceId = $id ;
        $rajaongkir = new Rajaongkir($config);

        $data = []; 
        foreach ($rajaongkir->getCities($provinceId) as $key => $city) {
            $data[$key]['id'] = $city['city_id'];
            $data[$key]['text'] = $city['city_name'];
        }

        return $data;
    }

    public function getSubDistrict($id)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        $rajaongkir = new Rajaongkir($config);

        $data = []; 
        
        foreach ($rajaongkir->getSubdistricts($id) as $key => $subdistrict) {
            $data[$key]['id'] = $subdistrict['subdistrict_id'];
            $data[$key]['text'] = $subdistrict['subdistrict_name'];
        }

        return $data;
    }

    public function getKurir(){
        $kurir = [
            text =>'jne',
            'jnt'
        ];
        return $kurir;
    }

    public function getCost($id)
    {
        $config['api_key'] = '36c8c1ee70aa09f3bc85fe0f2d3ee62f';
        $config['account_type'] = 'pro';

        // $originID = $req->input('origin_id'); 
        // Origin id di set 2127(Kode District Penjaringan)

        // $kurir = $req->input('kurir');
        // Kurir untuk sementara hanya available dengan JNE

        // Berate satuan gram;

        $originID = 2127;
        $berat = 1000;
        

        $rajaongkir = new Rajaongkir($config);


        if ($originID && $destID && $berat && $kurir) {

            $data =  $rajaongkir->getCost(['subdistrict' => $originID], ['subdistrict' => $id], $berat, $kurir);

            return $data;
        }

        return response()->json([
            'success' => false,
            'message' => 'Mohon lengkapi data, Data Origin, Data Tujuan, Derat, dan Kurir'
        ], 400);
    


    }
}
