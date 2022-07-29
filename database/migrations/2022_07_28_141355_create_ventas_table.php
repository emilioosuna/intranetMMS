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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tienda_id')->constrained('tiendas')->comment('id de la tienda al cual pertenece la operacion registrada');
            $table->date('fventa')->comment('Fecha de la operacion a registrar');
            $table->date('fregistro')->comment('Fecha de registro');
            $table->decimal('contado',20,4)->default(0.0000)->comment('Cantidad de ventas de contado en USD del Día ');
            $table->decimal('credito',20,4)->default(0.0000)->comment('Cantidad de ventas a credito en USD del Día');
            $table->integer('linea_blanca')->default(0)->comment('Cantidad de prodcutos linea_blanca vendidos a la fecha de la operacion');
            $table->integer('linea_menor')->default(0)->comment('Cantidad de prodcutos linea_menor vendidos a la fecha de la operacion');
            $table->integer('linea_marron')->default(0)->comment('Cantidad de prodcutos linea_marron vendidos a la fecha de la operacion');
            $table->integer('aire_acondicionados')->default(0)->comment('Cantidad de prodcutos aire_acondicionados vendidos a la fecha de la operacion');
            $table->integer('celulares')->default(0)->comment('Cantidad de prodcutos celulares vendidos a la fecha de la operacion');
            $table->integer('otros')->default(0)->comment('Cantidad de prodcutos otros vendidos a la fecha de la operacion');
            $table->softDeletes()->comment('indica si el registro fue eliminado o no');
            $table->timestamps();

              // Índices
            $table->index('tienda_id');
            $table->index('fventa');
            $table->index('fregistro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};

