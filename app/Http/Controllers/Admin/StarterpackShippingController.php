<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeer;
use App\Models\Address;
use DB;
use Excel;
use DataTables;
use Auth;
use Alert;

class StarterpackShippingController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            $data = Employeer::with('transaction','address')->whereHas('transaction', function ($query) {
                $query->where('type', '=', 1);
                $query->where('shipping_status','=', 0);
            })->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username', function($row){
                    return $row->username;
                })
                ->addColumn('invoice', function($row){
                    return $row->transaction ? $row->transaction->invoice_number : 'No Data';
                })
                ->addColumn('address', function($row){
                    return $row->address ? $row->address->province .', '. $row->address->city_name .', '. $row->address->subdistrict_name  : 'No Data';
                })
                ->addColumn('phone', function($row){
                    return $row->phone_number;
                })
                ->addColumn('action', function($row) {
                    return '<a data-id="'.$row->id.'"  class="btn btn-warning fa fa-check-square edit-testimonial" title="Deliver Starterpack"></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.starterpack-shipping-status.index');
         
    }
    
    public function deliver(Request $request)
    {
        $data = Employeer::findOrFail($request->id);

        if($data) {
            $data->transaction()->update([
                'shipping_status' => 1,
                'waybill' => $request->waybill
            ]);

            if($data->transaction->save()) {
                Alert::success('Sukses Update Data', 'Sukses');
                return \redirect()->back();
            }
            Alert::error('Gagal Update Data', 'Gagal');
            return \redirect()->back();
        }

        Alert::error('Data tidak ditemukan', 'Gagal');
        return \redirect()->back();
    }

    public function import()
    {
        $employeerID = Employeer::with('transaction','address')->whereHas('transaction', function ($query) {
                        $query->where('type', '=', 1);
                        $query->where('shipping_status','=', 0);
                    })->pluck('id');

        // return $employeer;

        $address = Address::whereIn('user_id', $employeerID)->get();

        // return $address;

        return Excel::download($address, 'adrress.xlsx');
    }

    // public function htmlAction($row)
    // {
    //     switch($row->transaction->status) {
    //         case 1; 
    //         return '
    //                 <a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-testimonial" title="Edit"></a>
    //                 <a data-id="'.$row->id.' "class="btn btn-default fa fa-power-off unpublish-testimonial" style="background-color: #b85ebd; color: #ffffff;" title="Set Unpublished"></a>
    //                 <a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-ourProduct"title="Delete"></a>
    //                 ';
    //         break;

    //         case 0;
    //         return '
    //                 <a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-testimonial" title="Edit"></a>
    //                 <a data-id="'.$row->id.' "class="btn btn-success fa fa-check-square publish-testimonial"title="Set Published"></a>
    //                 <a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-ourProduct"title="Delete"></a>
    //                 ';
    //         break;

    //     }
    // }
}
