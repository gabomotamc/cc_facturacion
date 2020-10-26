<a href="{{ url('factura/crear') }}">Crear nueva factura</a>

<h1>Mostrar todas las facturas</h1>

	<table>
		<tr>

			<th>#</th>
			<th>Descripción</th>
			<th>Cantidad de Items</th>
			<th>Total Facturado</th>
			<th>Creado</th>
			<th>Detalles</th>				

		</tr>

		@foreach($facturaTodo as $factura)
		<tr>
			
			<td>{{$loop->iteration}}</td>
			<td>{{$factura->descripcion}}</td>
			<td>{{$factura->cantidad_item}}</td>
			<td>{{$factura->total_factura}}</td>			
			<td>{{$factura->created_at}}</td>
			<td><a href="{{ url('/factura/detalle/'.$factura->uuid ) }}"> Ver </a></td>

		</tr>
		@endforeach
	
	</table>

