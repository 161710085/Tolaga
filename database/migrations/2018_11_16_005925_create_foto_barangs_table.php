<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto');
            $table->unsignedInteger('id_barang');
            $table->foreign('id_barang')->references('id')
            ->on('barangs')->onUpdate('cascade')->onDelete('cascade');      
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_barangs');
    }
}
