<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CDNController extends Controller
{
    public $idEncoded;
    public $id;
    public $isModel;
    public $route;

    public function showCDN( $idEncoded ){
        $this->idEncoded = $idEncoded;
        $this->decodeId();
        $this->checkExistsModel();
        $this->generateRoute();
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
        UploadModel::findOrFail( $this->id );
    }

    public function notFound(){
        return view( 'not-found-cdn' );
    }

    public function generateRoute(){
        $this->route = url( '/download/{$this->idEncoded}' ); 
    }

    public function redirectToFinish(){
        if( $this->isModel ){
            return view( 'sho-cdn', [ 'route' => $this->route ] );
        }
        else{
            return view( 'not-found-cdn' );
        }
    }
}
