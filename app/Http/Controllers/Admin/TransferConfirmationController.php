<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransferConfirmation;
use App\Models\Testimonial;
use DataTables;
use Auth;
use Alert;
use DB;

class TransferConfirmationController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = TransferConfirmation::orderBy('id','desc');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return $row->status == 0 ? 'Submitted' : 'Approved';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.transfer-confirmations.index');
    }

    public function show($id)
    {
        $data = TransferConfirmation::findOrFail($id);

        return \response()->json($data);
    }

    public function approve($id)
    {
        // If Type *Register Member* update table transaction member

        DB::beginTransaction();
        try {
            $data = TransferConfirmation::findOrFail($id);
            $data->update([
                'status' => 1
            ]); 
            // if($data->type == 'Register Member') {
            //     return 'Masuk Sini'; 
            // }
            DB::commit();
            Alert::success('Success Update Data', 'Success');
        } catch (Exception $e) {
            DB::rollback();
            Alert::error('Gagal Update Data', 'Gagal');
            return redirect()->back(); 
        }
    }

    public function htmlAction($row)
    {
        switch($row->status) {
            case 0; 
            return '
                    <a data-id="'.$row->id.'"  class="btn btn-success fa fa-eye show-testimonial" title="Show Payment"></a>
                    <a data-id="'.$row->id.' "class="btn btn-default fa fa-check approve-payment" style="background-color: #b85ebd; color: #ffffff;" title="Approve Payment"></a>';
            break;

            case 1;
            return '
                    <a data-id="'.$row->id.'"  class="btn btn-success fa fa-eye show-testimonial" title="Show Payment"></a>';
            break;

        }
       
    }
}
