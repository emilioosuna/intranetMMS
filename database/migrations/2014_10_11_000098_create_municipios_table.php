<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       protected $tableName = 'municipios';
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id()
            ->comment('ID del municipio');

            $table->foreignId('estado_id')
            ->comment('ID del estado a que pertenece el municipio');

            $table->string('municipio')
            ->comment('Nombre del municipio');
            
            $table->timestamps();
            // Índices
            $table->index('estado_id');
            $table->index('municipio');
        });
              DB::statement("ALTER TABLE `$this->tableName` COMMENT 'TABLA DE MUNICIPIOS'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
