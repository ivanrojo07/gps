<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("usuario_id");
            $table->decimal("lat",10,7);
            $table->decimal("lng",10,7);
            $table->time("hora",0);
            $table->date("fecha",0);
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
        Schema::dropIfExists('puntos');
    }
}
