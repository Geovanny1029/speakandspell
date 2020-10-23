const lity = require("lity");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    responsive: true,
    language: {
        url: '/languaje/es.json'
    },
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
    ]
});

let active = $("#checkactivo").val();
let level = $("#level").val();
let schedule = $("#schedule").val();

let parameters = {
    'horario': schedule,
    'nivel': level,
    'activo': active
};

function params()
{
    active = $("#checkactivo").val();
    level = $("#level").val();
    schedule = $("#schedule").val();

    parameters = {
        'horario': schedule,
        'nivel': level,
        'activo': active
    }
}

let studentstable = null;

function StudentsTable() {
    let scrollY = screen.height - 520;
    studentstable = $("#studentstable").DataTable({
        scrollY       : scrollY,
        destroy       : true,
        scrollCollapse: true,
        ajax          : {
            url: '/students/datatable',
            type: 'POST',
            data: parameters
        },
        columns: [
            { 
                data: 'id',
                className: 'w-10', 
            },
            { 
                data: 'nombre',
                className: 'w-25', 
            },
            { 
                data: 'nivel',
                className: 'w-25', 
            },
            { 
                data: 'horario',
                className: 'w-25', 
            },
            {
                data : null,
                searchable: false,
                orderable: false,  
                className: 'text-center w-15',
                render: function (data) 
                {              
                    let response = btnperfilstudent(data.id) + btneditstudent; 

                    if (parameters.activo == 1){
                        response += btnpagostudent + btnremovestudent;
                    }else{
                        response += btnreturnstudent;
                    }    
                    return response;
                }
            }
        ]
    });
}

function btnperfilstudent(id) {
    return (["<button",
        "class          = 'btn btn-default btn-sm border border-dark'",
        "data-toggle    = 'tooltip'",
        "data-placement = 'left'",
        "title          = 'Ver Alumno'>",
        "<i class   = 'icon-user icon-large'></i>",
        "</button >"]).join(' ');
}

const btneditstudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-warning btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Editar Alumno'>",
    "<i class   = 'icon-pencil icon-large'></i>",
    "</button>"]).join(' ');

const btnremovestudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-danger btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Baja Alumno'>",
    "<i class   = 'icon-remove-sign icon-large'></i>",
    "</button>"]).join(' ');

const btnpagostudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-success btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Pago'>",
    "<i class   = 'icon-money icon-large'></i>",
    "</button>"]).join(' ');

const btnreturnstudent = (["<button",
    "type           = 'button'",
    "class          = 'btn btn-secondary btn-sm border border-dark'",
    "data-toggle    = 'tooltip'",
    "data-placement = 'top'",
    "title          = 'Regresar Alumno'>",
    "<i class   = 'icon-undo icon-large'></i>",
    "</button>"]).join(' ');

$("#btncreatestudent").on('click', function () {
    $("#modalformstudent").html('');

    let url = $(this).val();

    $("#modalformstudent").load(url, function () 
    {
        $("#createstudent").modal("show");   
        
        $(".date").datetimepicker(
        {
            timepicker : false,
            format     : 'd/m/Y'
        });

        avatarusercreate();              
    });
});

$("#btnstudentpdf").on('click',function(){
    let url = $(this).val() + "?" + $.param(parameters);
    
    lity(url);
    CreateStudentsTable();
});

function EditStudent(id) {
    $("#modalformstudent").html('');

    let url = `/students/${id}/edit`;
    $("#modalformstudent").load(url, () => {
        $(".date").datetimepicker(
            {
                timepicker: false,
                format: 'd/m/Y'
            });
        avatarusercreate();
        $("#editstudent").modal('show');
    });
}

function avatarusercreate(){
    $("#avatar").fileinput({
        overwriteInitial     : true,
        maxFileSize          : 1500,
        showClose            : false,
        showCaption          : false,
        showBrowse           : false,
        showUpload           : false,
        browseOnZoneClick    : true,
        removeLabel          : '',
        removeIcon           : '<i class = "glyphicon glyphicon-remove"></i>',
        removeTitle          : 'Cancel or reset changes',
        elErrorContainer     : '#kv-avatar-errors-2',
        msgErrorClass        : 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src = "/img/avatar-default.jpg" alt = "Your Avatar" width = "200px;"><h6 class = "text-muted">Click para seleccionar</h6>',
        allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
    }).on('filezoomshown', function (event, params) {
        $("#createstudent").modal('toggle');
    }).on('filezoomhidden', function (event, params) {
        $("#createstudent").modal('show');
    }); 
}

function CreateStudentsTable(){
    let activo   = $("#checkactivo");

    $("#titlestudents").text('Activos');

    if (!activo.prop('checked')){
        $("#titlestudents").text('Inactivos');
    }

    StudentsTable();
}

$("#checkactivo").on('change',function(){
    $(this).val(1);
    
    if(!this.checked){
        $(this).val(0);        
    }    
    params();
});

$("#schedule").on('change',function(){
    params();
});

$("#level").on('change', function () {
    params();
});

$("#studentstable tbody").on('click', '.btn-default', function () {
    let data = studentstable.row($(this).closest('tr')).data();
    let url = `/students/${data.id}`;
    lity(url);
});

$("#btnfilterstudentstable").on('click',function(){
    CreateStudentsTable();
});



$('#studentstable tbody').on('click', '.btn-warning', function (){
    let data = studentstable.row($(this).closest('tr')).data();

    EditStudent(data.id);
});

$('#studentstable tbody').on('click', '.btn-danger', function () {
    let data = studentstable.row($(this).closest('tr')).data();

    $.confirm({
        title: 'Confirmación!',
        content: `¿Estas seguro de dar de baja al alumno : ${data.nombre}`,
        type: 'red',
        buttons: {
            Confirmar: {
                btnClass: 'btn-danger text-white',
                keys: ['enter'],
                action: function () {
                    $.ajax({
                        url: `students/${data.id}`,
                        type: 'PUT',
                        data: { 'activo': 0 },
                        success: function (r) {
                            CreateStudentsTable();
                            resolve();
                        }
                    });                    
                }
            },
            cancelar: function () {                
            }
        }
    });       
});

$('#studentstable tbody').on('click', '.btn-secondary', function () {
    let data = studentstable.row($(this).closest('tr')).data();

    $.confirm({
        title: 'Confirmación!',
        content: `¿Estas seguro de activar al alumno : ${data.nombre}`,
        type: 'green',
        buttons: {
            Confirmar: {
                btnClass: 'btn-success text-white',
                keys: ['enter'],
                action: function () {
                    $.ajax({
                        url: `students/${data.id}`,
                        type: 'PUT',
                        data: { 'activo': 1},
                        success: function (r) {
                            CreateStudentsTable();
                            resolve();
                        }
                    });                    
                }
            },
            cancelar: function () {
            }
        }
    });
});

CreateStudentsTable();


