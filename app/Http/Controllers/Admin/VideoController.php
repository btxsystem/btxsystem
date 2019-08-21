<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Ebook;
use DataTables;
use Alert;
use Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Video::with('ebooks')->select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('video.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>
                                <a href="'.route('video.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>
                                <a href="'.route('deleteVideo',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ebooks = Ebook::all();
        return view('admin.videos.create', compact('ebooks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->video;
        $fileName = \Str::slug($request->title).'-'.time().'-'.$file->getClientOriginalName() ; 
        $uploadPath = 'upload/video/' . $fileName;  
        
        $file->move('upload/video/', $fileName);

        $ebook = Ebook::findOrFail($request->ebook_id);
        $video = new Video;
        $video->title = $request->title;
        $video->path = $uploadPath;

        $video->save();

        $ebook->videos()->attach($video);


        Alert::success('Sukses Menambah Data Video', 'Sukses');

        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Video::findOrFail($id);
        return view('admin.videos.detail', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Video::findOrFail($id);

        if ($data) { 
            \File::delete(public_path($data->path));
            $data->delete(); 
            Alert::success('Success Delete Data Video', 'Success');
        } else {
            Alert::error('Gagal Delete Data Video', 'Gagal');
        }

        return redirect()->route('video.index');
    }
}
