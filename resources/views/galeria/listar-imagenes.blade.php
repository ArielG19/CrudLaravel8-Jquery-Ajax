<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<th>Id</th>
				<th>Nombre</th>
				<th>Imagen</th>
				<th>Opciones</th>
			</thead>
			<tbody>
						@foreach($imagenes as $img)
							<tr>
								<td>
									{{$img->id}}
								</td>
								<td>
									{{$img->nombre}}
								</td>
								<td>
									 <img src="imagenes/{{$img->imagen}}" alt="" class="d-flex align-self-start rounded mr-3" height="64px">
								</td>
							
								<td>
				             		<!--en la ruta pasamos el parametro para mostrar el id y poder editar o eliminar luego-->
									<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" Onclick=' MostrarCategoria({{$img->id}});'>
									  Editar
									</a>

				              		<a id="elim" class="btn btn-danger btn-sm" href="#" onclick="Eliminar('{{$img->id}}','{{$img->nombre}}')">
				                		<i class="fa fa-trash" aria-hidden="true">Eliminar</i>
				              		</a>
				           		</td>
							</tr>
						@endforeach

			</tbody>

		</table>

</div>
{{ $imagenes->links() }}