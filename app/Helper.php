<?php
use Illuminate\Support\Facades\DB;
use App\Employeer;

function invoiceNumbering(){
      $dateNow = date('ym');
      $lastInvoiceNo = Employeer::pluck('id_member')->last();
      $lastInvoiceDate = substr($lastInvoiceNo, 0, -4); 
      $increment = (int)substr($lastInvoiceNo, -4) + 1;
      $increment = sprintf("%06d", $increment);
      return 'M'.$dateNow.$increment;
}

function currency($value)
{
    if (is_decimal($value)) {
        return 'Rp. ' . number_format($value, 2).',-';
    }
    return 'Rp. ' . number_format($value, 0).',-';
}

function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

