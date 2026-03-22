<div class="card shadow ">
    @include('common.alert')
    <form action="{{ route('notasgestions.filtros') }}" method="post" autocomplete="off">
        @csrf
        <div class="card-body border-bottom-primary shadow">
            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>GESTI&Oacute;N:</strong>
                    <select name="gestion_id" class="form-control form-control-sm" id="gestion_id">
                        @foreach ($gestions as $gestion)
                            <option value="{{ $gestion->id }}"
                                {{ old('gestion_id', $selectedGestionId) == $gestion->id ? 'selected' : '' }}>
                                {{ $gestion->descripcion }} - {{ $gestion->anio }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('gestion_id') }}</span>
                </div>
                <div class="col-sm-3">
                    <strong>CARRERAS:</strong>
                    <select name="carrera_id" class="form-control form-control-sm" id="carrera_id">
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}"
                                {{ old('carrera_id', $selectedCarreraId) == $carrera->id ? 'selected' : '' }}
                                onclick="return buscar_materias();">
                                {{ $carrera->nombre ?? '-' }}
                        @endforeach
                    </select>
                    @error('carrera_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <strong>NIVEL:</strong>
                    <select name="nivel" class="form-control form-control-sm" id="nivel">
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->nivel }}" {{ old('nivel') == $nivel->nivel ? 'selected' : '' }}>
                                {{ textoNivel($nivel->nivel ?? '') }}
                            </option>
                        @endforeach
                    </select>
                    @error('nivel')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <strong>MATERIA GESTIÓN (CURSO):</strong></label>
                    <select name="materia_id" class="form-control form-control-sm" id="materia_id" required>
                        <option value="" selected disabled>Seleccione Materia</option>
                    </select>
                    @error('materia_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-2 mt-3">
                    <div class="btn-group">
                        <a href="{{ route('notasgestions.index') }}"
                            class="shadow btn btn-outline-danger border-left-danger mr-1"><i
                                class="fas fa-redo-alt"></i></a>
                        <button class="shadow btn btn-outline-primary border-left-primary"
                            onclick="return buscar_materias();"><i class="fas fa-filter"></i>&nbsp;Filtrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@php
    function textoNivel($nivel)
    {
        if ($nivel == 1) {
            return 'TÉCNICO MEDIO';
        } elseif ($nivel == 2) {
            return 'TÉCNICO SUPERIOR';
        } elseif ($nivel == 3) {
            return 'LICENCIATURA';
        } elseif ($nivel == 4) {
            return 'MAESTRÍA';
        } elseif ($nivel == 5) {
            return 'DOCTORADO';
        }

        return '';
    }

@endphp
<script>
    function buscar_materias() {
        $('#mensaje_busqueda').html('');
        let gestion_id = $('#gestion_id').val();
        let carrera_id = $('#carrera_id').val();
        let nivel = $('#nivel').val();

        if (carrera_id == '' || nivel == '' || gestion_id == '') {
            $('#mensaje_busqueda').html('Debe seleccionar una carrera');
            return false;
        }

        $.ajax({
            url: "{{ route('notasgestions.buscar_materias') }}",
            type: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
                'carrera_id': carrera_id,
                'nivel': nivel,
                'gestion_id': gestion_id,
            },
            success: function(response) {
                if (response.length > 0) {
                    $('#materia_id').html('');
                    $('#materia_id').append(
                        '<option value="" selected disabled>Seleccione Materia</option>');
                    $.each(response, function(i, item) {
                        $('#materia_id').append('<option value="' + item.materia_id + '">' +
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
