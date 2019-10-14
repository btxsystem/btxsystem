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
      return response()->json([
        'ErrorCode' => 'ESB-14-011',
        'ErrorMessage' => [
          'Indonesian' => 'Service tidak ada',
          'English' => "Service doesn't exist"
        ]
      ], 400);
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
      return response()->json([
        'ErrorCode' => 'ESB-14-011',
        'ErrorMessage' => [
          'Indonesian' => 'Service tidak ada',
          'English' => "Service doesn't exist"
        ]
      ], 400);
    }    
  }

}
