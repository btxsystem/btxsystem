<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookChapter;
use DataTables;
use Alert;
use Validator;

class BookChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $book = new BookChapter;
        $book->book_id = $request->book_id;
        $book->title = $request->title;
        $book->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $book->save();
        Alert::success('Sukses Menambah Chapter Book', 'Sukses');

        return redirect()->route('book.show', $request->book_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BookChapter::findOrFail($id);

        if (request()->ajax()) {
            return Datatables::of($data->lessons)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('book-chapter-lesson.show',$row->id).'"  class="btn btn-primary fa fa-eye"title="Show"></a>
                                <a href="'.route('book-chapter-lesson.edit',$row->id).'"  class="btn btn-warning fa fa-pencil"title="Edit"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    

        return view('admin.book-chapters.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = BookChapter::findOrFail($id);

        return \response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateChapter(Request $request)
    {
        $book = BookChapter::findOrFail($request->chapter_id);
        $book->book_id = $request->book_id;
        $book->title = $request->title;
        $book->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $book->save();
    
    
        Alert::success('Sukses Update Chapter Book', 'Sukses');
        
        return back();
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BookChapter::findOrFail($id);
        if ($data) { 
            $data->delete(); 
            Alert::success('Success Delete Book Chapter', 'Success');
            return back();
        } else {
            Alert::error('Gagal Delete Data Book Chapter', 'Gagal');
        }
    }
}
