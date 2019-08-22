<?php
use Illuminate\Support\Facades\DB;
use App\Employeer;

function invoiceNumbering(){
      $dateNow = date('Ym');
      $lastInvoiceNo = Employeer::orderBy('id', 'desc')->pluck('id_member')->first();
      $lastInvoiceDate = substr($lastInvoiceNo, 0, -4); 
      $increment = (int)substr($lastInvoiceNo, -4) + 1;
      $increment = sprintf("M%06d", $increment);


      if ((string)$dateNow == (string)$lastInvoiceDate ) {
          $next = $lastInvoiceDate . $increment;
          return $next;
        }

      $start = 'M'. $dateNow . '000001';
      return $start;
}

