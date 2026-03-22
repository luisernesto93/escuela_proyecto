@extends('layouts.app')

@section('title', 'Nueva Materia')

@section('content')

    <div class="container-fluid">
        {{-- alertas --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> REGISTRAR MATERIA</h6>
            </div>
            <form method="POST" action="{{ route('materias.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mt-3">
                            {{-- <label for="plan_estudio_id"> --}}<strong>Plan Estudio:</strong>
                            <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('plan_estudio_id') is-invalid @enderror"
                                name="plan_estudio_id" id="plan_estudio_id" required> {{-- name debe corresponder al nombre del campo de la tabla --}}
                                <option value="" selected disabled>Seleccione Plan Estudio</option>
                                @foreach ($plan_estudios as $plan_estudio)
                                    <option value="{{ $plan_estudio->id }}"
                                        {{ old('plan_estudio_id') == $plan_estudio->id ? 'selected' : '' }}>
                                        {{ $plan_estudio->area_formacion }}</option>
                                @endforeach
                            </select>
                            @error('plan_estudio_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            {{-- <label for="carrera_id"> --}}<strong>Carrera:</strong>
                            <span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('carrera_id') is-invalid @enderror"
                                name="carrera_id" id="carrera_id" required> {{-- name debe corresponder al nombre del campo de la tabla --}}
                                <option value="" selected disabled>Seleccione Carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}
                                        onclick="return buscar_materias();">{{ $carrera->nombre }}

                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <small class="text-danger" id='mensaje_busqueda'></small>
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Sigla</strong><span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('sigla') is-invalid @enderror"
                                id="sigla" placeholder="Sigla" name="sigla" value="{{ old('sigla') }}" required>
                            @error('sigla')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Nombre Materia</strong><span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('nombre_materia') is-invalid @enderror"
                                id="nombre_materia" placeholder="Nombre Materia" name="nombre_materia"
                                value="{{ old('nombre_materia') }}" required>
                            @error('nombre_materia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Horas</strong><span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('horas') is-invalid @enderror"
                                id="horas" placeholder="Horas" name="horas" value="{{ old('horas') }}" required>
                            @error('horas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Nivel de Titulación: </strong><span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('nivel') is-invalid @enderror" name="nivel"
                                id="nivel" required>
                                <option value="2">TECNICO SUPERIOR</option>
                                <option value="1">TECNICO MEDIO</option>
                            </select>
                            @error('nivel')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Año - Semestre: </strong><span style="color:red;">*</span></label>
                            <select class="form-control form-control-sm @error('orden') is-invalid @enderror" name="orden"
                                id="orden" required>
                                <option value="1">1ER AÑO</option>
                                <option value="2">2DO AÑO</option>
                                <option value="3">3ER AÑO</option>
                                <option value="4">1ER SEMESTRE</option>
                                <option value="5">2DO SEMESTRE</option>
                                <option value="6">3ER SEMESTRE</option>
                                <option value="7">4TO SEMESTRE</option>
                                <option value="8">5TO SEMESTRE</option>
                                <option value="9">6TO SEMESTRE</option>
                            </select>
                            @error('orden')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{--  <input type="number" class="form-control form-control-sm @error('orden') is-invalid @enderror"
                                id="orden" placeholder="orden" name="orden" value="{{ old('orden') }}" required
                                onkeypress="return event.charCode>=48 && event.charCode<=57">

                            @error('orden')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </div>
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <strong>Pre-Requisito:</strong></label>
                            <select class="form-control form-control-sm" name="materia_pre_requisito"
                                id="materia_pre_requisito">
                                <option value="" selected disabled>Seleccione Materia</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i
                            class="fas fa-save"></i> GUARDAR</button>
                    <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('materias.index') }}"><i
                            class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
                </div>
            </form>
        </div>

    </div>
@endsection

<script>
    function buscar_materias() {
        $('#mensaje_busqueda').html('');
        let carrera_id = $('#carrera_id').val();

        if (carrera_id == '') {
            $('#mensaje_busqueda').html('Debe seleccionar una carrera');
            return false;
        }

        $.ajax({
            url: "{{ route('materias.buscar_materias') }}",
            type: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
                'carrera_id': carrera_id
            },
            success: function(response) {
                if (response.length > 0) {
                    $('#materia_pre_requisito').html('');
                    $('#materia_pre_requisito').append(
                        '<option value="" selected disabled>Seleccione Materia</option>');
                    $.each(response, function(i, item) {
                        $('#materia_pre_requisito').append('<option value="' + item.id + '">' +
                            item
                            .nombre_materia +
                            '</option>');
                    });
                } else {
                    $('#mensaje_busqueda').html('No se encontraron materias');
                }
            }
        });
    }
</script>
