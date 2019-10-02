<?php

namespace App\Http\Controllers\Bca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\Bca\VirtualAccountService;

class VirtualAccountController extends Controller
{
  
  public $virtualAccountService;

  public function __construct(
    VirtualAccountService $virtualAccountService
  )
  {
    $this->virtualAccountService = $virtualAccountService;
  }
  /**
   * bills function
   *
   * @param Request $request
   * @return void
   */
  public function bills(Request $request)
  {
    try {
      $inquryBills = $this->virtualAccountService->checkInquiryBills($request);
  
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
    try {
      $paymentBills = $this->virtualAccountService->paymentBills($request);
  
      return response()->json($paymentBills, 200);
    } catch (\Exception $e) {

    }    
  }

}
