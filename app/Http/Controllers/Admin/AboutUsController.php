<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use DataTables;
use Auth;
use Alert;
use App\Models\Icon;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'a';
        if (request()->ajax()) {
            $data = AboutUs::orderBy('id','desc');

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

        return view('admin.about-us.index');
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
        $data = new AboutUs;
        $data->title = $request->title;
        $data->desc = $request->desc;
        $icon = Icon::select('icon')->where('id',$request->icon)->first();
        $data->img = $icon->icon;

        if ($data->save()) {
            Alert::success('Sukses Menambah Data', 'Sukses');

            return redirect()->route('cms.about-us.index');
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
        $data = AboutUs::findOrFail($id);

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
        // return $request->all();
        $data = AboutUs::findOrFail($request->id);
        $data->title = $request->title;
        $data->desc = $request->desc;
        $oldImg = $data->img;

        if ($request->hasFile('img')) {
            $image = $request->img;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/about-us/' . $imageName; //make sure folder path already exist
            $image->move('upload/about-us/', $imageName);
            \File::delete(public_path($oldImg));
            $data->img = $uploadPath;
        }

        if($data->save()) {
            Alert::success('Sukses Update Data', 'Sukses');

            return redirect()->route('cms.about-us.index');
        }
        Alert::error('Gagal Update Data', 'Gagal');
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
        $data = AboutUs::findOrFail($id);
        if ($data) {
            \File::delete(public_path($data->img));
            $data->delete();
            Alert::success('Success Delete Data', 'Success');
        } else {
            Alert::error('Gagal Delete Data', 'Gagal');
        }
    }

    public function published($id)
    {
        $data = AboutUs::findOrFail($id);
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
        $data = AboutUs::findOrFail($id);
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

    public function select2(Request $request){
        $search = $request->q;
        if ($request->q) {
            $data['items'] = Icon::select('id','full_name','icon')->where('full_name', 'like', '%' . $search . '%')->get();
        }else{
            $data['items'] = Icon::select('id','full_name','icon')->get();
            $data['total_count'] = count($data);
        }
        return response()->json($data, 200);
    }

    public function htmlAction($row)
    {
        switch($row->isPublished) {
            case 1;
            $edit = \Auth::guard('admin')->user()->hasPermission('Cms.about_us.edit') ? '<a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-about" title="Edit"></a>' : '';
            $publish = \Auth::guard('admin')->user()->hasPermission('Cms.about_us.publish') ? '<a data-id="'.$row->id.' "class="btn btn-default fa fa-power-off unpublish-about-us" style="background-color: #b85ebd; color: #ffffff;" title="Set Unpublished"></a>' : '';
            $delete = \Auth::guard('admin')->user()->hasPermission('Cms.about_us.delete') ? '<a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-about"title="Delete"></a>':'';
            return $edit.' '.$publish.' '.$delete;
            break;

            case 0;
            $edit = \Auth::guard('admin')->user()->hasPermission('Cms.about_us.edit') ? '<a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-about" title="Edit"></a>' : '';
            $publish = \Auth::guard('admin')->user()->hasPermission('Cms.about_us.publish') ? '<a data-id="'.$row->id.' "class="btn btn-success fa fa-check-square publish-about-us"title="Set Published"></a>' : '';
            $delete = \Auth::guard('admin')->user()->hasPermission('Cms.about_us.delete') ? '<a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-about"title="Delete"></a>':'';
            return $edit.' '.$publish.' '.$delete;
            break;

        }

    }
}
