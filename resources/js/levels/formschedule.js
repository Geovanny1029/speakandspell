$("#scheduleinicio").timepicker({
    timeFormat: 'h:mm p',
    startTime: '10:00',
    interval: 30,
    dynamic: false,
    dropdown: true,
    scrollbar: false
});

$("#scheduleinicio").on('click', () => {
    $(".ui-timepicker-container").css('z-index', 9999);
});

$("#schedulefin").timepicker({
    timeFormat: 'h:mm p',
    startTime: '10:00',
    interval: 30,
    dynamic: false,
    dropdown: true,
    scrollbar: false
});

$("#schedulefin").on('click', () => {
    $(".ui-timepicker-container").css('z-index', 9999);
});


////// form levels

$("#finicio").datetimepicker({
    timepicker: false,
    format: 'Y-m-d',
    onShow: function(ct) {
        this.setOptions({
            maxDate: jQuery('#ffin').val() ? jQuery('#ffin').val() : false
        })
    },
    lang: 'es'
});

$("#ffin").datetimepicker({
    timepicker: false,
    format: 'Y-m-d',
    onShow: function(ct) {
        this.setOptions({
            minDate: jQuery('#finicio').val() ? jQuery('#finicio').val() : false
        })
    },
    lang: 'es'
});