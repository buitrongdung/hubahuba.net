$(document).ready(function () {
    $('#formEditUser').submit(function () {
        var id = $('input[name=id]').val();
        var email = $('input[name=email]').val();
        var phone = $('input[name=phone]').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            url: 'http://hubahuba.lvh.me/khach-hang/thong-tin/' + id + '/cap-nhat',
            data: {'_token' : token, 'id' : id, 'email' : email, 'phone' : phone},
            method: 'post'
        }).done(function (data) {

        });
    });
});