	<a href="{{ url('factura') }}" onclick="return confirm('Si regresa no podrás agregar más items a esta factura');">Ver todas las facturas</a>	
	
	<h1> Asignar items a factura: {{$dato_factura_item['descripcion']}} </h1>

	<form name="guardar_item_form" action="{{ url('/item/crear') }}" 	method="POST">
		@csrf <!-- {{ csrf_field() }} -->

		<input type="hidden" name="uuid_factura" value="{{$dato_factura_item['uuid_factura']}}">

		<label>Producto</label>
		
		<select id="producto-select" name="uuid_producto">
		   @foreach($productoTodo as $producto)

		   	<option value="{{$producto->uuid}}">
		   		{{$producto->descripcion}}
		   		(Precio Bruto Unitario:

			   		<p id="precio-{{$producto->uuid}}">
			   			{{$producto->precio_bruto_unitario}}
			   		</p>

		   		)
		   	</option>	
		   		
		    @endforeach
	    </select>


		<label>Cantidad</label>
		<input type="number" name="cantidad" min="1" max ="100" required="required">

		<button type="submit" name="guardar_item">Guardar Item</button>

	</form>

	
