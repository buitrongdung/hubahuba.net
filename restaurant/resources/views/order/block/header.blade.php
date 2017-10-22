
<div id="home" class="banner two">
	<div class="header-bottom">
		<div class="container">
			<div class="fixed-header">
			<!--logo-->
		       <div class="logo">
                  <a href="{{url('/')}}"><img src="{{asset('images/hubahuba.png')}}" height="100" width="197"></a>  
			   </div>
			<!--//logo-->
				<div class="top-menu">
					<span class="menu"> </span>
					<nav class="link-effect-4" id="link-effect-4">
					   <ul>
					   		<div style="margin-left: -728px;margin-top:-5px;">
						   		<li class="active"><a data-hover="Trang chủ" href="{{route('getHome')}}">Trang chủ</a></li>
						   		<li><a data-hover="Giới thiệu" href="{{route('getIntro')}}">Giới thiệu</a></li>
								<li><a data-hover="Khuyến mãi" href="{{route('khuyenmai')}}">Khuyến mãi</a></li>
							    <li><a data-hover="Đặt bàn" href="{{route('getIndexBooking')}}">Đặt bàn</a></li>
							    <li ><a data-hover="Thực đơn" href="{{action('StartController@danhsachmonan', ['id' => 1, 'alias' => 'khaivi'])}}<?=ARTICLE_SUFFIX?>">Thực đơn</a></li>
							    <li><a data-hover="Liên hệ" href="{{url('/')}}">Liên hệ</a></li>
							    <li><a data-hover="Tin tức" href="{{route('getNews')}}">Tin tức</a></li>
						    </div>
						    <div style="margin-top: 15px;">
						   		<li >
						   			<a href="{{ route('getinformation')}}">
						   			<span style="text-transform:initial;font-style:oblique ;font-size:22px;">Xin chào</span>
						   			<span style="text-transform:capitalize;font-size:20px;">{{Auth::User()->name}}</span>
						   			</a>
						   		</li>
						   		<li style="text-transform: initial;font-size: 18px;margin-right: -52px;">
						   			<a  href="{{url('auth/logout')}}">Đăng xuất</a>
						   		</li>
					   		</div>
					   </ul>
					 </nav>
			   </div>
			   <div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<!-- script-for-menu -->
<script>
	$("span.menu").click(function(){
		$(".top-menu ul").slideToggle("slow" , function(){
		});
	});
</script>
<!-- script-for-menu -->
<script>
	$(document).ready(function() {
		 var navoffeset=$(".header-bottom").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".header-bottom").addClass("fixed");
			}else{
				$(".header-bottom").removeClass("fixed");
			}
		 });
		 
	});
</script>
	