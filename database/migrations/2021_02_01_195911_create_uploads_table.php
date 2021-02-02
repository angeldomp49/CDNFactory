<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string( 'name', 255 );
            $table->dateTime( 'date-time' );
            $table->binary( 'content' );
            $table->string( 'mime' );
            $table->string( 'extension' );
            $table->timestamps();
        });

        Schema::table( 'uploads', function ( Blueprint $table ){
            DB::statement( 'ALTER TABLE uploads MODIFY content MEDIUMBLOB' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
