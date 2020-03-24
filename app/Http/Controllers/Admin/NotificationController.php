<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Service\NotificationService;
use DataTables;
use Illuminate\Support\Carbon;

class NotificationController
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.notification.index');
    }

    public function data()
    {
        $data = $this->service->getData();
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function($row) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d M Y');
                })
                ->editColumn('isRead', function($row) {
                    return $row->isRead==1 ? '<label class="btn btn-success">Read</label>' : '<label class="btn btn-danger">Unread</label>';
                })
                ->rawColumns(['isRead'])
                ->make(true);
    }

    public function read($id)
    {
        $this->service->readNotif($id);
    }
}
