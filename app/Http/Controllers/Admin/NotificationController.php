<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Service\NotificationService;
use DataTables;

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
                ->make(true);
    }

    public function read()
    {
        $this->service->readNotif();
    }
}
