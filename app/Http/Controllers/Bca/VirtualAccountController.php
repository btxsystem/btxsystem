<?php

namespace App\Http\Controllers\Bca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\Bca\VirtualAccountService;

class VirtualAccountController extends Controller
{
  
  /**
   * bills function
   *
   * @param Request $request
   * @return void
   */
  public function bills(Request $request)
  {
    try {
      $inquryBills = (new VirtualAccountService())->checkInquiryBills($request);
  
      return response()->json($inquryBills, 200);
    } catch (\Exception $e) {

    }
  }

  /**
   * payments function
   *
   * @param Request $request
   * @return void
   */
  public function payments(Request $request)
  {
    
  }

}
