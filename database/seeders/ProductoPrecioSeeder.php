<?php

namespace Database\Seeders;

use App\Traits\Uuid;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductoPrecioSeeder extends Seeder
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
        foreach(range(1,20) as $indice){

            $producto_descripcion = 'Producto '.$indice;
            $uuid_producto = Str::random(20);
            $uuid_precio = Str::random(20);

            DB::table('productos')->insert([
                'uuid' => $uuid_producto,
                'descripcion' => $producto_descripcion,                
                'created_at' =>  $fecha_hora,
                'updated_at' =>  $fecha_hora,            
            ]);

            DB::table('precios')->insert([
                'uuid' => $uuid_precio,
                'uuid_producto' => $uuid_producto,    
                'precio_bruto_unitario' => random_int(100, 999),
                'precio_neto_unitario' => random_int(100, 999),
                'created_at' =>  $fecha_hora,
                'updated_at' =>  $fecha_hora,            
            ]);            

        }// foreach
     
    }// run    

}// class seeder



