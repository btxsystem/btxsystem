<?php
use Illuminate\Support\Facades\DB;
use App\Employeer;

function invoiceNumbering(){
      $dateNow = date('ym');
      $lastInvoiceNo = Employeer::pluck('id_member')->last();
      $lastInvoiceDate = substr($lastInvoiceNo, 0, -4); 
      $increment = (int)substr($lastInvoiceNo, -4) + 1;
      $increment = sprintf("%04d", $increment);
      return $lastInvoiceDate . $increment;
}

