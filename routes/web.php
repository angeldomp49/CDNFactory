<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\UploadController;
use App\Models\Upload as UploadModel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get( '/new-file', function(){
    return view( 'new-file' );
} );

Route::get( '/show-upload', function(){
    return view( 'show-upload' );
} );



Route::post( '/upload', [ UploadController::class, 'upload' ] )->name( 'upload' );

Route::get( '/cdn/{resource}', function( $resource ){
    $upload =  UploadModel::where( 'code', $resource );
    return view( 'cdn', [ 'upload' => $upload ] );
} );