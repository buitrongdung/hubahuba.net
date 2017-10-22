$(document).ready(function () {
    $('#showChamCong').submit(function (e) {
        var month = $(this).find('select[name=month]').val();
        var year = $(this).find('select[name=year]').val();
        var token = $(this).find('input[name=_token]').val();
        $.ajax({
            url :  '<?=BASE_URL?>/admin/saraly/show',
            data : {'_token' : token, 'month' : month, 'year' : year},
            typeData : 'json',
            type : 'post'
        }).done(function (data) {
            // $('#show').html(data.items);
            console.log(data);
        });

    });
});