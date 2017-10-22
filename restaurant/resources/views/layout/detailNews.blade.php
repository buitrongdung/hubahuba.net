
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
<title>{!! $new->title !!}</title>
<link rel="icon" href="{{asset('images/favicon.gif')}}" type="image/gif" >
<meta name="description" content="<?=$new->summary?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Honest Food  Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
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
 <!--comment-->
 <div class="blog-section" style="margin-top: -2em;">
		<div class="container">


		   <div class="single">
						<div class="leave">
							<h4 class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Gửi nhận xét</h4>
						</div>
						@if (Auth::check())
							<form id="commentform" action="{{route('postComment')}}" method="POST">
								<input type="hidden" name="_token" value="{!! csrf_token() !!}">
								<input type="hidden" name="news_id" value="{{$new->id}}">
									<input id="author" name="author" type="hidden" value="{!! Auth::user()->name !!}" size="30" >
									<input id="email" name="email" type="hidden" value="{!! Auth::user()->email !!}" size="30" >
								 <p class="comment-form-comment wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">
									<label class="comment">Nhận xét</label>
									<textarea name="comment"></textarea>
								 </p>
								 <div class="clearfix"></div>
								<p class="form-submit wow shake"  data-wow-duration="1s" data-wow-delay=".3s">
								   <input name="commemt" type="submit" id="comment" value="Gửi">
								</p>
								<div class="clearfix"></div>
						   </form>
						@else
						<form id="commentform" action="{{route('postComment')}}" method="POST">
							<input type="hidden" name="_token" value="{!! csrf_token() !!}">
							<input type="hidden" name="news_id" value="{{$new->id}}">
							 <p class="comment-form-author-name"><label for="author">Tên quý khách</label>
								<input id="author" name="author" type="text" value="" size="30" aria-required="true" required>
							 </p>
							 <p class="comment-form-email wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">
								<label class="email">Email</label>
								<input id="email" name="email" type="text" value="" size="30" aria-required="true" required>
							 </p>
							 <p class="comment-form-comment wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">
								<label class="comment">Nhận xét</label>
								<textarea name="comment"></textarea>
							 </p>
							 <div class="clearfix"></div>
							<p class="form-submit wow shake"  data-wow-duration="1s" data-wow-delay=".3s">
							   <input name="commemt" type="submit" id="comment" value="Gửi">
							</p>
							<div class="clearfix"></div>
						   </form>
						@endif			
				 <div class="single_grid2" style="margin-bottom: 25px">
				   <h4 class="tz-title-4 tzcolor-blue wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">
						Cảm ơn quý khách đã để lại nhận xét cho nhà hàng!
					</h4>
					<ul class="list">
						@foreach ($comments as $data)
						@if ($data->news_id === $new->id)
						<li>
				            
				            <div class="col-md-10 data">
				                <div class="title"><a href="#">{!! $data->author !!}</a><br><span class="m_14"><?=date("d-m-Y", strtotime($data->date));?></span></div>
				                <p class="wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s">{!! $data->comment !!}</p>
				            </div>
				           <div class="clearfix"></div>
			       		</li>
			       		<hr>
			       		@endif
			        @endforeach
			     </ul>
				</div>
			 </div>
		</div>
	  </div>
	
 <!--/comment-->
		
<!--footer-->
		@include ('block.footer');
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