$(document).ready(function () {
    $('#formEditEmployee').submit(function () {
        var id = $('input[name=id_employer]').val();
        var email = $('input[name=email]').val();
        var phone = $('input[name=phone]').val();
        var cmnd = $('input[name=cmnd]').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            url: 'http://hubahuba.lvh.me/admin/employer/' + id + '/update',
            data: {'_token' : token, 'id' : id, 'email' : email, 'phone' : phone, 'cmnd' : cmnd},
            method: 'post'
        }).done(function (data) {

        });
    });

    $('#formEditDetailEmp').submit(function () {
        var id = $('input[name=id_employer]').val();
        var email = $('input[name=email]').val();
        var phone = $('input[name=phone]').val();
        var cmnd = $('input[name=cmnd]').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            url: 'http://hubahuba.lvh.me/admin/show-employer/' + id + '/update',
            data: {'_token' : token, 'id' : id, 'email' : email, 'phone' : phone, 'cmnd' : cmnd},
            method: 'post'
        }).done(function (data) {

        });
    });
});