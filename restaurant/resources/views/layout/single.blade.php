
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from p.w3layouts.com/demos/apr-2016/05-04-2016/honest_food/web/single.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Sep 2016 07:41:51 GMT -->
<head>
<title>Hubahuba - Restaurant | Nhà hàng Hubahuba tại thành phố Hồ Chí Minh | đặt món ăn</title>
<link rel="icon" href="{{asset('images/favicon.gif')}}" type="image/gif">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Nhà hàng Hubahuba tại TP. Hồ Chí Minh là nhà hàng chất lượng cao, sang trọng, hiện đại. Cung cấp các dịch vụ đặt bàn, đặt món ăn trực tuyến, dịch vụ ca nhạc trực tiếp… Tổ chức các sự kiện, sinh nhật, gia đình. Ẩm thực đa dạng, phong phú, chất lượng vệ sinh cao…">
<meta name="keywords" content="Hubahuba Restaurant, nhà hàng Hubahuba tại tp.HCM, đặt bàn online, dat ban online, đặt món ăn online, nha hang Hubahuba" />
<meta name="copyright" content="HUBAHUBAT" />
<meta name="author" content="HUBAHUBA" />
<meta name="robots" content="index,follow" />
<meta http-equiv="content-language" content="vi"/>
<meta name="geo.placename" content="Hồ Chí Minh, Viet Nam" />
<script type="applisalonion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="{{asset('css/iconeffects.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />	
<link href="{{asset('css/mycss.css')}}" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="{{asset('css/swipebox.css')}}">
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
<!--/web-font-->
	<link href="{{asset('http://fonts.googleapis.com/css?family=Italianno')}}" rel='stylesheet' type='text/css'>
	<link href="{{asset('http://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700')}}" rel='stylesheet' type='text/css'>
<!--/script-->

<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
<script type="text/javascript">
	function xacnhanxoa(msg) {
		if (window.confirm(msg)) {
			return true;
		}
		return false;
	}
</script>
<!--animate-->
<link href="{{asset('css/animate.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{asset('js/wow.min.js')}}"></script>
	<script>
		 new WOW().init();
	</script>
<!--//animate-->
</head>
<body>
<!--blog-section-->

<!--start-home-->
		@include ('block.header')

<!--contents-->
		<div class="container">

			
                        @yield('content')
            
		
<!--footer-->
		@include ('block.footer')
		<!--start-smooth-scrolling-->
						<!-- <script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										$().UItoTop({ easingType: 'easeOutQuart' });
									});
								</script> -->
								<!--end-smooth-scrolling-->
		<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</body>
<!-- Mirrored from p.w3layouts.com/demos/apr-2016/05-04-2016/honest_food/web/single.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Sep 2016 07:41:51 GMT -->
</html>