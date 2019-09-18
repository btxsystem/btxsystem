<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Employeer;
use DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        // $data = Transaction::with('member','product')->get();
        $data = Employeer::with('transaction')->where('id',1)->first();

        return $data;
    }

}
