<?php

namespace Database\Seeders;

use App\Models\Punto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::connection("pgsql_2")->table('puntos')->orderBy('id')->chunk(100, function ($puntos) {
		   	foreach ($puntos as $p) {
		   		$punto = Punto::create([
		   			"usuario_id" => $p->usuario_id,
					"lat" => $p->lat,
					"lng" => $p->lng,
					"hora" => $p->hora,
					"fecha" => $p->fecha
		   		]);
		   		var_dump($punto);
		   	}
		});
		
    }
}
