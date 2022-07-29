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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('estado_id')
                  ->nullable()
                  ->constrained('estados')
                  ->comment('Código del Estado (entidad federal)');
            $table->foreignId('municipio_id')
                  ->nullable()
                  ->constrained('municipios')
                  ->comment('Código del Municipio (Sucursal tienda)');
            $table->foreignId('parroquia_id')
                  ->nullable()
                  ->constrained('parroquias')
                  ->comment('Código de la Parroquia');
            $table->tinyInteger('nivel')->default(3)
            ->comment('1: Root, 2: Administrador, 3: Usuario Operaciones, 4: Usuario Generente');
            $table->foreignId('tienda')->nullable()->constrained('tiendas')
            ->comment('id de la tienda al cual pertenece el usuario');
            $table->rememberToken();
            $table->softDeletes()
                  ->comment('Indica si el Proveedor fue borrado o no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
