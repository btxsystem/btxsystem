<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Employeer;
use Carbon\Carbon;
use stdClass;
use App\Models\AttachmentImage;
use Illuminate\Routing\UrlGenerator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!\Auth::user()) {
                return redirect('/');
            }
            return $next($request);
        });
    }
    
    public function index(UrlGenerator $url)
    {
        $event = AttachmentImage::where('attachable_type','App\Models\EventPromotion')
                                     ->where('isPublished',1)->select('name','path','desc')->get();
        $data = null;
        if ($event) {
            foreach ($event as $key => $value) {
                $value->path = $url->to('/').'/'.$value->path;
            }
            $data['event'] = $event;
        }
        return view('frontend.auth.event')->with('data', $data);
    }

}
