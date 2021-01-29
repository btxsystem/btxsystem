<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ValidationDataService;

class ValidationDataController extends Controller
{
    //

    public $validationService;
    
    public function __construct(ValidationDataService $validationService)
    {
        $this->validationService = $validationService;
    }

    public function validateUniqueMemberUsername(Request $request)
    {
        try {
            return response()->json([
                'success' => $this->validationService->validateUniqueMemberUsername($request->input('username'))
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function validateUniqueMemberEmail(Request $request)
    {
        try {
            return response()->json([
                'success' => $this->validationService->validateUniqueMemberEmail($request->input('email'))
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function validateExistMember(Request $request)
    {
        try {
            return response()->json([
                'success' => $this->validationService->validateExistMember($request->input('username'))
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function validateExistIdentity(Request $request)
    {
        try {
            return response()->json([
                'success' => $this->validationService->validateExistIdentity($request->input('nik'))
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
