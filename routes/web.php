<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Resources\Upload as UploadResource;
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
    view( 'upload' );
} );

Route::post( '/upload', [ UploadController::class, 'upload' ] )->name( 'upload' );

Route::get( '/cdn/{resource}', function( $resource ){
    return UploadResource::where( 'code', $resource );
} );

Route::get( '/cdn/content/{code}', function( $code ){
    $upload = Upload::where( 'code', $code );
    return view( 'file', [ 'upload' => $upload ] );
} );