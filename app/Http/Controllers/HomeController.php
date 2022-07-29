<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Tienda;
use App\Models\EspecialidadMedico;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('permission:dashboard')->only(['dashboard']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }
    public function escritorio()
    {
        $user = User::find(auth()->user()->id);
        $year=date('Y');
         if(!$user->tienda){
            $tienda='General MultimaxStore';
             $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                FROM ventas vt
                WHERE Year(fventa)=$year GROUP BY mes";
         }else{
            $tiendaid= Tienda::find($user->tienda);
            $tienda=$tiendaid->tienda;
            $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                FROM ventas vt
                WHERE Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
         }
         $dgrafvent=DB::connection('mysql')->select(DB::raw($sql));

        $totalventa=0;
        $totalvcontado=0;
        $totalvcredito=0;
        foreach ($dgrafvent as $ven) {
            $totalvcontado=$totalvcontado+$ven->tcontado;
            $totalvcredito=$totalvcredito+$ven->tcredito;
            $totalventa= $totalvcontado + $totalvcredito;
        }

        for ($i=1;  $i <= date('m'); $i++) {
            switch ($i) {
                case '1':
                    $mes='ENERO';
                    $abr='ENE';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '2':
                    $mes='FEBRERO';
                    $abr='FEB';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '3':
                    $mes='MARZO';
                    $abr='MAR';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '4':
                    $mes='ABRIL';
                    $abr='ABR';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '5':
                    $mes='MAYO';
                    $abr='MAY';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '6':
                    $mes='JUNIO';
                    $abr='JUN';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                 case '7':
                    $mes='JULIO';
                    $abr='JUL';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '8':
                    $mes='AGOSTO';
                    $abr='AGO';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '9':
                    $mes='SEPTIEMBRE';
                    $abr='SEP';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '10':
                    $mes='OCTUBRE';
                    $abr='OCT';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '11':
                    $mes='NOVIEMBRE';
                    $abr='NOV';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
                case '12':
                    $mes='DICIEMBRE';
                    $abr='DIC';
                    if(!$user->tienda){
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                                FROM ventas vt
                                WHERE Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year GROUP BY mes";
                    }else{
                        $sql="SELECT Month(fventa) AS mes,SUM(contado) AS tcontado ,sum(credito) as tcredito
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                        $sql2="SELECT Month(fventa) AS mes,
                            sum(linea_blanca) as tlbla,sum(linea_menor) as tlmen, sum(linea_marron) as tlmar ,
                            sum(aire_acondicionados) as taa, sum(celulares) as tcel , sum(otros) as tot
                            FROM ventas vt
                            WHERE  Month(fventa)='$i' AND Year(fventa)=$year AND tienda_id=$user->tienda GROUP BY mes";
                    }
                    $dgrafven[$i]=DB::connection('mysql')->select(DB::raw($sql));
                    $dgrafven2[$i]=DB::connection('mysql')->select(DB::raw($sql2));
                    if(count($dgrafven[$i])==0){
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;

                    }else{
                        $tven=0;
                        $tvcon=0;
                        $tvcre=0;
                        foreach ($dgrafven[$i] as $pcmd) {
                            $tven=$pcmd->tcontado+$pcmd->tcredito;
                            $tvcon=$pcmd->tcontado;
                            $tvcre=$pcmd->tcredito;
                        }
                    }
                    $dgrafventas[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tven'=>$tven,
                        'tvcon'=>$tvcon,
                        'tvcre'=>$tvcre,
                    ];
                    if(count($dgrafven[$i])==0){
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                    }else{
                        $tlblan=0;
                        $tlmar=0;
                        $tlmen=0;
                        $taa=0;
                        $tcel=0;
                        $totr=0;
                        foreach ($dgrafven2[$i] as $pcmd2) {
                            $tlblan=$pcmd2->tlbla;
                            $tlmar=$pcmd2->tlmen;
                            $tlmen=$pcmd2->tlmar;
                            $taa=$pcmd2->taa;
                            $tcel=$pcmd2->tcel;
                            $totr=$pcmd2->tot;
                        }
                    }
                    $dgrafventas2[$i]=[
                        'mn'=> $i,
                        'mes'=> $mes,
                        'abr'=>$abr,
                        'tlblan'=>$tlblan,
                        'tlmar'=>$tlmar,
                        'tlmen'=>$tlmen,
                        'taa'=>$taa,
                        'tcel'=>$tcel,
                        'totr'=>$totr,
                    ];
                break;
            }
        }

        //dd($year,$dgrafventas,$dgrafventas2, $totalvcontado,$totalvcredito,$totalventa);
        return view('escritorio',compact('user','tienda','dgrafventas','dgrafventas2','totalventa','totalvcontado','totalvcredito'));
    }
    public function creditos()
    {
        return view('creditos') ;
    }
    public function soporte()
    {
        return view('soporte');
    }

}
