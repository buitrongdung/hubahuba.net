<div class="banner-slider">
				<div class="callbacks_container">
					<ul class="rslides" id="slider4">
					<?php 
						$slides = DB::table('home')->select('image', 'content', 'created_at', 'type')->where('type', '=', 2)->paginate(3);
					?>
					@foreach ($slides as $slide)
					    <li>
						   <div class="banner-info" style="padding-bottom: 0px;padding-top: 0px;border: none;">
							      <!-- <h3 class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Chào mừng</h3>
								  <p class="wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">Đến với Honest Food</p>
								     <div class="arrows wow slideInDown"  data-wow-duration="1s" data-wow-delay=".2s"><img src="{{asset('images/'.$slide->image)}}" alt="border"/></div>
								 <span class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">{{$slide->content}}</span> -->
								<div class="arrows wow slideInDown"  data-wow-duration="1s" data-wow-delay=".2s">
									<img src="{{asset('images/'.$slide->image)}}" style="height: 439px;width: 721px;margin-left: -79px;" />
								</div>
							 </div>
						</li>
					@endforeach
					</ul>
			  </div>
		<!--banner Slider starts Here-->
	  	<script src="js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager:true,
			        nav:false,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
	      <!--banner Slider starts Here-->
		 </div>