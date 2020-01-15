<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventPromotion;
use App\Models\AttachmentImage;
use DataTables;
use Auth;
use Alert;

class EventPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EventPromotion::first();
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
    public function show()
    {
        $data =  EventPromotion::first();

        return view('admin.event-promotion.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = EventPromotion::first();
        return \response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = EventPromotion::findOrFail($request->id);
        $data->title = $request->title;
        $data->desc = $request->desc;

        if($data->save()) {
            Alert::success('Sukses Update Data', 'Sukses');

            return redirect()->route('cms.event-promotions.show');
        }
        Alert::error('Gagal Update Data', 'Gagal');
        return \redirect()->back();
    }

    public function image()
    {
        $data = EventPromotion::first()->attachments;

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->isPublished == 1 ? 'Published' : 'Unpublished';
                })
                ->addColumn('action', function($row) {
                    return $this->htmlAction($row);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function uploadAttachment(Request $request)
    {
        $data = EventPromotion::first();

        $validator = \Validator::make($request->all(), ['path' => 'mimes:png,jpg,jpeg']);

        if ($validator->fails()) {
            Alert::error('The path must be a file of type: png, jpg, jpeg.', 'Gagal');
            return \redirect()->back();
         }

        $uploadPath = '';
        if ($request->hasFile('path')) {

            $image = $request->path;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/event-promotion/' . $imageName; //make sure folder path already exist
            $image->move('upload/event-promotion/', $imageName);
            $path = $uploadPath;
        }
        if($data->addAttachment($request->name, $uploadPath, 0, $request->desc)) {
            Alert::success('Sukses Menambah Data', 'Sukses');

            return redirect()->route('cms.event-promotions.show');
        }
        Alert::error('Gagal Menambah Data', 'Gagal');
        return \redirect()->back();
    }

    public function editAttachment($id)
    {
        $data = AttachmentImage::findOrFail($id);
        return \response()->json($data);
    }

    public function updateAttachment(Request $request)
    {
        $data = AttachmentImage::findOrFail($request->id);
        $data->name = $request->name;
        $oldImg = $data->path;

        if ($request->hasFile('path')) {
            $image = $request->path;
            $imageName = time() . str_random(15).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'upload/event-promotion/' . $imageName; //make sure folder path already exist
            $image->move('upload/event-promotion/', $imageName);
            \File::delete(public_path($oldImg));
            $data->path = $uploadPath;
        }

        if($data->save()) {
            Alert::success('Sukses Update Data', 'Sukses');

            return redirect()->route('cms.event-promotions.show');
        }
        Alert::error('Gagal Update Data', 'Gagal');
        return \redirect()->back();
    }

    public function destroyAttachment($id)
    {
        $data = AttachmentImage::findOrFail($id);
        if ($data) {
            \File::delete(public_path($data->path));
            $data->delete();
            Alert::success('Success Delete Data', 'Success');
        } else {
            Alert::error('Gagal Delete Data', 'Gagal');
        }
    }


    public function published($id)
    {
        $data = AttachmentImage::findOrFail($id);
        if ($data) {

            $data->update([
                'isPublished' => 1
            ]);
            Alert::success('Success Update Data', 'Success');
        } else {
            Alert::error('Gagal Update Data', 'Gagal');
        }
        return redirect()->back();
    }

    public function unpublished($id)
    {
        $data = AttachmentImage::findOrFail($id);
        if ($data) {

            $data->update([
                'isPublished' => 0
            ]);
            Alert::success('Success Update Data', 'Success');
        } else {
            Alert::error('Gagal Update Data', 'Gagal');
        }
        return redirect()->back();
    }




    public function htmlAction($row)
    {
        switch($row->isPublished) {
            case 1;
            $edit = \Auth::guard('admin')->user()->hasPermission('Cms.event.edit') ? '<a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-attachment" title="Edit"></a>' : '';
            $publish = \Auth::guard('admin')->user()->hasPermission('Cms.event.publish') ? '<a data-id="'.$row->id.' "class="btn btn-default fa fa-power-off unpublish-attachment" style="background-color: #b85ebd; color: #ffffff;" title="Set Unpublished"></a>' : '';
            $delete = \Auth::guard('admin')->user()->hasPermission('Cms.event.delete') ? '<a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-attachment"title="Delete"></a>' : '';
            return $edit.' '.$publish.' '.$delete;
            break;

            case 0;
            $edit = \Auth::guard('admin')->user()->hasPermission('Cms.event.edit') ? '<a data-id="'.$row->id.'"  class="btn btn-warning fa fa-pencil edit-attachment" title="Edit"></a>' : '';
            $publish = \Auth::guard('admin')->user()->hasPermission('Cms.event.publish') ? '<a data-id="'.$row->id.' "class="btn btn-success fa fa-check-square publish-attachment"title="Set Published"></a>' : '';
            $delete = \Auth::guard('admin')->user()->hasPermission('Cms.event.delete') ? '<a data-id="'.$row->id.' "class="btn btn-danger fa fa-trash delete-attachment"title="Delete"></a>' : '';
            return $edit.' '.$publish.' '.$delete;
            break;

        }

    }


}
