<?php

namespace App\Http\Controllers\Webstore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\MemberService;

class MemberController extends Controller
{
    //

    public $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function register(Request $request)
    {
        try {
            $register = $this->memberService->registerMemberAutoPlacement($request);
            return response()->json([
                'status' => true,
                'data' => $register
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null
            ]);
        }
    }
}
