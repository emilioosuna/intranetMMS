<?php

namespace App\Http\Controllers;

use App\Models\VentasVendedore;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tienda;

/**
 * Class VentasVendedoreController
 * @package App\Http\Controllers
 */
class VentasVendedoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ventas-vendedores.index')->only(['index']);
        $this->middleware('permission:ventas-vendedores.create')->only(['create']);
        $this->middleware('permission:ventas-vendedores.store')->only(['store']);
        $this->middleware('permission:ventas-vendedores.show')->only(['show']);
        $this->middleware('permission:ventas-vendedores.edit')->only(['edit']);
        $this->middleware('permission:ventas-vendedores.update')->only(['update']);
        $this->middleware('permission:ventas-vendedores.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          if(!auth()->user()->tienda){
            $ventasVendedores = VentasVendedore::join('tiendas','tiendas.id','=','ventas_vendedores.tienda_id')->select('ventas_vendedores.*','tiendas.tienda')->orderBy('ventas_vendedores.fdesde','DESC')
            ->get();
        }else{
            $ventasVendedores = VentasVendedore::where('ventas_vendedores.tienda_id',auth()->user()->tienda)->join('tiendas','tiendas.id','=','ventas_vendedores.tienda_id')->select('ventas_vendedores.*','tiendas.tienda')->orderBy('ventas_vendedores.fdesde','DESC')->get();
        }

        return view('ventas-vendedore.index', compact('ventasVendedores'))->with('i',0);
            // ->with('i', (request()->input('page', 1) - 1) * $ventasVendedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ventasVendedore = new VentasVendedore();
          if(auth()->user()->tienda){
            $tiendas=Tienda::where('id',auth()->user()->tienda)->orderBy('tienda', 'ASC')->get();
        }else{
            $tiendas=Tienda::orderBy('tienda', 'ASC')->get();
        }
        return view('ventas-vendedore.create', compact('ventasVendedore','tiendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            request()->validate(VentasVendedore::$rules);

            $ventasVendedore = VentasVendedore::create($request->all());
            $vvid=VentasVendedore::max('id');
            $file=$request->file('prueba');

            $datos =fopen ($file,"r");
            $i=0;
            $data = array();
            $nuevoArreglo=array();
            $registros=array();
            while (!feof($datos)) {
                        $data[] = (fgetcsv($datos,NULL,';'));
            }

            $tope=count($data);
            for ($i=1; $i < $tope ; $i++) {
                if(!empty($data[$i][0])){
                     $registros[] = [
                            'vvid'=>$vvid,
                            'vendedor'=>$data[$i][0],
                            'montob'=>$data[$i][1],
                            'vunidades'=>$data[$i][2],
                           ];
                }

            }


            //dd($registros);

           $ventasvendedores=DB::table('ventas_vendedor_detalle')->insert($registros);
            fclose ($datos);

           // dd($request,$file,$registros,$data,$vendedor);



            return redirect()->route('ventas-vendedores.index')
                ->with('success', 'Ventas Vendedores created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$ventasVendedore = VentasVendedore::find($id);

            $ventasVendedore = VentasVendedore::where('ventas_vendedores.id',$id)->join('tiendas','tiendas.id','=','ventas_vendedores.tienda_id')
            ->select('ventas_vendedores.*','tiendas.tienda')->first();

            $vvdetalle= DB::table('ventas_vendedor_detalle')->where('ventas_vendedor_detalle.vvid',$id)->get();

        return view('ventas-vendedore.show', compact('ventasVendedore','vvdetalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ventasVendedore = VentasVendedore::find($id);
           if(auth()->user()->tienda){
            $tiendas=Tienda::where('id',auth()->user()->tienda)->orderBy('tienda', 'ASC')->get();
        }else{
            $tiendas=Tienda::orderBy('tienda', 'ASC')->get();
        }
        return view('ventas-vendedore.edit', compact('ventasVendedore','tiendas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  VentasVendedore $ventasVendedore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentasVendedore $ventasVendedore)
    {
        request()->validate(VentasVendedore::$rules);

        $ventasVendedore->update($request->all());

        return redirect()->route('ventas-vendedores.index')
            ->with('success', 'Ventas Vendedores updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ventasVendedore = VentasVendedore::find($id)->delete();
         DB::table('ventas_vendedor_detalle')->where('vvid',$id)->delete();
        return redirect()->route('ventas-vendedores.index')
            ->with('success', 'Ventas Vendedores deleted successfully');
    }
}
