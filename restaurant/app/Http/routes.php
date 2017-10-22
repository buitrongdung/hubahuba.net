<?php
Route::controller('start', 'StartController');
Route::get('/', [ 'as' => 'getHome', 'uses' => 'StartController@getHome']);
Route::get('danh-sach-mon-an', ['as' => 'getMenu', 'uses' => 'StartController@getMenu']);
Route::get('danh-sach-mon-an/{id}/{alias}', ['as' => 'danhsachmonan', 'uses' => 'StartController@danhsachmonan']);
Route::get('combo', ['as' => 'getCombo', 'uses' => 'StartController@getCombo']);
Route::get('gioi-thieu-nha-hang', [ 'as' => 'getIntro', 'uses' => 'StartController@getIntro']);
Route::get('khuyen-mai',['as' => 'khuyenmai', 'uses' => 'StartController@khuyenmai']);
Route::get('lien-he', 'StartController@getMessage');
Route::post('lien-he', ['as' => 'postMessage', 'uses' => 'StartController@postMessage']);
//tin tuc
Route::get('tin-tuc', ['as' => 'getNews', 'uses' => 'StartController@getNews']);
Route::get('tin-tuc/{id}/{alias}', ['as' => 'getDetailNews', 'uses' => 'StartController@getDetailNews']);
Route::get('nhan-xet', 'StartController@getComment');
Route::post('nhan-xet', ['as' => 'postComment', 'uses' => 'StartController@postComment']);

Route::controller('auth', 'Auth\AuthController');
Route::get('dang-nhap',['as'=>'getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('dang-nhap',['as'=>'postLogin','uses'=>'Auth\AuthController@postLogin']);
Route::get('login-admin', [ 'as' => 'getLoginAdmin', 'uses' => 'Auth\AuthController@getLoginAdmin']);
Route::post('login-admin',['as'=>'postLoginAdmin','uses'=>'Auth\AuthController@postLoginAdmin']);
Route::get('dang-ky', [ 'as' => 'getSignUp', 'uses' => 'Auth\AuthController@getSignUp']);
Route::post('dang-ky-thanh-vien',['as'=>'postDangky','uses'=>'Auth\AuthController@postSignUp']);

Route::get('thanh-vien/{id}/chinh-sua', ['as' => 'user.edit', 'uses' =>'Auth\UserController@edit']);
Route::put('thanhvien/{id}/cap-nhat', ['as' => 'user.update', 'uses' => 'Auth\UserController@update']);

// Password reset link request routes...
Route::get('gui-email', 'Auth\PasswordController@getEmail');
Route::post('gui-email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['prefix'=>'khach-hang', 'middleware' => 'auth'], function() {
	Route::group(['prefix'=>'thuc-don'], function() {
		Route::get('chon-thuc-don/{id}/{alias}',['as' => 'indexCart', 'uses' => 'CartController@index']);
		Route::get('dat-thuc-don/{id}/{tensanpham}',['as' => 'getAddCombo', 'uses' => 'CartController@getAddCombo']);
		Route::get('hoa-don', ['as' => 'postOrder', 'uses' => 'CartController@postOrder']);
		Route::get('{id}/xoa', ['as' => 'delete', 'uses' => 'CartController@delete']);
		Route::get('hoa-don-thuc-don/xac-nhan', ['as' => 'xacNhanMuaHang', 'uses' => 'CartController@xacNhanMuaHang']);
		Route::post('ajax-mua-hang',['as'=>'ajaxMuaHang','uses'=>'CartController@ajaxMuaHang']);
		Route::post('hoa-don/xac-nhan', ['as' => 'postXacNhanMuaHang', 'uses' => 'CartController@postXacNhanMuaHang']);
		Route::post('hoa-don/thanh-toan', ['as' => 'postThanhToanNganLuong', 'uses' => 'CartController@postThanhToanNganLuong']);
		Route::get('thanh-toan-thanh-cong', ['as' => 'getXacNhanThanhCong', 'uses' => 'CartController@getXacNhanThanhCong']);
	});
	Route::group(['prefix' => 'dat-ban'], function() {
		Route::get('/', [ 'as' => 'getIndexBooking', 'uses' => 'BookingController@getIndexBooking']);
		Route::post('/', [ 'as' => 'postStart', 'uses' => 'BookingController@postStart']);
		Route::get('chon-thong-tin', [ 'as' => 'getGroup', 'uses' => 'BookingController@getGroup']);
		Route::post('chon-thong-tin', [ 'as' => 'postGroup', 'uses' => 'BookingController@postGroup']);

	});
	Route::group(['prefix' => 'thong-tin'], function() {
		Route::get('/', ['as' => 'getinformation', 'uses' => 'UserController@informationUser']);
		Route::get('chinh-sua', ['as' => 'editUser', 'uses' =>'UserController@editUser']);
		Route::put('{id}/cap-nhat', ['as' => 'updateUser', 'uses' => 'UserController@updateUser']);
		Route::get('thay-doi-mat-khau', ['as' => 'getChangePassword', 'uses' => 'Auth\PasswordController@getChangePassword']);
		Route::put('thay-doi-mat-khau', ['as' => 'postChangePassword', 'uses' => 'Auth\PasswordController@postChangePassword']);
		Route::get('{id}/hoa-don-dat-ban', ['as' => 'getShowOrder', 'uses' => 'UserController@getShowOrder']);
		Route::delete('{id}/{randNumber}/dat-ban/delete', ['as' => 'deleteBooking', 'uses' => 'UserController@deleteBooking']);
		Route::get('{id}/dat-ban/chinh-sua', ['as' => 'editBooking', 'uses' => 'UserController@editBooking']);
		Route::put('{id}/dat-ban/cap-nhat', ['as' => 'updateBooking', 'uses' => 'UserController@updateBooking']);
		Route::get('{id}/in/{randNumber}', ['as' => 'printMenu', 'uses' => 'UserController@printMenu']);

		Route::get('{id}/hoa-don-thuc-don/{randNumber}', ['as' => 'getOrderMenu', 'uses' => 'UserController@getOrderMenu']);
		Route::put('{id}/update', ['as' => 'postUpdate', 'uses' => 'UserController@postUpdate']);
		Route::delete('{id}/delete', ['as' => 'deleteOrderMenu', 'uses' => 'UserController@deleteOrderMenu']);
	});
});


Route::group(['prefix'=>'admin', 'middleware' => 'auth'	], function() {	
	Route::group(['prefix'=>'employer'], function() {
		Route::get('list', ['as' => 'admin.employer.list', 'uses' => 'Admin\EmployerController@index']);
		Route::get('create', ['as' => 'admin.employer.create', 'uses' => 'Admin\EmployerController@create']);
		Route::post('create', ['as' => 'admin.employer.store', 'uses' => 'Admin\EmployerController@store']);
		Route::get('{id}/detail', ['as' => 'admin.employer.show', 'uses' => 'Admin\EmployerController@show']);
		Route::delete('{id}/delete', ['as' => 'admin.employer.destroy', 'uses' => 'Admin\EmployerController@destroy']);
		Route::get('{id}/edit', ['as' => 'admin.employer.edit', 'uses' =>'Admin\EmployerController@edit']);
		Route::put('{id}/update', ['as' => 'admin.employer.update', 'uses' => 'Admin\EmployerController@update']);
		Route::get('carlendar', ['as' => 'admin.employer.lichLamViec', 'uses' => 'Admin\EmployerController@lichLamViec']);
		Route::get('edit/{id}/carlendar', ['as' => 'admin.employer.editCalendar', 'uses' => 'Admin\EmployerController@editCalendar']);
		Route::put('edit/carlendar', ['as' => 'admin.employer.updateCalendar', 'uses' => 'Admin\EmployerController@updateCalendar']);
		Route::get('create/calendar', ['as' => 'admin.employer.getCalendar', 'uses' => 'Admin\EmployerController@getCalendar']);
		Route::post('post/calendar', ['as' => 'admin.employer.postCalendar', 'uses' => 'Admin\EmployerController@postCalendar']);
		Route::post('calendar/show', ['as' => 'showCalendar', 'uses' => 'Admin\EmployerController@showCalendar']);
	});

	Route::group(['prefix'=>'show-admin'], function() {
		Route::get('list', ['as' => 'admin.show.listAdmin', 'uses' => 'Admin\ShowController@listAdmin']);
		Route::get('information', ['as' => 'admin.show.show', 'uses' => 'Admin\ShowController@show']);
		Route::get('{id}/edit', ['as' => 'admin.show.editAdmin', 'uses' => 'Admin\ShowController@editAdmin']);
		Route::put('{id}/update', ['as' => 'admin.show.update', 'uses' => 'Admin\ShowController@update']);
		Route::delete('{id}/delete', ['as' => 'admin.show.destroy', 'uses' => 'Admin\ShowController@destroy']);
		Route::get('create', ['as' => 'admin.show.add', 'uses' => 'Admin\ShowController@create']);
		Route::post('create', ['as' => 'admin.show.store', 'uses' => 'Admin\ShowController@store']);
	});
	Route::group(['prefix' => 'post'], function () {
	//list bai viet
		Route::get ('list/news', ['as' => 'admin.post.listNews', 'uses' => 'Admin\PostController@listNews']);
		Route::get ('create/news', ['as' => 'admin.post.createNews', 'uses' => 'Admin\PostController@createNews']);
		Route::post ('store/news', ['as' => 'admin.post.storeNews', 'uses' => 'Admin\PostController@storeNews']);
		Route::delete('{id}/delete', ['as' => 'admin.post.destroy', 'uses' => 'Admin\PostController@destroy']);
		Route::get ('{id}/edit', ['as' => 'admin.post.edit', 'uses' => 'Admin\PostController@edit']);
		Route::put ('{id}/update', ['as' => 'admin.post.update', 'uses' => 'Admin\PostController@update']);
		Route::post('ajax-show-hide', ['as' => 'ajaxShowHide', 'uses' => 'Admin\PostController@ajaxShowHide']);
	});
	Route::group(['prefix'=>'account-employer'], function() {
		Route::get('list', ['as' => 'admin.account.listAccount', 'uses' => 'Admin\ShowController@listAccount']);
		Route::get('{id}/edit', ['as' => 'admin.account.editAccount', 'uses' => 'Admin\ShowController@editAccount']);
		Route::put('{id}/update', ['as' => 'admin.account.updateAccount', 'uses' => 'Admin\ShowController@updateAccount']);
		Route::delete('{id}/delete', ['as' => 'admin.account.destroyAccount', 'uses' => 'Admin\ShowController@destroyAccount']);
		Route::get('{id}/create', ['as' => 'admin.account.createAccount', 'uses' => 'Admin\ShowController@createAccount']);
		Route::put('create', ['as' => 'admin.account.storeAccount', 'uses' => 'Admin\ShowController@storeAccount']);
		Route::get('list/non-account', ['as' => 'admin.account.nonAccount', 'uses' => 'Admin\ShowController@nonAccount']);
	});
	
	Route::group(['prefix'=>'show-employer'], function() {
		Route::get('list', ['as' => 'admin.employer.listEmployer', 'uses' => 'Admin\ShowEmployer@listEmployer']);
		Route::get('{id}/edit', ['as' => 'admin.employer.editDetail', 'uses' => 'Admin\ShowEmployer@editDetail']);
		Route::put('{id}/update', ['as' => 'admin.employer.updateDetail', 'uses' => 'Admin\ShowEmployer@updateDetail']);
		Route::get('saraly', ['as' => 'admin.employer.saraly', 'uses' => 'Admin\ShowEmployer@saraly']);
		Route::get('calendar', ['as' => 'admin.employer.calendar', 'uses' => 'Admin\ShowEmployer@calendar']);
		Route::get('change/password', ['as' => 'admin.employer.getpassword', 'uses' => 'Admin\ShowEmployer@getPassword']);
		Route::put('change/password', ['as' => 'admin.employer.postpassword', 'uses' => 'Admin\ShowEmployer@postPassword']);
        Route::post('calendar/show', ['as' => 'admin.employer.showCalendar', 'uses' => 'Admin\ShowEmployer@showCalendar']);
        Route::get('cham-cong', ['as' => 'admin.employer.chamCong', 'uses' => 'Admin\ShowEmployer@chamCong']);
        Route::post('cham-cong/show', ['as' => 'showChamCong', 'uses' => 'Admin\ShowEmployer@showChamCong']);
	});
		
	Route::group(['prefix'=>'user'], function() {
		Route::get('list', ['as' => 'admin.user.list', 'uses' => 'Admin\UserController@index']);
		Route::delete('{id}/delete', ['as' => 'admin.user.destroy', 'uses' => 'Admin\UserController@destroy']);
		Route::get('{id}/show', ['as' => 'admin.user.show', 'uses' => 'Admin\UserController@show']);
	});

	Route::group(['prefix'=>'message'], function() {
		Route::get('show', ['as' => 'admin.message.show', 'uses' => 'Admin\MessageController@show']);
		Route::delete('{id}/delete', ['as' => 'admin.message.destroy', 'uses' => 'Admin\MessageController@destroy']);
	});
	
	Route::group(['prefix'=>'menu'], function() {
		Route::get('list', ['as' => 'admin.menu.list', 'uses' => 'Admin\MenuController@index']);
		Route::get('list/{id}/{tenloai}', ['as' => 'admin.menu.listfood', 'uses' => 'Admin\MenuController@listByType']);
		Route::get('create', ['as' => 'admin.menu.create', 'uses' => 'Admin\MenuController@create']);
		Route::post('create', ['as' => 'admin.menu.store', 'uses' => 'Admin\MenuController@store']);
		Route::delete('{id}/delete', ['as' => 'admin.menu.destroy', 'uses' => 'Admin\MenuController@destroy']);
		Route::get('{id}/edit', ['as' => 'admin.menu.edit', 'uses' =>'Admin\MenuController@edit']);
		Route::put('{id}/update', ['as' => 'admin.menu.update', 'uses' => 'Admin\MenuController@update']);
		
	});
	Route::group(['prefix'=>'combo'], function() {
		Route::get('list', ['as' => 'admin.combo.list', 'uses' => 'Admin\ComboController@index']);
		Route::get('create', ['as' => 'admin.combo.create', 'uses' => 'Admin\ComboController@create']);
		Route::post('create', ['as' => 'admin.combo.store', 'uses' => 'Admin\ComboController@store']);
		Route::delete('{id}/delete', ['as' => 'admin.combo.destroy', 'uses' => 'Admin\ComboController@destroy']);
		Route::get('{id}/edit', ['as' => 'admin.combo.edit', 'uses' =>'Admin\ComboController@edit']);
		Route::put('{id}/update', ['as' => 'admin.combo.update', 'uses' => 'Admin\ComboController@update']);
	});
	Route::group(['prefix'=>'home'], function() {
		Route::get('list', ['as' => 'admin.home.list', 'uses' => 'Admin\HomeController@index']);
		Route::get('list/{id}/{tenloai}', ['as' => 'admin.home.listfood', 'uses' => 'Admin\HomeController@listByType']);
		Route::get('create', ['as' => 'admin.home.create', 'uses' => 'Admin\HomeController@create']);
		Route::post('create', ['as' => 'admin.home.store', 'uses' => 'Admin\HomeController@store']);
		Route::delete('{id}/delete', ['as' => 'admin.home.destroy', 'uses' => 'Admin\HomeController@destroy']);
		Route::get('{id}/edit', ['as' => 'admin.home.edit', 'uses' =>'Admin\HomeController@edit']);
		Route::put('{id}/update', ['as' => 'admin.home.update', 'uses' => 'Admin\HomeController@update']);
	});
	Route::group(['prefix' => 'order'], function () {
		Route::get('list', ['as' => 'admin.order.index', 'uses' => 'Admin\OrderController@index']);
		Route::get('{id}/edit/{randNumber}', ['as' => 'admin.order.edit', 'uses' => 'Admin\OrderController@edit']);
		Route::put('{id}/update', ['as' => 'admin.order.update', 'uses' => 'Admin\OrderController@update']);
		Route::delete('{id}/delete', ['as' => 'admin.order.destroy', 'uses' => 'Admin\OrderController@destroy']);
		Route::get('list/unpaid', ['as' => 'admin.order.unpaid', 'uses' => 'Admin\OrderController@unpaid']);
		Route::get('list/{id}/print/{randNumber}', ['as' => 'orderPrint', 'uses' => 'Admin\OrderController@printOrder']);

		Route::get('list-combo', ['as' => 'admin.order.indexCombo', 'uses' => 'Admin\OrderCombo@indexCombo']);
		Route::get('combo/{id}/edit', ['as' => 'admin.order.editCombo', 'uses' => 'Admin\OrderCombo@editCombo']);
		Route::put('combo/{id}/update', ['as' => 'admin.order.updateCombo', 'uses' => 'Admin\OrderCombo@updateCombo']);
		Route::delete('combo/{id}/delete', ['as' => 'admin.order.destroyCombo', 'uses' => 'Admin\OrderCombo@destroyCombo']);
	});

	Route::group(['prefix' => 'booking'], function () {
		Route::get('list', ['as' => 'admin.booking.index', 'uses' => 'Admin\BookingController@index']);
		Route::get('{id}/edit', ['as' => 'admin.booking.edit', 'uses' => 'Admin\BookingController@edit']);
		Route::put('{id}/update', ['as' => 'admin.booking.update', 'uses' => 'Admin\BookingController@update']);
		Route::delete('{id}/{randNumber}/delete', ['as' => 'admin.booking.destroy', 'uses' => 'Admin\BookingController@destroy']);
		Route::get('list/unpaid', ['as' => 'admin.booking.unpaid', 'uses' => 'Admin\BookingController@unpaid']);
        Route::post('show', ['as' => 'showDetailOrder', 'uses' => 'Admin\BookingController@showDetailOrder']);
	});

	Route::group(['prefix' => 'saraly'], function () {
		Route::get('list-employer', ['as' => 'admin.saraly.list', 'uses' => 'Admin\SaralyController@index']);
		Route::get('list-employer/create', ['as' => 'admin.saraly.calendar', 'uses' => 'Admin\SaralyController@create']);
		Route::post('list-employer/create', ['as' => 'admin.saraly.store', 'uses' => 'Admin\SaralyController@store']);
		Route::get('list-saraly-employer', ['as' => 'admin.saraly.saralyEmployer', 'uses' => 'Admin\SaralyController@showEmployer']);
		Route::get('{id}/payroll', ['as' => 'admin.saraly.payroll', 'uses' => 'Admin\SaralyController@payroll']);
		Route::get('list', ['as' => 'admin.saraly.listChamCong', 'uses' => 'Admin\SaralyController@listChamCong']);
		Route::get('add', ['as' => 'admin.saraly.getChamCong', 'uses' => 'Admin\SaralyController@getChamCong']);
		Route::post('post', ['as' => 'admin.saraly.ChamCong', 'uses' => 'Admin\SaralyController@ChamCong']);
        Route::post('show', ['as' => 'showDetailChamCong', 'uses' => 'Admin\SaralyController@showDetailChamCong']);

		Route::delete('{id}/delete', ['as' => 'admin.saraly.destroy', 'uses' => 'Admin\SaralyController@destroy']);
		Route::get('{id}/edit', ['as' => 'admin.saraly.editSaraly', 'uses' => 'Admin\SaralyController@editSaraly']);
		Route::put('{id}/update', ['as' => 'admin.saraly.updateSaraly', 'uses' => 'Admin\SaralyController@updateSaraly']);
		Route::delete('cham-cong/{id}/delete/', ['as' => 'admin.saraly.destroyChamCong', 'uses' => 'Admin\SaralyController@destroyChamCong']);
		Route::get('cham-cong/{id}/edit', ['as' => 'admin.saraly.editChamCong', 'uses' => 'Admin\SaralyController@editChamCong']);
		Route::put('cham-cong/{id}/update', ['as' => 'admin.saraly.updateChamCong', 'uses' => 'Admin\SaralyController@updateChamCong']);
	});
});


Route::get('/management/ReservationManagement.php','ManagementController@getIndex');
Route::post('/management/ReservationManagement.php','ManagementController@postIndex');
