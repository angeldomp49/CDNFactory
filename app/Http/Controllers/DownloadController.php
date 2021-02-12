<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Upload as UploadModel;

class DownloadController extends Controller
{
    public $idEncoded;
    public $id;
    public $isModel;
    public $model;
    public $content;

    public function download( $idEncoded ){
        $this->idEncoded = $idEncoded;
        $this->decodeId();
        $this->checkExistsModel();
        $this->putContent();

        if( $this->isModel ){
            $this->downloadFile();
        }
        else{
            return $this->notFoundCDN();
        }
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
        }
    }

    public function searchModel(){
        $this->model = UploadModel::where( 'id', $this->id )->first();
    }

    public function putContent(){
        $this->content = $this->model->content;
    }

    public function downloadFile(){
        $content = $this->content;
            
        if (!isset($_SERVER['HTTP_ACCEPT_ENCODING']) OR empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
            header('Content-Length: '. strlent( $content ));
        }
        header('Content-Type: application/pdf');
        header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0, max-age=1');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); 
        header( 'Content-Disposition: inline; filename="doc.pdf"' );
    
        echo( $content );
    }

    public function notFoundCDN(){
        return view( 'not-found-cdn' );
    }
    
}
