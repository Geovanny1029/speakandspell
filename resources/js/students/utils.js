const { refrescarTabla } = require('./table');

let params = () => {
    return {
        activo: $("#checkactivo").val(),
        nivel: $("#level").val(),
        horario: $("#schedule").val()
    }
}

const confirmStatus = (mensaje, status, id) => {
    $.confirm({
        title: 'Confirmación!',
        content: mensaje,
        type: status ? 'green' : 'red',
        buttons: {
            Confirmar: {
                btnClass: status ? 'btn-success' : 'btn-danger',
                keys: ['enter'],
                action: function() {
                    $.ajax({
                        url: `students/${id}`,
                        type: 'PUT',
                        data: { 'activo': status },
                        success: function(r) {
                            refrescarTabla();
                        }
                    });
                }
            },
            cancelar: function() {}
        }
    });
}

const cambiarTitulo = () => {
    let activo = $("#checkactivo");

    $("#titlestudents").text('Activos');

    if (!activo.prop('checked')) {
        $("#titlestudents").text('Inactivos');
    }
}

module.exports = {
    params,
    confirmStatus,
    cambiarTitulo
}