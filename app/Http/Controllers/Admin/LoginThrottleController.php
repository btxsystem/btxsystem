<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginThrottle;
use DataTables;
use Alert;
use Carbon\Carbon;

class LoginThrottleController extends Controller
{
    public function index()
    {
        if(!\Auth::guard('admin')->user()->hasPermission('Login_throttle')) {
          return redirect('backoffice/dashboard');
        }

        if (request()->ajax()) {
            $data = LoginThrottle::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                      return '<a href="'.route('login-throttle.unblock', [$data->id]).'" class="btn btn-primary unblock-access">Unblock</a><a href="'.route('login-throttle.block', [$data->id]).'" class="btn btn-warning block-access">Block</a><a href="'.route('login-throttle.destroy', [$data->id]).'" class="btn btn-danger btn-remove">Delete</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.login-throttle.index');
    }

    public function unblock(Request $request, $id = 0)
    {
      try {
        if(!\Auth::guard('admin')->user()->hasPermission('Login_throttle')) {
          return redirect('backoffice/dashboard');
        }

        $unblock = LoginThrottle::findOrFail($id)->update([
          'locked_at' => null,
          'total_fail' => 0,
          'updated_at' => date('Y-m-d H:i:s')
        ]);

        if(!$unblock) {
          Alert::error('Gagal membuka Akses', 'Gagal');
          return redirect()->back();
        }

        Alert::error('Berhasil membuka Akses', 'Sukses');
        return redirect()->back();
      } catch (\Exception $e) {
        Alert::error('Gagal membuka Akses', 'Gagal');
        return redirect()->back();
      }
    }

    public function block(Request $request, $id = 0)
    {
      try {
        if(!\Auth::guard('admin')->user()->hasPermission('Login_throttle')) {
          return redirect('backoffice/dashboard');
        }

        $unblock = LoginThrottle::findOrFail($id)->update([
          'locked_at' => Carbon::now()->addHours(10)->toDateTimeString(),
          'total_fail' => 10,
          'updated_at' => date('Y-m-d H:i:s')
        ]);

        if(!$unblock) {
          Alert::error('Gagal mengunci Akses', 'Gagal');
          return redirect()->back();
        }

        Alert::error('Berhasil mengunci Akses', 'Sukses');
        return redirect()->back();
      } catch (\Exception $e) {
        Alert::error('Gagal mengunci Akses', 'Gagal');
        return redirect()->back();
      }
    }

    public function destroy(Request $request, $id = 0)
    {
      try {
        if(!\Auth::guard('admin')->user()->hasPermission('Login_throttle')) {
          return redirect('backoffice/dashboard');
        }

        $destroy = LoginThrottle::findOrFail($id)->delete();

        if(!$destroy) {
          Alert::error('Gagal menghapus Data', 'Gagal');
          return redirect()->back();
        }

        Alert::error('Berhasil menghapus Data', 'Sukses');
        return redirect()->back();
      } catch (\Exception $e) {
        Alert::error('Gagal menghapus Data', 'Gagal');
        return redirect()->back();
      }
    }
}
