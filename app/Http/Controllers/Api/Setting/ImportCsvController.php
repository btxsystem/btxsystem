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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\System\Module;
use App\Models\Settings\StatusInvoice;
use App\Models\Area\DivisiPenjualan;
use App\Models\Penjualan\DirectInvoice;
use App\Models\Penjualan\DirectInvoiceDetails;
use App\Models\Penjualan\SalesOrders;
use App\Models\Penjualan\SalesOrderDetails;
use App\Models\Inventory\Locations;
use App\Models\Sales\Sales;
use App\Models\Customer\Customers;
use App\Models\Customer\CustomerOwners;
use App\Models\Inventory\Product;
use App\Models\Inventory\TipeProduct;
use App\Models\Inventory\ProductBrands;
use App\Models\Inventory\ProductUnits;
use App\Models\Inventory\ProductGroups;
use App\Models\Keuangan\Giro;
use File;
use Validator;

/**
 * Module Import Csv
 *
 * Module to manage Import Csv
 *
 * Table : Any
 *
 * @category Controller
 * @package  App\Http\Controllers\Api\Setting
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */
class ImportCsvController extends Controller
{
    private $permission = "Setting.ImportCsv.";

    /**
     * Return Name Of Table In Table Module
     *
     * @return json
     */
    public function getTable(Request $request)
    {
        $request->user()->hasPermission($this->permission.'View');

        $list = Module::whereIn('id', array(27,28,29))->get();

        return response()->json(['data' => $list], 200);
    }

    /**
     * Create a new Import Data
     *
     * @return json
     */
    public function store(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'Create');
        $res = '';

        if ($request->get('module_name') == 'direct_invoice') 
        { $res = $this->importInvoice($request); }

        else if ($request->get('module_name') == 'direct_invoice_details') 
        { $res = $this->importInvoiceDetail($request); }

        else if ($request->get('module_name') == 'giro') 
        { $res = $this->importGiro($request); }

        return $res;
    }


    /**
     * Import Invoice Product
     *
     * @param Array $request location file / file path
     * @return void
     */
    public function importInvoice($request) 
    {
        $input      = $request->all();
        $file       = $input['location'];
        $insert     = 0;
        $update     = 0;
        $total      = 0;  session()->put('total', 0);
        $errors     = []; 
        $insert     = 0;  session()->put('insert', 0); 
        $update     = 0;  session()->put('update', 0);

        $get = Excel::load($file, function($doc) use ($input, $insert, $update, $errors) {

            $sheet      = $doc->getSheet(0);//
            $totalRow   = $sheet->getHighestRow();
            $totalCol   = $sheet->getHighestColumn();
            $totalDim   = $sheet->calculateWorksheetDimension();
            $tes        = $sheet->getCell('N2')->getValue();           
            $lengthCol  = $this->conV($totalCol);
            $dataInput    = [];
            $getHeader    = [];        

            for ($qj=1; $qj <= $totalRow; $qj++) {

                $cekKodePelanggan   = trim($sheet->getCell('A'.$qj)->getValue());
                $cekNik             = trim($sheet->getCell('E'.$qj)->getValue());
                $cekFaktur          = trim($sheet->getCell('M'.$qj)->getValue());
                $cekSO              = trim($sheet->getCell('G'.$qj)->getValue());
                $getCell            = $this->conV2($qj);
                $getHeader          = [];
                $colInvoice         = DB::getSchemaBuilder()->getColumnListing('direct_invoice');
                $dataInvoice        = [];
                $colSO              = DB::getSchemaBuilder()->getColumnListing('sales_orders');
                $dataSO             = [];
                $colStatus          = DB::getSchemaBuilder()->getColumnListing('status_invoice');
                $dataStatus         = [];

                // if ($cekKodePelanggan != ""  && $cekNik != "" && $cekFaktur != "" && $qj != 1) {
                if ($cekKodePelanggan != ""  && $qj != 1) {                   

                    for ($i=0; $i < $lengthCol; $i++) {

                        $ftanggal       = substr(trim($sheet->getCell($this->conV2($i+1).'1')->getValue()), 0, 3);
                        $cekIsi         = trim($sheet->getCell($this->conV2($i+1).$qj)->getValue());
                        $getData        = "";

                        if ($ftanggal == "Tgl" && $cekIsi != "") {
                            $getData    =   $this->tglConv(trim($sheet->getCell($this->conV2($i+1).($qj))->getCalculatedValue()));
                        } else {
                            $getData    =  trim($sheet->getCell($this->conV2($i+1).($qj))->getCalculatedValue());
                            if (!$getData) {
                                $getData    = trim($sheet->getCell($this->conV2($i+1).($qj))->getValue());
                            }
                        }

                        
                        $index              = $this->rowInvoce(trim($sheet->getCell($this->conV2($i+1).'1')->getValue()));
                        $getHeader[$index]  = $getData;

                        if ($index == "id") { $getHeader['no_faktur'] = $getData; }
                        if ($index == "trx_no") { $getHeader['no_so'] = $getData; }
                        if ($index == "due_date") { $getHeader['tgl_jatuh_tempo'] = $getData; }
                        if ($index == "payment_total") { $getHeader['grand_total'] = $getData; }
                        
                        if ($index == "customer_name") {

                            $getCustomer = Customers::where('code', $getHeader['customer_code'])->first();
                            
                            if ($getCustomer) {

                                $getOwner = CustomerOwners::find($getCustomer->customer_owner_id);

                                if ($getOwner) {

                                    $getHeader['customer_id'] = $getCustomer->id;

                                } else {

                                    $id = CustomerOwners::create(['name'  => $getData]); 

                                    $getId = Customers::create([     
                                        'customer_owner_id' => $id->id,
                                        'code'              => $getHeader['customer_code'],
                                        'name'              => $getData
                                    ]);

                                    $getHeader['customer_id'] = $getId->id;
                                }                          
    
                            } else if ($getHeader['customer_code']) {

                                $id = CustomerOwners::create(['name'  => $getData]); 

                                $getId = Customers::create([     
                                    'customer_owner_id' => $id->id,
                                    'code'              => $getHeader['customer_code'],
                                    'name'              => $getData
                                ]);

                                $getHeader['customer_id'] = $getId->id;
                            }                             
                        }

                        if ($index == "divisi" ) { 
                            
                            $getDivisi = DivisiPenjualan::where('code', $getData)->first();
                            
                            if ($getDivisi) {
                                
                                if ($getDivisi->perusahaan_id) {
                                    $getHeader['perusahaan_id'] = $getDivisi->perusahaan_id;
                                    $getHeader['cabang_id']     = $getDivisi->cabang_id;
                                }
                                
                                $getLokasi = Locations::where('perusahaan_id', $getDivisi->perusahaan_id)->first();
                                
                                if ($getLokasi) {
                                    $getHeader['location_id'] = $getLokasi->id;
                                    $getHeader['location_code'] = $getLokasi->code;
                                    $getHeader['location_name'] = $getLokasi->name;
                                }
                                unset($getHeader[$index]);
                            } else {

                                $getDivisi = DivisiPenjualan::create([
                                    'code' => $getData,
                                    'name' => $getData
                                ]);

                                $getHeader['perusahaan_id'] = $getDivisi->perusahaan_id;
                                $getHeader['cabang_id']     = $getDivisi->cabang_id;

                                unset($getHeader[$index]);
                            }                        
                        }

                        if ($index == "tipe_bayar" ) { 
                           if($getHeader[$index] ==  'TRF') { $getHeader['payment_mode'] = 2; }
                           if($getHeader[$index] ==  'GRO') { $getHeader['payment_mode'] = 3; }
                           if($getHeader[$index] ==  'CBD') { $getHeader['payment_mode'] = 1; }
                        }

                        if ($index == "due_date" ) { $getHeader['expired_date'] = $getData;}  

                        $getHeader['delivery_status'] = 1;
                        
                        if ($index == "tgl_sudah_kirim" &&  $getHeader['tgl_sudah_kirim'] !== '') { 
                            $getHeader['delivery_status'] = 3;
                        }  

                        $getHeader['payment_status'] = 1 ;

                        if ($index == "tgl_terima_lunas" && $getHeader['tgl_terima_lunas'] !== '') { 
                            $getHeader['payment_status'] = 3;
                        }               

                        if ($index == "nik" ) { $getHeader[$index] = $getData; }

                        if ($index == "sales_name") {
                            
                            if (!$getHeader['nik']) { $getHeader['nik'] = $getData; }

                            $getSales = Sales::where('nik', $getHeader['nik'])->first();

                            if ($getSales) {
                                $getHeader['sales_id']      = $getSales->id;
                                $getHeader['sales_code']    = $getSales->code;

                            } else if ($getHeader['nik']) {

                                $getSales = Sales::create([
                                    'nik'   => $getHeader['nik'],
                                    'code'  => $getData,
                                    'name'  => $getData
                                ]);

                                $getHeader['sales_id']      = $getSales->id;
                                $getHeader['sales_code']    = $getSales->code;
                            }
                        }
                    } 


                    unset($getHeader[0]);
                    
                    if ($getHeader['id'] != "") {

                        $colStatus = array(
                            'status_bukti_so', 
                            'status_ex_so', 
                            'keterangan_pending', 
                            'tgl_faktur_jadi', 
                            'tgl_picked', 
                            'tgl_checked', 
                            'tgl_siap_kirim', 
                            'no_siap_kirim', 
                            'tgl_sudah_kirim', 
                            'no_sudah_kirim', 
                            'tgl_status_order', 
                            'status_order', 
                            'tgl_terima_lunas', 
                            'telat', 
                            'bukti_terima_lunas'
                        );

                        foreach ($getHeader as $key => $value) {

                            
                            $cekColInvoice = in_array($key, $colInvoice);
                            if ($cekColInvoice && $value != "") { $dataInvoice[$key] = $value; }                            
                            
                            $cekColStatus = in_array($key, $colStatus);                          
                            

                            if ($cekColStatus && $value !== "") { 

                                $masuk  = 0;
                                $tgl    = null;

                                if ($key == 'status_bukti_so' || $key == 'status_ex_so' || $key == 'keterangan_pending' || $key == 'telat') {
                                    $masuk = 1;

                                    if ($value == '0') { $masuk = 0; }
                                }

                                if (strpos($key, 'tgl') !== false) {
                                   $tgl = $value;  $value = null;
                                } 

                                if ( $key == 'tgl_siap_kirim') {
                                    $value = trim($sheet->getCell('T'.$qj)->getValue()); $masuk = 1;
                                }

                                if ( $key == 'tgl_sudah_kirim') {
                                    $value = trim($sheet->getCell('V'.$qj)->getValue()); $masuk = 1;
                                } 
                                
                                if ( $key == 'tgl_status_order') {
                                    $value = trim($sheet->getCell('X'.$qj)->getValue()); $masuk = 1;
                                }

                                if ( $key == 'tgl_terima_lunas') {
                                    $value = trim($sheet->getCell('AB'.$qj)->getValue()); $masuk = 1;
                                }                                
                                
                                $dataStatus = array(
                                    'no_faktur'     =>  $getHeader['no_faktur'],
                                    'no_so'         =>  $getHeader['no_so'],
                                    'label'         =>  str_replace('_',' ',str_replace('.',' ',str_replace('tgl_','',$key))),
                                    'tanggal'       =>  $tgl,
                                    'keterangan'    =>  $value
                                );
                            

                                if ($masuk == 1) {
                                    try {
                                        $cekSts = StatusInvoice::where('no_faktur', $dataStatus['no_faktur'])->where('label', $dataStatus['label'])->first();
                                        if (!$cekSts) {  $cekSts = StatusInvoice::where('no_so', $dataStatus['no_so'])->where('label', $dataStatus['label'])->first(); }
                                        if ($cekSts) { $cekSts->update($dataStatus); }
                                        else { StatusInvoice::create($dataStatus); }    
                                    } catch (\Exception $e) {
                                        $errors[] = "Status Invoice Row {$qj} : Gagal di Import";           
                                    }       
                                }
                            }
                        }
                        unset($dataStatus['id']);
                    }

                    if ($dataInvoice) {
                        try {
                            $cek = DirectInvoice::find($dataInvoice['id']);
                            if ($cek) { 
                                $cek->update($dataInvoice); 
                                $update++;
                            } else {
                                DirectInvoice::create($dataInvoice); 
                                $insert++;
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Invoice Row {$qj} : Gagal di Import";                          
                        }                        
                                         
                    }

                    $dataStatus = [];

                    if ($getHeader['trx_no'] != "") {

                        foreach ($getHeader as $key => $value) {

                            $cekColSO = in_array($key, $colSO);
                            if ($cekColSO && $value != "") { $dataSO[$key] = $value; }

                            $cekColStatus = in_array($key, $colStatus);
                            if ($cekColStatus && $value != "") { $dataStatus[$key] = $value; }
                        }

                        $dataSO['id'] = $getHeader['trx_no'];
                    }

                                  

                    if ($dataSO) {
                        
                        try {
                            $cek = SalesOrders::find($dataSO['id']);
                            if ($cek) { 
                                $cek->update($dataSO); 
                                $update++;
                            } else {
                                SalesOrders::create($dataSO);                                 
                                $insert++;
                            }
                        } catch (\Exception $e) {
                            $errors[] = "SO Row {$qj}: Gagal di Import";                          
                        }                       
                           
                    }

                    $err = implode("<br />",$errors);
                    session()->put('total', $qj-1);          
                    session()->put('insert', $insert); 
                    session()->put('update', $update);
                    session()->put('errors', $err); 
                }
            }

        });//->toArray();


        // exit;

        return response()->json([
            "status"  => 200,
            "total"   => session()->get('total').' Row Data',
            "insert"  => session()->get('insert'),
            'update'  => session()->get('update'),
            'message' => session()->get('errors')
        ], 201);  
    }

    /**
     * Import Invoice Product Detail
     *
     * @param  $request location file / file Path
     * @return json
     */
    public function importInvoiceDetail($request) 
    {
        $input      = $request->all();
        $file       = $input['location'];
        $total      = 0; session()->put('total', 0);
        $errors     = []; session()->put('errors', '');
        $insert     = 0;  session()->put('insert', 0); 
        $update     = 0;  session()->put('update', 0); 

        $get = Excel::load($file, function($doc) use ($input, $insert, $update, $errors, $total) {

            $sheet          = $doc->getSheet(0);//
            $totalRow       = $sheet->getHighestRow();
            $totalCol       = $sheet->getHighestColumn();
            $totalDim       = $sheet->calculateWorksheetDimension();
            $tes            = $sheet->getCell('B2')->getValue();           
            $lengthCol      = $this->conV($totalCol);
            $dataInput      = [];
            $getHeader      = [];
            $colInDt        = DB::getSchemaBuilder()->getColumnListing('direct_invoice_details');
            $dataInDt       = [];
            $colSOd         = DB::getSchemaBuilder()->getColumnListing('sales_order_details');
            $dataSOd        = [];      

            for ($qj=1; $qj < $totalRow; $qj++) {

                $cekNoSO   = trim($sheet->getCell('A'.$qj)->getValue());
                $cekFaktur = trim($sheet->getCell('B'.$qj)->getValue());

                if ($qj != 1) {

                    for ($i=0; $i < $lengthCol; $i++) {
                        $getData            = "";
                        $getData            =  trim($sheet->getCell($this->conV2($i+1).($qj))->getCalculatedValue());

                        if (!$getData) {
                            $getData        = trim($sheet->getCell($this->conV2($i+1).($qj))->getValue());
                        }                       

                        $index              = $this->rowInvoceDetail(trim($sheet->getCell($this->conV2($i+1).'1')->getValue()));
                        if ($index != "") { $getHeader[$index]  = $getData; }                                                                      
                    } 

                   
                    
                    $getBarang = Product::where('code', $getHeader['product_code'])->first();

                    if (!$getBarang) { 

                        $getTipe =  TipeProduct::where('name', $getHeader['ty.barang'])->first();
                        $getMerk =  ProductBrands::where('name', $getHeader['mr.barang'])->first();

                        if (!$getTipe) { 
                            $getTipe =  TipeProduct::create(['name' => $getHeader['ty.barang'], 'code' => $getHeader['ty.barang'] ]);
                        } 

                        if (!$getMerk) {
                            $getMerk =  ProductBrands::create(['name' => $getHeader['mr.barang'], 'code' => $getHeader['mr.barang'] ]);
                        }

                        $getBarang = Product::create([
                            'code'                      => $getHeader['product_code'],
                            'name'                      => $getHeader['product_name'],
                            'product_type_id'           => $getTipe->id,
                            'product_brand_id'          => $getMerk->id,
                            'unit_id'                   => 13,
                            'product_group_id'          => 14
                        ]);                       
                    }

                    $getUnit = ProductUnits::find($getBarang->unit_id);

                    if ($getUnit) { $getHeader['product_unit'] = $getUnit->name; }

                    $getHeader['product_category_id'] = $getBarang->product_group_id;
                    $getHeader['product_id'] = $getBarang->id;

                    unset($getHeader[0]);                                    

                    foreach ($getHeader as $key => $value) {
                        $cekColInDt = in_array($key, $colInDt);
                        if ($cekColInDt && $value != "") { $dataInDt[$key] = $value; }

                        $cekColSOd = in_array($key, $colSOd);
                        if ($cekColSOd && $value != "") { $dataSOd[$key] = $value; }
                    }

                   
                    $cekMaster =  DirectInvoice::find($getHeader['direct_invoice_id']); 
                     
                    if ($cekMaster) {

                        $cek1 = DirectInvoiceDetails::where('direct_invoice_id', $cekMaster->id)
                        ->where('product_code', $dataInDt['product_code'])->first();
                       
                        try {

                            if ($cek1) { 
                                $dataUp = $cek1->update($dataInDt);
                                $update++;                                
                            } else {
                                $dataIn = DirectInvoiceDetails::create($dataInDt);                                
                                if ($dataIn) { $insert++;}
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Row Invoice Detail {$qj} : Gagal di Import";                            
                            
                        }                      
                        
                    }

                    $cekMaster2 =  SalesOrders::find($getHeader['trx_no']);                  

                    if ($cekMaster2) {

                        $cek2 = SalesOrderDetails::where('sales_order_id', $cekMaster2->id)
                        ->where('product_code', $dataSOd['product_code'])->first();                    

                        try {

                            if ($cek2) { 
                                $cek2->update($dataSOd);
                                $update++;
                                
                            } else {
                                // $cekMaster2->salesorderdetails()->attach($dataSOd);
                                $dataSOd['sales_order_id'] = $cekMaster2->id;
                                SalesOrderDetails::create($dataSOd);
                                $insert++;
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Row  SO Detail {$qj} : Gagal di Import";                            
                            
                        }                      
                        
                    }
                }  $total++;
            } 

            $err = implode("<br />",$errors);          
            session()->put('total', $total." Row"); 
            session()->put('insert', $insert); 
            session()->put('update', $update);
            session()->put('errors', $err); 
        });//->toArray();

        return response()->json([
            "status"  => 200,
            "total"   => session()->get('total'),
            "insert"  => session()->get('insert'),
            'update'  => session()->get('update'),
            'message' => session()->get('errors')
        ], 201);   

    }

    /**
     * Import Data Giro
     *
     * @param  $request location File / File Path
     * @return Json
     */
    public function importGiro($request) 
    {
        $input      = $request->all();
        $file       = $input['location'];
        $total      = 0; session()->put('total', 0);
        $errors     = []; session()->put('errors', '');
        $insert     = 0;  session()->put('insert', 0); 
        $update     = 0;  session()->put('update', 0); 

        $get = Excel::load($file, function($doc) use ($input, $insert, $update, $errors, $total) {

            $sheet          = $doc->getSheet(0);//
            $totalRow       = $sheet->getHighestRow();
            $totalCol       = $sheet->getHighestColumn();
            $totalDim       = $sheet->calculateWorksheetDimension();
            $tes            = $sheet->getCell('B2')->getValue();           
            $lengthCol      = $this->conV($totalCol);
            $dataInput      = [];
            $getHeader      = [];
            $colGiro        = DB::getSchemaBuilder()->getColumnListing('giro');
            $dataInDt       = [];

            for ($qj=1; $qj <= $totalRow; $qj++) {

                if ($qj != 1) {

                    $getHeader = []; 

                    for ($i=0; $i < $lengthCol; $i++) {

                        $getData   = "";                                            
                        
                        $ftanggal  = substr(trim($sheet->getCell($this->conV2($i+1).'1')->getValue()), 0, 3);

                        if ($ftanggal == "Tgl") {
                            $data       = [];
                            $getData    =  trim($sheet->getCell($this->conV2($i+1).($qj))->getCalculatedValue());                                       
                            $data       =  explode('/', $getData);

                            if (count($data) == 3 && (int)$data[0] > 0) {
                                if ($data[0] < 10) { $data[0] = '0'.$data[0]; }
                                if ($data[1] < 10) { $data[1] = '0'.$data[1]; }
                                $getData = $data[2].'-'.$data[1].'-'.$data[0];                               
                            } else {
                                $getData = ""; 
                            }
                             
                        } else {

                            $getData   =  trim($sheet->getCell($this->conV2($i+1).($qj))->getCalculatedValue());
                            if (!$getData) {
                                $getData    = trim($sheet->getCell($this->conV2($i+1).($qj))->getValue());
                            }  
                        }                     

                        $index              = $this->rowGiro(trim($sheet->getCell($this->conV2($i+1).'1')->getValue()));
                        if ($index != "" && $getData != "") { $getHeader[$index]  = $getData; }                                                                      
                    }
                                        
                    $dataE = explode('.', $getHeader['nilai_cek']);
                    $cnt   = count($dataE);

                    $dataBaru = [];

                    for ($i=0; $i < $cnt; $i++) {
                        $dataBaru[$i] = $dataE[$i];
                    }

                    if (strlen($dataE[$cnt-1]) != 3) { 
                        $dataBaru[$cnt-1] = number_format('0.'.$dataE[$cnt-1], 2); 

                        $dataBaru[$cnt-1] = str_replace("0", "", $dataBaru[$cnt-1]);

                    }

                    $getHeader['nilai_cek'] = implode($dataBaru);               
                   

                    try {

                        $cekData = Giro::where('no_cek', $getHeader['no_cek'])->first();

                        if ($cekData) { 
                            $cekData->update($getHeader);
                            $update++;
                            
                        } else {
                            Giro::create($getHeader);
                            $insert++;
                        }
                    } catch (\Exception $e) {
                        $errors[] = "Row {$qj} : Gagal di Import";  
                            
                    }  
                      

                }  $total++;
            } 

            $err = implode("<br />",$errors);          
            session()->put('total', $total." Row"); 
            session()->put('insert', $insert); 
            session()->put('update', $update);
            session()->put('errors', $err); 
        });//->toArray();

        return response()->json([
            "status"  => 200,
            "total"   => session()->get('total'),
            "insert"  => session()->get('insert'),
            'update'  => session()->get('update'),
            'message' => session()->get('errors')
        ], 201);   

    }

    /**
     * Parameter Header Csv Ke Header Tabel Invoice dan Tabel Status
     *
     * @param  $input String
     * @return String
     */
    public function rowInvoce($input) {

        $data = "";
        $input = strtolower($input);
        $rowData    = array(
            'kode.plg'          => "customer_code",         'tgl.faktur.jadi'   => "tgl_faktur_jadi",
            'nama.plg'          => "customer_name",         'tgl.picked'        => "tgl_picked",
            'divisi'            => "divisi",                'tgl.checked'       => "tgl_checked",  
            'nama.spv'          => "0",                     'tgl.siap.krm'      => "tgl_siap_kirim",   
            'nik'               => "nik",                   'no.siap.krm'       => "no_siap_kirim", 
            'nama.slm'          => "sales_name",            'tgl.sdh.krm'       => "tgl_sudah_kirim", 
            'no.so'             => "trx_no",                'no.sdh.krm'        => "no_sudah_kirim",       
            'tgl.so'            => "trx_date",              'tgl.sts.o'         => "tgl_status_order", 
            'nilai.so'          => "payment_total",         'status.o'          => "status_order",     
            'sts.bkt.so'        => "status_bukti_so",       'tgl.jtt'           => "due_date",       
            'sts.exp.so'        => "status_ex_so",          'metode.byr'        => "tipe_bayar",        
            'ket.pending'       => "keterangan_pending",    'telat'             => "telat",        
            'no.faktur'         => "id",                    'bkt.trm.lns'       => "bukti_terima_lunas",    
            'tgl.faktur'        => "order_date",            'tgl.trm.lns'       => "tgl_terima_lunas",     
            'nilai.faktur'      => "payment_total"     
              
        );

        $cek = array_key_exists( $input, $rowData);
        if ($cek) { $data = $rowData[$input] ;}    if ($data == $input){ $data = $input; }
       
        return $data;
    }

    /**
     * Parameter Header Csv Ke Header Tabel Invoice  Detail
     *
     * @param  $input string
     * @return String
     */
    public function rowInvoceDetail($input) {

        $data = "";
        $input = strtolower($input);
        $rowData    = array(
            "no.so"     => "trx_no",        
            "no.faktur" => "direct_invoice_id",    
            "no.part"   => "product_code",      
            "nm.barang" => "product_name",    
            "ty.barang" => "ty.barang",    
            "mr.barang" => "mr.barang",    
            "jumlah"    => "qty_ordered"                    
              
        );

        $cek = array_key_exists( $input, $rowData);
        if ($cek) { $data = $rowData[$input] ;}    if ($data == $input){ $data = $input; }
       
        return $data;
    }

    /**
     * Parameter Header Csv Ke Header Tabel Giro
     *
     * @param $input String
     * @return String
     */
    public function rowGiro($input) {

        $data = "";
        $input = strtolower($input);
        $rowData    = array(
            "nocek"         => 'no_cek',
            "noac"          => 'no_account',
            "namabank"      => 'nama_bank',
            "kotabank"      => 'kota_bank',
            "kt"            => 'keterangan',
            "pelanggan"     => 'pelanggan',
            "tglcek"        => 'tanggal_cek',
            "tgljtt"        => 'tanggal_jatuh_tempo',
            "sts"           => 'status',
            "nilcek"        => 'nilai_cek',
            "tglcair"       => 'tanggal_cair',
            "sales"         => 'sales',
            "tglbayar"      => 'tanggal_bayar'            
        );

        $cek = array_key_exists( $input, $rowData);
        if ($cek) { $data = $rowData[$input] ;}    if ($data == $input){ $data = $input; }
       
        return $data;
    }

    /**
     * Conversi Dari format Tanggal Di Csv Ke Format Tanggal Mysql / YYYY-MM-DD
     *
     * @param [type] $input
     * @return void
     */
    public function tglConv($input) {
        $newDate = "";
        if ($input != $newDate) { $arr = explode('/', $input);            
            $newDate = $arr[2].'-'.$arr[1].'-'.$arr[0];
        }
        return $newDate;
    }

    /**
     * Conversi Huruf / Row Di Excel Ke Angka Untuk Mendapatkan panjang Baris / Row Yang Terisi Data
     *
     * @param  $input String
     * @return Number
     */
    public function conV($input) {
        $dataC = array(
            'A' => 1,  'N' => 14,
            'B' => 2,  'O' => 15,
            'C' => 3,  'P' => 16,
            'D' => 4,  'Q' => 17,
            'E' => 5,  'R' => 18,
            'F' => 6,  'S' => 19,
            'G' => 7,  'T' => 20,
            'H' => 8,  'U' => 21, 
            'I' => 9,  'V' => 22,
            'J' => 10, 'W' => 23,
            'K' => 11, 'X' => 24,
            'L' => 12, 'Y' => 25,
            'M' => 13, 'Z' => 26 
        );
        
        $nx  = strlen($input);  
        $n1  = trim(substr($input, 0, 1));
        $n2  = trim(substr($input, 1, 1));
        $get = 0;

        if ($nx == 1) {  $get = $dataC[$n1]; } 
        else if ($nx == 2) { $get = 26 + $dataC[$n2]; }
        return $get;
    }

    /**
     * Conversi Angka / Row Di Excel Ke Huruf Untuk Mendapatkan Lokasi Data / Cell Pada Excel
     *
     * @param  $input Number
     * @return String
     */
    public function conV2($input) {
        $dataC = array(
            '1'  => 'A' ,'14' => 'N' ,
            '2'  => 'B' ,'15' => 'O' , 
            '3'  => 'C' ,'16' => 'P' , 
            '4'  => 'D' ,'17' => 'Q' , 
            '5'  => 'E' ,'18' => 'R' , 
            '6'  => 'F' ,'19' => 'S' , 
            '7'  => 'G' ,'20' => 'T' , 
            '8'  => 'H' ,'21' => 'U' , 
            '9'  => 'I' ,'22' => 'V' , 
            '10' => 'J' ,'23' => 'W' ,
            '11' => 'K' ,'24' => 'X' , 
            '12' => 'L' ,'25' => 'Y' , 
            '13' => 'M' ,'26' => 'Z'          
        );
        
        $nx  = (int)$input;  
        $get = '';

        if ($nx <= 26) { $get = $dataC[$input]; } 
        else if ($nx <= 52 && $nx > 26) { $n2 = $input - 26; $get = 'A'.$dataC[$n2]; } 
        else if ($nx <= 78  && $nx > 52) { $n2 = $input - 52; $get = 'B'.$dataC[$n2]; }
        return $get;
    }

    /**
     * Update Potensi
     *
     * @return json
     */
    public function update(Request $request, Potensi $potensi)
    {
        $request->user()->hasPermission($this->permission . 'Edit');

        $validator = Validator::make($request->all(), [
            'bulan' => ['required', 'max:12'],
            'tahun' => 'required|digits:4'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $input = $request->all();
        $potensi->update($input);
        return response()->json(["status" => 200], 200);
    }

    /**
     * Delele Potensi
     *
     * @return json
     */
    public function destroy(Request $request, Potensi $potensi)
    {
        $request->user()->hasPermission($this->permission . 'Delete');
        $potensi->delete();
        return response()->json(null, 204);
    }

    public function sample(Request $request)
    {
        $sample = '';
        $get    = $request->get('req');
        $type   = $request->get('type');

        if ($get == 'direct_invoice')           { $sample = 'a-sample-invoice-barang.csv';}
        if ($get == 'direct_invoice_details')   { $sample = 'a-sample-invoice-barang-detail.csv'; }
        if ($get == 'giro')                     { $sample = 'a-sample-giro.csv';}

        $file = storage_path('app/').$type.'/'.$sample;
        $file = File::get($file);

        return response()->json(['file' => $file, 'filename' => $sample], 200);
    }

    /**
     * Upload file 
     *
     * @param Request $request
     *
     * @return json
     */
     public function upload(Request $request)
     {
        $file = $request->file('file0');
        $name = time().'-'.$file->getClientOriginalName();

        $filePath = storage_path('app/csv');

        $file->move($filePath, $name);

        // Read CSV
        $lokasi = '/storage/app/csv/'.$name;

        // config(['excel.import.startRow' => 3 ]);

        $reader     = Excel::load($lokasi)->get();
        $headerRow  = $reader->first()->keys()->toArray();
        $sumHeader  = 0;
        $modul      = '';
        
        $master     = array("kode.plg","nama.plg","divisi","nama.spv","nik","nama.slm","no.so","tgl.so","nilai.so","sts.bkt.so","sts.exp.so","ket.pending","no.faktur","tgl.faktur","nilai.faktur","tgl.faktur.jadi","tgl.picked","tgl.checked","tgl.siap.krm","no.siap.krm","tgl.sdh.krm","no.sdh.krm","tgl.sts.o","status.o","tgl.jtt","metode.byr","telat","bkt.trm.lns","tgl.trm.lns");
        $detail     = array("no.so","no.faktur","no.part","nm.barang","ty.barang","mr.barang","jumlah", 0);
        $giro       = array("nocek","noac","namabank","kotabank","kt","pelanggan","tglcek","tgljtt","sts","nilcek","tglcair","sales","tglbayar");

        for ($i = 0; $i < count($headerRow); $i++) {
            if ( in_array($headerRow[$i], $master) || in_array($headerRow[$i], $detail) ) { $sumHeader++; }
        }

        if ($sumHeader == 29) { $modul = "direct_invoice"; }
        if ($sumHeader < 9 &&  $sumHeader > 6 ) { $modul = "direct_invoice_details"; }
        if ($sumHeader == 13 ) { $modul = "giro"; }

        return response()->json(['location' => $lokasi, 'header' => $headerRow, 'data' => $modul ], 200);
    } 


}
