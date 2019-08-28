<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ImageBook;
use App\Models\Book;
use DataTables;
use Alert;
use Validator;

class BookImageController extends Controller
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
        // return $request->all();
        // return $request->src;
        $request->validate([
            'src' => 'mimes:png,jpg,jpeg'
        ]);
        
        $book = Book::findOrFail($request->book_id);

        $data = new Image;
        $data->name = $request->name;

        if ($request->hasFile('src')) {
            $image = $request->src;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/book/image/' . $imageName; //make sure folder path already exist
            $image->move('upload/book/image/', $imageName);
            $data->src = $uploadPath;
        }
        $data->save();

        $data->books()->attach($book);


        Alert::success('Sukses Update Data Image', 'Sukses');

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
        return Image::with('books')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Image::findOrFail($id);

        return \response()->json($data);
    }

    public function updateImage(Request $request)
    {
        $data = Image::findOrFail($request->image_id);
        $oldSrc = $data->src;

        $data->name = $request->name;
        if ($request->hasFile('src')) {
            $image = $request->src;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/book/image/' . $imageName; //make sure folder path already exist
            $image->move('upload/book/image/', $imageName);
            \File::delete(public_path($oldSrc));
            // $data->src = $uploadPath;
        }
        $data->src = $request->src ? $uploadPath : $oldSrc;
        $data->save();
    
    
        Alert::success('Sukses Update Image', 'Sukses');
        
        return back();
 
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
        $data = Image::findOrFail($id);

        if ($data) { 
            $data->delete(); 
            Alert::success('Success Delete Data Image', 'Success');
        } else {
            Alert::error('Gagal Delete Data Image', 'Gagal');
        }

        return back();
    }
}
