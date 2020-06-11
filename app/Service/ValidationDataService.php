<?php

namespace App\Service;
use DB;

class ValidationDataService
{
  public function validateUniqueMemberUsername($username = null){
    $data = DB::table('employeers')->where('username',$username)->get();

    if(strlen($username) < 6) return true;

    return count($data) > 0 ? true : false;
  }

  public function validateUniqueMemberEmail($email = null)
  {
    $data = DB::table('employeers')->where('email',$email)->get();

    return count($data) > 0 ? true : false;
  }

  public function validateExistMember($username = null)
  {
    $data = DB::table('employeers')->where('username',$username)->get();

    if(strlen($username) < 6) return false;

    return count($data) > 0 ? true : false;
  }
}