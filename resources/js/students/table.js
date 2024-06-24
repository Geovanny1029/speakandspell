const {
    btnperfilstudent,
    btneditstudent,
    btnremovestudent,
    btnpagostudent,
    btnreturnstudent
} = require('./buttonsTable');


const StudentsTable = (params) => {
    let scrollY = screen.height - 520;
    return $("#studentstable").DataTable({
        scrollY: scrollY,
        destroy: true,
        scrollCollapse: true,
        processing: true,
        responsive: true,
        ajax: {
            url: '/students/datatable',
            type: 'POST',
            data: params
        },
        columns: [{
                data: 'id',
                className: 'w-10',
            },
            {
                data: 'nombre',
                className: 'w-25',
            },
            {
                data: null,
                className: 'w-25',
                render: ({ nivel_al }) => {
                    return nivel_al ? nivel_al.nombre : '';
                }
            },
            {
                data: null,
                className: 'w-25',
                render: ({ nivel_al }) => {
                    return nivel_al ? nivel_al.level_schedule.schedule : '';
                }
            },
            {
                data: null,
                searchable: false,
                orderable: false,
                className: 'text-center w-15',
                render: function(data) {
                    let response = btnperfilstudent + btneditstudent;

                    if (params.activo == 1) {
                        response += btnpagostudent + btnremovestudent;
                    } else {
                        response += btnreturnstudent;
                    }
                    return response;
                }
            }
        ],
        language: {
            url: '/languaje/es.json'
        },
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ]
    });
}

/**
 * función para volver a cargar el datatable
 *
 * @return  {[type]}  [return description]
 */
const refrescarTabla = () => {
    document.getElementById('btnfilterstudentstable').click();
}

module.exports = {
    StudentsTable,
    refrescarTabla
}