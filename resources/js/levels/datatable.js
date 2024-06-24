const LevelsTable = (params) => {
    let scrollY = screen.height - 520;
    return $("#levelstable").DataTable({
        scrollY: scrollY,
        destroy: true,
        scrollCollapse: true,
        processing: true,
        responsive: true,
        ajax: {
            url: '/levels/datatable',
            type: 'POST',
            data: params
        },
        columns: [{
                data: 'id',
                className: 'w-10',
            },
            {
                data: 'nombre',
                className: 'w-20',
            },
            {
                data: 'level_schedule.schedule',
                className: 'w-20',
            },
            {
                data: 'finicio',
                className: 'w-20',
            },
            {
                data: 'ffin',
                className: 'w-20',
            },
            {
                data: null,
                searcheable: false,
                className: 'w-10',
                render: ({ costo }) => {
                    return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(costo);
                }
            },
            {
                data: 'costo',
                visible: false
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

module.exports = {
    LevelsTable
}