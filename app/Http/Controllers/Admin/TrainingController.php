<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Training;
use DataTables;

class TrainingController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Training::all('id','location','start_training','price','capacity','note','open');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('price', function($row){
                        return "Rp " . number_format($row->price,2,',','.');
                    })
                    ->editColumn('open', function($row){
                        return $row->open ? 'Yes' : 'No';
                    })
                    ->addColumn('action', function($row) {
                        return '<a href="/admin/trainings/'. $row->id .'/edit" class="btn btn-warning fa fa-edit"></a>
                                <a onclick="deleteTraining('. $row->id .')" class="btn btn-danger fa fa-trash"></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.trainings.index');
    }

    public function create()
    {
        return view('admin.trainings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|min:5|max:255',
            'start_training' => 'required|date',
            'price' => 'required|numeric|min:1',
            'capacity' => "required|numeric|min:1",
            'open' => "required|boolean",
        ]);

        $training = Training::create($request->all());

        return redirect()->route('admin.trainings.index');
    }

    public function edit($id)
    {
        $training = Training::findOrFail($id);

        return view('admin.trainings.edit', compact('training'));
    }

    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'location' => 'required|min:5|max:255',
            'start_training' => 'required|date',
            'price' => 'required|numeric|min:1',
            'capacity' => "required|numeric|min:1",
            'open' => "required|boolean",
        ]);

        $training = Training::findOrFail($id)->update($request->all());

        return redirect()->route('admin.trainings.index');
    }

    public function destroy($id)
    {
        $training = Training::findOrFail($id)->delete();

        return redirect()->route('admin.trainings.index');
    }
}
