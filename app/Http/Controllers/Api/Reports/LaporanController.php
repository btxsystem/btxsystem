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

namespace App\Http\Controllers\Api\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customers;
use App\Models\Pembelian\Supplier;
use App\Models\Inventory\Product;
use App\Models\Inventory\Stok;
use App\Models\Inventory\ProductGroups;
use App\Models\Penjualan\SalesOrders;
use App\Models\Penjualan\SalesOrderDetails;
use App\Models\Pembelian\PurchaseOrderDetails;
use App\Models\Pembelian\PurchaseOrders;
use Maatwebsite\Excel\Facades\Excel;
use Charts;
use Validator;
use DateTime;


/**
 * Module Laporan
 *
 * Module to manage Laporan
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class LaporanController extends Controller
{
    private $permission = "Laporan.Laporan.";

    /**
     * Return PDF Laporan
     *
     * @return json
     */
    public function index(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'View');
        
        $now    = date('Y-m-d');
        $dtFrom = Input::get('from', $now);
        $dtTo   = Input::get('to', $now);
        $tipe   = Input::get('tipe', false);

        $template = str_replace(" ", "-", strtolower($tipe[0]));
        $template = str_replace("/", "", strtolower($template));

        $title = ucwords($tipe[0]);
        $orientation = "";
        $graph = false;

        // master data
        if ($template == "pelanggan") {
            $orientation = "-O landscape";
            $records = $this->customer();
        } elseif ($template == "barang") {
            $records = $this->barang();
        } elseif ($template == "penjualan-per-barang") {
            $orientation = "-O landscape";
            $records = $this->penjualanPerBarang();
        } elseif ($template == "penjualan-per-pelanggan") {
            $orientation = "-O landscape";
            $records = $this->penjualanPerCustomer();
        } elseif ($template == "penjualan-per-tanggal") {
            $orientation = "-O landscape";
            $records = $this->penjualanPerTanggal();
        } elseif ($template == "pembelian-per-barang") {
            $orientation = "-O landscape";
            $records = $this->pembelianPerBarang();
        } elseif ($template == "pembelian-per-supplier") {
            $orientation = "-O landscape";
            $records = $this->pembelianPerSupplier();
        } elseif ($template == "pembelian-per-tanggal") {
            $orientation = "-O landscape";
            $records = $this->pembelianPerTanggal();
        } elseif ($template == "profit-per-barang") {
            $orientation = "-O landscape";
            $records = $this->profitPerBarang();
        } elseif ($template == "profit-per-supplier") {
            $orientation = "-O landscape";
            $records = $this->profitPerSupplier();
        } elseif ($template == "profit-per-tanggal") {
            $orientation = "-O landscape";
            $records = $this->profitPerTanggal();
        }

        $exportExcel = $request->get('export_excel', false);

        if ($exportExcel) {

            $excelFile  = $template.'-'.date("YmdHis");

            $params['template'] = $template;
            $params['data'] = array(
                'title' => $title, 
                "now" => date('d/m/Y', strtotime($now)),
                "from" => date('d/m/Y', strtotime($dtFrom)),
                "to" => date('d/m/Y', strtotime($dtTo)),
                "fromRaw" => $dtFrom,
                "toRaw" => $dtTo,
                "records" => $records,
                "tipe"=> 'excel'
            ); 

            Excel::create($excelFile, function ($excel) use ($params) {

                $excel->sheet('Sheet', function ($sheet) use ($params) {
            
                    $sheet->loadView('reports.masterdata.' . $params['template'], $params['data']);
            
                });
            
            })->store('xls', public_path('reports/excel'));

            $url = url("/viewexcel/?f=" . $excelFile . ".xls");
        } else {

            //Generate HTML
            $view = View::make('reports.masterdata.' . $template, [
                'title'     => $title, 
                "now"       => date('Y-m-d', strtotime($now)),
                "from"      => date('Y-m-d', strtotime($dtFrom)),
                "to"        => date('Y-m-d', strtotime($dtTo)),
                "fromRaw"   => $dtFrom,
                "toRaw"     => $dtTo,
                "records"   => $records,
                "tipe"      => 'pdf'

            ]);

            $contents = $view->render();

            $htmlFile = public_path("reports/html/".date("YmdHis").".html");
            
            file_put_contents($htmlFile, $view);

            //Generate PDF
            $pdfFile  = date("YmdHis").".pdf";
            if ($graph) {
                @system("\"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe\" --enable-javascript --javascript-delay 1900 -q --page-size A4 {$orientation} $htmlFile " . public_path("reports/". $pdfFile));
            } else {
                @system("\"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe\" -q --page-size A4 {$orientation} $htmlFile " . public_path("reports/". $pdfFile));
            }
            
            $url = url("/viewpdf/?f=" . $pdfFile);
        }
        return response()->json(["status" => 200, "url" => $url], 201);
    }


    function customer() {
        $now    = date('Y-m-d');
        $dtFrom = Input::get('from', $now);
        $dtTo   = Input::get('to', $now);
        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Customers::where('created_at', '>=', $dtFrom.' 00:00:00')
            ->where('created_at', '<=', $dtTo.' 23:59:59')
            ->get();
        return $records;
    }

    function barang() {
        $now    = date('Y-m-d');
        $dtFrom = Input::get('from', $now);
        $dtTo   = Input::get('to', $now);
        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $kategori   = Input::get('kategori_barang');
        $merk       = Input::get('merk_barang');

        $records = Product::join('product_types','product_types.id','=','products.product_type_id')
            ->join('product_brands','product_brands.id','=','products.product_brand_id')
            ->selectRaw('es_product_brands.name as merk, es_product_types.name as type, es_products.code, es_products.name, es_products.purchase_cost')
            // ->where('products.created_at', '>=', $dtFrom.' 00:00:00')
            // ->where('products.created_at', '<=', $dtTo.' 23:59:59')
            ->where('products.product_type_id', 'like', '%'.$kategori.'%')
            ->where('products.product_brand_id', 'like', '%'.$merk.'%')
            ->get();
        return $records;
    }

    function penjualanPerBarang() {
        $now    = date('Y-m-d');
        $dtFrom = Input::get('from', $now);
        $dtTo   = Input::get('to', $now);
        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));
        $code   = Input::get('code_barang');

        $records['barang'] = Product::join('product_groups','product_groups.id','=','products.product_group_id')
        ->join('product_brands','product_brands.id','=','products.product_brand_id')
        //->join('product_units','product_units.id','=','products.unit_id')
        ->selectRaw('es_product_brands.name as merk, es_product_groups.name as kategori, es_products.unit_id as unit, es_products.code, es_products.name, es_products.purchase_cost')
        ->where('products.code', $code)
        ->first();

        $records['detail'] = SalesOrderDetails::join('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->join('customers', 'customers.id', '=', 'sales_orders.customer_id')
            ->selectRaw('
                sum(es_sales_order_details.qty_ordered) as jumlah,
                sum(es_sales_order_details.total_discount) as diskon,
                es_sales_order_details.unit_price,
                es_sales_orders.customer_code,
                es_sales_orders.customer_name,
                sum(es_sales_order_details.subtotal) as subtotal,
                sum(es_sales_order_details.grand_total) as total,
                es_sales_orders.trx_date,
                es_sales_orders.id as no_transaksi,
                es_customers.mobile_no
                ')
            ->where('sales_orders.trx_date','>=', $dtFrom)
            ->where('sales_orders.trx_date', '<=', $dtTo)
            ->where('sales_order_details.product_code', 'like', '%'.$code.'%')
            ->groupBy('trx_date', 'unit_price', 'customer_name', 'customer_code', 'no_transaksi', 'mobile_no')
            ->get();

        return $records;
    }    


    function penjualanPerCustomer() {
        $now            = date('Y-m-d');
        $dtFrom         = Input::get('from', $now);
        $dtTo           = Input::get('to', $now);
        $dtFrom         = date('Y-m-d', strtotime($dtFrom));
        $dtTo           = date('Y-m-d', strtotime($dtTo));
        $idCustomer     = Input::get('id_customer');

        $records['customer'] = Customers::find($idCustomer);

        $records['detail'] = SalesOrderDetails::join('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->selectRaw('
                sum(es_sales_order_details.qty_ordered) as jumlah,
                sum(es_sales_order_details.total_discount) as diskon,
                es_sales_order_details.unit_price,
                es_sales_order_details.product_code,
                es_sales_order_details.product_name,
                es_sales_order_details.product_unit,
                sum(es_sales_order_details.subtotal) as subtotal,
                sum(es_sales_order_details.grand_total) as total,
                es_sales_orders.trx_date,
                es_sales_orders.id as no_transaksi
                ')
            ->where('sales_orders.trx_date','>=', $dtFrom)
            ->where('sales_orders.trx_date', '<=', $dtTo)
            ->where('sales_orders.customer_id', $idCustomer)
            ->groupBy('trx_date', 'unit_price', 'no_transaksi', 'product_code', 'product_name', 'product_unit')
            ->get();

        return $records;
    }

    function penjualanPerTanggal() {
        $now            = date('Y-m-d');
        $dtFrom         = Input::get('from', $now);
        $dtTo           = Input::get('to', $now);
        $dtFrom         = date('Y-m-d', strtotime($dtFrom));
        $dtTo           = date('Y-m-d', strtotime($dtTo));

        $records['detail'] = SalesOrderDetails::join('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->selectRaw('
                sum(es_sales_order_details.qty_ordered) as jumlah,
                sum(es_sales_order_details.total_discount) as diskon,
                es_sales_order_details.unit_price,
                es_sales_order_details.product_code,
                es_sales_order_details.product_name,
                es_sales_order_details.product_unit,
                sum(es_sales_order_details.subtotal) as subtotal,
                sum(es_sales_order_details.grand_total) as total,
                es_sales_orders.trx_date,
                es_sales_orders.id as no_transaksi
                ')
            ->where('sales_orders.trx_date','>=', $dtFrom)
            ->where('sales_orders.trx_date', '<=', $dtTo)
            ->groupBy('trx_date', 'unit_price', 'no_transaksi', 'product_code', 'product_name', 'product_unit')
            ->get();

        return $records;
    }
	
	
	
	function pembelianPerBarang() {
        $now    = date('Y-m-d');
        $dtFrom = Input::get('from', $now);
        $dtTo   = Input::get('to', $now);
        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));
        $code   = Input::get('code_barang');

        $records['barang'] = Product::join('product_types','product_types.id','=','products.product_type_id')
        ->join('product_brands','product_brands.id','=','products.product_brand_id')
        //->join('product_units','product_units.id','=','products.unit_id')
        ->selectRaw('es_product_brands.name as merk, es_product_types.name as types, es_products.unit_id as unit, es_products.code, es_products.name, es_products.purchase_cost')
        ->where('products.code', $code)
        ->first();

        $records['detail'] = PurchaseOrderDetails::join('purchase_orders', 'purchase_orders.id', '=', 'purchase_order_details.order_no')
            ->join('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->selectRaw('
                sum(es_purchase_order_details.qty_ordered) as jumlah,
                sum(es_purchase_order_details.total_discount) as diskon,
                es_purchase_order_details.unit_price,
                es_purchase_orders.supplier_code,
                es_purchase_orders.supplier_name,
                sum(es_purchase_order_details.subtotal) as subtotal,
                sum(es_purchase_order_details.grand_total) as total,
                es_purchase_orders.order_date,
                es_purchase_orders.id as no_transaksi,
                es_suppliers.mobile_no
                ')
            ->where('purchase_orders.order_date','>=', $dtFrom)
            ->where('purchase_orders.order_date', '<=', $dtTo)
            ->where('purchase_order_details.product_code', 'like', '%'.$code.'%')
            ->groupBy('order_date', 'unit_price', 'supplier_name', 'supplier_code', 'no_transaksi', 'mobile_no')
            ->get();

        return $records;
    }  
	
	function pembelianPerSupplier() {
        $now            = date('Y-m-d');
        $dtFrom         = Input::get('from', $now);
        $dtTo           = Input::get('to', $now);
        $dtFrom         = date('Y-m-d', strtotime($dtFrom));
        $dtTo           = date('Y-m-d', strtotime($dtTo));
        $idSupplier     = Input::get('id_supplier');

        $records['supplier'] = Supplier::find($idSupplier);

        $records['detail'] = PurchaseOrderDetails::join('purchase_orders', 'purchase_orders.id', '=', 'purchase_order_details.order_no')
             ->join('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->selectRaw('
                sum(es_purchase_order_details.qty_ordered) as jumlah,
                sum(es_purchase_order_details.total_discount) as diskon,
				es_purchase_order_details.unit_price,
                es_purchase_order_details.product_code,
                es_purchase_order_details.product_name,
                es_purchase_order_details.product_unit,
                es_purchase_orders.supplier_code,
                es_purchase_orders.supplier_name,
                sum(es_purchase_order_details.subtotal) as subtotal,
                sum(es_purchase_order_details.grand_total) as total,
                es_purchase_orders.order_date,
                es_purchase_orders.id as no_transaksi,
                es_suppliers.mobile_no
                ')
            ->where('purchase_orders.order_date','>=', $dtFrom)
            ->where('purchase_orders.order_date', '<=', $dtTo)
            ->where('purchase_orders.supplier_id', $idSupplier)
            ->groupBy('order_date', 'product_code', 'product_name', 'product_unit', 'unit_price', 'supplier_name', 'supplier_code', 'no_transaksi', 'mobile_no')
            ->get();

        return $records;
    }
	
	function pembelianPerTanggal() {
        $now            = date('Y-m-d');
        $dtFrom         = Input::get('from', $now);
        $dtTo           = Input::get('to', $now);
        $dtFrom         = date('Y-m-d', strtotime($dtFrom));
        $dtTo           = date('Y-m-d', strtotime($dtTo));

        $records['detail'] = PurchaseOrderDetails::join('purchase_orders', 'purchase_orders.id', '=', 'purchase_order_details.order_no')
             ->join('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->selectRaw('
                sum(es_purchase_order_details.qty_ordered) as jumlah,
                sum(es_purchase_order_details.total_discount) as diskon,
				es_purchase_order_details.unit_price,
                es_purchase_order_details.product_code,
                es_purchase_order_details.product_name,
                es_purchase_order_details.product_unit,
                es_purchase_orders.supplier_code,
                es_purchase_orders.supplier_name,
                sum(es_purchase_order_details.subtotal) as subtotal,
                sum(es_purchase_order_details.grand_total) as total,
                es_purchase_orders.order_date,
                es_purchase_orders.id as no_transaksi,
                es_suppliers.mobile_no
                ')
            ->where('purchase_orders.order_date','>=', $dtFrom)
            ->where('purchase_orders.order_date', '<=', $dtTo)
            ->groupBy('order_date', 'product_code', 'product_name', 'product_unit', 'unit_price', 'supplier_name', 'supplier_code', 'no_transaksi', 'mobile_no')
            ->get();

        return $records;
    }
	
	function profitPerBarang() {
        $now            = date('Y-m-d');
        $dtFrom         = Input::get('from', $now);
        $dtTo           = Input::get('to', $now);
        $dtFrom         = date('Y-m-d', strtotime($dtFrom));
        $dtTo           = date('Y-m-d', strtotime($dtTo));
		
		$code   = Input::get('code_barang');

        $records['detail'] = Stok::selectRaw('
				reff_id,
				trx_date,
				product_id,
				product_code,
				product_name,
				location_id,
				price,
				dpp,
				cogs_avg,
				sum(dpp - cogs_avg) as profit
			')
			->where('trx_date','>=', $dtFrom)
            ->where('trx_date', '<=', $dtTo)
			->where('trx_type', 2)
            ->groupBy('cogs_avg','dpp','product_id', 'product_code', 'product_name', 'location_id', 'price', 'trx_date', 'reff_id')
            ->get();

        return $records;
    }
	
	//////////////////////////////////////////////////////////////////////////////////////////////
   
	
    function barangOmsetTerbesar() { 
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = JualDetail::whereHas('jual', function ($query) use ($dtFrom, $dtTo) {
                            $query->where('so_tanggal', '>=', $dtFrom);
                            $query->where('so_tanggal', '<=', $dtTo);
                        })
                        ->groupBy('barang_txt')
                        ->selectRaw('barang_txt, SUM(qty) as sumQty, SUM(total) as sumTotal, SUM(total_hpp) as sumHPP, SUM(laba) as sumLaba')
                        ->orderBy('sumLaba', 'DESC')
                        ->take(20)
                        ->get();
        
        return $records;
    }
	

    function feedback() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Jual::where('so_tanggal', '>=', $dtFrom)
                        ->where('so_tanggal', '<=', $dtTo)
                        ->whereNotNull('cust_feedback')
                        ->orderBy('so_tanggal', 'ASC')
                        ->get();
        
        return $records;
    }

    function grafikPenjualanHarian() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo   = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Jual::selectRaw('so_tanggal, total')
                        ->where('so_tanggal', '>=', $dtFrom)
                        ->where('so_tanggal', '<=', $dtTo)
                        ->get();

        $chart = Charts::database($records, 'area', 'highcharts')
                        ->dateColumn('so_tanggal')
                        ->aggregateColumn('total', 'sum')
                        ->elementLabel("Total")
                        ->dimensions(1000, 500)
                        ->title("Grafik Penjualan")
                        ->responsive(false)
                        ->groupByDay();

        return $chart;
    }
	
	function grafikPenjualanBulanan() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Jual::selectRaw('so_tanggal, total')
                        ->where('so_tanggal', '>=', $dtFrom)
                        ->where('so_tanggal', '<=', $dtTo)
                        ->get();

        $chart = Charts::database($records, 'bar', 'highcharts')
                        ->dateColumn('so_tanggal')
                        ->aggregateColumn('total', 'sum')
                        ->title("Grafik Penjualan")
                        ->elementLabel("Total")
                        ->dimensions(1000, 500)
                        ->responsive(false)
                        ->groupByMonth();
        
        return $chart;
    }

    function details() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Jual::where('so_tanggal', '>=', $dtFrom)
						->where('so_tanggal', '<=', $dtTo)
                        ->orderBy('so_noinvoice', 'ASC')
                        ->get();
        
        return $records;
    }
	
	function penjualanPerBarang2() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $jualDetail = JualDetail::
                    join('jual', 'jual.id', '=', 'jual_detail.jual_id')
                    ->selectRaw('es_jual.so_noinvoice, es_jual.so_tanggal, es_jual.notacanvas, es_jual.cust_txt, es_jual_detail.barang_txt, es_jual_detail.qty, es_jual_detail.harga, es_jual_detail.total, es_jual_detail.total_hpp, es_jual_detail.laba')
                    ->where('jual.so_tanggal', '>=', $dtFrom)
                    ->where('jual.so_tanggal', '<=', $dtTo)
                    ->orderBy('jual.cust_txt', 'ASC')
                    ->get();

        $records = $jualDetail->mapToGroups(function ($item, $key) {
            return [$item['barang_txt'] => $item];
        });
        
        return $records;
    }

    function penjualanPerCustomer2() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $jual = Jual::where('so_tanggal', '>=', $dtFrom)
                    ->where('so_tanggal', '<=', $dtTo)
                    ->orderBy('cust_txt', 'ASC')
                    ->orderBy('so_tanggal', 'ASC')
                    ->get();

        $records = $jual->mapToGroups(function ($item, $key) {
            return [$item['cust_txt'] => $item];
        });
        
        return $records;
    }

    function penjualanPerBulan() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Jual::selectRaw('MONTH(so_tanggal) as bulan, YEAR(so_tanggal) as tahun, SUM(total) as sumTotal, SUM(hpp) as sumHPP, SUM(laba) as sumLaba')
                    ->where('so_tanggal', '>=', $dtFrom)
                    ->where('so_tanggal', '<=', $dtTo)
                    ->groupBy(DB::raw('MONTH(so_tanggal)'), DB::raw('YEAR(so_tanggal)'))
                    ->orderBy(DB::raw('MONTH(so_tanggal)'), 'ASC')
                    ->get();
        
        return $records;
    }

    function penjualanPerHari() {
        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $records = Jual::selectRaw('so_tanggal, SUM(total) as sumTotal, SUM(hpp) as sumHPP, SUM(laba) as sumLaba')
                    ->where('so_tanggal', '>=', $dtFrom)
                    ->where('so_tanggal', '<=', $dtTo)
                    ->groupBy('so_tanggal')
                    ->orderBy('so_tanggal', 'ASC')
                    ->get();
        
        return $records;
    }

    function piutangGlobal() {
        $sekarang = new DateTime();

        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $jual = Jual::selectRaw('cust_txt, so_jatuhtempo, piutang')
                    ->where('so_tanggal', '>=', $dtFrom)
                    ->where('so_tanggal', '<=', $dtTo)
                    ->where('status_pembayaran', 0)
                    ->orderBy('cust_txt', 'ASC')
                    ->get();

        $records = array();

        foreach ($jual as $row) {

            $tanggal = new DateTime($row->so_jatuhtempo); 

            $perbedaan = $sekarang->diff($tanggal);
            $selisih   = $perbedaan->d;

            if (strtotime($now) <= strtotime($row->so_jatuhtempo)) {
                $records[ $row['cust_txt'] ]['belum_jt'] = $row->piutang;
            } elseif ($selisih > 0 && $selisih <= 30) {
                $records[ $row['cust_txt'] ]['jt1'] = $row->piutang;
            } elseif ($selisih >= 31 && $selisih <= 60) {
                $records[ $row['cust_txt'] ]['jt2'] = $row->piutang;
            } elseif ($selisih >= 61 && $selisih <= 90) {
                $records[ $row['cust_txt'] ]['jt3'] = $row->piutang;
            } elseif ($selisih >= 91) {
                $records[ $row['cust_txt'] ]['jt4'] = $row->piutang;
            }

            if (isset($records[ $row['cust_txt'] ]['total'])) {
                $records[ $row['cust_txt'] ]['total']+= $row->piutang;
            } else {
                $records[ $row['cust_txt'] ]['total'] = $row->piutang;
            }
        }

        unset($jual);

        foreach ($records as $cust_txt => $row) {

            if (!isset($row['belum_jt'])) {
                $records[ $cust_txt ]['belum_jt'] = 0;
            }

            if (!isset($row['jt1'])) {
                $records[ $cust_txt ]['jt1'] = 0;
            }

            if (!isset($row['jt2'])) {
                $records[ $cust_txt ]['jt2'] = 0;
            }

            if (!isset($row['jt3'])) {
                $records[ $cust_txt ]['jt3'] = 0;
            }

            if (!isset($row['jt4'])) {
                $records[ $cust_txt ]['jt4'] = 0;
            }

        }
        
        return $records;
    }

    function piutangPerCustomer() {
        $sekarang = new DateTime();

        $now = date('Y-m-d');

        $dtFrom = Input::get('from', $now);
        $dtTo = Input::get('to', $now);

        $dtFrom = date('Y-m-d', strtotime($dtFrom));
        $dtTo   = date('Y-m-d', strtotime($dtTo));

        $jual = Jual::selectRaw('cust_txt, so_noinvoice, notacanvas, so_tanggal, so_jatuhtempo, total, piutang')
                    ->where('so_tanggal', '>=', $dtFrom)
                    ->where('so_tanggal', '<=', $dtTo)
                    ->where('status_pembayaran', 0)
                    ->orderBy('cust_txt', 'ASC')
                    ->get();

        $records = array();

        foreach ($jual as $row) {

            $tanggal = new DateTime($row->so_tanggal); 
            $jatuhtempo = new DateTime($row->so_jatuhtempo); 

            $perbedaan = $sekarang->diff($jatuhtempo);
            $selisih   = $perbedaan->d;

            $terms = $tanggal->diff($jatuhtempo);

            $tmp = array();

            $tmp['so_noinvoice'] = $row->so_noinvoice;
            $tmp['notacanvas'] = $row->notacanvas;
            $tmp['so_tanggal'] = $row->so_tanggal;
            $tmp['so_jatuhtempo'] = $row->so_jatuhtempo;
            $tmp['term'] = $terms->d;
            $tmp['total'] = $row->total;

            $tmp['belum_jt'] = 0;
            $tmp['jt1'] = 0;
            $tmp['jt2'] = 0;
            $tmp['jt3'] = 0;
            $tmp['jt4'] = 0;

            if (strtotime($now) <= strtotime($row->so_jatuhtempo)) {
                $tmp['belum_jt'] = $row->piutang;
            } elseif ($selisih > 0 && $selisih <= 30) {
                $tmp['jt1'] = $row->piutang;
            } elseif ($selisih >= 31 && $selisih <= 60) {
                $tmp['jt2'] = $row->piutang;
            } elseif ($selisih >= 61 && $selisih <= 90) {
                $tmp['jt3'] = $row->piutang;
            } elseif ($selisih >= 91 ) {
                $tmp['jt4'] = $row->piutang;
            }

            $tmp['piutang'] = $row->piutang;

            $records[ $row['cust_txt'] ][] = $tmp;

            unset($tmp);
        }

        unset($jual);

        return $records;
    }
}
