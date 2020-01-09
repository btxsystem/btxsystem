<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use Auth;
use DB;
use Alert;
use Carbon\Carbon;
use App\Models\Testimonial;
use App\Models\AttachmentImage;
use Illuminate\Routing\UrlGenerator;
use App\Models\AboutUs;

class LoginController extends Controller
{
  public function getLogin(UrlGenerator $url)
  {
    $testimoni = Testimonial::where('isPublished',1)->select('name','desc')->get();
    $ourHeadQuarter = AttachmentImage::where('attachable_type','App\Models\OurHeadquarter')
                                     ->where('isPublished',1)->select('name','path')->get();
    $ourProduct = AttachmentImage::where('attachable_type','App\Models\EventPromotion')
                                     ->where('isPublished',1)->select('name','path')->get();
    $about_us = AboutUs::where('isPublished',1)->select('title','img','desc')->get();

    $data = null;
    if ($testimoni) {
        $data['testimoni'] = $testimoni;
    }if ($ourHeadQuarter) {
        foreach ($ourHeadQuarter as $key => $value) {
           $value->path = $url->to('/').'/'.$value->path;
        }
        $data['ourHeadQuarter'] = $ourHeadQuarter;
    }if ($ourProduct) {
        foreach ($ourProduct as $key => $value) {
            $value->path = $url->to('/').'/'.$value->path;
        }
        $data['ourProduct'] = $ourProduct;
    }if ($about_us) {
        $data['about_us'] = $about_us;
    }
    return view('frontend.auth.login')->with('data',$data);
  }
  public function postLogin(Request $request)
  {

    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    $data = DB::table('close_member')->select('is_close_member')->first();

    if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password]) || Auth::guard('user')->attempt(['email' => $request->username, 'password' => $request->password])) {

      if (Auth::user()->expired_at <= Carbon::now() || Auth::user()->expired_at==null) {
        Auth::guard('user')->logout();
        return view('frontend.expired-member');
      }

      elseif(Auth::user()->status==0) {
        Auth::guard('user')->logout();
        Alert::error('Your account has been banned, please contact admin', 'Error')->persistent("OK");
        return view('frontend.auth.login');
      }

      elseif ($data->is_close_member == 1) {
        Auth::guard('user')->logout();
        return view('frontend.auth.maintenance');
      }

      return redirect()->route('member.dashboard');

    } else if (Auth::guard('nonmember')->attempt(['username' => $request->username, 'password' => $request->password])){
        if ($data->is_close_member == 1) {
          Auth::guard('user')->logout();
          return view('frontend.auth.maintenance');
        }
      return redirect()->route('member.home');
    }

    else{
      Alert::error('Username or password is incorrect', 'Error')->persistent("OK");
    }
    return view('frontend.auth.login');
  }

  public function logout()
  {
    if (Auth::guard('user')->check()) {
      Auth::guard('user')->logout();
    }
    return redirect('/login');
  }
}
