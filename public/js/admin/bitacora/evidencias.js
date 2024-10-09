$('#modalEditarEvidencia').on('hidden.bs.modal', function () {
    $('#actevi_nombre').val('');
    $('#form-editar-evidencia').attr('action', '');
});

function agregar() {
    $('#modalAgregarEvidencia').modal('show');
}

function editar(codigo, nombre) {
    $('#actevi_nombre_edit').val(nombre);
    $('#form-editar-evidencia').attr('action', window.location.origin+'/admin/actividades/editar-evidencia/'+codigo);
    $('#modalEditarEvidencia').modal('show');
}