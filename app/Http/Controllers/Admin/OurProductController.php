<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\OurProduct;
use DataTables;
use Auth;
use Alert;

class OurProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = OurProduct::orderBy('id','desc');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('cms.our-products.show',$row->id).'"  class="btn btn-primary fa fa-eye"title="Show"></a>
                                <a href="'.route('cms.our-products.edit',$row->id).'"  class="btn btn-warning fa fa-pencil"title="Edit"></a>
                                <a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-ourProduct"title="Delete"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('admin.our-product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  dd(Auth::guard('admin')->user());
        return view('admin.our-product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'mimes:png,jpg,jpeg'
        ]);
        
        DB::beginTransaction();
        try{

            $data = new OurProduct;
            $data->title = $request->title;
            $data->slug = \Str::slug($request->title) .'-'. date('YmdHis');
            $data->article = $request->article;

            if ($request->hasFile('img')) {
                $image = $request->img;
                $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
                $uploadPath = 'upload/cms/our-product/' . $imageName; //make sure folder path already exist
                $image->move('upload/cms/our-product/', $imageName);
                $data->img = $uploadPath;
            }
        
            $data->save();
            DB::commit();

            Alert::success('Sukses Menambah Data', 'Sukses');

            return redirect()->route('cms.our-products.show', $data->id);

        }catch(\Exception $e){
            // throw $e;
            DB::rollback();
            
            Alert::error('Gagal Menambah Data', 'Gagal');
            return \redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = OurProduct::findOrFail($id);

        return view('admin.our-product.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = OurProduct::findOrFail($id);

        return view('admin.our-product.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'img' => 'mimes:png,jpg,jpeg'
        ]);

        DB::beginTransaction();
        try{
            $data = OurProduct::findOrFail($id);
            $data->title = $request->title;
            $data->slug = $request->title == $data->title ? \Str::slug($request->title) .'-'. date('YmdHis') : $data->slug;
            $data->article = $request->article;

            if ($request->hasFile('img')) {
                $image = $request->img;
                $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
                $uploadPath = 'upload/cms/our-product/' . $imageName; //make sure folder path already exist
                $image->move('upload/cms/our-product/', $imageName);
                $data->img = $uploadPath;
            }

            $data->save();
            DB::commit();

            Alert::success('Sukses Menambah Data', 'Sukses');

            return redirect()->route('cms.our-products.show', $data->id);

        }catch(\Exception $e){
            // throw $e;
            DB::rollback();
            
            Alert::error('Gagal Menambah Data', 'Gagal');
            return \redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = OurProduct::findOrFail($id);
        if ($data) { 
            \File::delete(public_path($data->img));
            $data->delete(); 
            Alert::success('Success Delete Data', 'Success');
        } else {
            Alert::error('Gagal Delete Data', 'Gagal');
        }
    }
}
