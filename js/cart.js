var baseUrl = 'http://www.noithatgroup.com/';
$('a.cart_quantity_up').on('click',function(){
	var value = parseInt($(this).next().val()) + 1;
	$(this).next().val(value);
	event.preventDefault();
});
$('a.cart_quantity_down').on('click',function(event){
	var value = parseInt($(this).prev().val()) - 1;
	if(value > 0){
		$(this).prev().val(value);
	}else{
		alert('Số lượng không hợp lệ.');
	}
	event.preventDefault();
})
$('a.cart_quantity_update').on('click',function(event){
	// alert('dfsdfsd');
	var token = $("input[name='_token']").val();
	var qty = $(this).parent().prev().find('input').eq(0).val();
	var rowId = $(this).parent().prev().find('input').eq(1).val();
	// alert(rowId);
	// // alert(token);
	$.ajax({
		url:baseUrl+'mua-hang',
		type:'post',
		cache:false,
		data:{'_token':token,'qty':qty,'rowId':rowId}
	}).done(function(kq){
		if(kq == "oke"){
			window.location=baseUrl+"mua-hang";
		}else{
			alert('that bai');
		}
	});
	event.preventDefault();
});
$('a.cart_quantity_delete').on('click',function(event){
	var rowId=$("td.cart_quantity").find("input[name='rowId']").eq(0).val();
	var token = $("input[name='_token']").val();
	// alert('Thất bại');
	// $.ajax({
	// 	url:baseUrl+"xoasp",
	// 	type:'post',
	// 	cache:false,
	// 	data:{'_token':token,'rowId':rowId}
	$.ajax({
		url:baseUrl+'xoasp',
		type:'post',
		cache:false,
		data:{'_token':token,'rowId':rowId}
	}).done(function(kq){
		if(kq=="oke"){
			window.location =baseUrl+"mua-hang";
		}else{
			alert('Thất bại');
		}
	});

	event.preventDefault();
});
