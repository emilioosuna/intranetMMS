<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\{UserController,HomeController, VentaController,VentasVendedoreController,FacturasVendedoreController};
use App\Models\{Estado,Municipio,Parroquia,User,VentasVendedore,FacturasVendedore};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/escritorio', [HomeController::class, 'escritorio'])->middleware(['auth','verified'])->name('escritorio');

/*--- Ruta Credito---*/
Route::get('/creditos', [HomeController::class, 'creditos'])->middleware(['auth','verified'])->name('creditos');
/*--- Ruta Soporte---*/
Route::get('/soporte', [HomeController::class, 'soporte'])->middleware(['auth','verified'])->name('soporte');

/*--- Rutas resource para los usuarios ---------------------------------------------*/
Route::resource('users', UserController::class)
->names([
         'index'   => 'users.index',
         'show'    => 'users.show',
         'create'  => 'users.create',
         'store'   => 'users.store',
         'edit'    => 'users.edit',
         'update'  => 'users.update',
         'destroy' => 'users.destroy'
])->middleware(['auth','verified']);

/*--- Rutas resource para los usuarios ---------------------------------------------*/
Route::resource('ventas', VentaController::class)
->names([
         'index'   => 'ventas.index',
         'show'    => 'ventas.show',
         'create'  => 'ventas.create',
         'store'   => 'ventas.store',
         'edit'    => 'ventas.edit',
         'update'  => 'ventas.update',
         'destroy' => 'ventas.destroy'
])->middleware(['auth','verified']);

/*--- Rutas resource para los ventas por vendedor ---------------------------------------------*/
Route::resource('ventas-vendedores', VentasVendedoreController::class)
->names([
         'index'   => 'ventas-vendedores.index',
         'show'    => 'ventas-vendedores.show',
         'create'  => 'ventas-vendedores.create',
         'store'   => 'ventas-vendedores.store',
         'edit'    => 'ventas-vendedores.edit',
         'update'  => 'ventas-vendedores.update',
         'destroy' => 'ventas-vendedores.destroy'
])->middleware(['auth','verified']);

/*--- Rutas resource para los facturas por vendedor  ---------------------------------------------*/
Route::resource('facturas-vendedores', FacturasVendedoreController::class)
->names([
         'index'   => 'facturas-vendedores.index',
         'show'    => 'facturas-vendedores.show',
         'create'  => 'facturas-vendedores.create',
         'store'   => 'facturas-vendedores.store',
         'edit'    => 'facturas-vendedores.edit',
         'update'  => 'facturas-vendedores.update',
         'destroy' => 'facturas-vendedores.destroy'
])->middleware(['auth','verified']);

Route::get('cambioclave', [UserController::class,'clave'])->name('users.clave')->middleware(['auth','verified']);
Route::put('cambioclave/{user}', [UserController::class,'updateClave'])->name('users.updateClave')->middleware(['auth','verified']);

// carga el combo municipios
Route::get('/municipio/{estado_id}', function($estado_id){
    return Municipio::where('estado_id',$estado_id)
    ->select('id as value','municipio as text')
    ->orderBy('municipio','ASC')
    ->get();
});

// carga el combo parroquias
Route::get('/parroquia/{municipio_id}', function($municipio_id) {
    return Parroquia::where('municipio_id',$municipio_id)
    ->select('id as value','parroquia as text')
    ->orderBy('parroquia','ASC')
    ->get();
});


require __DIR__.'/auth.php';
