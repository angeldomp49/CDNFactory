<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public $idEncoded;
    public $id;
    public $model;

    public function download( $idEncoded ){
        $this->idEncoded = $idEncoded;
        $this->decodeId();
        $this->checkExistsModel();
        $this->putContent();
        $this->redirectToFinish();
    }

    public function decodeId(){
        $this->id = base64_decode( $this->idEncoded );
    }

    public function checkExistsModel(){
        $this->isModel = true;
        try{
            $this->searchModel();
        }
        catch( Exception $e ){
            $this->isModel = false;
            $this->notFound();
        }
    }

    public function searchModel(){
        $this->model = UploadModel::findOrFail( $this->id );
    }

    public function notFound(){

    }

    public function putContent(){
        $this->content = $this->model->content;
    }

    public function redirectToFinish(){
        if( $this->isModel ){
            return view( 'download', [ 'content' => $this->content ] );
        }
        else{
            return view( 'not-found-cdn' );
        }
    }
}
