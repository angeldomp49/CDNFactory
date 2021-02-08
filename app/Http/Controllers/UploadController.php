<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Upload as UploadModel;

class UploadController extends Controller
{
    public $request;

    public $fileName;
    public $fileContent;
    public $fileSize;

    public $dateTime;
    public $mime;
    public $extension;
    public $code;

    public $redirectTo;

    public function newCDN( Request $request ){
        $this->request = $request;
        $this->validateUpload();
        $this->extractFileData();
        $this->fillMetaData();
        $this->createModel();
        return $this->redirectToFinish();
        
    }

    public function validateUpload(){
        $validated = $this->request->validate([
            'upload-content' => 'required|max:15000|file'
        ]);
    }

    public function extractFileData(){
        $fileInfo = $this->request->file( 'upload-content' );
        $fileObject = $fileInfo->openFile();

        $this->fileName = $fileInfo->getFilename();
        $this->fileSize = $fileInfo->getSize();
        $this->fileContent = $fileObject->fread( $this->fileSize );
    }

    public function fillMetaData(){
        $this->dateTime = date( 'Y-m-d h:i:s', time() );
        $this->mime = 'application/pdf';
        $this->extension = 'pdf';
        $this->code = '';
    }

    public function createModel(){
        $upload = new UploadModel();
        $upload->name = $this->fileName;
        $upload->content = $this->fileContent;
        $upload->datetime = $this->dateTime;
        $upload->mime = $this->mime;
        $upload->extension = $this->extension;
        $upload->code = $this->code;
        
        $upload->save();

        $upload->code = base64_encode( $upload->id );

        $upload->save();

        $this->code = $upload->code;
    }

    public function redirectToFinish(){
        $this->redirectTo = url( "/show-cdn/{$this->code}" );
        return redirect( $this->redirectTo );
    }

}
