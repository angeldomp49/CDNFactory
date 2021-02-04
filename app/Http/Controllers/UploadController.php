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
        
        $upload = new Upload();
        $upload->name = $request->input( 'upload-name' );
        $upload->content = $request->input( 'upload-content' );
        
        $upload->save();

        $upload->code = Hash::make( $upload->id );

        $upload->save();

        return view( 'show-upload', [ 'upload' => $upload ] );
    }
}
