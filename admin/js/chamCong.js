$(document).ready(function () {
    $('#submit').click(function () {
        var checkValue = [];
        $("input[class=selectedDay]:checked").each(function () {
            checkValue.push($(this).val());
        });
        var countCheck = checkValue.length;
        var myJSON = JSON.stringify(checkValue);
        var token = $('input[name=_token]').val();
        $.ajax({
            url: 'http://hubahuba.lvh.me/admin/saraly/post',
            method: 'post',
            data: {'_token': token, 'checkValue': myJSON, 'countCheck' : countCheck}
        }).success(function (data) {
            $("button[name=reset]").trigger('click');
        })
    });

    $('#formShowChamCong').submit(function () {
        var month = $(this).find('select[name=month]').val();
        var year = $(this).find('select[name=year]').val();
        var token = $(this).find('input[name=_token]').val();
        $.ajax({
            url: '<?=BASE_URL?>/admin/employer/saraly/show',
            data: {'_token': token, 'month': month, 'year': year},
            typeData: 'json',
            type: 'post'
        }).done(function (data) {
            $('#showCalendar').html(data.items);
        });

    });

    $('#formShowWithEmp').submit(function () {
        var month = $(this).find('select[name=month]').val();
        var year = $(this).find('select[name=year]').val();
        var token = $(this).find('input[name=_token]').val();
        $.ajax({
            url: '<?=BASE_URL?>/admin/show-employer/cham-cong/show',
            data: {'_token': token, 'month': month, 'year': year},
            typeData: 'json',
            type: 'post'
        }).done(function (data) {
            $('#showChamCongWithEmp').html(data.items);
        });

    });
});
