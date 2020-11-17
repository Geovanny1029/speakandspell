require('./formschedule');
const { LevelsTable } = require('./datatable');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#btnhorario").on('click', () => {
    $("#createschedule").modal('show');
});

$("#btncreatelevel").on('click', () => {
    $("#newlevel").modal('show');
});

// check on change
$("#checklevelactivo").on('change', function() {
    $(this).val(1);

    if (!this.checked) {
        $(this).val(0);
    }

    Levelstable = LevelsTable({ 'activo': $(this).val() });
});

let Levelstable = LevelsTable({ 'activo': $("#checklevelactivo").val() });