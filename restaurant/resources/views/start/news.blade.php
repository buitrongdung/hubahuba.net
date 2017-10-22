@extends('layout.single')
@section('content')
<div class="gallery" id="gallery" style="padding-top:16px">
	<div class="container">
		<h3 class="tittle">Tin tức</h3>
		<div style="margin-bottom: 14px;" class="arrows-serve"><img src="{{asset('images/border.png')}}" alt="border"></div>
		@foreach ($news as $new)
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 articles-box" style="float: left;padding-bottom: 15px">
            <article class="article">
                <figure class="article-media-container pull-left"> 
                    <a href="{{route('getDetailNews', [$new->id, $new->alias])}}<?=ARTICLE_SUFFIX?>"> 
                       <img class="img-responsive" src="{{asset('images/post/'.$new->image)}}" alt=""> 
                    </a> 
                </figure>
                    <h2 class="article-header-container font-2">
                      <a href="{{route('getDetailNews', [$new->id, $new->alias])}}<?=ARTICLE_SUFFIX?>">{!! $new->title !!}</a>
                    </h2>
                    <div class="article-content-container">
                    	{!! $new->summary !!}...
                    </div>
                    <div class="start wow flipInX btn btn-xs btn-extra btn-flat pull-right" style="margin-top: -14px"  data-wow-duration="1s" data-wow-delay=".3s"> 
                    <a style="padding: 5px;text-transform: none;" class=" hvr-bounce-to-bottom" href="{{route('getDetailNews', [$new->id, $new->alias])}}<?=ARTICLE_SUFFIX?>" title="" ><em>Xem thêm</em></a> 
                    </div>
           	</article>                 
        </div>
        @endforeach
    </div>
</div>
<div class="top-menu pull-left" style="margin-left: 540px;margin-top: -69px;">
	<ul>
		@if ($news->currentPage() != 1)
		<li><a href="{{str_replace('/?', '?', $news->url($news->currentPage() - 1)) }}" style="color:black;font-size: 18px"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
		@endif
		@for ($i = 1; $i <= $news->lastPage(); $i = $i + 1 )
		<li class="{{$news->currentPage() == $i ? 'scroll' : ''}}" >
			<a href="{{str_replace('/?', '?', $news->url($i)) }}" style="color:black; font-size: 18px" >{{$i}}</a>
		</li>
		@endfor
		@if ($news->currentPage() != $news->lastPage())
		<li><a href="{{str_replace('/?', '?', $news->url($news->currentPage() + 1)) }}" style="color:black; font-size: 18px"><i class="fa fa-forward" aria-hidden="true"></i></a></li>
		@endif
	</ul>
</div>		

<style type="text/css">
	.article-content-container {
		font-size: 14px;
		font-family:'Merriweather Sans, sans-serif';
	}
	.time-create{
		font-size: 12px;
	    color: #aaa;
	    display: block;
	    margin-bottom: 15px;
	}
	.article {
	    display: inline-block;
	    text-align: justify;
	    width: 100%;
	}
	.article-media-container {
	    width: 210px;
	    height: 140px;
	    display: block;
	    position: relative;
	    overflow: hidden;
	    margin-right: 7.5px;
	    margin-bottom: 7.5px;
	}
	figure {
	    margin: 0;
	}
	.font-2 {
	    font-family: 'Open Sans', sans-serif;
	    font-weight: 600;
	}
	.article-header-container {
	    font-size: 1.5em;
	    font-weight: 700;
	    margin-bottom:0;
	    color: #575a59;
	}
	p {
	    margin: 0 0 10px;
	}
	p {
	    display: block;
	    -webkit-margin-before: 0em;
	    -webkit-margin-after: 1em;
	    -webkit-margin-start: 0px;
	    -webkit-margin-end: 10px;
	}
</style>
@endsection