<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHistorialIdToPuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntos', function (Blueprint $table) {
            //

            $table->bigInteger("historial_id")->nullable();

            $table->foreign("historial_id")->references("id")->on("historials");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puntos', function (Blueprint $table) {
            //
            $table->dropForeign(['historial_id']);
        });
    }
}
