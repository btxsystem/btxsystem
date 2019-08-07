<?php
/**
 * Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

namespace App\Http\Controllers\Api\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\System\Module;
use App\Models\Customer\Customers;
use App\Models\Customer\CustomerOwners;
use App\Models\Customer\CustomerCategories;
use App\Models\Customer\CustomerTypes;
use App\Models\Area\Kota;
use App\Models\Inventory\TipeProduct;
use App\Models\Inventory\ProductBrands;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductGroups;
use App\Models\Settings\Outstanding;
use App\Models\Settings\Omset;
use Illuminate\Support\Collection;
use Validator;

/**
 * Module Modules
 *
 * Module to manage module list
 *
 * Table : modules
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class ImportController extends Controller
{
    private $permission = "Setting.ImportTxt.";

    /**
     * Return all table
     *
     * @param Request $request Request Object
     *
     * @return json
     */
    public function getTable(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'View');

        $list = Module::whereIn('id', array(22, 23, 24, 25, 26))->get();

        return response()->json(['data' => $list], 200);
    }


    /**
     * Create a new Data
     *
     * @return json
     */
    public function store(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'Create');
        $res = '';

        if ($request->get('module_name') == 'customers') 
        {

            $res = $this->importCustomer($request);

        } else if ($request->get('module_name') == 'products') {

            $res = $this->importProduct($request);

        } else if ($request->get('module_name') == 'outstanding') {

            $res = $this->importOutstanding($request);
            
        } else if ($request->get('module_name') == 'omset') {

            $res = $this->importOmset($request);
            
        } else if ($request->get('module_name') == 'product_groups') {

            $res = $this->importKategori($request);
            
        }

        return $res;
        
    }


    /**
     * import data customer
     */

    public function importCustomer($request)
    {
        $fileTxt    = $request->get('file_txt');

        $file = File::get(storage_path('app/'.$fileTxt));

        $array = array();
        $no             = 0;
        $errors         = [];
        $update         = 0;
        $insert         = 0;
        $keterangan     = "";

        $kolom = array(
            // array('start' => 0,     'length' => 5,     'nama' => 'no'),            //0   s/d 4  
            array('start' => 5,     'length' => 11,    'nama' => 'code'),          //5   s/d 15 
            array('start' => 16,    'length' => 26,    'nama' => 'name'),          //16  s/d 41 
            array('start' => 42,    'length' => 51,    'nama' => 'alamat'),       //42  s/d 92 
            array('start' => 93,    'length' => 16,    'nama' => 'kota_id'),          //93  s/d 108
            array('start' => 109,   'length' => 16,    'nama' => 'phone_no'),         //109 s/d 124
            array('start' => 125,   'length' => 26,    'nama' => 'nama_pemilik'),  //125 s/d 150
            //array('start' => 151,   'length' => 25,    'nama' => 'tr_titip'),      //151 s/d 175
            array('start' => 176,   'length' => 16,    'nama' => 'credit_limits')     //176 s/d 191
            //array('start' => 192,   'length' => 15,    'nama' => 'l_top_plafon')   //192 s/d 207
        );

       
        $kategori       = CustomerCategories::first();
        $tipe           = CustomerTypes::first();

        try {
            foreach (explode("\n", $file) as $key => $line){
                if ($key >= 7  && trim(substr($line, 0, 5)) != '' && (int)trim(substr($line, 0, 5)) != 0 ) {
                    foreach ($kolom as $index => $col) {
                        $array[$no][$col['nama']] = trim(substr($line, $col['start'], $col['length']));                        

                        if ($col['nama'] == 'credit_limits') { 
                            $array[$no][$col['nama']] =(int)str_replace('.', '',trim(substr($line, $col['start'], $col['length'])));
                        }
                        
                        if ($col['nama'] == 'kota_id') { 
                            $getKota = Kota::where('name', 'like', trim(substr($line, $col['start'], $col['length'])))->first();
                            
                            if ($getKota) {
                                $array[$no][$col['nama']] = $getKota->id; }
                            else {
                                $array[$no][$col['nama']] = 1;
                            }
                        }
                    }

                    // if ($array[$no]['name'] == 'YMS PART / REJEKI (MSM034') { 
                    //     print_r($array[$no]);
                    //     exit;
                    // }

    
                
                    $dataCustomer   = Customers::where('code', $array[$no]['code'])->first();
                    $dataPemilik    = CustomerOwners::where('name', $array[$no]['nama_pemilik'])->first();
                 
                    
                    if ($dataPemilik ) {
                        
                            $dataPemilik->name               = $array[$no]['nama_pemilik'];
                            $dataPemilik->alamat             = $array[$no]['alamat'];
                            $dataPemilik->kota_id            = $array[$no]['kota_id'];
                            $dataPemilik->phone_no           = $array[$no]['phone_no'];
                            $dataPemilik->save();
                                        
                        if ($dataCustomer) {

                            $dataCustomer->customer_owner_id = $dataPemilik->id;
                            $dataCustomer->name              = $array[$no]['name'];
                            $dataCustomer->alamat            = $array[$no]['alamat'];
                            $dataCustomer->kota_id           = $array[$no]['kota_id'];
                            $dataCustomer->phone_no          = $array[$no]['phone_no'];
                            $dataCustomer->save();
                            
                            $update++;

                        } else {

                           Customers::create([
                                'customer_owner_id'          => $dataPemilik->id,
                                'code'                       => $array[$no]['code'],
                                'name'                       => $array[$no]['name'],
                                'alamat'                     => $array[$no]['alamat'],
                                'kota_id'                    => $array[$no]['kota_id'],
                                'phone_no'                   => $array[$no]['phone_no'],
                                'customer_category_id'       => $kategori->id,
                                'customer_type_id'           => $tipe->id
                            ]);


                            $insert++;
                        }
                    }

                    if (!$dataPemilik){

                        if ($array[$no]['nama_pemilik'] != "" && $array[$no]['nama_pemilik'] != "-") {

                            $id = CustomerOwners::create([
                                'name'                          => $array[$no]['nama_pemilik'],
                                'alamat'                        => $array[$no]['alamat'],
                                'kota_id'                       => $array[$no]['kota_id'],
                                'phone_no'                      => $array[$no]['phone_no']
                            ]); 
                            
                            $dataCustomer   = Customers::where('code', $array[$no]['code'])->first();

                            if (!$dataCustomer) {
                                Customers::create([     
                                    'customer_owner_id'             => $id->id,
                                    'code'                          => $array[$no]['code'],
                                    'name'                          => $array[$no]['name'],
                                    'alamat'                        => $array[$no]['alamat'],
                                    'kota_id'                       => $array[$no]['kota_id'],
                                    'phone_no'                      => $array[$no]['phone_no'],
                                    'customer_category_id'          => $kategori->id,
                                    'customer_type_id'              => $tipe->id
                                ]);
                            }                         
                        
                        }                   

                        $insert++;
                    }

                    $getPemilik      = CustomerOwners::where('name', $array[$no]['nama_pemilik'])->first();

                    if ($getPemilik) {

                        $totalCustomer   = Customers::where('customer_owner_id', $getPemilik->id)->count();
                        $getPemilik->customer_total = $totalCustomer;
                        $getPemilik->save();
                       
                    }               
                
                    $no++;                
                }
            }
        } catch (Exception $e) {
            $errors[] = $e;
        }

        $status = 200;

        if (count($errors) > 0) {
            $status = 400;
        }

        return response()->json([
            'data'              => "Customer", 
            'status'            => $status, 
            'update'            => $update, 
            'insert'            => $insert,
            'total'             => ($no)." Line ".($update + $insert)." data",
            'keterangan'        => $keterangan,
            'message'           => implode("<br />", $errors)
        ], 201);
    }

    public function importProduct($request)
    {
        $fileTxt    = $request->get('file_txt');

        $file = File::get(storage_path('app/'.$fileTxt));

        $update         = 0;
        $insert         = 0;
        $no             = 0;
        $errors         = [];
        $array          = array();
        $keterangan     = "";

        $kolom = array (
                
                array('start' => 5,     'length' => 21, 'nama' =>  'code'                 ),
                array('start' => 26,    'length' => 26, 'nama' =>  'name'                 ),
                array('start' => 52,    'length' => 16, 'nama' =>  'product_type_id'      ),
                array('start' => 68,    'length' => 12, 'nama' =>  'product_brand_id'     ),
                array('start' => 97,    'length' => 13, 'nama' =>  'purchase_cost'        )
        );

        try {
            foreach (explode("\n", $file) as $key => $line){
                if ($key >= 10  && trim(substr($line, 0, 5)) != '' && (int)trim(substr($line, 0, 5)) != 0 ) {
                    foreach ($kolom as $index => $col) {
                        $array[$no][$col['nama']]   = trim(substr($line, $col['start'], $col['length']));             
                        $array[$no]['unit_id']               = 13;
                        $array[$no]['product_group_id']      = 14;

                        if ($col['nama'] == 'purchase_cost') { 
                            $array[$no][$col['nama']] =(int)str_replace('.', '',trim(substr($line, $col['start'], $col['length'])));
                        }
                        
                        if ($col['nama'] == 'product_type_id') { 
                            $getTipe = TipeProduct::where('name', 'like', trim(substr($line, $col['start'], $col['length'])))->first();
                            
                            if ($getTipe) {

                                $array[$no][$col['nama']] = $getTipe->id; 
                                $getTipe->total_barang = $getTipe->total_barang + 1;
                                $getTipe->save();

                            } else {
                                $idTipe = TipeProduct::create([
                                    'code'          => $array[$no][$col['nama']],
                                    'name'          => $array[$no][$col['nama']],
                                    'total_barang'  => 1
                                ]);

                                $array[$no][$col['nama']] = $idTipe->id;
                            }
                        }

                    

                        if ($col['nama'] == 'product_brand_id') { 
                            $getMerk = ProductBrands::where('name', 'like', trim(substr($line, $col['start'], $col['length'])))->first();
                            
                            if ($getMerk) {

                                $array[$no][$col['nama']] = $getMerk->id; 
                                $getMerk->total_barang = $getMerk->total_barang + 1;
                                $getMerk->save();

                            } else {
                                $idMerk = ProductBrands::create([
                                    'code'          => $array[$no][$col['nama']],
                                    'name'          => $array[$no][$col['nama']],
                                    'total_barang'  => 1
                                ]);

                                $array[$no][$col['nama']] = $idMerk->id;
                            }
                        }
                    }

                    $dataBarang   = Product::where('code', $array[$no]['code'])->first();
                    
                    try {
                        if ($dataBarang ) {
                            
                            $dataBarang->name               = $array[$no]['name'            ];
                            $dataBarang->product_type_id    = $array[$no]['product_type_id' ];
                            $dataBarang->product_brand_id   = $array[$no]['product_brand_id'];
                            $dataBarang->purchase_cost      = $array[$no]['purchase_cost'   ];
                            $dataBarang->unit_id            = 13;
                            $dataBarang->product_group_id   = 14;
                            $dataBarang->save();
                                            
                            $update++;
                        }

                        if (!$dataBarang){

                            Product::create([
                                'code'                      => $array[$no]['code'            ],
                                'name'                      => $array[$no]['name'            ],
                                'product_type_id'           => $array[$no]['product_type_id' ],
                                'product_brand_id'          => $array[$no]['product_brand_id'],
                                'purchase_cost'             => $array[$no]['purchase_cost'   ],
                                'unit_id'                   => 13,
                                'product_group_id'          => 14
                            ]);     

                            $insert++;
                        }
                        $no++; 
                    } catch (\Exception $e) {
                        $errors[] = "Txt Line {$line} : Gagal di Import";
                    }             
                }
            }                   

        } catch (\Exception $e) {
            $errors[] = $e;
        }

        $status = 200;

        if (count($errors) > 0) {
            $status = 400;
        }

       
        return response()->json([
            'data'              => "Product", 
            'status'            => $status, 
            'update'            => $update, 
            'insert'            => $insert,
            'total'             => ($no)." Line ".($update + $insert)." data",
            'keterangan'        => $keterangan,
            'message'           => implode("<br />", $errors)
        ], 201);
    }

    public function importOutstanding($request)
    {
        $fileTxt        = $request->get('file_txt');

        $file           = File::get(storage_path('app/'.$fileTxt));
        $array          = array();
        $update         = 0;
        $insert         = 0;
        $no             = 0;
        $dataInput      = 0;
        $errors         = [];
        $status         = 200;
        $keterangan     = "";

        $kolom = array (

            array('start' => 5,         'length' => 11, 'nama' =>    'customer_code'    ),
            array('start' => 16,        'length' => 60, 'nama' =>    'customer_name'    ),
            array('start' => 76,        'length' => 11, 'nama' =>    'order_no'         ),
            array('start' => 87,        'length' => 9,  'nama' =>    'order_date'       ),
            array('start' => 96,        'length' => 9,  'nama' =>    'due_date'         ),
            array('start' => 105,       'length' => 6,  'nama' =>    'keterangan'       ),
            array('start' => 111,       'length' => 18, 'nama' =>    'total_pembelian'  ),
            array('start' => 129,       'length' => 18, 'nama' =>    'total_bayar'      ),
            array('start' => 147,       'length' => 18, 'nama' =>    'tagihan'          )

        );

        
        try {
            foreach (explode("\n", $file) as $key => $line){
                if ($key >= 8  && trim(substr($line, 0, 5)) != '' && (int)trim(substr($line, 0, 5)) != 0 ) {
                    foreach ($kolom as $index => $col) {                        

                        $array[$no][$col['nama']]   = trim(substr($line, $col['start'], $col['length']));
                        
                        if (($col['nama'] == 'customer_code' || $col['nama'] == 'customer_name') && $array[$no][$col['nama']] != '' ) {

                            session()->put($col['nama'], $array[$no][$col['nama']]);
                        }
                       
                        if ($col['nama'] == 'total_pembelian' || $col['nama'] == 'total_bayar' || $col['nama'] == 'tagihan') { 

                            $array[$no][$col['nama']] =(int)str_replace('.', '',trim(substr($line, $col['start'], $col['length'])));
                        }
                        
                        if ($col['nama'] == 'order_date' || $col['nama'] == 'due_date') { 
                            
                            $tgl    = trim(substr($line, $col['start'], $col['length']));
                            $d      = substr($tgl, 0,2);
                            $m      = substr($tgl, 3,2);
                            $y      = '20'.substr($tgl, 6,2);

                            $array[$no][$col['nama']] = $y.'-'.$m.'-'.$d;
                        }
                    
                    }

                    if ($array[$no]['customer_code'] == '') {

                        $array[$no]['customer_code'] = session()->get('customer_code');
                        $array[$no]['customer_name'] = session()->get('customer_name');
                    }

                    $dataOutstanding = Outstanding::where('order_no', $array[$no]['order_no'])->first();

                    try {

                        if ($dataOutstanding) {

                            $dataOutstanding->customer_code    = $array[$no]['customer_code'];
                            $dataOutstanding->customer_name    = $array[$no]['customer_name'];
                            $dataOutstanding->order_date       = $array[$no]['order_date'];     
                            $dataOutstanding->due_date         = $array[$no]['due_date'];       
                            $dataOutstanding->keterangan       = $array[$no]['keterangan'];     
                            $dataOutstanding->total_pembelian  = $array[$no]['total_pembelian'];
                            $dataOutstanding->total_bayar      = $array[$no]['total_bayar'];                    
                            $dataOutstanding->tagihan          = $array[$no]['tagihan'];        
                            $dataOutstanding->save();

                            $update++;
                        }

                        if (!$dataOutstanding) {

                             $data = Outstanding::create([
                                'customer_code'    => $array[$no]['customer_code'],
                                'customer_name'    => $array[$no]['customer_name'],
                                'order_no'         => $array[$no]['order_no'],    
                                'order_date'       => $array[$no]['order_date'],     
                                'due_date'         => $array[$no]['due_date'],      
                                'keterangan'       => $array[$no]['keterangan'],     
                                'total_pembelian'  => $array[$no]['total_pembelian'],
                                'total_bayar'      => $array[$no]['total_bayar'],     
                                'tagihan'          => $array[$no]['tagihan']        
                            ]);
                            
                            $insert++;
                        }                        

                    } catch (\Exception $e) {
                        $errors[] = $e;
                    }
                    $no++;                             
                }
            }                   

        } catch (\Exception $e) {
            $errors[] = $e;
        }

        if (count($errors) > 0) {
            $status = 400;
        }

        return response()->json([
            'data'              => "Outstanding", 
            'status'            => $status, 
            'update'            => $update, 
            'insert'            => $insert,
            'total'             => ($no)." Line ".($update + $insert)." data",
            'keterangan'        => $keterangan,
            'message'           => implode("<br />", $errors)
        ], 201);
    }

    public function importOmset($request)
    {
        $fileTxt        = $request->get('file_txt');

        $file           = File::get(storage_path('app/'.$fileTxt));
        $file           = explode("\n", $file);
        $array          = array();
        $update         = 0;
        $insert         = 0;
        $no             = 0;
        $errors         = [];
        $array          = [];
        $status         = 200;
        $tahun          = 0000;
        $keterangan     = "1 Line = 6 x 3 (omset, target, potensi) / 18 Data (Jika jumlah data Terpenuhi / tidak NULL)";

        $kolom_target = array (
		
            array('length' => array(14, 14, 14, 14, 14, 14, 14, 14, 14, 15, 14, 14),   'nama' =>    'omset'   ),
            array('length' => array(14, 14, 14, 14, 14, 14, 14, 14, 14, 14, 14, 14),   'nama' =>    'target'  ),
            array('length' => array(14, 14, 14, 15, 15, 18, 14, 14, 14, 15, 14, 14),   'nama' =>    'potensi' ),			
			array('start' => 0,  'length' => 21, 'nama' =>    'customer_name'  ),
            array('start' => 21, 'length' => 5,  'nama' =>    'kelas_target'   ),
            array('start' => 26, 'length' => 14, 'nama' =>    'nominal_target' ),
            array('start' => 56, 'length' => 27, 'nama' =>    'customer_code'  ),
            array('start' => 84, 'length' => 27, 'nama' =>    'keterangan'     )
        );

        try {
            foreach ($file as $key => $line){

                if ($key == 1) { $tahun  = trim(substr($line, 31, 4)); session()->put('tahun', $tahun);}
                
                if ($key > 7  && $key < (count($file) - 15) ) {
				
                    $start  = 25;
                    $kolom0 = $kolom_target[0]['length'];
                    $kolom1 = $kolom_target[1]['length'];
                    $kolom2 = $kolom_target[2]['length'];

					if(($key + 1)%3 == 0) {
						for ($i = 3; $i < 8; $i++) {
							session()->put($kolom_target[$i]['nama'], trim(substr($line, $kolom_target[$i]['start'], $kolom_target[$i]['length'])));
					    }
					}
					
                    if(($key)%3 == 0) {
                       
                        for ($i = 0; $i < 6; $i++) {

                            $array[$i]    =  array(
                                'tahun'          => session()->get('tahun' ),
                                'bulan'          => $i + 1,
								'customer_name'  => session()->get('customer_name' ),
								'kelas_target'   => session()->get('kelas_target'  ),
								'nominal_target' => (int)str_replace('.', '', session()->get('nominal_target')),
								'customer_code'  => session()->get('customer_code' ),
								'keterangan'     => "-",
                                $kolom_target[0]['nama'] => (int)str_replace('.', '', trim(substr($line, $start, $kolom0[$i]))),
                                $kolom_target[1]['nama'] => (int)str_replace('.', '', trim(substr($line, ($start + $kolom0[$i]) , $kolom1[$i]))),
                                $kolom_target[2]['nama'] => (int)str_replace('.', '', trim(substr($line, ($start + $kolom0[$i] + $kolom1[$i]), $kolom2[$i]))) 
                             );
                                         
                            $start = ($kolom0[$i] + $kolom1[$i] + $kolom2[$i]  + $start);
                            session()->put('start' , $start);

                            if ($array[$i][$kolom_target[0]['nama']] + $array[$i][$kolom_target[1]['nama']] + $array[$i][$kolom_target[2]['nama']] < 1 && $i < 5) {

                                unset($array[$i]);
                            } else {

                                $getData = Omset::where('tahun', $array[$i]['tahun'])
                                    ->where('bulan', $array[$i]['bulan'])
                                    ->where('customer_code', $array[$i]['customer_code'])
                                    ->first();

                                if ($getData && $i < 5) {
                                        
                                    $getData->omset   = $array[$i]['omset'];
                                    $getData->target  = $array[$i]['target'];
                                    $getData->potensi = $array[$i]['potensi'];
                                    $getData->save();
                                    unset($array[$i]);
                                    $update++;
                                }

                                if (!$getData && $i < 5) {

                                    Omset::insert($array);
                                    unset($array[$i]);
                                    $insert++;
                                }
                            }                            
                        }
                    }

                    if(($key - 1)%3 == 0 && $no > 0) {
                        
                        $start = session()->get('start');
                        $array[5]['potensi'] = (int)str_replace('.', '',trim(substr($line, ($start - 24), 14)));

                        if ($array[5]['omset'] + $array[5]['target'] + $array[5]['potensi'] == 0) { 
                            
                            unset($array[5]); 

                        } else {

                            $getData = Omset::where('tahun', $array[5]['tahun'])
                                    ->where('bulan', $array[5]['bulan'])
                                    ->where('customer_code', $array[5]['customer_code'])
                                    ->first();

                            if ($getData) {

                                $getData->omset   = $array[5]['omset'];
                                $getData->target  = $array[5]['target'];
                                $getData->potensi = $array[5]['potensi'];
                                $getData->save();
                                unset($array[5]);
                                $update++;
                            } 

                            if (!$getData) {

                                Omset::insert($array);
                                unset($array[5]);
                                $insert++;
                            }
                        }
                       
                        for ($i = 6; $i < 12; $i++) {

                            $array[$i]    =  array(  
                                'tahun'          => session()->get('tahun'),
                                'bulan'          => $i + 1,
								'customer_name'  => session()->get('customer_name' ),
								'kelas_target'   => session()->get('kelas_target'  ),
								'nominal_target' => (int)str_replace('.', '', session()->get('nominal_target')),
								'customer_code'  => session()->get('customer_code' ),
								'keterangan'     => "-",
                                $kolom_target[0]['nama'] => (int)str_replace('.', '', trim(substr($line, $start, $kolom0[$i]))),
                                $kolom_target[1]['nama'] => (int)str_replace('.', '', trim(substr($line, ($start + $kolom0[$i]) , $kolom1[$i]))),
                                $kolom_target[2]['nama'] => (int)str_replace('.', '', trim(substr($line, ($start + $kolom0[$i] + $kolom1[$i]), $kolom2[$i]))) 
                             );
                        
                            $start = ($kolom0[$i] + $kolom1[$i] + $kolom2[$i]  + $start);
                            
                              
                            if ($array[$i][$kolom_target[0]['nama']] + $array[$i][$kolom_target[1]['nama']] + $array[$i][$kolom_target[2]['nama']] < 1 ) {

                                unset($array[$i]);
                            } else {

                                $getData = Omset::where('tahun', $array[$i]['tahun'])
                                    ->where('bulan', $array[$i]['bulan'])
                                    ->where('customer_code', $array[$i]['customer_code'])
                                    ->first();

                                if ($getData) {

                                    $getData->omset   = $array[$i]['omset'];
                                    $getData->target  = $array[$i]['target'];
                                    $getData->potensi = $array[$i]['potensi'];
                                    $getData->save();    
                                    unset($array[$i]);
                                    $update++;
                                }

                                if (!$getData) {

                                    Omset::insert($array);
                                    unset($array[$i]);
                                    $insert++;
                                }
                            }                            
                        }
                    }                              
                    $no++;                            
                }               
            }             
        } catch (\Exception $e) {
            $errors[] = $e;
        }

        if (count($errors) > 0) {
            $status = 400;
        }

        return response()->json([
            'data'              => "Omset", 
            'status'            => $status, 
            'update'            => $update, 
            'insert'            => $insert,
            'total'             => ($no -1)." Line ".($insert + $update)." data",
            'keterangan'        => $keterangan,
            'message'           => implode("<br />", $errors)
        ], 201);
    }

    public function importKategori($request)
    {
        $fileTxt        = $request->get('file_txt');

        $file           = File::get(storage_path('app/'.$fileTxt));
        $file           = explode("\n", $file);
        $array          = array();
        $update         = 0;
        $insert         = 0;
        $no             = 0;
        $errors         = [];
        $array          = [];
        $status         = 200;
        $keterangan     = "-";

        $kolom = array (
			
			array('start' => 31, 'length' => 13, 'nama' =>    'code'  ),
            array('start' => 43, 'length'  => 21,  'nama' =>    'type'   ),
            array('start' => 64, 'length'  => 23,  'nama' =>    'brand'   )
        );

        try {
            foreach ($file as $key => $line){

                $kategoriLabel  = trim(substr($line, 0, 8));
                $kategori       = trim(substr($line, 10, 10));

                if ($kategoriLabel == 'Kategori') { session()->put('kategori', $kategori); }

                if ((int)trim(substr($line, 0, 5)) != 0 ) {

                    $array['kategori'] = session()->get('kategori');

                    foreach ($kolom as $index => $col) { 

                        $array[$col['nama']] =  trim(substr($line, $col['start'], $col['length']));
                    }

                    $getKategori = ProductGroups::where('code', $array['kategori'])->first();
                    
                    if (!$getKategori) { 
                        $getKategori = ProductGroups::create([ 'code' => $array['kategori'], 'name' => $array['kategori'] ]); 
                        $insert++;
                    }

                    $getBarang = Product::where('code', $array['code'])->first();

                    if ($getBarang) {

                        if ($getBarang->product_group_id != $getKategori->id) {

                            $getUpdate = ProductGroups::find($getBarang->product_group_id);
                            $getUpdate->total_barang = $getUpdate->total_barang -1;
                            $getUpdate->save();

                            $getBarang->product_group_id = $getKategori->id; 
                            $getBarang->save();

                            $update++;
                        }                       

                        $dataTotal = Product::where('product_group_id', $getKategori->id)->count();                        
                        $getKategori->total_barang = $dataTotal;
                        $getKategori->save();
                    }

                }  
                $no++;             
            }  

        } catch (\Exception $e) {
            $errors[] = $e;
        }        

        if (count($errors) > 0) {
            $status = 400;
        }

        return response()->json([
            'data'              => "Omset", 
            'status'            => $status, 
            'update'            => $update, 
            'insert'            => $insert,
            'total'             => ($no)." Line ",
            'keterangan'        => $keterangan,
            'message'           => implode("<br />", $errors)
        ], 201);
    }

    public function sample(Request $request)
    {
        $sample = '';
        $get    = $request->get('req');
        $type   = $request->get('type');

        if ($get == 'omset')            { $sample = 'a-sample-file-omset.txt';}
        if ($get == 'product_groups')   { $sample = 'a-sample-kategori.txt'; }
        if ($get == 'products')         { $sample = 'a-sample-cost-control.txt';}
        if ($get == 'customers')        { $sample = 'a-sample-pelanggan.txt'; }
        if ($get == 'outstanding')      { $sample = 'a-sample-outstanding.txt';}

        $file = storage_path('app/').$type.'/'.$sample;
        $file = File::get($file);

        return response()->json(['file' => $file, 'filename' => $sample], 200);
    }

    /**
     * Upload TXT file
     *
     * @param Request $request
     *
     * @return json
     */
    public function upload(Request $request)
    {

        $data = $request->validate( ['file0' => 'required|mimes:txt']);

        if (!$data) {
            return response()->json(['status' => 401 ], 201);
         }

        $filePath = $request->file('file0')->store('txt');

        // Read txt
        $file       = '/storage/app/' . $filePath;
        $file       = File::get(storage_path('app/'.$filePath));
        $fileEX     = explode("\n", $file);
        $tanggal    = "";

        for ($i = 0; $i < 6; $i++) {
            
            $pattern     = preg_quote('Tanggal', '/'); $pattern     = "/^.*$pattern.*\$/m";
            if(preg_match_all($pattern, $fileEX[$i], $matches) && $i < 4){
                $tanggal  = substr($fileEX[$i], 0, 32);
            }

            $pattern     = preg_quote('Tgl', '/'); $pattern     = "/^.*$pattern.*\$/m";
            if(preg_match_all($pattern, $fileEX[$i], $matches) && $i < 4){
                $tanggal  = substr($fileEX[$i], 0, 32);               
            }

            $pattern     = preg_quote('THN', '/'); $pattern     = "/^.*$pattern.*\$/m";
            if(preg_match_all($pattern, $fileEX[$i], $matches) && $i < 4){
                $tanggal  = substr($fileEX[$i], 26, 10);               
            }

        }

        $modul       = '';
        $judul       = '';

        $data = array( 
            '1' => array('customers', 'DAFTAR PELANGGAN'),
            '2' => array('products', 'DAFTAR SALDO DAN HARGA BARANG'),
            '3' => array('outstanding', 'LAPORAN STATUS FAKTUR PELANGGAN'),
            '4' => array('omset', 'LAPORAN OMZET PELANGGAN'),
            '5' => array('product_groups', 'LAPORAN STATUS UNIT BARANG per PELANGGAN MONTHLY')
        );
        
        for ($i = 1; $i <= count($data); $i++) {
            
                $pattern     = preg_quote($data[$i][1], '/');
                $pattern     = "/^.*$pattern.*\$/m";
        
                if(preg_match_all($pattern, $file, $matches)) {
                    //$modul = $matches[0];
                    $modul   = $data[$i][0];
                    $judul   = $data[$i][1];
                }
        
        }

        

        return response()->json(['location' => $filePath, 'tanggal' => $tanggal, 'judul' => $judul, 'modul' => $modul ], 200);
        
    }

}
