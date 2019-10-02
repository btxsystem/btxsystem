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
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
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
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
        $config['account_type'] = 'pro';

        $rajaongkir = new Rajaongkir($config);

        $data = [];

        foreach ($rajaongkir->getSubdistricts($id) as $key => $subdistrict) {
            $data[$key]['id'] = $subdistrict['subdistrict_id'];
            $data[$key]['text'] = $subdistrict['subdistrict_name'];
        }

        return $data;
    }

    public function getCost($id)
    {
        $config['api_key'] = '04f0a0070bc0d7a543e78ff45fa0dc95';
        $config['account_type'] = 'pro';

        $originID = 2127;
        $berat = 1000;
        $kurir = array(
            'jne' => 'jne' ,
            // 'pos' => 'pos' ,
            // 'tiki' => 'tiki' ,
            'jnt' => 'jnt' ,
            // 'wahana' => 'wahana',
            // 'ninja' => 'ninja'
        );

        $rajaongkir = new Rajaongkir($config);
        $datas = [];
        $data = [];
        $index = 0;

        foreach ($kurir as $key => $kur) {
            $datas[$key] =  $rajaongkir->getCost(['subdistrict' => $originID], ['subdistrict' => $id], $berat, $kur);
        }

        foreach ($datas as $key => $value) {
            for ($i=0; $i<count($value['costs']); $i++) {
                $data[$index]['id'] = $value['costs'][$i]['cost'][0]['value'];
                $data[$index]['text'] = $value['code'].' '.$value['costs'][$i]['service'].' ('.$value['costs'][$i]['cost'][0]['etd'].') - ('.$value['costs'][$i]['cost'][0]['value'].')';
                $index++;
            }
        }

        return($data);
    }
}
