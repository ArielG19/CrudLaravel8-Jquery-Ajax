<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<th>Id</th>
				<th>Nombre</th>
				<th>Opciones</th>
			</thead>
			<tbody>
						@foreach($categorias as $cate)
							<tr>
								<td>
									{{$cate->id}}
								</td>
								<td>
									{{$cate->name}}
								</td>
							
								<td>
				             		<!--en la ruta pasamos el parametro para mostrar el id y poder editar o eliminar luego-->
									<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" Onclick=' MostrarCategoria({{$cate->id}});'>
									  Editar
									</a>

				              		<a id="elim" class="btn btn-danger btn-sm" href="#" onclick="Eliminar('{{$cate->id}}','{{$cate->name}}')">
				                		<i class="fa fa-trash" aria-hidden="true">Eliminar</i>
				              		</a>
				           		</td>
							</tr>
						@endforeach

			</tbody>

		</table>

</div>
{{ $categorias->links() }}