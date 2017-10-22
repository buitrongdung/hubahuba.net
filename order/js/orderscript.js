function formatNumber(number) {
    var number = number.toFixed(0) + '';
    var x = number.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function number_format (number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number;
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
    var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep;
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
    var s = '';
    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return '' + (Math.round(n * k) / k).toFixed(prec);
    }
    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function myFunction (obj) {
    var baseUrl = "http://hubahuba.lvh.me/khach-hang/thuc-don/";
    var token = $("input[name='_token']").val();
    var id = $(obj).attr('id');
    var qty = $(obj).val();
    var price = $(obj).data("price");

    if (qty > 0 && $.isNumeric(qty)) {
        var total = parseInt(qty)* price;
        var abc = total;
        $(obj).closest('tr').find('#a').text(number_format(abc)+" VNĐ");
        $(obj).closest('tr').find('#total').text(abc+" VNĐ");// tìm kiếm <tr> gần nhất xem có class total ko thì truyền vào giá trị
        var totalAmount = 0;
        $('.invoice_item').each(function() {// lọc tất cả các <tr class="invoice_item">
            var total = $(this).find('#total').text();
            totalAmount += parseInt(total);
        });
        $('#totalAmount').text(number_format(totalAmount)+" VNĐ");
        //updateQuantity();
        $.ajax({
            url: baseUrl + 'ajax-mua-hang',
            type: 'POST',
            cache: false,
            data: {'_token':token, 'qty':qty, 'id':id},
            success:function (data) {
                if (data == 'oke') {
                    //window.location = baseUrl + 'hoa-don-thuc-don/xac-nhan';
                } else {
                    //alert('Error');
                }
            }
        });
    } else {
        alert("Vui lòng nhập đúng số lượng!");
    }
}
