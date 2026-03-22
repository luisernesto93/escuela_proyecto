<div class="card shadow ">
    <div class="card-header text-center">
        <h6 class="font-weight-bold text-primary"><i class="fas fa-user-graduate"></i>&nbsp;
            REPORTE HISTORICO ACADEMICO</h6>
    </div>
    <form action="{{ route('r_historico_academico.filtrar') }}" method="post" autocomplete="off">
        @csrf
        <div class="card-body border-bottom-primary shadow">
            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>GESTION:</strong>
                    <select name="gestion_id" class="form-control form-control-sm">
                        <option value="*" {{ old('gestion_id') == '*' ? 'selected' : '' }}>TODOS</option>
                        @foreach ($gestions as $gestion)
                            <option value="{{ $gestion->id }}"
                                {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>
                                {{ $gestion->descripcion }} - {{ $gestion->anio }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <strong>ESTUDIANTE:</strong>
                    <select name="estudiante_id" class="form-control form-control-sm" id="estudiante_id">
                        <option value="" disabled selected>Seleccione</option>
                        @foreach ($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id }}"
                                {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}
                                onclick="return buscar_carreras_estudiante();">
                                {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <strong>ASIGNATURAS:</strong>
                    <select class="form-control form-control-sm" name="carrera_id" id="carrera_id">
                        <option value="" selected disabled>Seleccione Carrera</option>
                    </select>
                    {{-- <select name="carrera_id" class="form-control form-control-sm">
                        <option value="*" {{ old('carrera_id') == '*' ? 'selected' : '' }}>TODOS</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}"
                                {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                {{ $carrera->nombre }} -
                                {{ $carrera->nivel == 1 ? 'TECNICO MEDIO' : 'TECNICO SUPERIOR' }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="col-sm-2 mt-3">
                    <div class="btn-group">
                        <a href="{{ route('r_historico_academico.index') }}"
                            class="shadow btn btn-outline-danger border-left-danger mr-1"><i
                                class="fas fa-redo-alt"></i></a>
                        <button class="shadow btn btn-outline-primary border-left-primary"><i
                                class="fas fa-filter"></i>&nbsp;Filtrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function buscar_carreras_estudiante() {
        $('#mensaje_busqueda').html('');
        let estudiante_id = $('#estudiante_id').val();
        console.log('estudiante_id: ', estudiante_id);

        if (estudiante_id == '') {
            $('#mensaje_busqueda').html('Debe seleccionar un estudiante');
            return false;
        }

        $.ajax({
            url: "{{ route('r_historico_academico.buscar_carreras_estudiante') }}",
            type: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
                'estudiante_id': estudiante_id
            },
            success: function(response) {
                if (response.length > 0) {
                    $('#carrera_id').html('');
                    $('#carrera_id').append(
                        '<option value="" selected disabled>Seleccione Carrera</option>');
                    $.each(response, function(i, item) {
                        $('#carrera_id').append('<option value="' + item.id + '">' +
                            item
                            .nombre +
                            '</option>');
                    });
                } else {
                    $('#mensaje_busqueda').html('No se encontraron carreras');
                }
            }
        });
    }
</script>
