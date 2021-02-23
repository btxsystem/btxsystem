<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GaleryVideo;
use DataTables;
use Alert;
use Validator;

class GalleryVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = GaleryVideo::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a onclick="deleteVideo('. $row->id .')" class="btn btn-danger fa fa-trash" title="Delete"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.video-galleries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video-galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set("memory_limit", "-1");

        // return $request->all();
        // $request->validate([
        //     'path' => 'required|mimes:mp4,mov',
        //     'title' => 'required'
        // ]);

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $fileName = \Str::slug($request->title).'_'.time().'_.'.$file->getClientOriginalExtension() ;
            $uploadPath = 'upload/video/' . $fileName;
        } else {
            $uploadPath = $request->path;
        }

        $file->move("upload/video/", $fileName);

        $video = new GaleryVideo;
        $video->title = $request->title;
        $video->path = $uploadPath;
        $video->save();

        Alert::success('Sukses Menambah Data Video', 'Sukses');

        return redirect()->route('galeries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = Video::with('videoEbook.ebook')->findOrFail($id);

        // return view('admin.videos.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data = Video::with('videoEbook.ebook')->findOrFail($id);
        // $categories = VideoCategory::where('ebook_id', $data->videoEbook->ebook->id)->get();

        // return view('admin.videos.edit', compact('data', 'categories'));
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
        // $request->validate([
        //     'path' => 'required|mimes:mp4,mov'
        // ]);

        // $data = Video::findOrFail($id);
        // $oldPath = $data->path;
        // $uploadPath = $request->path;
        // if ($request->hasFile('path')) {
        //     $file = $request->path;
        //     $fileName = \Str::slug($request->title).'-'.time().'-'.$file->getClientOriginalName() ;
        //     $uploadPath = 'upload/video/' . $fileName;

        //     $file->move('upload/video/', $fileName);
        //     \File::delete(public_path($oldPath));
        // }


        // $data->title = $request->title;
        // $data->category_id = $request->category_id;
        // // $data->path = $uploadPath ? $uploadPath : $oldPath;
        // $data->path = $request->path;

        // if ($data->save())
        // {
        //     // Alert::success('Sukses Update Data Book', 'Sukses');

        //     // return redirect()->route('video.show', $id);
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Success Update Video'
        //     ]);
        // }
        // // Alert::error('Gagal Menambah Data', 'Gagal');
        // // return \redirect()->back();
        // return response()->json([
        //     'status' => false,
        //     'message' => 'Failed Update Video'
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = GaleryVideo::findOrFail($id);

        if ($data) {
            \File::delete(public_path($data->path));
            $data->delete();
            Alert::success('Success Delete Data Video', 'Success');
        } else {
            Alert::error('Gagal Delete Data Video', 'Gagal');
        }

        return back();
    }
}
