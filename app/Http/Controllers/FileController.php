<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Response;

class FileController extends Controller
{
    /**
     * serveVideo function
     *
     * @param [type] $file
     * @return void
     */
    public function serveVideo ($file)
    {
        $storagePath = public_path('upload/video/' .$file);
        $mimeType = mime_content_type($storagePath);

        $referer = parse_url(\request()->headers->get('referer'), PHP_URL_HOST);
        $host = parse_url(\request()->getHttpHost(), PHP_URL_HOST);

        if(is_null($host)) {
            $host = parse_url(url(''), PHP_URL_HOST);
        }

        if($referer != $host) {
            return redirect('/');
        }

        if( ! \File::exists($storagePath)){
            return redirect('/');
        }

        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$file.'"'
        );

        return Response::make(file_get_contents($storagePath), 200, $headers);
    }
}
