function xacnhanxoa (msg) {
	if (window.confirm(msg)) {
		return true;
	}
	return false;
}
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
function saraly (obj) {
	var ngayCong = $(obj).prev().val();
	//alert(ngayCong);
	var NCC = $(obj).prev().attr('data-NCC');
	var LCB = $(obj).prev().attr('data-LCB');
	var a = parseInt(LCB);
	var PC = $(obj).prev().attr('data-PC');
	var b = parseInt(PC);
	var KT = $(obj).prev().attr('data-KT');
	var c = parseFloat(KT);
	var kq = (a+b)/NCC*ngayCong;
	var total = formatNumber(kq);
	$(obj).closest('tr').find('#TLTT').text(total+".000 VNĐ");
	var LTL = kq-c;
	var sumSaraly = formatNumber(LTL);
	$(obj).closest('tr').find('#LTL').text(sumSaraly+".000 VNĐ");
}
function showHide (obj) {
	var baseUrl = 'http://localhost/doan/public/admin/post/';
	var token = $("input[name='_token']").val();
	var value = $(this).val();
	alert(token);
	$.ajax({
		url: baseUrl + 'ajax-show-hide',
		cache: false,
		type: "GET",
		data: {'value':value, '_token':token}
	});
}