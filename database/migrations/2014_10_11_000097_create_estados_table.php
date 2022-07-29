<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $tableName = 'estados';
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id()
                  ->comment('ID del estado');

            $table->string('estado')
                  ->comment('Nombre del estado');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$this->tableName` COMMENT 'TABLA DE ESTADOS'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
