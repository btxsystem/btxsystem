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
        //
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
        if (request()->ajax()) {
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

        return $data;

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
        //
    }
}
