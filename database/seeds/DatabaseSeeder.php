<?php

use Illuminate\Database\Seeder;
use App\Tipo;
use App\Aeronave;
use App\Aeroporto;
use App\Voo;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //Tipo de aeronave
        $tipo = new Tipo([
            "tipo" => "C440"
        ]);

        $tipo->save();

        //Aeronave
        $aeronave = new Aeronave([
            "matricula" => "PT-4888",
            "tipo_id" => $tipo->id
        ]);

        $aeronave->save();
        
        //Aeroporto de origem
        $origem = new Aeroporto([
            "nome" => "SPMG"
        ]);

        $origem->save();

        //Aeroporto de destino
        $destino = new Aeroporto([
            "nome" => "SPMS"
        ]);

        $destino->save();

        //Voo
        $voo = new Voo([
            "numero" => "TAM4855",
            "data" => date('Y-m-d'),
            "hora" => date('H:i:s'),
            "aeronave_id" => $aeronave->id,
            "origem_id" => $origem->id,
            "destino_id" => $destino->id
        ]);

        $voo->save();
    }
}
