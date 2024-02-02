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
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->comment('vendedor');
            $table->integer('codigo')->nullable()->comment('codigo vendedor');
            $table->string('cedula',15)->nullable()->comment('cedula Vendedor');
            $table->string('nombre')->nullable()->comment('Nombre Vendedor');
            $table->string('telefono')->nullable()->comment('telefono Vendedor');
            $table->string('correo')->nullable()->unique()->comment('correo Vendedor');
            $table->string('imagen')->nullable()->comment('imagen Vendedor');
            $table->softDeletes()->comment('indica si el registro fue eliminado o no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
