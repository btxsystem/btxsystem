<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ebook;
use DataTables;
use Alert;
use Validator;


class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Ebook::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('ebook.show',$row->id).'"  class="btn btn-primary fa fa-eye"title="Show"></a>
                                <a href="'.route('ebook.edit',$row->id).'"  class="btn btn-warning fa fa-pencil"title="Edit"></a>
                                <a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash"title="Delete"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('admin.ebooks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ebook = new Ebook;
        $ebook->title = $request->title;
        $ebook->slug = \Str::slug($request->title) .'-'. date('YmdHis') ;
        $ebook->price = $request->price;
        $ebook->price_markup = $request->price_markup;
        $ebook->pv = $request->pv;
        $ebook->bv = $request->bv;
        $ebook->description = $request->description;
        $ebook->save();

        Alert::success('Sukses Menambah Data Ebook', 'Sukses');

        return redirect()->route('ebook.show', $ebook->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Ebook::with('books')->findOrFail($id);

        return view('admin.ebooks.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ebook::findOrFail($id);
 
        return view('admin.ebooks.edit', compact('data'));
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
        
        $data = Ebook::findOrFail($id);
        $data->title = $request->title;
        $data->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $data->price = $request->price;
        $data->price_markup = $request->price_markup;
        $data->pv = $request->pv;
        $data->bv = $request->bv;
        $data->description = $request->description;
        $data->save();
        Alert::success('Sukses Update Data Ebook', 'Sukses');

        return redirect()->route('ebook.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ebook::findOrFail($id);
        if ($data) { 
            $data->delete(); 
            Alert::success('Success Delete Data Ebook', 'Success');
        } else {
            Alert::error('Gagal Delete Data Ebook', 'Gagal');
        }
    }



    public function bookData($id)
    {
        $data = Ebook::with('books')->findOrFail($id);
     
        return Datatables::of($data->books)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '<a href="'.route('book.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>
                        <a href="'.route('book.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>
                        <a href="'.route('deleteBook',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function videoData($id)
    {
        $data = Ebook::with('videos')->findOrFail($id);
     
        return Datatables::of($data->videos)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '<a href="'.route('video.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>
                        <a href="'.route('video.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>
                        <a href="'.route('deleteVideo',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
