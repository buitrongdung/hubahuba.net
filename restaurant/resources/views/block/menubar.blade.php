<div id="menu" style="margin-left: -18px">
   <ul>
	   	<?php 
			$data = DB::table('type_menu')->select('id','name', 'alias')->orderBy('id')->get();
		?>
		@foreach ($data as $item)
	   		<li><a href="{{action('StartController@danhsachmonan', ['id' => $item->id, 'alias' => $item->alias])}}<?=ARTICLE_SUFFIX?>">{{$item->name}}</a></li>
	   	@endforeach
   </ul>
</div>

