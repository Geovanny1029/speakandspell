const lity = require("lity");
const { createStudentForm, editStudentForm } = require('./form');
const { params, confirmStatus, cambiarTitulo } = require('./utils');
const { StudentsTable, refrescarTabla } = require('./table');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * función para abrir el modal con el formulario para agregar un nuevo estudiante
 *
 * @param   {[type]}  #btncreatestudent  
 */
$("#btncreatestudent").on('click', function() {
    $("#modalformstudent").html('');

    let url = $(this).val();

    createStudentForm(url);
});

/**
 * evento onclick para crear el listado de alumnos
 *
 * @param   {[type]}  #btnstudentpdf 
 */
$("#btnstudentpdf").on('click', function() {
    let url = $(this).val() + "?" + $.param(params());

    lity(url);
    refrescarTabla();
});

/**
 * funcion para cambiar el valor del check de activos
 *
 * @param   {[type]}  #checkactivo  
 */
$("#checkactivo").on('change', function() {
    $(this).val(1);

    if (!this.checked) {
        $(this).val(0);
    }
});

/**
 * Funcion para filtrar la busqueda de estudiantes
 *
 * @param   {[type]}  #btnfilterstudentstable  
 */
$("#btnfilterstudentstable").on('click', function() {
    cambiarTitulo();
    studentstable = StudentsTable(params());
});



/**
 * Acción para visualizar el perfil del estudiante
 *
 * @param   {[type]}  #studentstable tbody  
 */
$("#studentstable tbody").on('click', '.btn-default', function() {
    let data = studentstable.row($(this).closest('tr')).data();
    let url = `/students/${data.id}`;
    lity(url);
});

/**
 * Acción de editar usuario
 *
 * @param   {[type]}  #studentstable tbody  
 */
$('#studentstable tbody').on('click', '.btn-warning', function() {
    let data = studentstable.row($(this).closest('tr')).data();

    editStudentForm(data.id);
});

/**
 * Acción de dar de baja a un estudiante
 *
 * @param   {[type]}  #studentstable tbody  
 */
$('#studentstable tbody').on('click', '.btn-danger', function() {
    let data = studentstable.row($(this).closest('tr')).data();
    let mensaje = `¿Estas seguro de dar de baja al alumno : ${data.nombre}`;

    confirmStatus(mensaje, 0, data.id);
});

/**
 * Acción de reincorporrar estudiante
 *
 * @param   {[type]}  #studentstable tbody 
 */
$('#studentstable tbody').on('click', '.btn-secondary', function() {
    let data = studentstable.row($(this).closest('tr')).data();
    let mensaje = `¿Estas seguro de activar al alumno : ${data.nombre}`

    confirmStatus(mensaje, 1, data.id);
});

let studentstable = StudentsTable(params());