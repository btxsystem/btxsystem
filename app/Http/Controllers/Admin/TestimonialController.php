<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use DataTables;
use Auth;
use Alert;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Testimonial::orderBy('id','desc');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        return $row->isPublished == 1 ? 'Published' : 'Unpublished';
                    })
                    ->addColumn('action', function($row) {
                        return $this->htmlAction($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Testimonial;
        $data->name = $request->name;
        $data->desc = $request->desc;

        if($data->save()) {
            Alert::success('Sukses Menambah Data', 'Sukses');

            return redirect()->route('cms.testimonials.index');
        }

        Alert::error('Gagal Menambah Data', 'Gagal');
        return \redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Testimonial::findOrFail($id);

        return \response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Testimonial::findOrFail($request->id);

        if ($data) {
            $data->name = $request->name;
            $data->desc = $request->desc;


            if($data->save()) {

                Alert::success('Sukses Update Data', 'Sukses');

                return redirect()->route('cms.testimonials.index');
            }

            Alert::error('Gagal Update Data', 'Gagal');
            return \redirect()->back();
        }

        Alert::error('Data tidak ditemukan', 'Gagal');
        return \redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function published($id)
    {
        $data = Testimonial::findOrFail($id);
        if ($data) { 
    
            $data->update([
                'isPublished' => 1
            ]); 
            Alert::success('Success Update Data', 'Success');
        } else {
            Alert::error('Gagal Update Data', 'Gagal');
        }
        return redirect()->back(); 
    }

    public function unpublished($id)
    {
        $data = Testimonial::findOrFail($id);
        if ($data) { 
    
            $data->update([
                'isPublished' => 0
            ]); 
            Alert::success('Success Update Data', 'Success');
        } else {
            Alert::error('Gagal Update Data', 'Gagal');
        }
        return redirect()->back(); 
    }


    public function htmlAction($row)
    {
        switch($row->isPublished) {
            case 1; 
            return '
                    <a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-testimonial" title="Edit"></a>
                    <a data-id="'.$row->id.' "class="btn btn-default fa fa-power-off unpublish-testimonial" style="background-color: #b85ebd; color: #ffffff;" title="Set Unpublished"></a>
                    <a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-ourProduct"title="Delete"></a>';
            break;

            case 0;
            return '
                    <a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-testimonial" title="Edit"></a>
                    <a data-id="'.$row->id.' "class="btn btn-success fa fa-check-square publish-testimonial"title="Set Published"></a>
                    <a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-ourProduct"title="Delete"></a>';
            break;

        }
       
    }
}
