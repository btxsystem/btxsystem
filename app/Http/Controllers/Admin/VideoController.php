<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoEbook;
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
    public function create($id)
    {
        $data = Ebook::find($id);

        return view('admin.videos.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'path' => 'required|mimes:mp4,mov'
        ]);
        
        if ($request->hasFile('path')) {
            $file = $request->path;
            $fileName = \Str::slug($request->title).'-'.time().'-'.$file->getClientOriginalName() ; 
            $uploadPath = 'upload/video/' . $fileName;  
            
            $file->move('upload/video/', $fileName);
        }

        //$ebook = Ebook::findOrFail($request->ebook_id);

        $video = new Video;
        $video->title = $request->title;
        $video->path = $uploadPath;
        
        if ($video->save()) {

            VideoEbook::firstOrCreate([
                'video_id' => $video->id,
                'ebook_id' => $request->ebook_id
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success Upload Video'
            ]);
            // $ebook->videos()->attach($video);
            
            //Alert::success('Sukses Menambah Data Video', 'Sukses');

           // return redirect()->route('ebook.show', $ebook->id);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed Upload Video'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Video::with('videoEbook.ebook')->findOrFail($id);

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
        $data = Video::with('videoEbook.ebook')->findOrFail($id);

        return view('admin.videos.edit', compact('data'));
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
            'path' => 'required|mimes:mp4,mov'
        ]);
        
        $data = Video::findOrFail($id);
        $oldPath = $data->path;
        if ($request->hasFile('path')) {
            $file = $request->path;
            $fileName = \Str::slug($request->title).'-'.time().'-'.$file->getClientOriginalName() ; 
            $uploadPath = 'upload/video/' . $fileName;  
            
            $file->move('upload/video/', $fileName);
            \File::delete(public_path($oldPath));
        }

  
        $data->title = $request->title;
        $data->path = $uploadPath ? $uploadPath : $oldPath;
        
        if ($data->save())
        {
            // Alert::success('Sukses Update Data Book', 'Sukses');

            // return redirect()->route('video.show', $id);
            return response()->json([
                'status' => true,
                'message' => 'Success Update Video'
            ]);
        }
        // Alert::error('Gagal Menambah Data', 'Gagal');
        // return \redirect()->back();
        return response()->json([
            'status' => false,
            'message' => 'Failed Update Video'
        ]);
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

        return back();
    }
}
