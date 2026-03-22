<div class="card shadow ">
    <div class="card-header text-center">
        <h6 class="font-weight-bold text-primary"><i class="fas fa-user-graduate"></i>&nbsp;
            CENTRALIZADOR DE CALIFICACIONES</h6>
    </div>
    @include('common.alert')
    <form action="{{ route('r_centralizador.filtrar') }}" method="post" autocomplete="off">
        @csrf
        <div class="card-body border-bottom-primary shadow">
            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>GESTI&Oacute;N:</strong>
                    <select name="gestion_id" class="form-control form-control-sm">
                        @foreach ($gestions as $gestion)
                            <option value="{{ $gestion->id }}"
                                {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>
                                {{ $gestion->descripcion }} - {{ $gestion->anio }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('gestion_id') }}</span>
                </div>
                <div class="col-sm-3">
                    <strong>CARRERAS:</strong>
                    <select name="carrera_id" class="form-control form-control-sm">
                        <option value="" disabled selected>Seleccione</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}"
                                {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                {{ $carrera->nombre ?? '-' }}
                        @endforeach
                    </select>
                    @error('carrera_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <strong>NIVEL:</strong>
                    <select name="nivel" class="form-control form-control-sm">
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
                    <strong>MATERIA GESTI&Oacute;N (CURSO):</strong>
                    <select name="materia_gestion" class="form-control form-control-sm">
                        @foreach ($materia_gestions as $materia_gestion)
                            <option value="{{ $materia_gestion->orden }}"
                                {{ old('materia_gestion') == $materia_gestion->orden ? 'selected' : '' }}>
                                {{ textoOrden($materia_gestion->orden ?? '') }}
                            </option>
                        @endforeach
                    </select>
                    @error('materia_gestion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-2 mt-3">
                    <div class="btn-group">
                        <a href="{{ route('r_centralizador.index') }}"
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
    function textoOrden($orden)
    {
        if ($orden == 1) {
            return 'PRIMER AÑO';
        } elseif ($orden == 2) {
            return 'SEGUNDO AÑO';
        } elseif ($orden == 3) {
            return 'TERCER AÑO';
        } elseif ($orden == 4) {
            return 'CUARTO AÑO';
        } elseif ($orden == 5) {
            return 'QUINTO AÑO';
        } elseif ($orden == 6) {
            return 'SEXTO AÑO';
        }
        return '';
    }

@endphp
