$(document).ready(function () {
    $('#showOrder').submit(function (e) {
        var selectVal = $(this).find('select[name=selectOrder]').val();
        $.ajax({
           url :  '<?=BASE_URL?>/admin/booking/show/',
           data : selectVal,
           typeData : 'json',
           type : 'post'
        }).done(function (data) {
            $('#showOrderToSelected').html(data.items);
        });

    });
    $('#showToDay').submit(function () {
       var fromDay = $(this).find('input[name=fromDay]').val();
       var toDay = $(this).find('input[name=toDay]').val();
       $.ajax({
           url :  '<?=BASE_URL?>/admin/booking/show/',
           data : {'fromDay' : fromDay, 'toDay' : toDay},
           typeData : 'json',
           type : 'post'
       }).done(function (data) {
           $('#showOrderToSelected').html(data.items);
       })
    });
});