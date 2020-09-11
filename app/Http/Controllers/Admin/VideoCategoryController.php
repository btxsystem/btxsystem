<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use App\Models\Ebook;
use DataTables;
use Alert;
use Validator;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = VideoCategory::query();

        if($ebook = $request->input('ebook')) {
            $data->where('ebook_id', $ebook);
        }

        if (request()->ajax()) {
            return Datatables::of($data->get())
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('video-category.edit',$row->id).'"  class="btn btn-primary fa fa-edit" title="Edit"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.video-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //        
        $data = Ebook::find($id);

        return view('admin.video-categories.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $category = new VideoCategory();
            $category->ebook_id = $request->input('ebook_id');
            $category->name = $request->input('name');

            if($category->save()) {
                Alert::success('Success Add Video Category', 'Success');
            } else {
                Alert::error('Failed Add Video Category', 'Success');
            }

            return back();

        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(VideoCategory $category)
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
        //
        $data = VideoCategory::findOrFail($id);
        
        return view('admin.video-categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        //
        try {
            $update = VideoCategory::findOrFail($category)->update([
                'name' => $request->input('name')
            ]);

            if(!$update) {
                Alert::success('Failed Edit Video Category', 'Gagal');
            }

            Alert::success('Success Edit Video Category', 'Success');

            return back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'Gagal');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoCategory $category)
    {
        //
    }
}
