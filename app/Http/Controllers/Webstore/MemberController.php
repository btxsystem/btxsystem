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
        return response()->json($request->all());
    }
}
