<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tienda;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');                   // Desactiva la revisión de claves foráneas
        DB::table('tiendas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $tiendas = [
            ['id' => '1', 'tienda'=> 'Valencia'],
            ['id' => '2', 'tienda'=> 'Maracay'],
            ['id' => '3', 'tienda'=> 'Barquisimeto'],
            ['id' => '4', 'tienda'=> 'Caracas'],
            ['id' => '5', 'tienda'=> 'Maturin'],
            ['id' => '6', 'tienda'=> 'Barinas'],
            ['id' => '7', 'tienda'=> 'Lecheria'],
            ['id' => '8', 'tienda'=> 'Costaazul la Limpia'],
            ['id' => '9', 'tienda'=> 'Los Cortijos'],
            ['id' => '10', 'tienda'=> 'Maracaibo'],
            ['id' => '11', 'tienda'=> 'Apure'],
            ['id' => '12', 'tienda'=> 'Cumana'],
            ['id' => '13', 'tienda'=> 'Paraguana'],
            ['id' => '14', 'tienda'=> 'La Victoria'],
            ['id' => '15', 'tienda'=> 'Puerto la Cruz'],
            ['id' => '16', 'tienda'=> 'Guacara'],
            ['id' => '17', 'tienda'=> 'San Cristobal'],
            ['id' => '18', 'tienda'=> 'Cabimas'],
            ['id' => '19', 'tienda'=> 'Guanare'],
            ['id' => '20', 'tienda'=> 'Barcelona'],
            ['id' => '21', 'tienda'=> 'Merida']
        ];

        Tienda::insert($tiendas);
    }
}
