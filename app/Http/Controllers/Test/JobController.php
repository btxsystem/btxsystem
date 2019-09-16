<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\TestMailJob;
use App\Mail\TestMail as TestMail;


class JobController extends Controller
{
    //
  public function index()
  {
    $params = [
      'mail' => new TestMail(),
      'email' => 'akunmedia100@gmail.com'
    ];
    dispatch((new TestMailJob($params))->delay(50));
  }
}
