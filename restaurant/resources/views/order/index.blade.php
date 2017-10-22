@extends('layout.single3')
@section('content')
	<!--chon combo-->
	<div class="gallery" id="gallery" style="padding-top:16px;padding-bottom: 0px">
		<div class="container" >
			<h2 style="font-size: 50px" class="tittle">Danh sách thực đơn</h2>
			<div style="margin-bottom: 14px;" class="arrows-serve"><img src="{{asset('images/border.png')}}" alt="border"></div>
			<div class="container" style="margin-left: -30px">
				<div id="menu" style="margin-left: 13px">
					<ul>
                        <?php
                        $data = DB::table('type_menu')->select('id','name', 'alias')->orderBy('id')->get();
                        ?>
						@foreach ($data as $item)
							<li><a style="width: 185px;" href="{!! route('indexCart',[$item->id, $item->alias]) !!}<?=ARTICLE_SUFFIX?>">{{$item->name}}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
			<div style="height: 567px">
				<div class="gallery-grids" style="margin-top:0;margin-left: -30px;">
					<div class="container">
						@foreach ($menus as $menu)
							@if ($menu->id_type == 10)
								<div class="col-md-6 baner-top wow fadeInRight animated" data-wow-delay=".5s" style="margin-bottom:0; margin-right:-7px;margin-top: 37px">
									<a href="{!!asset('images/menu/'.$menu->image)!!}" class="b-link-stripe b-animate-go  swipebox" style="width: 543px;">
										<div class="gal-spin-effect vertical " style="height: 331px; width: 520px">
											<img src="{!!asset('images/menu/'.$menu->image)!!}" alt="" />
											<div class="gal-text-box">
												<div class="info-gal-con">
													<h4 style="font-size: 72px; margin-bottom: 0px;">{{ $menu->name }}</h4>
													<span class="separator"></span>
													<p style="font-size: 18px;">{{$menu->content}}</p>
													<input type="hidden" value="{{$menu->id_type}}">
													<span class="separator"></span>
													<p style="font-size: 13px;"><?php echo number_format($menu->price,0,".","."); ?> VND</p>
													<span class="separator"></span>
												</div>
											</div>
										</div>
									</a>
									<div class="start wow flipInX"  data-wow-duration="1s" data-wow-delay=".3s" style="margin-top:0;width:544px;">
										<a href="{{route('getAddCombo', [$menu->id, $menu->name])}}" class="hvr-bounce-to-bottom">Thêm</a>
									</div>
								</div>
							@else
								<div class="col-md-4 baner-top ban-mar wow fadeInLeft animated" data-wow-delay=".5s">
									<a href="{!!asset('images/menu/'.$menu->image)!!}" class="b-link-stripe b-animate-go  swipebox">
										<div class="gal-spin-effect vertical ">
											<img style="width:320px; height:210px; " src="{!!asset('images/menu/'.$menu->image)!!}" alt=" " />
											<div class="gal-text-box">
												<div class="info-gal-con">
													<h4>{!!$menu->name!!}</h4>
													<span class="separator"></span>
													<input type="hidden" value="{!!$menu->id_type!!}">
													<p>{!! number_format($menu->price,0,".",".") !!} VND</p>
													<span class="separator"></span>
												</div>
											</div>
										</div>
									</a>
									<div class="start wow flipInX"  data-wow-duration="1s" data-wow-delay=".3s" style="margin-top:0;width:351px;">
										<a href="{{route('getAddCombo', [$menu->id, $menu->name])}}" class="hvr-bounce-to-bottom">Thêm</a>
									</div>
								</div>
							@endif
						@endforeach
					</div>

				</div>
			</div>
		</div>
	</div>
	<div style="margin: 131px 0 -66px 0">
		<div class="top-menu pull-left" style="margin-left: 540px;margin-top: -108px;">
			<ul>
				@if ($menus->currentPage() != 1)
					<li><a href="{{str_replace('/?', '/', $menus->url($menus->currentPage() - 1)) }}" style="color:black;font-size: 18px"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
				@endif
				@for ($i = 1; $i <= $menus->lastPage(); $i = $i + 1 )
					<li class="{{$menus->currentPage() == $i ? 'scroll' : ''}}" >
						<a href="{{str_replace('/?', '/', $menus->url($i)) }}" style="color:black; font-size: 18px" >{{$i}}</a>
					</li>
				@endfor
				@if ($menus->currentPage() != $menus->lastPage())
					<li><a href="{{str_replace('/?', '/', $menus->url($menus->currentPage() + 1)) }}" style="color:black; font-size: 18px"><i class="fa fa-forward" aria-hidden="true"></i></a></li>
				@endif
			</ul>
		</div>
	</div>
@stop