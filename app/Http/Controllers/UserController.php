<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetalle;
use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Tienda;
use Illuminate\Auth\Events\Registered;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

       public function __construct()
    {
        $this->middleware('permission:users.index')->only(['index']);
        $this->middleware('permission:users.create')->only(['create']);
        $this->middleware('permission:users.store')->only(['store']);
        $this->middleware('permission:users.show')->only(['show']);
        $this->middleware('permission:users.edit')->only(['edit']);
        $this->middleware('permission:users.update')->only(['update']);
        $this->middleware('permission:users.destroy')->only(['destroy']);
        $this->middleware('permission:users.clave')->only(['clave']);
        $this->middleware('permission:users.updateClave')->only(['updateClave']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $estados=Estado::all();
        $municipios=Municipio::all();
        $parroquias=Parroquia::all();
        $tiendas=Tienda::all();
        return view('user.index',  compact('users','estados','municipios','parroquias','tiendas'))->with('i',0);
            //->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $estados=Estado::all();
        $municipios=Municipio::all();
        $parroquias=Parroquia::all();
        $tiendas=Tienda::all();
        return view('user.create',  compact('user','estados','municipios','parroquias','tiendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'], //,'unique:users,email'
            'password' => ['required','min:8'],
            'cpassword' => ['required','same:password'],
            'tienda'=> ['required'],
            'nivel' => ['required']
        ]);

        // $user = User::create($request->all());
         $user =User::create(
           [
            'name' => $request['name'],
            'email' => $request['email'],
            'email_verified_at' => NULL,
            'password' => bcrypt($request['password']),
            'estado_id' => $request['estado_id'],
            'municipio_id' => $request['municipio_id'],
            'parroquia_id' => $request['parroquia_id'],
            'tienda' => $request['tienda'],
            'nivel' => $request['nivel'],
           ])->assignRole($request['nivel']);
          event(new Registered($user));

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
          $estados=Estado::all();
        $municipios=Municipio::all();
        $parroquias=Parroquia::all();
        $tiendas=Tienda::all();
        return view('user.show', compact('user','estados','municipios','parroquias','tiendas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
          $estados=Estado::all();
        $municipios=Municipio::all();
        $parroquias=Parroquia::all();
        $tiendas=Tienda::all();
        return view('user.edit',  compact('user','estados','municipios','parroquias','tiendas'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function clave()
    {
        $id=auth()->user()->id;

        $user = User::find($id);
        //dd($user);
        return view('user.clave', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
             $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'], //,'unique:users,email'
            'password' => ['required','min:8'],
            'cpassword' => ['required','same:password'],
            // 'estado_id' => ['required'],
            // 'municipio_id' => ['required'],
            // 'parroquia_id' => ['required'],
            ' tienda'=> ['required'],
            'nivel' => ['required'],
            ]);
        $user->update($request->all());
        $user->syncRoles($request->input('nivel'));
        $user->password = bcrypt($request->password);
        $user->save();


        return redirect()->route('users.index')
            ->with('success', 'Usuario editado con éxito');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function updateClave(Request $request, User $user)
    {
            $request->validate([
                'password' => ['required','min:8'],
                'cpassword' => ['required','same:password'],
            ]);
        //dd($request,$user);
        $user->update($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.clave')
            ->with('success', 'Cambio de Clave realizado con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado con éxito');
    }
}
