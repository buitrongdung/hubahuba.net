@extends('layout.detailNews')
@section('content')

	<div class="" style="margin-bottom:10px">
		<img src="{{ asset('images/tintuc.jpg')}}" width="100%" height="400px" />
	</div>
	<div class="container" style="margin-bottom: 15px;margin-left: -13px;">
		<h1 class="" style="font-size: 33px;text-align: center;text-transform: uppercase;font-family: initial;color: #5b311a;margin-top: 21px;">
			{!! $new->title !!}
		</h1>
			<span class="time-create"><?=date("d-m-Y h:i:s", strtotime($new->created_at));?></span>
		<div style="text-align: justify;" class="abc">
			{!! $new->content !!}
		</div>
		<div style="margin-top:11px">
			<img src="{{asset('images/orange-tag-16.ico')}}"> Thẻ tag:
		</div>
	</div>
<style type="text/css">
	.abc p {
		font-size:18px; font-family:'Merriweather Sans, sans-serif';
	}
	.time-create{
		font-size: 12px;
	    color: #aaa;
	    display: block;
	    margin-bottom: 15px;
	}
</style>
@stop	  