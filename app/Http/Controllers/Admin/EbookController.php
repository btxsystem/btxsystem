<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ebook;
use DataTables;
use Alert;
use Validator;
use DB;


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
            $data = Ebook::orderBy('id','desc');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $detail = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.detail') ? '<a href="'.route('ebook.show',$row->id).'"  class="btn btn-primary fa fa-eye"title="Show"></a>' : '';
                        $edit   = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.edit') ? '<a href="'.route('ebook.edit',$row->id).'"  class="btn btn-warning fa fa-pencil"title="Edit"></a>' : '';
                        $action = $detail.' '.$edit;
                        return $action;
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
        $request->validate([
            'src' => 'mimes:png,jpg,jpeg'
        ]);

        $ebook = new Ebook;
        $ebook->title = $request->title;
        $ebook->slug = \Str::slug($request->title) .'-'. date('YmdHis') ;
        $ebook->price = $request->price;
        $ebook->price_markup = $request->price_markup;
        $ebook->pv = $request->pv;
        $ebook->bv = $request->bv;
        $ebook->description = $request->description;

        if ($request->hasFile('src')) {
            $image = $request->src;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/ebook/image/' . $imageName; //make sure folder path already exist
            $image->move('upload/ebook/image/', $imageName);
            $ebook->src = $uploadPath;
        }

        $ebook->save();
        $ebook->position = $ebook->id;
        $ebook->save();
       

        $ebook_renewal = new Ebook;
        $ebook_renewal->title = $request->title .' '. 'Renewal';
        $ebook_renewal->slug = \Str::slug($ebook_renewal->title) .'-'. date('YmdHis') ;
        $ebook_renewal->price = $request->price_renewal;
        $ebook_renewal->price_markup = $request->price_markup_renewal;
        $ebook_renewal->pv = $request->pv_renewal;
        $ebook_renewal->bv = $request->bv_renewal;
        $ebook_renewal->description = $request->description;
        $ebook_renewal->src = $ebook->src;
        $ebook_renewal->position = $ebook->id;
        $ebook_renewal->save();

        Alert::success('Sukses Menambah Data Ebook', 'Sukses');

        return redirect()->route('ebook.index');
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

        $request->validate([
            'src' => 'mimes:png,jpg,jpeg'
        ]);

        
        $data = Ebook::findOrFail($id);
        $oldImage = $data->src; //Get old path to delete when updated

        $data->title = $request->title;
        $data->slug = \Str::slug($request->title) .'-'. date('YmdHis');
        $data->price = $request->price;
        $data->price_markup = $request->price_markup;
        $data->pv = $request->pv;
        $data->bv = $request->bv;
        $data->description = $request->description;

        if ($request->hasFile('src')) {
            $image = $request->src;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/ebook/image/' . $imageName; //make sure folder path already exist
            $image->move('upload/ebook/image/', $imageName);

            \File::delete(public_path($oldImage)); //Delete old image
            $data->src = $uploadPath;
        }


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
            \File::delete(public_path($data->src));
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
                $show = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.book.view') ? '<a href="'.route('book.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>' : '';
                $edit = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.book.edit') ? '<a href="'.route('book.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>' : '';
                $delete = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.book.delete') ? '<a href="'.route('deleteBook',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>' : '';
                return $show.' '.$edit.' '.$delete;
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
                $show = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.video.view') ? '<a href="'.route('video.show',$row->id).'"  class="btn btn-primary fa fa-eye" title="Show"></a>' : '';
                $edit = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.video.edit') ? '<a href="'.route('video.edit',$row->id).'"  class="btn btn-warning fa fa-pencil" title="Edit"></a>' : '';
                $delete = \Auth::guard('admin')->user()->hasPermission('Ebooks.list.video.delete') ? '<a href="'.route('deleteVideo',$row->id).'" class="btn btn-danger fa fa-trash" title="Delete"></a>' : '';
                return $show.' '.$edit.' '.$delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function salesEbook(){
        $datas = DB::table('transaction_member')->select(DB::raw('MONTH(created_at) as tanggal'), DB::raw('count(id) as views'))
                                                ->where(DB::raw('YEAR(created_at)'),now()->year)->where('status',1)
                                                ->where('transaction_ref','<>', null)->groupBy('tanggal')->get();
        $tmp_data = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($datas as $key => $data) {
            if ($data->tanggal != null) {
                switch ($data->tanggal) {
                    case '1':
                        $tmp_data[0] = $data->views;
                        break;
                    case '2':
                        $tmp_data[1] = $data->views;
                        break;
                    case '3':
                        $tmp_data[2] = $data->views;
                        break;
                    case '4':
                        $tmp_data[3] = $data->views;
                        break;
                    case '5':
                        $tmp_data[4] = $data->views;
                        break;
                    case '6':
                        $tmp_data[5] = $data->views;
                        break;
                    case '7':
                        $tmp_data[6] = $data->views;
                        break;
                    case '8':
                        $tmp_data[7] = $data->views;
                        break;
                    case '9':
                        $tmp_data[8] = $data->views;
                        break;
                    case '10':
                        $tmp_data[9] = $data->views;
                        break;
                    case '11':
                        $tmp_data[10] = $data->views;
                        break;
                    case '12':
                        $tmp_data[11] = $data->views;
                        break;
                }
            }
        }
        return response()->json($tmp_data, 200);
    }

}
