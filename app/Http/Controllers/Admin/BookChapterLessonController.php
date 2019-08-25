<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookChapterLesson;
use App\Models\BookChapter;
use Alert;
use Validator;

class BookChapterLessonController extends Controller
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
    public function create($id)
    {
        $data = BookChapter::find($id);
        return view('admin.book-chapter-lessons.create', compact('data'));
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
            'content' => 'required',
        ]);


        $data = new BookChapterLesson;
        $data->title = $request->title;
        $data->chapter_id = $request->chapter_id;
        $data->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $data->content = $request->content;
        $data->type = 'paragraph';
        $data->save();


        Alert::success('Sukses Menambah Data Book', 'Sukses');

        return redirect()->route('book-chapter.show', $request->chapter_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data = BookChapterLesson::findOrFail($id);

    //    return $data;

       return view('admin.book-chapter-lessons.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = BookChapterLesson::findOrFail($id);

        return view('admin.book-chapter-lessons.edit', compact('data'));
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

        $data = BookChapterLesson::findOrFail($id);
        $data->title = $request->title;
        $data->content = $request->content;
        $data->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $data->save();
    
    
        Alert::success('Sukses Update Lesson', 'Sukses');
        
        return view('admin.book-chapter-lessons.detail', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BookChapterLesson::findOrFail($id);
        if ($data) { 
            $data->delete(); 
            Alert::success('Success Delete Book Chapter', 'Success');
        } else {
            Alert::error('Gagal Delete Data Book Chapter', 'Gagal');
        }
    }
}
