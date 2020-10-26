<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Precio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DateTime;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $productoTodo = Producto::all();
        return view('factura.asignar', compact('productoTodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $fecha_hora = new DateTime();
        $uuidItem = Str::random(20);       

        $datoItem = request()->except('_token','guardar_item','subtotal');
        $datoItem['uuid'] = $uuidItem;
        $datoItem['created_at'] = $fecha_hora;
        $datoItem['updated_at'] = $fecha_hora; 

        $uuidFactura = $datoItem['uuid_factura'];
        $uuidProducto = $datoItem['uuid_producto'];
        $cantidadItem = $datoItem['cantidad'];

        $consultaPrecioUnitario = Precio::where('uuid_producto',$uuidProducto)->get(['precio_bruto_unitario']);   

        foreach($consultaPrecioUnitario as $clave_precio => $valor_precio){

            $valorSubtotalItem = ($cantidadItem * $valor_precio->precio_bruto_unitario);

        }// foreach        

        $datoItem['subtotal'] = $valorSubtotalItem;

        Item::insert($datoItem);

        $consultaItemCantidad = Item::where('uuid_factura',$uuidFactura)->get(['cantidad']);
        $consultaItemSubtotal = Item::where('uuid_factura',$uuidFactura)->get(['subtotal']);

        $sumCantidadTotal = 0;
        $sumPrecioTotalFactura = 0;

        foreach($consultaItemCantidad as $clave_cantidad => $valor_cantidad){

            if(isset($valor_cantidad->cantidad))   
                $sumCantidadTotal += $valor_cantidad->cantidad;
        }// foreach

        foreach($consultaItemSubtotal as $clave_subtotal => $valor_subtotal){

            if(isset($valor_subtotal->subtotal))   
                $sumPrecioTotalFactura += $valor_subtotal->subtotal;
        }// foreach

        Factura::where('uuid',$uuidFactura)->update(
            ['cantidad_item' => $sumCantidadTotal,'total_factura' => $sumPrecioTotalFactura]
        );        

        $productoTodo = DB::table('productos')
        ->select('productos.uuid','productos.descripcion','precios.precio_bruto_unitario')
        ->join('precios','precios.uuid_producto','=','productos.uuid')
        ->get();        

        $descripcionFactura = Factura::where('uuid',$uuidFactura)->get(['descripcion']);
        foreach ($descripcionFactura as $clave_factura => $valor_factura) {
            $descripcion = $valor_factura->descripcion;
        }        
        
        $datoFacturaItem['dato_factura_item']['uuid_factura'] = $uuidFactura;
        $datoFacturaItem['dato_factura_item']['descripcion'] =  $descripcion;  

        return view( 'factura.asignar', $datoFacturaItem, compact('productoTodo') );  

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
