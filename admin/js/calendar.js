$(document).ready(function () {
    $("#submit").click(function () {
        var listCheckbox = [];
        $("input[class=selectedDay]:checked").each(function () {
            listCheckbox.push($(this).val());
        });
        var myJSON = JSON.stringify(listCheckbox);
        var month = $('select[name=month]').val();
        var year = $('select[name=year]').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            method: 'post',
            url: 'http://hubahuba.lvh.me/admin/employer/post/calendar',
            data: {
                '_token': token, 'listCheckbox': myJSON,
                'month': month, 'year': year
            }
        }).success(function (data) {
            alert(data);
            $("button[name=reset]").trigger('click');
            $("#timeToWeek").html(data);
        });
    });

    $('#formShowCalendar').submit(function () {
        var month = $(this).find('select[name=month]').val();
        var year = $(this).find('select[name=year]').val();
        var token = $(this).find('input[name=_token]').val();
        $.ajax({
            url: '<?=BASE_URL?>/admin/employer/calendar/show',
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
            url: '<?=BASE_URL?>/admin/show-employer/calendar/show',
            data: {'_token': token, 'month': month, 'year': year},
            typeData: 'json',
            type: 'post'
        }).done(function (data) {
            $('#showCalendarWithEmp').html(data.items);
        });

    });
});
