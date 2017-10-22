@extends('layout.master')
@section('content')
<div id="reservation_management"><!--management-->
                                <h1>Reservation management</h1>
                                <form action="{{url('/management/ReservationManagement.php')}}" method="post">
                                    <fieldset>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                            <colgroup>
                                                <col style="width: 5%">
                                                <col style="width: 30%">
                                                <col style="width: 10%">
                                                <col style="width: 30%">
                                                <col style="width: 10%">
                                                <col style="width: 5%">
                                                <col style="width: 5%">
                                                <col style="width: 5%">
                                                <col style="width: 5%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                <th rowspan="2">Day</th>
                                                <th rowspan="2">Seating</th>
                                                <th rowspan="2">Booking No.</th>
                                                <th rowspan="2">Guests</th>
                                                <th rowspan="2">Status</th>
                                                <th colspan="4">Action</th>
                                                </tr>
                                                <tr>
                                                <th>Confirm</th>
                                                <th>Decline</th>
                                                <th>Waitlist</th>
                                                <th>Reschedule</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                            		$day_old=0;$table_old=0;$count=1;

                                            	 ?>
                                            	 @foreach($seats as $seat)
                                            	 	<?php 
                                            	 			if($seat->day_id!=$day_old || $seat->table_id != $table_old)
                                            	 			{
                                            	 				$day_old=$seat->day_id;
                                            	 				$table_old=$seat->table_id;
                                            	 				$count=1;
                                            	 			}
                                            	 	 ?>
                                                <tr>
                                                <td>
                                                	@if($seat->status==='reschedule')
                                                		<select name="ds-{{$seat->id}}">
                                                				@foreach($days as $day)
                                                					<option value="{{$day->id}}" {{$day->id==$seat->day_id?'selected':''}}>{{$day->short}}</option>
                                                				@endforeach
                                                		</select>
                                                	@else
                                                		{{$seat->day->short}}
                                                	@endif
                                                </td>
                                                <td>
                                                	@if($seat->status==='reschedule')
                                                		<select name="ts-{{$seat->id}}">
                                                				@foreach($dinings as $dining)
                                                					@foreach($dining->getTables() as $table)
                                                					<option value="{{$table->id}}" {{$table->id==$seat->table_id?'selected':''}}>{{$dining->name}} {{$table->time}}</option>
                                                					@endforeach
                                                				@endforeach
                                                		</select>
                                                	@else
                                                		{{$seat->table->dining->name}} {{$seat->table->time}}
                                                	@endif
                                                </td>
                                                <td><span title="{{$seat->getInfo()}}">{{$seat->booking_id}}</span></td>
                                                <td>{{$count}}. {{$seat->guest}} {{$seat->country}}</td>
                                                <td>{{$seat->status}}</td>
                                                	@if($seat->status=='requested' || $seat->status=='reschedule')
	                                                <td><p class="text-center"><input type="radio" name="{{$seat->id}}" value="confirmed"></p></td>
	                                                <td><p class="text-center"><input type="radio" name="{{$seat->id}}" value="declined"></p></td>
	                                                <td><p class="text-center"><input type="radio" name="{{$seat->id}}" value="waitlisted"></p></td>
	                                                <td><p class="text-center"><input type="radio" name="{{$seat->id}}" value="reschedule" {{$seat->status=='reschedule'?'checked':''}}></p></td>
	                                                @else
	                                                	<td></td>
	                                                	<td></td>
	                                                	<td></td>
	                                                	<td></td>
	                                                @endif
                                                </tr>
                                                <?php $count++; ?>
                                                @endforeach
                                               
                                            </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                    <button class="btn btn-default" type="submit" name="create-guest-list">Create guest list</button>
                                    <button class="btn btn-default" type="submit" name="send-emails">Send emails</button>
                                    <button class="btn btn-primary" type="submit" name="save-confirmations">Save changes</button>
                                </form>
                        </div>
@stop