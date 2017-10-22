@extends('layout.single')
@section('content')
<!--blog-section-->
		<div class="container">
			<div style="margin-left: -15px;padding-right: 14px;">
				@foreach ($news as $new)
				<div class="" style="margin-bottom:10px">
					<img src="{{ asset('images/noithat.png')}}" width="100%" height="400px" />
				</div>
				<h1 class="" style="font-size: 33px;text-align: center;text-transform: uppercase;font-family: initial;color: #5b311a;margin-top: 21px;">{!! $new->title !!}</h1> <br>

				<div style="text-align: justify;">
					<a style=" font-size:18px; font-family:'Merriweather Sans, sans-serif'">
						{!! $new->content !!}
					</a>
				</div>
				@endforeach
			
				<div class="col-md-6 contact-grid wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s" style="margin-top:21px">
					<h3 class="tittle wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Liên hệ với chúng tôi</h3>
					<div class="arrows-three"><img src="{{asset('images/border.png')}}" alt="border"></div>
					<div>
						<a style="font-family:'Merriweather Sans, sans-serif'">Địa chỉ: Nguyễn Văn Bảo, P.4, Gò Vấp, TP.HCM<br>
						</a><br>
					</div>
				</div>
				<div>
					<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3295.353457614039!2d106.68588245189297!3d10.822194051406848!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1479721197322" width="100%" height="400" frameborder="0" style="border:0;margin-bottom: 15px;" allowfullscreen></iframe>
				</div>
			</div>
		</div>
@stop	  
		
