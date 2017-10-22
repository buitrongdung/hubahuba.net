@extends('layout.single2')
@section('content')
<!--chon combo-->
  @include ('order/block/header')
  <div id="submission_confirmation">
    <h1 class="page-header">Submission confirmation</h1>
    <p>
    {{$booking->name}},<br/><br/>
    Thank you for your booking request {{$booking->id}}.<br/><br/>

    You have requested booking for the following guests:
    </p>
    <ul>
    	@foreach($booking->getSeatsByDays() as $info)
  		  <li>{{$info['day']->name}}, {{$info['table']->dining->name}} {{$info['table']->time}} <br/>
  		  	@if($booking->type==='group')
  		  	for 
  		  	@foreach($info['seats'] as $seat)
  		  		{{$seat->guest}} {{$seat->country}},
  		  	@endforeach
  		  	@endif
  		  </li>
    	@endforeach
    </ul>
    <p>
    Please note that these booking requests will need to be reviewed and confirmed by WSI. <br/>
    You will receive an email with the confirmation as soon as possible.
    </p>
</div>
@stop