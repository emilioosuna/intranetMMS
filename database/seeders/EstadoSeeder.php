<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');                   // Desactiva la revisión de claves foráneas
        DB::table('estados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $estados = [
            ['id' => '1','estado' => 'Amazonas'],
            ['id' => '2','estado' => 'Anzoátegui'],
            ['id' => '3','estado' => 'Apure'],
            ['id' => '4','estado' => 'Aragua'],
            ['id' => '5','estado' => 'Barinas'],
            ['id' => '6','estado' => 'Bolívar'],
            ['id' => '7','estado' => 'Carabobo'],
            ['id' => '8','estado' => 'Cojedes'],
            ['id' => '9','estado' => 'Delta Amacuro'],
            ['id' => '10','estado' => 'Falcón'],
            ['id' => '11','estado' => 'Guárico'],
            ['id' => '12','estado' => 'Lara'],
            ['id' => '13','estado' => 'Mérida'],
            ['id' => '14','estado' => 'Miranda'],
            ['id' => '15','estado' => 'Monagas'],
            ['id' => '16','estado' => 'Nueva Esparta'],
            ['id' => '17','estado' => 'Portuguesa'],
            ['id' => '18','estado' => 'Sucre'],
            ['id' => '19','estado' => 'Táchira'],
            ['id' => '20','estado' => 'Trujillo'],
            ['id' => '21','estado' => 'La Guaira'],
            ['id' => '22','estado' => 'Yaracuy'],
            ['id' => '23','estado' => 'Zulia'],
            ['id' => '24','estado' => 'Distrito Capital'],
            ['id' => '25','estado' => 'Dependencias Federales']
        ];

        Estado::insert($estados);
    }
}
