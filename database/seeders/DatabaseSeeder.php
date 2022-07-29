<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Departamento;
use App\Models\TipoEquipo;
use App\Models\TipoIncidencia;
use App\Models\MarcasEquipo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(ParroquiaSeeder::class);
        $this->call(TiendaSeeder::class);
        $this->call(UserSeeder::class);

    }
}

;
