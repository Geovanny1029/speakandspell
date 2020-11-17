const { Toast } = require("bootstrap");

const createStudentForm = (url) => {
    $("#modalformstudent").load(url, function() {
        $("#createstudent").modal("show");

        $(".date").datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            lang: 'es'
        });

        avatarusercreate();

        getSchedulebyLevel();
    });
}

const editStudentForm = (id) => {
    $("#modalformstudent").html('');

    let url = `/students/${id}/edit`;

    $("#modalformstudent").load(url, () => {
        $(".date").datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            lang: 'es'
        });
        avatarusercreate();
        $("#editstudent").modal('show');

        getSchedulebyLevel();
    });
}

const getSchedulebyLevel = () => {
    $("#nivel").on('change', () => {
        let levelid = $("#nivel").val();

        $.ajax({
            url: `levels/${levelid}`,
            type: 'GET',
            success: (resp) => {
                let schedule = $("#horario");
                let options = '<option selected="selected" value="">Seleccione Horario</option>';

                if (resp.length > 0) {
                    resp.forEach(({ level_schedule }) => {
                        options += `<option value=${level_schedule.id}>${level_schedule.schedule}</option>`;
                    });
                }

                schedule.html(options);
                schedule.attr('disabled', false);
            },
            error: (err) => {
                Toast(err, 'error');
            }
        });
    });
};

const avatarusercreate = () => {
    let img = $("#ruta_foto").val();

    if (typeof img === 'undefined' || img === null || img === '') {
        img = '/img/avatar-default.jpg';
    }

    $("#avatar").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        showUpload: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class = "glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: `<img src = "${img}" alt = "Your Avatar" width = "200px;"><h6 class = "text-muted">Click para seleccionar</h6>`,
        allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
    }).on('filezoomshown', function(event, params) {
        $("#createstudent").modal('toggle');
    }).on('filezoomhidden', function(event, params) {
        $("#createstudent").modal('show');
    });
}

module.exports = {
    createStudentForm,
    editStudentForm,
    getSchedulebyLevel
}