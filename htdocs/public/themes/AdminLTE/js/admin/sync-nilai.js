$(function(){
    $('#sync').on('click', function(){
        var url = $(this).data('url');
        var kd = $('#kode_test option:selected').val();

        window.location.href = url + '/' + kd;
    });
});