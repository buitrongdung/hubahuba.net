@extends('layout.master')
@section('content')
	@if(count($seats)>0)
		<table>
				<thead>
						<th>Booking No</th>
						<th>Booking Contact Name</th>
						<th>Booking Contact Organization</th>
						<th>Guest Name</th>
						<th>Guest Country</th>
				</thdead>
				<tbody>
					
						@foreach($seats as $seat)
						<tr>
							<td>{{$seat->booking_id}}</td>
							<td>{{$seat->booking->name}}</td>
							<td>{{$seat->booking->organization}}</td>
							<td>{{$seat->guest}}</td>
							<td>{{$seat->country}}</td>
						</tr>
						@endforeach
					
				</tbody>
		</table>
	@else
					<p style="color:red">There are no seat confirmed!</p>
	@endif
@stop