<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ventas_vendedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tienda_id')->constrained('tiendas')->comment('id de la tienda al cual pertenece la operacion registrada');
            $table->date('fdesde')->comment('Fecha de la operacion a registrar');
            $table->date('fdhasta')->comment('Fecha de registro');
            $table->softDeletes()->comment('indica si el registro fue eliminado o no');
            $table->timestamps();

            // Índices
            $table->index('tienda_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('ventas_vendedores');
    }
};
