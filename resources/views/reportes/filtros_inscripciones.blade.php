<div class="card shadow ">
    <div class="card-header text-center">
        <h6 class="font-weight-bold text-primary"><i class="fas fa-user-graduate"></i>&nbsp;
            REPORTE DE INSCRIPCIONES</h6>
    </div>
    <form action="{{ route('r_inscripcion.filtrar') }}" method="post" autocomplete="off">
        @csrf
        <div class="card-body border-bottom-primary shadow">
            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>ESTADO:</strong>
                    <select name="estado" class="form-control form-control-sm">
                        <option {{ old('estado') == '*' ? 'selected' : '' }} value="*">TODOS</option>
                        <option {{ old('estado') == '1' ? 'selected' : '' }} value="1">ACTIVO</option>
                        <option {{ old('estado') == '0' ? 'selected' : '' }} value="0">INACTIVO</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <strong>FECHA DESDE:</strong>
                    <input type="date" name="fecha_inicio" class="form-control form-control-sm"
                        value="{{ old('fecha_inicio') }}">
                </div>
                <div class="col-sm-2">
                    <strong>FECHA HASTA:</strong>
                    <input type="date" name="fecha_fin" class="form-control form-control-sm"
                        value="{{ old('fecha_fin') }}">
                </div>

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
                <div class="col-sm-2">
                    <strong>PUBLICIDAD:</strong>
                    <select name="canal_publicitario_id" class="form-control form-control-sm">
                        <option value="*" {{ old('canal_publicitario_id') == '*' ? 'selected' : '' }}>TODOS
                        </option>
                        @foreach ($canal_publicitarios as $canal_publicitario)
                            <option value="{{ $canal_publicitario->id }}"
                                {{ old('canal_publicitario_id') == $canal_publicitario->id ? 'selected' : '' }}>
                                {{ $canal_publicitario->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2 mt-3">
                    <div class="btn-group">
                        <a href="{{ route('r_inscripcion.index') }}"
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
