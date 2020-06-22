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

        if(!isSelfRequest()) {
            return redirect('/');
        }

        if( ! \File::exists($storagePath) || !\Auth::check()){
            return redirect('/');
        }

        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$file.'"'
        );

        return Response::make(file_get_contents($storagePath), 200, $headers);
    }
}
