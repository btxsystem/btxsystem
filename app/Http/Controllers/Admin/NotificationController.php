<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Service\NotificationService;
use DataTables;
use Illuminate\Support\Carbon;
use App\Models\Notification;

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
                    return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d M Y - H:i');
                })
                ->addColumn('isRead', function($row) {
                    return $row->isRead==1 ? '<label class="btn btn-success">Read</label><label onclick="deleteNotif('.$row->id.')" class="btn btn-danger">Delete</label>' : '<label class="btn btn-danger">Unread</label> <label onclick="readNotification('.$row->id.')" class="btn btn-primary">View</label>';
                })
                ->rawColumns(['isRead'])
                ->make(true);
    }

    public function read($id)
    {
        $this->service->readNotif($id);
    }

    public function delete($id)
    {
        try {
            $delete = Notification::where('id', $id)->delete();

            if(!$delete) {
                return response()->json([
                    'status' => false
                ]);
            }

            return response()->json([
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function deleteAll()
    {
        try {
            $delete = Notification::query()->update([
                'isRead' => 2
            ]);

            if(!$delete) {
                return response()->json([
                    'status' => false
                ]);
            }

            return response()->json([
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function readAll()
    {
        try {
            $update = Notification::where('isRead', 0)->update([
                'isRead' => 1
            ]);

            if(!$update) {
                return response()->json([
                    'status' => false
                ]);
            }

            return response()->json([
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function unreadAll()
    {
        try {
            $update = Notification::where('isRead', 1)->update([
                'isRead' => 0
            ]);

            if(!$update) {
                return response()->json([
                    'status' => false
                ]);
            }

            return response()->json([
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function generate()
    {
        $this->service->sendNotification();
    }
}
