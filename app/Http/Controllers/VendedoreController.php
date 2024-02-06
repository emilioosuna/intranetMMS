<?php

namespace App\Http\Controllers;

use App\Models\{Vendedore,FacturasVendedore};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class VendedoreController
 * @package App\Http\Controllers
 */
class VendedoreController extends Controller
{
               public function __construct()
    {
        $this->middleware('permission:vendedores.index')->only(['index']);
        $this->middleware('permission:vendedores.create')->only(['create']);
        $this->middleware('permission:vendedores.store')->only(['store']);
        $this->middleware('permission:vendedores.show')->only(['show']);
        $this->middleware('permission:vendedores.edit')->only(['edit']);
        $this->middleware('permission:vendedores.update')->only(['update']);
        $this->middleware('permission:vendedores.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vendedores = Vendedore::select('vendedores.*')->get();
         $sldd="SELECT ven.*, (
                    SELECT sum(fvd.canfac)
                        FROM facturas_vendedor_detalle as fvd
                        LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
                        WHERE  YEAR(fv.fdesde)=2024 AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0 AND fvd.vendedor=ven.alias
                        AND  MONTH(fv.fdesde)=MONTH(CURRENT_DATE())
                    ) mactual,(
                        SELECT sum(fvd.canfac)
                            FROM facturas_vendedor_detalle as fvd
                            LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
                            WHERE  YEAR(fv.fdesde)=2024 AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0 AND fvd.vendedor=ven.alias
                            AND  MONTH(fv.fdesde)=MONTH(CURRENT_DATE())-1
                    )manterior
                    from vendedores as ven;";
        // $datadd=DB::connection('mysql')->select($sldd);
        $vendedores=collect(DB::connection('mysql')->select($sldd));

        // SELECT fvd.vendedor,fvd.canfac,fv.fdesde,MONTHNAME(fv.fdesde) as mes
        // FROM facturas_vendedor_detalle as fvd
        // LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
        // WHERE  YEAR(fv.fdesde)=2024 AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0 AND fvd.vendedor='1630 - FAENNYS GODOY'
        // AND  MONTH(fv.fdesde)=MONTH(CURRENT_DATE()) OR MONTH(fv.fdesde)=MONTH(CURRENT_DATE());
        return view('vendedore.index', compact('vendedores'))->with('i',0);
            // ->with('i', (request()->input('page', 1) - 1) * $vendedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendedore = new Vendedore();
        return view('vendedore.create', compact('vendedore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Vendedore::$rules);

        $vendedore = Vendedore::create($request->all());

        return redirect()->route('vendedores.index')
            ->with('success', 'Vendedore created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
      public function show($id, $year = null)
    {
        if (!$year) {
            $year=date('Y');
        }
        $vendedore = Vendedore::find($id);
        $sql="SELECT YEAR(facturas_vendedores.fdesde) as year FROM `facturas_vendedores` GROUP BY YEAR(facturas_vendedores.fdesde) ORDER BY YEAR(facturas_vendedores.fdesde) DESC;";
        $dyear=DB::connection('mysql')->select($sql);
        DB::statement("SET lc_time_names = 'es_ES'");
        $sqlda="SELECT fvd.vendedor as vendedor,sum(fvd.canfac) as canfac,MONTHNAME(fv.fdesde) as mes FROM facturas_vendedor_detalle as fvd
                    LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
                WHERE  YEAR(fv.fdesde)=$year AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0 AND fvd.vendedor='$vendedore->alias' GROUP BY (MONTHNAME(fv.fdesde));";
        $dataano=DB::connection('mysql')->select($sqlda);
        $sldd="SELECT fvd.vendedor,fvd.canfac,fv.fdesde,MONTHNAME(fv.fdesde) as mes
        FROM facturas_vendedor_detalle as fvd
        LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
        WHERE  YEAR(fv.fdesde)=$year AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0 and fvd.vendedor='$vendedore->alias';";
        // $datadd=DB::connection('mysql')->select($sldd);
        $datadd=collect(DB::connection('mysql')->select($sldd));
        // dd($datadd->groupBy('mes'));
        // foreach ($datadd->groupBy('mes') as $key => $value) {
        //     dd($key);
        //    foreach ($value as $val) {
        //        dd($val);
        //    }
        // }
        // dd($datadd->groupBy('mes'));
        // SELECT YEAR(facturas_vendedores.fdesde) FROM `facturas_vendedores` GROUP BY YEAR(facturas_vendedores.fdesde) ORDER BY YEAR(facturas_vendedores.fdesde) DESC;
        /*
        SELECT fvd.vendedor,fvd.canfac,fv.fdesde,MONTHNAME(fv.fdesde)
        FROM facturas_vendedor_detalle as fvd
        LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
        WHERE  YEAR(fv.fdesde)=2023 AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0;

        SELECT fvd.vendedor,fvd.canfac,fv.fdesde,MONTHNAME(fv.fdesde)
        FROM facturas_vendedor_detalle as fvd
        LEFT JOIN facturas_vendedores as fv on fv.id=fvd.fvid
        WHERE  YEAR(fv.fdesde)=2024 AND  DATEDIFF (fv.fdhasta, fv.fdesde)=0 and fvd.vendedor='1630 - FAENNYS GODOY';
        */



        return view('vendedore.show', compact('vendedore','dyear','dataano','datadd','year'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendedore = Vendedore::find($id);

        return view('vendedore.edit', compact('vendedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vendedore $vendedore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedore $vendedore)
    {
        request()->validate(Vendedore::$rules);

        $vendedore->update($request->all());

        return redirect()->route('vendedores.index')
            ->with('success', 'Vendedore updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vendedore = Vendedore::find($id)->delete();

        return redirect()->route('vendedores.index')
            ->with('success', 'Vendedore deleted successfully');
    }
}
