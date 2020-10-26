<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DateTime;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $datoFactura['facturaTodo'] = Factura::paginate(100);
        return view('factura.index',$datoFactura);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('factura.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $fecha_hora = new DateTime();
        $uuidFactura = Str::random(20); //Str random para el ejemplo

        $datoFactura = request()->except('_token','guardar_factura');
        $datoFactura['uuid'] = $uuidFactura;
        $datoFactura['created_at'] = $fecha_hora;
        $datoFactura['updated_at'] = $fecha_hora; 

        $datoFacturaItem['dato_factura_item']['descripcion'] = $datoFactura['descripcion'];
        $datoFacturaItem['dato_factura_item']['uuid_factura'] = $datoFactura['uuid'];


        $productoTodo = DB::table('productos')
        ->select('productos.uuid','productos.descripcion','precios.precio_bruto_unitario')
        ->join('precios','precios.uuid_producto','=','productos.uuid')
        ->get();
        
        Factura::insert($datoFactura);

        return view( 'factura.asignar', $datoFacturaItem, compact('productoTodo') );       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show($uuidFactura)
    {

        $detalleFactura = DB::table('items')
        ->select(
            'items.uuid',
            'items.uuid_producto',
            'items.uuid_factura',
            'items.cantidad',
            'items.subtotal',

            'productos.descripcion',

            'precios.uuid_producto',
            'precios.precio_bruto_unitario',
            'precios.precio_neto_unitario',

            )

        ->join('productos','productos.uuid','=','items.uuid_producto')
        ->join('precios','precios.uuid_producto','=','items.uuid_producto')

        ->where('uuid_factura', '=', $uuidFactura)    
        ->get();  

        $infoFactura = DB::table('facturas')
        ->select(
            'facturas.cantidad_item',
            'facturas.total_factura'
            )
        ->where('uuid', '=', $uuidFactura)    
        ->get();     

        return view('factura.detalle',compact('detalleFactura'),compact('infoFactura'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid_factura)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
