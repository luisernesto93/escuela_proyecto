@extends('layouts.app')

@section('title', 'Lista de Generos')

@section('content')
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Listado de G&eacute;neros</h1>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('generos.create') }}" class="btn btn-outline-success">
						<i class="fas fa-plus"></i> Nuevo G&eacute;nero
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
								<th>G&eacute;nero</th>
								<th>Sigla</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@if (count($generos))
							@foreach ($generos as $genero)
								<tr>
									<td class="p-2 align-middle">{{ $genero->id ?? '' }}</td>
									<td class="p-2 align-middle">{{ $genero->genero }}</td>
									<td class="p-2 align-middle">{{ $genero->sigla }}</td>
									<td class="p-2 align-middle text-center"> {!! $genero->estado_texto == 'ACTIVO'
									? '<span class="badge badge-success shadow">ACTIVO</span>'
									: '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
									<td style="display: flex">
										<a href="{{ route('generos.edit', ['genero' => $genero->id]) }}"
											class="btn btn-outline-primary m-1">
											<i class="fa fa-pen"></i>
										</a>
										<a href="{{ route('generos.show', ['genero' => $genero->id]) }}"
											class="btn btn-outline-info m-1">
											<i class="fa fa-eye"></i>
										</a>
										@if ($genero->estado == 0)
											<a
												href="{{ route('generos.estado', ['genero_id' => $genero->id, 'estado' => 1]) }}"
												class="btn btn-outline-success m-1">
												<i class="fa fa-check"></i>
											</a>
										@elseif ($genero->estado == 1)
											<a
												href="{{ route('generos.estado', ['genero_id' => $genero->id, 'estado' => 0]) }}"
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
								<td colspan="7" class="text-center">No hay G&eacute;neros registrados</td>
							</tr>
							@endif
						</tbody>
					</table>

					{{ $generos->links() }}
				</div>
			</div>
		</div>

	</div>

	@if (count($generos))
		@include('generos.delete-modal')
	@endif
@endsection

@section('scripts')

@endsection
