<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransferConfirmation;
use App\Models\Testimonial;
use DataTables;
use Auth;
use Alert;

class TransferConfirmationController extends Controller
{
//    public function index()
//    {
//     return TransferConfirmation::all();
//    }

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
        $data = TransferConfirmation::findOrFail($id);
        if ($data) { 
    
            $data->update([
                'status' => 1
            ]); 
            Alert::success('Success Update Data', 'Success');
        } else {
            Alert::error('Gagal Update Data', 'Gagal');
        }
        return redirect()->back(); 
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
