<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\HallOfFame;
use Alert;

class HallOfFameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = HallOfFame::with(['member','member.rank']);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->editColumn('username', function($data) {
                        return $data->member->username;
                    })

                    ->editColumn('rank', function($data) {
                        return isset($data->member->rank->name) ? $data->member->rank->name : '-';
                    })

                    ->addColumn('action', function($row) {
                        return '';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.hall-of-fame.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hall-of-fame.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'member_id' => $request->parent_id,
            'desc' => $request->desc
        ];
        HallOfFame::create($data);
        Alert::error('Data Saved', 'Success')->persistent("OK");
        return redirect()->route('hall-of-fame.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
