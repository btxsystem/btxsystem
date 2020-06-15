<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\LoginThrottle;
use App\Models\AuthOtp;
use Carbon\Carbon;
use App\Service\ActivityService;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public $activityService;

  public $validateThrottle;

  public function __construct()
  {
    $this->activityService = new ActivityService();
  }

  public function getPasscode(Request $request)
  {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('dashboard');
    }

    return view('admin.auth.passcode');
  }

  public function getLogin(Request $request)
  {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('dashboard');
    }

    $ipAddress = \Request::getClientIp(true);

    if(!$this->validateThrottle($ipAddress)) {
      $this->activityService
        ->setActivity()
        ->setCode('004')
        ->setName('Invalid Activity')
        ->setFrom('Login Page')
        ->record();

      return view('admin.auth.passcode')->with(['message' => 'Invalid Activity, your IP block by Firewall']);
    }

    if(!$this->validatePasscode($request->passcode)) {
      $this->insertUpdateThrottle($ipAddress);

      $this->activityService
        ->setActivity()
        ->setCode('001')
        ->setName('Input Passcode')
        ->setFrom('Passcode Page')
        ->setStatus(false)
        ->record();

      return view('admin.auth.passcode')->with(['message' => 'Invalid Passcode']);
    }

    $this->activityService
      ->setActivity()
      ->setCode('001')
      ->setName('Input Passcode')
      ->setFrom('Passcode Page')
      ->record();

    return view('admin.auth.login');
  }

  public function getLoginOtp()
  {
    // if (!Auth::guard('admin')->check()) {
    //   $ipAddress = \Request::getClientIp(true);
    //   $this->insertUpdateThrottle($ipAddress);

    //   return view('admin.auth.login')->with(['message' => 'Otherwise Invalid']);
    // }

    return view('admin.auth.otp');
  }

  public function insertUpdateThrottle($ip = null) {
    $throttle = LoginThrottle::where('ip_address', $ip)->first();

    if($throttle) {
      if($throttle->total_fail > 1) {

        $updateThrottle = LoginThrottle::where('ip_address', $ip)->update([
          'locked_at' => Carbon::now()->addHours(10)->toDateTimeString()
        ]);

        LoginThrottle::where('ip_address', $ip)->increment('total_fail' ,1);

        return false;
      } else {
        LoginThrottle::where('ip_address', $ip)->increment('total_fail' ,1);

        return true;
      }
    } else {

      LoginThrottle::insert([
        'ip_address' => $ip,
        'total_fail' => 1
      ]);

      return true;
    }
  }

  public function validateThrottle($ip = null, $insert = false)
  {
    if($ip != null) {
      $throttle = LoginThrottle::where('ip_address', $ip)->first();

      if($throttle) {
        if($throttle->total_fail > 2) {

          if($throttle->locked_at != null) {
            $lockedDate = strtotime($throttle->locked_at);
  
            $nowDate = strtotime(date('Y-m-d H:i:s'));
  
            if($nowDate > $lockedDate) {
              LoginThrottle::where('ip_address', $ip)->update([
                'locked_at' => null,
                'total_fail' => 0
              ]);
      
              return true;
            }
  
            return false;
          }

          return false;
        } else {  
          return true;
        }
      }

      return true;
    }

    return false;
  }

  public function postLoginOtp(Request $request)
  {
    //dd($request);
      // Validate the form data
    $userAgent = $request->header('User-Agent');
    $ipAddress = \Request::getClientIp(true);
    
    if(!$this->validateThrottle($ipAddress)) {
      $this->activityService
        ->setActivity()
        ->setCode('004')
        ->setName('Invalid Activity')
        ->setFrom('OTP Page')
        ->record();

      return view('admin.auth.login')->with(['message' => 'Invalid Activity, your IP block by Firewall']);
    }

    // Attempt to log the user in
      // Passwordnya pake bcrypt

    $validOtp = AuthOtp::where('type', 'otp')
      ->where('is_used', 0)
      ->first();

    if(!$validOtp || !\Hash::check($request->otp, $validOtp->code ?? null)) {
      $this->insertUpdateThrottle($ipAddress);

      $this->activityService
        ->setActivity()
        ->setCode('003')
        ->setName('Input OTP')
        ->setFrom('OTP Page')
        ->setStatus(false)
        ->record();

      if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
      }
  
      return view('admin.auth.login')->with(['message' => 'Invalid OTP']);
    }

    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]) && $validOtp) {
        AuthOtp::where('id', $validOtp->id)->update([
          'is_used' => 1
        ]);

        $this->activityService
          ->setActivity()
          ->setCode('003')
          ->setName('Input OTP')
          ->setFrom('OTP Page')
          ->record();

        $this->activityService
          ->setActivity()
          ->setCode('002')
          ->setName('Login Backoffice')
          ->setFrom('Login Backoffice Page')
          ->record();  
        // if successful, then redirect to their intended location
        return redirect()->route('dashboard');
    }

    if (Auth::guard('admin')->check()) {
      Auth::guard('admin')->logout();
    }

    return view('admin.auth.login')->with(['message' => 'Otherwise Invalid']);
  }

  public function validatePasscode($passcode = null)
  {
    if($passcode != null) {
      $data = AuthOtp::where([
        'type' => 'passcode'
      ])->first();

      if(!$data) {
        return false;
      }

      if(!\Hash::check($passcode, $data->code)) {
        return false;
      }

      return true;
    }

    return false;
  }

  public function postLogin(Request $request)
  {
    //dd($request);
      // Validate the form data
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required'
    ]);

    $userAgent = $request->header('User-Agent');
    $ipAddress = \Request::getClientIp(true);
    
    if(!$this->validateThrottle($ipAddress)) {
      $this->activityService
        ->setActivity()
        ->setCode('004')
        ->setName('Invalid Activity')
        ->setFrom('Login Page')
        ->record();

      return view('admin.auth.login')->with(['message' => 'Invalid Activity, your IP block by Firewall']);
    }

    // Attempt to log the user in
      // Passwordnya pake bcrypt

    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
          Auth::guard('admin')->logout();

          $uniqueOtp = $this->generateUniqueOtp($ipAddress, $userAgent);

          $dataOtp = (object) [
            'code' => $uniqueOtp,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'email' => $request->email
          ];

          if($uniqueOtp != null) {
            \Mail::to('office@bitrexgo.co.id')
              ->cc(['dhadhang.efendi@gmail.com','asepyayat.smd@gmail.com'])
              ->send(new SendOtpMail($dataOtp, null));
      
            $this->activityService
              ->setActivity()
              ->setCode('005')
              ->setName('Send OTP Code')
              ->setFrom('Passcode Page')
              ->record();
          } else {
            return view('admin.auth.login')->with(['message' => 'Failed send OTP Code']);
          }

        return view('admin.auth.otp')->with([
          'email' => $request->email,
          'password' => $request->password
        ]);
    }

    $this->insertUpdateThrottle($ipAddress);

    $this->activityService
      ->setActivity()
      ->setCode('002')
      ->setName('Login Backoffice')
      ->setFrom('Login Backoffice Page')
      ->setStatus(false)
      ->record();

    return view('admin.auth.login')->with(['message' => 'Otherwise Invalid']);
  }

  public function generateUniqueOtp($ip = null, $agent = null)
  {
    $code = strtoupper(str_random(10));

    $authOtp = AuthOtp::where('type', 'otp')->where('is_used', false)->first();

    if($authOtp) {
      //return $this->generateUniqueOtp($ip, $agent);
      $update = AuthOtp::where('is_used', false)->where('type', 'otp')->update([
        'code' => password_hash($code, PASSWORD_BCRYPT),
        'ip_address' => $ip,
        'user_agent' => $agent,
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      if(!$update) {
        return null;
      }

      return $code;
    }

    $insert = AuthOtp::insert([
      'code' => password_hash($code, PASSWORD_BCRYPT),
      'type' => 'otp',
      'is_used' => false,
      'ip_address' => $ip,
      'user_agent' => $agent,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);

    if(!$insert) {
      return null;
    }

    return $code;
  }

  public function logout()
  {
    if (Auth::guard('admin')->check()) {
      Auth::guard('admin')->logout();
    }
    return redirect('/backoffice/pintubelakangkhusus');
  }
}
