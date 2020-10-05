<?php

namespace App\Http\Controllers\Admin;

use App\Employeer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Alert;

class MemberExpiredController extends Controller
{
    public function index()
    {
        return view('admin.member-expired.create');
    }
    //
    public function store(Request $request)
    {
        try {

            if(!$request->hasFile('csv')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal Upload, Silahkan Upload File CSV',
                    'analyze' => ''
                ]);
            }

            $csv = $request->file('csv');
            $analyze = '';
            $totalWarning = 0;
            $totalError = 0;
            $totalSuccess = 0;
            foreach (file($csv) as $key => $line) {
                if ($key > 0) {
                    if (isset($line)) {
                        $columns = explode(";", $line);
                        $employeer = Employeer::select(['expired_at'])->where('username', $columns[0])->first();
                        if ($employeer) {
                            $expiredAt = date('Y-m-d H:i:s', strtotime($columns[1]));
                            $currentExpiredAt = $employeer->expired_at;

                            if(strtotime($expiredAt) > strtotime($currentExpiredAt)) {
                                $employeer->update([
                                    'expired_at' => $expiredAt
                                ]);

                                $analyze .= "<i class='fa fa-check'></i> <span class='text-light'>Masa aktif <strong>{$columns[0]}</strong> diupdate sampai {$expiredAt}<br/></span>";
                                $totalSuccess++;
                            } else {
                                $analyze .= "<i class='fa fa-warning'></i> <span class='text-light'>Masa aktif <strong>{$columns[0]}</strong> Gagal diupdate karena masa aktif sekarang lebih kecil dari masa aktif sebelumnya<br/></span>";
                                $totalWarning++;
                            }
                        } else {
                            $analyze .= "<i class='fa fa-warning'></i> <span class='text-light'>Username <strong>{$columns[0]}</strong> Tidak ada disistem<br/></span>";
                            $totalError++;
                        }
                    }
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Sukses Upload CSV',
                'analyze' => $analyze,
                'error' => [
                    'warning' => $totalWarning,
                    'error' => $totalError,
                    'success' => $totalSuccess
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Upload CSV',
                'analyze' => ''
            ]);
        }
    }
}
