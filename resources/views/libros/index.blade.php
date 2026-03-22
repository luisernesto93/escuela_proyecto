@extends('layouts.app')

@section('title', 'Lista de Libros')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de Libros</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('libros.create') }}"
						class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nuevo Libro
					</a>
				</div>
			</div>
		</div>
		{{-- Alert Messages --}}
		@include('common.alert')
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table-sm table-striped table-bordered bg-white shadow fs-12"
						id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Gesti&oacute;n</th>
								<th>Nro Libro</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($libros))
								@foreach ($libros as $key => $libro)
									<tr>
										<td class="p-2 align-middle">{{ $libro->id  ?? ''}}</td>
										<td class="p-2 align-middle">
											{{ $libro->gestion->descripcion.' - '.$libro->gestion->anio  ?? '' }}
										</td>
										<td class="p-2 align-middle">{{ $libro->nro_libro  ?? ''}}</td>
										<td class="p-2 align-middle text-center"> {!! $libro->estado_texto == 'ACTIVO'
										? '<span class="badge badge-success shadow">ACTIVO</span>'
										: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
										<td style="display: flex">
											<a
												href="{{ route('libros.edit', ['libro' =>  $libro->id]) }}"
												class="btn btn-outline-primary m-1">
												<i class="fa fa-pen"></i>
											</a>
											<a
												href="{{ route('libros.show', ['libro' => $libro->id]) }}"
												class="btn btn-outline-info m-1">
												<i class="fa fa-eye"></i>
											</a>

											@if ($libro->estado == 0)
												<a
													href="{{ route('libros.estado', ['libro_id' => $libro->id, 'estado' => 1]) }}"
													class="btn btn-outline-success m-1">
													<i class="fa fa-check"></i>
												</a>
											@elseif ($libro->estado == 1)
												<a
													href="{{ route('libros.estado', ['libro_id' => $libro->id, 'estado' => 0]) }}"
													class="btn btn-outline-danger m-1">
													<i class="fa fa-ban"></i>
												</a>
											@endif
											<a class="btn btn-outline-danger m-1" href="#"
												data-toggle="modal" data-target="#deleteModal" data-placement="top">
												<i class="fas fas fa-trash-alt"></i>
											</a>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="12" class="text-center">No hay Planes de Estudios registrados
									</td>
								</tr>
							@endif
						</tbody>
					</table>
					{{ $libros->links() }}
				</div>
			</div>
		</div>

	</div>

	@if (count($libros))
		@include('libros.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
