<?php

namespace App\Http\Controllers;

use App\Models\FacturasVendedore;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tienda;

/**
 * Class FacturasVendedoreController
 * @package App\Http\Controllers
 */
class FacturasVendedoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:facturas-vendedores.index')->only(['index']);
        $this->middleware('permission:facturas-vendedores.create')->only(['create']);
        $this->middleware('permission:facturas-vendedores.store')->only(['store']);
        $this->middleware('permission:facturas-vendedores.show')->only(['show']);
        $this->middleware('permission:facturas-vendedores.edit')->only(['edit']);
        $this->middleware('permission:facturas-vendedores.update')->only(['update']);
        $this->middleware('permission:facturas-vendedores.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $facturasVendedores = FacturasVendedore::paginate();
        if(!auth()->user()->tienda){
            $facturasVendedores = FacturasVendedore::join('tiendas','tiendas.id','=','facturas_vendedores.tienda_id')->select('facturas_vendedores.*','tiendas.tienda')->orderBy('facturas_vendedores.fdesde','DESC')
            ->get();
        }else{
            $facturasVendedores = FacturasVendedore::where('facturas_vendedores.tienda_id',auth()->user()->tienda)->join('tiendas','tiendas.id','=','facturas_vendedores.tienda_id')->select('facturas_vendedores.*','tiendas.tienda')->orderBy('facturas_vendedores.fdesde','DESC')->get();
        }

        return view('facturas-vendedore.index', compact('facturasVendedores'))->with('i',0);
            // ->with('i', (request()->input('page', 1) - 1) * $facturasVendedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facturasVendedore = new FacturasVendedore();
          if(auth()->user()->tienda){
            $tiendas=Tienda::where('id',auth()->user()->tienda)->orderBy('tienda', 'ASC')->get();
        }else{
            $tiendas=Tienda::orderBy('tienda', 'ASC')->get();
        }
        return view('facturas-vendedore.create', compact('facturasVendedore','tiendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FacturasVendedore::$rules);

           $facturasVendedore = FacturasVendedore::create($request->all());
            $fvid=FacturasVendedore::max('id');
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
                            'fvid'=>$fvid,
                            'vendedor'=>$data[$i][0],
                            'canfac'=>$data[$i][1],
                           ];
                }

            }


            //dd($registros);

           $facturasVendedores=DB::table('facturas_vendedor_detalle')->insert($registros);
            fclose ($datos);

           // dd($request,$file,$registros,$data,$vendedor);



        return redirect()->route('facturas-vendedores.index')
            ->with('success', 'FacturasVendedore created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $facturasVendedore = FacturasVendedore::find($id);

        $facturasVendedore = FacturasVendedore::where('facturas_vendedores.id',$id)->join('tiendas','tiendas.id','=','facturas_vendedores.tienda_id')
            ->select('facturas_vendedores.*','tiendas.tienda')->first();

            $fvdetalle= DB::table('facturas_vendedor_detalle')->where('facturas_vendedor_detalle.fvid',$id)->get();

        return view('facturas-vendedore.show', compact('facturasVendedore','fvdetalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facturasVendedore = FacturasVendedore::find($id);
         if(auth()->user()->tienda){
            $tiendas=Tienda::where('id',auth()->user()->tienda)->orderBy('tienda', 'ASC')->get();
        }else{
            $tiendas=Tienda::orderBy('tienda', 'ASC')->get();
        }

        return view('facturas-vendedore.edit', compact('facturasVendedore','tiendas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FacturasVendedore $facturasVendedore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacturasVendedore $facturasVendedore)
    {
        request()->validate(FacturasVendedore::$rules);

        $facturasVendedore->update($request->all());
         $fvid=$facturasVendedore->id;
        $facturasVendedores=DB::table('facturas_vendedor_detalle')->where('facturas_vendedor_detalle.fvid',$fvid)->delete();
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
                            'fvid'=>$fvid,
                            'vendedor'=>$data[$i][0],
                            'canfac'=>$data[$i][1],
                           ];
                }

            }


            //dd($registros);

           $facturasVendedores=DB::table('facturas_vendedor_detalle')->insert($registros);
            fclose ($datos);

        return redirect()->route('facturas-vendedores.index')
            ->with('success', 'FacturasVendedore updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $facturasVendedore = FacturasVendedore::find($id)->delete();
         DB::table('facturas_vendedor_detalle')->where('fvid',$id)->delete();
        return redirect()->route('facturas-vendedores.index')
            ->with('success', 'FacturasVendedore deleted successfully');
    }
}
