<?php

namespace Database\Seeders;

use App\Traits\Uuid;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Producto;

class PrecioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* Crear Seeder para tabla: precio */

        $fecha_hora = new DateTime();
        foreach(range(1,10) as $indice){
            
            $produto_todo = Producto::all()->pluck('uuid')->toArray();
            DB::table('precios')->insert([
                'uuid' => Str::random(20),
                'uuid_producto' => $produto_todo,    
                'precio_bruto_unitario' => random_int(100, 999),
                'precio_neto_unitario' => random_int(100, 999),
                'created_at' =>  $fecha_hora,
                'updated_at' =>  $fecha_hora,            
            ]);

        }// foreach
     
    }// run
}



