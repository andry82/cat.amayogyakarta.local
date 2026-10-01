$(function(){
    $('a.del-user').on('click', function () {
        var id = $(this).data(id);
    
        swalConfirm('Jika pilih Ya, muser akan dihapus.', function () {
            $.post(site_url + 'admin/user/hapus', { id: id }, function () {
                setInterval('location.reload()', 1000);
            })
        });
    });
});