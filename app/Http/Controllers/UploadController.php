<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function upload( Request $request ){
        $validated = $request->validate([
            'upload-name' => 'alpha_num|required|unique:uploads',
            'upload-content' => 'required|max:15000|file'
        ]);
        
        
        DB::table( 'uploads' )->insert([
            'id'   => null,
            'name' => $request->input( 'upload-name' ),
            'content' => $request->input( 'upload-content' ),
            'date-time' => date( 'Y-m-d h:i:sa' )
        ]);
    }
}
