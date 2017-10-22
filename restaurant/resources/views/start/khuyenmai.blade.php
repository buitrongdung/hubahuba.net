@extends('layout.single')
@section('content')
<!--blog-section-->
	<div class="container" style="margin-left: -13px;">	
		@foreach ($news as $new)
			<div class="" style="margin-bottom:10px">
				<img src="{{ asset('images/tintuc.jpg')}}" width="100%" height="400px" />
			</div>
			<h1 class="" style="font-size: 33px;text-align: center;text-transform: uppercase;font-family: initial;color: #5b311a;margin-top: 21px;">
				{!! $new->title !!}
			</h1> <br>
			<div style="text-align: justify;">
				<a style=" font-size:18px; font-family:'Merriweather Sans, sans-serif'">{!! $new->content !!}</a>
			</div>
		@endforeach
	</div>
	<div class="col-md-6 contact-grid wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s" style="margin-top:21px">
		<h3 class="tittle wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Liên hệ với chúng tôi</h3>
		<div class="arrows-three"><img src="{{asset('images/border.png')}}" alt="border"></div>
		<div>
			<a style="font-family:'Merriweather Sans, sans-serif'">Địa chỉ: Nguyễn Văn Bảo, P.4, Gò Vấp, TP.HCM<br>
			<br>
		</div>
	</div>
	<div>
		<iframe class="" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15675.147249854535!2d106.6939804!3d10.82762035!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcef95dce1fbe08e2!2zxJBhzKNpIEhvzKNjIEPDtG5nIE5naGnDqsyjcCBUUEhDTQ!5e0!3m2!1svi!2s!4v1470802067617"
		width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen>
		</iframe>
	</div>
	
@stop	  
		
