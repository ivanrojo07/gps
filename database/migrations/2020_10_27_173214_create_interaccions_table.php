<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteraccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaccions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("usuario_id");
            $table->bigInteger("interaccion_id");
            $table->decimal("lat_usuario",10,7);
            $table->decimal("lng_usuario",10,7);
            $table->decimal("lat_interaccion",10,7);
            $table->decimal("lng_interaccion",10,7);
            $table->decimal("distancia",4,2);
            $table->date("fecha",0);
            $table->time("hora",0);
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
        Schema::dropIfExists('interaccions');
    }
}
