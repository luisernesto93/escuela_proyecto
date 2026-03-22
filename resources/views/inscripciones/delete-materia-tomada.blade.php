<div class="modal fade" id="deletemateriaModal" tabindex="-1" role="dialog" aria-labelledby="deletemateriaModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletemateriaModal">Est&aacute;s seguro de eliminar el registro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecione <strong>"QUITAR MATERIA"</strong> si realmente desea eliminar el registro.</div>
            <div class="modal-footer">
                <button class="btn btn-outline-success" type="button" data-dismiss="modal"><i class="fas fa-times"></i> CANCELAR</button>
                <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('inscripcione-delete-form').submit();">
                    <i class="fas fa-trash"></i>
                    QUITAR MATERIA
                </a>
                <form id="inscripcione-delete-form" method="POST" action="{{ route('eliminar_materia_tomada', ['inscripcion_id' => $materias_tomada->id]) }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>