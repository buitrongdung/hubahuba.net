@if(count($errors) > 0)

	@foreach ($errors->all() as $error)
		<p style="color:red;margin-left: 104px;margin-bottom: 5px;font-style: italic;font-size: 14px;margin-top: -11px">
			{{$error}}
		</p>
	@endforeach

@endif 