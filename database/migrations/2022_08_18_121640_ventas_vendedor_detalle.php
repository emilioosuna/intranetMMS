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
         Schema::create('ventas_vendedor_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vvid')->constrained('ventas_vendedores')->comment('id de la venta por vendedor y periodo registrada');
            $table->string('vendedor')->comment('Nombre Vendedor');
            $table->decimal('montob',20,4)->default(0.0000)->comment('Cantidad de ventas monto bruto(sin iva)');
            $table->integer('vunidades')->default(0)->comment('Cantidad de prodcutos vendidos');
             $table->softDeletes()->comment('indica si el registro fue eliminado o no');
            $table->timestamps();
            // Índices
            $table->index('vvid');
            $table->index('vendedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_vendedor_detalle');
    }
};
