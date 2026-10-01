$.fn.editable.defaults.mode = 'inline';

$(document).ready(function() {
    $('a.editable').editable();
    $('a.editable-date').editable({
        mode: 'popup',
        format: "yyyy-mm-dd",
        viewformat: "yyyy-mm-dd",
        datepicker: {
            todayBtn: 'linked'
        } 
    });
});