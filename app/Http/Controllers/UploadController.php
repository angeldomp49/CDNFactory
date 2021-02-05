<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Upload as UploadModel;
use Illuminate\Support\Facades\Hash;

class UploadController extends Controller
{
    public function upload( Request $request ){
        $validated = $request->validate([
            'upload-name' => 'alpha_num|required',
            'upload-content' => 'required|max:15000|file'
        ]);

        $fileToUpload = $request->file( 'upload-content' );
        $fileSize = $fileToUpload->getSize();
        $fileContent = $fileToUpload->fread( $fileSize );
        $contentEncoded = base64_encode( $fileContent );
        
        $upload = new UploadModel();
        $upload->name = $request->input( 'upload-name' );
        $upload->content = $contentEncoded;
        $upload->datetime = date( 'Y-m-d h:i:s', time() );
        $upload->mime = 'application/pdf';
        $upload->extension = 'pdf';
        $upload->code = '';
        
        $upload->save();

        $upload->code = base64_encode( $upload->id );

        $upload->save();

        return view( 'show-upload', [ 'upload' => $upload ] );
    }
}
