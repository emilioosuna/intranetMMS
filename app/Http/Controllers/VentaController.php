<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Tienda;
/**
 * Class VentaController
 * @package App\Http\Controllers
 */
class VentaController extends Controller
{
           public function __construct()
    {
        $this->middleware('permission:ventas.index')->only(['index']);
        $this->middleware('permission:ventas.create')->only(['create']);
        $this->middleware('permission:ventas.store')->only(['store']);
        $this->middleware('permission:ventas.show')->only(['show']);
        $this->middleware('permission:ventas.edit')->only(['edit']);
        $this->middleware('permission:ventas.update')->only(['update']);
        $this->middleware('permission:ventas.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->tienda){
            $ventas = Venta::join('tiendas','tiendas.id','=','ventas.tienda_id')->select('ventas.*','tiendas.tienda')->orderBy('ventas.fventa','DESC')->get();
        }else{
            $ventas = Venta::where('ventas.tienda_id',auth()->user()->tienda)->join('tiendas','tiendas.id','=','ventas.tienda_id')->select('ventas.*','tiendas.tienda')->orderBy('ventas.fventa','DESC')->get();
        }

        //dd($ventas);
        return view('venta.index', compact('ventas'))->with('i',0);
            //->with('i', (request()->input('page', 1) - 1) * $ventas->perPage());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venta = new Venta();
        if(auth()->user()->tienda){
            $tiendas=Tienda::where('id',auth()->user()->tienda)->orderBy('tienda', 'ASC')->get();
        }else{
            $tiendas=Tienda::orderBy('tienda', 'ASC')->get();
        }
        // (!$venta->id ? dd('no'): dd('si'));
        return view('venta.create', compact('venta','tiendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Venta::$rules);
       // dd($request);
        $venta = Venta::create($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::where('ventas.id',$id)->join('tiendas','tiendas.id','=','ventas.tienda_id')->select('ventas.*','tiendas.tienda')->first();

        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::find($id);
         if(auth()->user()->tienda){
            $tiendas=Tienda::where('id',auth()->user()->tienda)->orderBy('tienda', 'ASC')->get();
        }else{
            $tiendas=Tienda::orderBy('tienda', 'ASC')->get();
        }
        return view('venta.edit', compact('venta','tiendas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        request()->validate(Venta::$rules);

        $venta->update($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $venta = Venta::find($id)->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta deleted successfully');
    }
}
