<a href="{{ url('factura') }}">Ver todas las facturas</a>
<a href="{{ url('factura/crear') }}">Crear nueva factura</a>		
<h1>Detalle de factura</h1>

	<table>
		<tr>

			<th>#</th>
			<th>Producto</th>
			<th>Cantidad de Items</th>
			<th>Cantidad</th>
			<th>Subtotal</th>

		</tr>

		@foreach($detalleFactura as $detalle)
		<tr>
			
			<td>{{$loop->iteration}}</td>
			<!-- Descripcion de producto -->
			<td>{{$detalle->descripcion}}</td>
			<td>{{$detalle->cantidad}}</td>
			<td>{{$detalle->precio_bruto_unitario}}</td>			
			<td>{{$detalle->subtotal}}</td>


		</tr>
		@endforeach

		<tr>
			<th>
				Cantidad Total Items
			</th>
			<th>
				Total Facturado
			</th>
		</tr>
		@foreach($infoFactura as $factura)
		<tr>
			<td>
				{{$factura->cantidad_item}}
			</td>
			<td>
				{{$factura->total_factura}}
			</td>
			
		</tr>
		@endforeach		
	
	</table>
