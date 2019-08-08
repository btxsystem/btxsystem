<?php
/**
 * Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   asma 081214190007 cirebon software 
 */
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Models\Inventory\Stok;
use App\Models\Inventory\KartuStok;
use App\Models\Inventory\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Training\Training;


/**
 * Base Module
 *
 * Base Module to manage CRUD
 * version 1.2
 *
 * @category Controller
 * @package  App\Http\Controllers\Api
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

abstract class BaseController extends Controller
{
    /**
     * Module base permission.
     *
     * @var string
     */
    protected $permission = "";

    /**
     * Module eloquent model
     *
     * @var object
     */
    protected $model = "";

    /**
     * Module eloquent relation function
     *
     * @var string
     */
    protected $detailRelation = "";

    /**
     * Rows per page
     *
     * @var int
     */
    protected $paginationRows = 10;

    /**
     * Module create validation rule
     *
     * @var array
     */
    protected $createRule = [];

    /**
     * Module update validation rule
     *
     * @var array
     */
    protected $updateRule = [];

    /**
     * Module index relation rule
     *
     * @var array
     */
    protected $relationRule = [];

    /**
     * Module index validation rule
     *
     * @var array
     */
    protected $filterRule = [];

    /**
     * Module index order rule
     *
     * @var array
     */
    protected $orderRule = [];

    /**
     * Upload Folder under ./storage/app
     *
     * @var string
     */
    protected $uploadDir = "";

    /**
     * Data di akses Per cabang
     *
     * @var boolean
     */
     protected $filterByBranch = false;

     /**
      *
     * Data di akses Per Customer
     *
     * @var boolean
     */
     protected $filterByCustomer = false;

      /**
      *
     * Data di akses Per Supir
     *
     * @var boolean
     */
    protected $filterBySupir = false;

    /**
     * Return module data 
     *
     * @param Request $request Request Object
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   


        $user  = Auth::guard('api')->user();

        // print_r($user); die;

        $cek = $user->hasPermission($this->permission . 'View');


                              
        $inputs = $request->all();

        $inputs = $this->beforeSearch($inputs);

        $model = new $this->model;
        $query = $model::query();

        // Relation Query builder
        if (count($this->relationRule) > 0) {
            $query->with($this->relationRule);
        }

        // Where / Like Query builder
        foreach ($this->filterRule as $rule) {

            $input = isset($inputs[ $rule['name'] ]) ? $inputs[ $rule['name'] ] : false;
            $input = urldecode($input);

            if ($input && $input != '' && $input != 'null' && $input != 'undefined') {
                if ($rule['operator'] == 'like') {
                    $input = "%$input%";
                }

                $query->where($rule['name'], $rule['operator'], $input);
            }
        }

        if ($this->filterByBranch) {
            if (!in_array($request->user('admin')->roles_id, config('app.admin'))) {
                $query->where('cabang_txt', '=', $request->user()->cabang_txt);
            } elseif (!empty($cabang) && $cabang!="null") {
                $cabang = urldecode($cabang);
                $query->where('cabang_txt', '=', $cabang);
            }
        }

        if ($this->filterByCustomer) {
            if (!in_array($request->user()->roles_id, config('app.admin'))) {
                $query->where('customer_id', '=', $request->user()->reff_id);
            }
        }

        $query = $this->customSearch($request, $query);

        if ($this->filterBySupir) {
            if (!in_array($request->user()->roles_id, config('app.admin'))) {
                $query->where('id', '=', $request->user()->reff_id);
            }
        }

        $query = $this->customSearch($request, $query);

        // Sorting Query builder
        $query->orderBy($this->orderRule['name'], $this->orderRule['operator']);

        if (isset($inputs['page']) && !empty($inputs['page'])) {
            $list = $query->paginate($this->paginationRows);

         //  return $list;
        }

        $list = $query->get();

        $list = $this->afterSearch($request, $list);

        // return response()->json(['data' => $list], 200, [], JSON_NUMERIC_CHECK);
		return response()->json(['data' => $list], 200);
    }

    /**
     * Create a new data
     *
     * @param Request $request Request Object
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $user  = Auth::guard('api')->user();

       $user->hasPermission($this->permission . 'Create');


        $input = $request->validate($this->createRule);

        $input = $this->beforeCreate($input);

        $model = new $this->model;

        // $input['created_by'] = $user->username;

        $result = Training::create($input);

        $this->afterCreate($request, $result);

        if (!empty($this->detailRelation)) {
            $dataDetail = $request->get('dataDetail');

            if (count($dataDetail) > 0) {
                $dataDetail = $this->beforeCreateDetail($dataDetail);

                $result->{$this->detailRelation}()->createMany($dataDetail);

                $this->afterCreateDetail($dataDetail);
            }
        }

        return response()->json(["status" => 200], 201);
    }

    /**
     * Update Module Data
     *
     * @param Request $request    Request Object
     * @param Int     $primaryKey Primary ID
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $primaryKey)
    {
        // $request->user('admin')->hasPermission($this->permission . 'Edit');

        $input = $request->validate($this->updateRule);

        $input = $this->beforeUpdate($input);

        $model = new $this->model;
        $data  = $model->findOrFail($primaryKey);

        // $input['updated_by'] = $request->user('admin')->username;

        $data->update($input);

        $this->afterUpdate($request, $data);

        if (!empty($this->detailRelation)) {
            $dataDetail = $request->get('dataDetail');

            if (count($dataDetail) > 0) {
                $dataDetail = $this->beforeUpdateDetail($dataDetail);

                $data->{$this->detailRelation}()->sync($dataDetail);

                $this->afterUpdateDetail($dataDetail);
            }
        }

        return response()->json(["status" => 200], 200);
    }

    /**
     * Delete Module Data
     *
     * @param Request $request    Request Object
     * @param Int     $primaryKey Primary ID
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $primaryKey)
    {
        $request->user('admin')->hasPermission($this->permission . 'Delete');

        $model = new $this->model;
        $data = $model->findOrFail($primaryKey);

        $this->beforeDelete($primaryKey);

        if (!empty($this->detailRelation)) {
            $data->{$this->detailRelation}()->delete();
        }

        $data->delete();

        $this->afterDelete($primaryKey);


        return response()->json(["status" => 200], 204);
    }

    /**
     * Return Data Detail
     *
     * @return json
     */
    public function detail(Request $request, $primaryKey)
    {
        $request->user()->hasPermission($this->permission . 'View');

        $model = new $this->model;
        $query = $model::query();

        // Relation Query builder
        if (count($this->relationRule) > 0) {
            $query->with($this->relationRule);
        }

        $data = $query->findOrFail($primaryKey);
        // print_r($data);
        $list = $data->{$this->detailRelation};

        return response()->json(['data' => $list], 200);
    }

    /**
     * Before Search Data Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function beforeSearch($inputs)
    {
        return $inputs;
    }

    /**
     * After Search Data Callback
     *
     * @param Request $request Request Object
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function afterSearch($request, $inputs)
    {
        return $inputs;
    }

    /**
     * After Search Data Callback
     *
     * @param Request $request Request Object
     * @param Array   $query   Eloquent Object
     *
     * @return Array
     */
    public function customSearch($request, $query)
    {
        return $query;
    }

    /**
     * Before Create Data Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function beforeCreate($input)
    {
        return $input;
    }

    /**
     * After Create Data Callback
     *
     * @param Request $request    Request Object
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function afterCreate($request, $input)
    {

    }

    /**
     * Before Update Data Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function beforeUpdate($input)
    {
        return $input;
    }

    /**
     * After Update Data Callback
     *
     * @param Request $request    Request Object
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function afterUpdate($request, $input)
    {

    }

    /**
     * before Delete Data Callback
     * @param Array $input Primary Key
     *
     * @return void
     */
    public function beforeDelete($input)
    {

    }

    /**
     * After Delete Data Callback
     *
     * @param String $input Params  Primary Key
     *
     * @return void
     */
    public function afterDelete($input)
    {

    }

    /**
     * Before Create Data Detail Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function beforeCreateDetail($input)
    {
        return $input;
    }

    /**
     * After Create Data Detail Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function afterCreateDetail($input)
    {
        return $input;
    }

    /**
     * Before Update Data Detail Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function beforeUpdateDetail($input)
    {
        return $input;
    }

    /**
     * After Update Data Detail Callback
     *
     * @param Array $input Params Array
     *
     * @return Array
     */
    public function afterUpdateDetail($input)
    {
        return $input;
    }

    /**
     * Upload CSV file
     *
     * @param Request $request
     *
     * @return json
     */
    public function upload(Request $request)
    {
        $filePath = $request->file('file')->store($this->uploadDir);

        $filePath = str_replace('public/', '', $filePath);

        return response()->json(['location' => $filePath], 200);
    }
	
	

    public function create(Request $request)
    {
		//return response()->json(['location' => 200 ], 200);
       return $this->cetak($request, $this->model);
    }
	
	public function cetak($request, $model)
	{
		return $request;
	}

    /**
     * Send FCM Notification
     *
     * @param string $title
     * @param string $body
     * @param string $token
     *
     * @return void
     */
    private function sendNotification($title, $body, $token)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification);

    }

    /**
     * Hitung Barang Detail untuk master
     *
     * @param array $input
     * @param int   $id
     *
     * @return array
     */
    public function hitungBarang($input, $primaryKey)
    {
        $grandTotal = 0;
        $dpp        = 0;
		$subTotal   = 0;
        $diskon     = 0;
        $pajak      = 0;

        foreach ($input as $row) {
			$qty         = $row['qty_ordered'];
            $subTotal   += ($row['subtotal']);
            $grandTotal += ($row['grand_total']);
            $diskon     += ($row['total_discount'] * $qty);
            $pajak      += ($row['total_tax']);
			$dpp        += ($row['dpp'] * $qty);
        }

        $updateMaster = $this->model::find($primaryKey);
            $updateMaster->grand_total      = $grandTotal;
            $updateMaster->subtotal         = $subTotal;
            $updateMaster->total_discount   = $diskon;
            $updateMaster->total_tax        = $pajak;
			$updateMaster->total_dpp        = $dpp;
            $updateMaster->save();

        return $input;

    }


    /**
     * update Stok  / 
     *
     * @param array $data
     * @return array
     */
    public function updateStok($primaryKey, $tipeTrx)
    {
        $input      	= array();        
        $dataMaster 	= $this->model::find($primaryKey);		
        $idLokasi   	= $dataMaster->location_id;
        $namaLokasi 	= $dataMaster->location_name;
		$dvPenjualan 	= request()->user()->divisi_penjualan_id;
		$input 			= array(
            'perusahaan_id'       => $dataMaster->perusahaan_id,
            'cabang_id'           => $dataMaster->cabang_id,
            'location_id'         => $idLokasi,
			'location_name'       => $namaLokasi,
            'divisi_penjualan_id' => $dvPenjualan,
            'reff_id'             => $primaryKey,
            'type_trx'            => $tipeTrx
        );

        if ($tipeTrx == 7) { 
		    $idLokasi   = $dataMaster->location_asal_id; 
			$namaLokasi = $dataMaster->location_asal_name;
		}

        $dataDetail = $dataMaster->{$this->detailRelation};

        foreach($dataDetail as $key => $row) {

            $getData = Stok::where('product_id', $row['product_id'])->where('location_id', $idLokasi)->orderBy('id', 'desc')->first();

            if ($getData) {
                $qty               = $getData->current_stock;
                $persediaanAwal    = $qty * $getData->cogs_avg;
              
            } else {
                $qty               = 0;
                $persediaanAwal    = 0;
            }
            
            if ($tipeTrx == 1) { 

                $input['trx_date'] 		= $dataMaster->order_date;
                $price             		= $row['unit_price'];
                $potonganBeli      		= $row['total_discount'];                
                $currentStock      		= ($qty + $row['qty_received']); 
                $dpp               		= ($price - $row['total_discount']);
                $pembelian         		= ($row['qty_received'] * $dpp) ; 
                $cogsAvg           		= ($persediaanAwal + $pembelian) / $currentStock;
                $cogsBalance       		= $cogsAvg * $currentStock;
				$input['qty']      		= $row['qty_received'];
				$input['keterangan'] 	= "Pembelian Dari Supplier ".$dataMaster->supplier_name;
            }

            if ($tipeTrx == 2) {
                $input['trx_date']  	= $dataMaster->trx_date;
                $price              	= $row['unit_price'];              
                $currentStock       	= ($qty - $row['qty_ordered']); 
                $dpp                	= $row['unit_price'] - $row['total_discount']; 
                $cogsAvg            	= $getData->cogs_avg;
                $cogsBalance        	= $cogsAvg * $currentStock;
                $input['qty']  			= ($row['qty_ordered']) * -1;
				$input['keterangan']	= "Penjualan Ke Customer  ".$dataMaster->customer_name;
            }       

			$input['product_id']          = $row['product_id'];
			$input['product_code']        = $row['product_code'];
			$input['product_name']        = $row['product_name'];
			$input['price']               = $price;
			$input['current_stock']       = $currentStock;
			$input['dpp']                 = $dpp;
			$input['cogs_avg']            = $cogsAvg;
			$input['cogs_balance']        = $cogsBalance;
			
			$this->doUpdateStok($input);
            
        }
    }
	
	
	/**
     * Update Stok
     * @param array $input
     * @return void
     */
    public function doUpdateStok($input)
    {

        if ($input['type_trx'] == 1) {
            $updateHarga = Product::find($input['product_id']);
            $updateHarga->purchase_cost = $input['price'];
			$updateHarga->cogs_avg      = $input['cogs_avg'];
            $updateHarga->save();
        }

        KartuStok::updateOrCreate([
            'location_id'   => $input['location_id'],
            'product_id'    => $input['product_id']
        ],[
            'product_code'  => $input['product_code'],
            'product_name'  => $input['product_name'],
            'location_name' => $input['location_name'],
            'reff_id'       => $input['reff_id'],
            'current_stock' => $input['current_stock']
        ]);

        Stok::insert($input);

    }

    /**
     * cek stok
     * @return Number
     */
    public function cekStok($idProduct, $location)
    {   
        $stok 		= 0;        
        $cekStok 	= KartuStok::where('product_id', $idProduct)->where('location_id', $location)->first();

        if ($cekStok) { $stok = $cekStok->current_stock; }
		
        return $stok;
    }
	
	


}
