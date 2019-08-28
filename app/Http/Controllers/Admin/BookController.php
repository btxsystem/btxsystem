<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Ebook;
use DataTables;
use Alert;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $data = Book::with('ebooks')->select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '<a href="'.route('book.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>
                                <a href="'.route('book.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>
                                <a href="'.route('deleteBook',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Ebook::find($id);

        return view('admin.books.create', compact('data'));
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
            'article' => 'required',
        ]);

        $ebook = Ebook::findOrFail($request->ebook_id);
        $book = new Book;
        $book->title = $request->title;
        $book->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $book->article = $request->article;
        $book->save();

        $ebook->books()->attach($book);

        Alert::success('Sukses Menambah Data Book', 'Sukses');

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
        $data = Book::with('chapters')->findOrFail($id);

        return view('admin.books.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Book::findOrFail($id);

        return view('admin.books.edit', compact('data'));
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
        $data = Book::findOrFail($id);
        $data->title = $request->title;
        $data->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $data->article = $request->article;
        $data->save();

        Alert::success('Sukses Update Data Book', 'Sukses');

        return redirect()->route('book.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Book::findOrFail($id);

        if ($data) { 
            $data->delete(); 
            Alert::success('Success Delete Data Book', 'Success');
        } else {
            Alert::error('Gagal Delete Data Book', 'Gagal');
        }

        return back();
    }

    public function chapterData($id)
    {
        $data = Book::with('chapters')->findOrFail($id);
     
        return Datatables::of($data->chapters)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '
                        <a href="'.route('book-chapter.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>
                        <a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-chapter" title="Edit"></a>
                        <a href="'.route('deleteChapter',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
                    
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function imageData($id)
    {
        $data = Book::with('images')->findOrFail($id);

        // return $data->load('images');
     
        return Datatables::of($data->images)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '
                        <a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-image" title="Edit"></a>
                        <a href="'.route('deleteImage',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
