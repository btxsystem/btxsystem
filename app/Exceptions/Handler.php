<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;
use Response;
use Illuminate\Auth\AuthenticationException;
use Auth;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];
    
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
      if ($exception instanceof CustomException) {
        return response()->view('errors.custom', [], 500);
      }
      if (request()->segment(1) != 'backoffice' || request()->segment(1) != 'ebook' || request()->segment(1) != 'login') {
        if (!Auth::user()) {
            return redirect('/');
        }
      }
      return parent::render($request, $exception);
    }
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
      if($request->expectsJson()){
        return response()->json(['error' => 'Unauthenticated.'], 401);
      }
      return redirect('/login');
    }
}
