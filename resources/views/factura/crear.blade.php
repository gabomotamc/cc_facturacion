<a href="{{ url('factura') }}">Ver todas las facturas</a>
<h1>Crear Factura</h1>

	<form name="guardar_factura_form" 
	action="{{ url('/factura/crear') }}" 	
	method="POST">
		@csrf <!-- {{ csrf_field() }} -->

		<label>Descripción</label>
		<input type="text" name="descripcion" required="required">

		<input type="hidden" name="cantidad_item" value="0">
		<input type="hidden" name="total_factura" value="0">

		<button type="submit" name="guardar_factura">Guardar Factura</button>
	</form>

<p>
	Luego de agregar factura redirecciona a una interfaz que funciona con Seeder: ProductoPrecioSeeder
</p>