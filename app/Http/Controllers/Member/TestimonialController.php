<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimoni = Testimonial::where('isPublished',1)->select('name','desc')->get();
        $data = [];
        $status = null;
        if ($testimoni) {
            $data = [
                'datas' => $testimoni,
                'success' => true
            ];
            $status = 200;
        }else{
            $data = [
                'datas' => null,
                'success' => false
            ];
            $status = 402;
        }
        return response()->json($data, $status);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'desc' => $request->desc,
        ];

        $cek = Testimonial::create($data);
        $response = [];
        $status = null;
        if (!$cek) {
            $response = [
                'success' => false,
            ];
            $status = 403;
        }else{
            $response = [
                'success' => true,
            ];
            $status = 200;
        }

        return response()->json($response, $status);
    }
}
