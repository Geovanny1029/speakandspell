const btnperfilstudent = (["<button",
    "class          = 'btn btn-default btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'left'",
    "title          = 'Ver Alumno'>",
    "<i class   = 'icon-user icon-large'></i>",
    "</button >"
]).join(' ');


const btneditstudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-warning btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Editar Alumno'>",
    "<i class   = 'icon-pencil icon-large'></i>",
    "</button>"
]).join(' ');

const btnremovestudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-danger btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Baja Alumno'>",
    "<i class   = 'icon-remove-sign icon-large'></i>",
    "</button>"
]).join(' ');

const btnpagostudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-success btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Pago'>",
    "<i class   = 'icon-money icon-large'></i>",
    "</button>"
]).join(' ');

const btnreturnstudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-secondary btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Regresar Alumno'>",
    "<i class   = 'icon-undo icon-large'></i>",
    "</button>"
]).join(' ');

module.exports = {
    btnperfilstudent,
    btneditstudent,
    btnremovestudent,
    btnpagostudent,
    btnreturnstudent
}