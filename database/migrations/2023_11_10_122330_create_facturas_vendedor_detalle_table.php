<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas_vendedor_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fvid')->constrained('facturas_vendedores')->comment('id de la factura por vendedor y periodo registrada');
            $table->string('vendedor')->comment('Nombre Vendedor');
            $table->integer('canfac')->default(0)->comment('Cantidad de facturas por vendedor');
             $table->softDeletes()->comment('indica si el registro fue eliminado o no');
            $table->timestamps();
            // Índices
            $table->index('fvid');
            $table->index('vendedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_vendedor_detalle');
    }
};
