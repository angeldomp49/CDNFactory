<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\CDNController;
use App\Http\Controllers\DownloadController;

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



Route::get( '/new-cdn', function(){
    return view( 'new-cdn' );
} );
Route::post( '/new-cdn', [ UploadController::class, 'newCDN' ])->name( 'new-cdn' );


Route::get( '/show-cdn/{idEncoded}', [ CDNController::class, 'showCDN' ] );

Route::get( '/download/{idEncoded}', [ DownloadController::class, 'download' ] );
