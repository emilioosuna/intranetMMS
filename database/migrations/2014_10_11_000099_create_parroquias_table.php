<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateParroquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $tableName = 'parroquias';
    public function up()
    {
        Schema::create('parroquias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id()
                  ->comment('ID de la parroquia');
            $table->unsignedBigInteger('municipio_id')
                  ->comment('ID del municipio al que pertenece la parroquia');
            $table->string('parroquia')
                  ->comment('Nombre de la parroquia');
            $table->timestamps();
            // Índices
            $table->index('municipio_id');
            $table->index('parroquia');
            
        });
        DB::statement("ALTER TABLE `$this->tableName` COMMENT 'TABLA DE PARROQUIAS'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parroquias');
    }
}
