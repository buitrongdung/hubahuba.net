@extends('layout.single')
@section('content')
		
	<!--món ăn-->
	<div class="gallery" id="gallery" style="padding-top:16px">
		<div class="container">
			<h3 class="tittle">Thực đơn</h3>
			<div style="margin-bottom: 14px;" class="arrows-serve"><img src="{{asset('images/border.png')}}" alt="border"></div>
				<div class="container">
				@include('block.menubar')
				</div>
			<div style="height: 567px">
				<div class="gallery-grids" style="margin-top:0;margin-left: -30px;" >
					<div class="container">
						@foreach ($menus as $menu)
							@if ($menu->id_type == 10)
							<div class="col-md-6 baner-top wow fadeInRight animated" data-wow-delay=".5s" style="margin-bottom: 20px; margin-right: -7px;">
								<a href="{!!asset('images/combo/'.$menu->image)!!}" class="b-link-stripe b-animate-go  swipebox" style="width: 543px;">
									<div class="gal-spin-effect vertical " style="height: 331px; width: 520px">
										<img src="{!!asset('images/menu/'.$menu->image)!!}" alt="" />
										<div class="gal-text-box">
											<div class="info-gal-con">
												<h4 style="font-size: 72px; margin-bottom: 0px;">{{ $menu->name }}</h4>
												<span class="separator"></span>
												<p style="font-size: 18px;">{{$menu->content}}</p>
												<span class="separator"></span>
												<p style="font-size: 13px;"><?php echo number_format($menu->price,0,".","."); ?> VND</p>
												<span class="separator"></span>		
											</div>
										</div>
									</div>
								</a>
							</div>
							@else
							<div class="col-md-4 baner-top ban-mar wow fadeInLeft animated" data-wow-delay=".5s">							
								<a href="{!!asset('images/menu/'.$menu['image'])!!}" class="b-link-stripe b-animate-go  swipebox">
									<div class="gal-spin-effect vertical ">
										<img style="width:320px; height:210px; " src="{!!asset('images/menu/'.$menu['image'])!!}" alt=" " />	
										<div class="gal-text-box">
											<div class="info-gal-con">									
												<h4>{!!$menu['name']!!}</h4>											
												<span class="separator"></span>											
												<p>{!! number_format($menu->price,0,".",".") !!} VND</p>
												<span class="separator"></span>											
											</div>
										</div>
									</div>
								</a>
							</div>
							@endif
						@endforeach			
					</div>
				</div>
			</div>
		</div>
	</div> 			
	<div class="top-menu pull-left" style="margin-left: 540px;margin-top: -108px;">
				<ul>
					@if ($menus->currentPage() != 1)
					<li><a href="{{str_replace('/?', '?', $menus->url($menus->currentPage() - 1)) }}" style="color:black;font-size: 18px"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
					@endif
					@for ($i = 1; $i <= $menus->lastPage(); $i = $i + 1 )
					<li class="{{$menus->currentPage() == $i ? 'scroll' : ''}}" >
						<a href="{{str_replace('/?', '?', $menus->url($i)) }}" style="color:black; font-size: 18px" >{{$i}}</a>
					</li>
					@endfor
					@if ($menus->currentPage() != $menus->lastPage())
					<li><a href="{{str_replace('/?', '?', $menus->url($menus->currentPage() + 1)) }}" style="color:black; font-size: 18px"><i class="fa fa-forward" aria-hidden="true"></i></a></li>
					@endif
				</ul>
			</div>			
@endsection