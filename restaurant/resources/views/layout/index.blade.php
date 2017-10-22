<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<!-- Mirrored from p.w3layouts.com/demos/apr-2016/05-04-2016/honest_food/web/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Sep 2016 07:40:43 GMT -->
<head>
    <title>Hubahuba - Restaurant | Nhà hàng Hubahuba tại thành phố Hồ Chí Minh | đặt món ăn</title>
    <link rel="icon" href="{{asset('images/favicon.gif')}}" type="image/gif">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description"
          content="Nhà hàng Hubahuba tại TP. Hồ Chí Minh là nhà hàng chất lượng cao, sang trọng, hiện đại. Cung cấp các dịch vụ đặt bàn, đặt món ăn trực tuyến, dịch vụ ca nhạc trực tiếp… Tổ chức các sự kiện, sinh nhật, gia đình. Ẩm thực đa dạng, phong phú, chất lượng vệ sinh cao…">
    <meta name="keywords"
          content="Hubahuba Restaurant, nhà hàng Hubahuba tại tp.HCM, đặt bàn online, dat ban online, đặt món ăn online, nha hang Hubahuba"/>
    <meta name="copyright" content="HUBAHUBAT"/>
    <meta name="author" content="HUBAHUBA"/>
    <meta name="robots" content="index,follow"/>
    <meta http-equiv="content-language" content="vi"/>
    <meta name="geo.placename" content="Hồ Chí Minh, Viet Nam"/>
    <script type="applisalonion/x-javascript">
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom Theme files -->
    <link href="css/iconeffects.css" rel='stylesheet' type='text/css'/>
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="css/swipebox.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!--/web-font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
    <!--/script-->
    <script src="{{ url('admin/bower_components/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 900);
            });
        });
    </script>
    <!-- swipe box js -->
    <script src="js/jquery.swipebox.min.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $(".swipebox").swipebox();
        });
    </script>
    <!-- //swipe box js -->
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

</head>
<body>


<!--start-home-->
<div class="banner" id="home" style="min-height: 718px;">
    <div class="header-bottom wow slideInDown" data-wow-duration="1s" data-wow-delay=".3s">
        <div class="container">
            <div class="fixed-header">
                <!--logo-->
                <h1 class="logo mb0 mt0">
                    <a href="{{url('/')}}"><img src="{{asset('images/hubahuba.png')}}" height="100" width="197"></a>
                </h1>
                <!--//logo-->
                <div class="top-menu">
                    <span class="menu"> </span>
                    <nav class="link-effect-4" id="link-effect-4">
                        @if (Auth::check())
                            <ul>
                                <div style="margin-left: -728px;margin-top:-5px;">
                                    <li class="active"><a data-hover="Trang chủ" href="{{url('/')}}">Trang chủ</a></li>
                                    <li><a data-hover="Giới thiệu" href="{{route('getIntro')}}">Giới thiệu</a></li>
                                    <li><a data-hover="Khuyến mãi" href="{{route('khuyenmai')}}">Khuyến mãi</a></li>
                                    <li><a data-hover="Đặt bàn" href="{{route('getIndexBooking')}}">Đặt bàn</a></li>
                                    <li><a data-hover="Thực đơn"
                                           href="{{action('StartController@danhsachmonan', ['id' => 1, 'alias' => 'khaivi'])}}<?=ARTICLE_SUFFIX?>">Thực
                                            đơn</a></li>
                                    <li><a data-hover="Liên hệ" href="{{url('/')}}">Liên hệ</a></li>
                                    <li><a data-hover="Tin tức" href="{{route('getNews')}}">Tin tức</a></li>
                                </div>
                                <div style="margin-top: 15px;">
                                    <li>
                                        <a href="{{ route('getinformation')}}">
                                            <span style="text-transform:initial;font-style:oblique ;font-size:22px;">Xin chào</span>
                                            <span style="text-transform:capitalize;font-size:20px;">{{Auth::User()->name}}</span>
                                        </a>
                                    </li>
                                    <li style="text-transform: initial;font-size: 18px;margin-right: -52px;">
                                        <a href="{{url('auth/logout')}}">Đăng xuất</a>
                                    </li>
                                </div>
                            </ul>
                        @else

                            <ul>
                                <li class="active"><a data-hover="Trang chủ" href="{{url('/')}}">Trang chủ</a></li>
                                <li><a data-hover="Giới thiệu" href="#about" class="scroll">Giới thiệu</a></li>
                                <li><a data-hover="Dịch vụ" href="#services" class="scroll">Dịch vụ</a></li>

                                <li><a data-hover="Đặt bàn" href="{{route('getIndexBooking')}}">Đặt bàn</a></li>
                                <li><a data-hover="Thực đơn" href="#gallery" class="scroll">Thực đơn</a></li>
                                <li><a data-hover="Liên hệ" href="#contact" class="scroll">Liên hệ</a></li>
                                <li><a data-hover="Tin tức" href="{{route('getNews')}}">Tin tức</a></li>
                                <li><a data-hover="Đăng nhập" href="{{route('getLogin')}}">Đăng nhập</a></li>
                            </ul>
                        @endif

                    </nav>
                </div>
                <!-- script-for-menu -->
                <script>
                    $("span.menu").click(function () {
                        $(".top-menu ul").slideToggle("slow", function () {
                        });
                    });
                </script>
                <!-- script-for-menu -->

                <div class="clearfix"></div>
                <script>
                    $(document).ready(function () {
                        var navoffeset = $(".header-bottom").offset().top;
                        $(window).scroll(function () {
                            var scrollpos = $(window).scrollTop();
                            if (scrollpos >= navoffeset) {
                                $(".header-bottom").addClass("fixed");
                            } else {
                                $(".header-bottom").removeClass("fixed");
                            }
                        });

                    });
                </script>
            </div>
        </div>
    </div>

    <!--slide-->
@include ('block.slide')
<!--/slide -->

    <div class="down"><a class="scroll" href="#services"><img src="images/down.png" alt=""></a></div>
</div>

<!--/products-->
<div class="about" id="about">
    <div class="container">
        <!--728x90-->
        <!--/about-section-->
        <div class="about-section">
            <div class="col-md-7 ab-left">
                <div class="grid">
                    <div class="h-f wow slideInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                        <figure class="effect-jazz">
                            <img src="images/s1.jpg" alt="img25"/>
                            <figcaption>
                                <h4>George Bernard Shaw</h4>
                                <p>"Còn tình cảm nào chân thành hơn tình yêu dành cho thức ăn."</p>

                            </figcaption>
                        </figure>

                    </div>
                    <div class="h-f wow slideInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                        <figure class="effect-jazz">
                            <img src="images/s2.jpg" alt="img25"/>
                            <figcaption>
                                <h4>J.R.R.Tolkien</h4>
                                <p>"Nếu có càng nhiều người trong chúng ta coi trọng thức ăn, những lời chúc tụng và các
                                    bài hát hơn là tích trữ vàng, thế giới này hẳn đã vui vẻ hơn nhiều."</p>

                            </figcaption>
                        </figure>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-5 ab-text">
                <h3 class="tittle wow slideInDown" data-wow-duration="1s" data-wow-delay=".3s">Xin chào!</h3>
                <div class="arrows-two wow slideInDown" data-wow-duration="1s" data-wow-delay=".5s"><img
                            src="images/border.png" alt="border"/></div>
                <p class="wow slideInUp" data-wow-duration="1s" data-wow-delay=".3s" style="font-style: italic;"><img
                            src="images/left-quotes.png" alt=""> Nhà hàng tự hào mang tới cho quý khách hàng những món
                    ăn tinh tế, mang đậm chất truyền thống Việt Nam. Không gian nhà hàng kết hợp hài hòa giữa thiết kế
                    đồ họa và hội họa mang phong cách Việt Nam đặc trưng. Đặc biệt, nhà hàng còn có các phòng riêng rất
                    thích hợp để tổ chức các sự kiện như tiệc kỉ niệm ngày cưới hay mừng sinh nhật, lưu giữ những khoảnh
                    khắc hạnh phúc và đáng nhớ. <img src="images/right-quotes.png" alt=""></p>
                <div class="start wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">
                    <a href="{{route('getIntro')}}" class="hvr-bounce-to-bottom">Đọc tiếp</a>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
        <!--//about-section-->
        <!--/about-section2-->
        <div class="about-section">
            <div class="col-md-5 ab-text two">
                <h3 class="tittle wow slideInDown" data-wow-duration="1s" data-wow-delay=".3s">Khuyến mãi</h3>
                <div class="arrows-two wow slideInDown" data-wow-duration="1s" data-wow-delay=".5s"><img
                            src="images/border.png" alt="border"/></div>
                <p class="wow slideInUp" data-wow-duration="1s" data-wow-delay=".3s">Chương trình khuyến mãi nhằm tri ân
                    khách hàng đã ghé thăm nhà hàng. Với nhiều chương trình khuyến mãi hấp dẫn với những chủ đề khác
                    nhau...</p>
                <div class="start wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">
                    <a href="{{route('khuyenmai')}}" class="hvr-bounce-to-bottom">Đọc tiếp</a>
                </div>

            </div>
            <div class="col-md-7 ab-left">
                <div class="grid">
                    <div class="h-f  wow slideInRight" data-wow-duration="1s" data-wow-delay=".2s">
                        <figure class="effect-jazz">
                            <img src="images/s4.jpg" alt="img25"/>
                            <figcaption>
                                <h4>Tia Mowry</h4>
                                <p>After my pregnancy I discovered I have an allergy to yeast. Problem is all the food I
                                    love has yeast in it. So I have to relearn how to cook.</p>

                            </figcaption>
                        </figure>

                    </div>
                    <div class="h-f  wow slideInRight" data-wow-duration="1s" data-wow-delay=".2s">
                        <figure class="effect-jazz">
                            <img src="images/s3.jpg" alt="img25"/>
                            <figcaption>
                                <h4>Nicole Eggert</h4>
                                <p>For all the concern about bodies and weight 'Baywatch' has three huge catering trucks
                                    on the set at all times. One for entrees one appetizers and one for junk food.</p>

                            </figcaption>
                        </figure>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--//about-section2-->
    </div>
</div>
<!--//products-->
<!-- service-type-grid -->
<div class="service" id="services">
    <div class="container">

        <h3 class="tittle">Dịch vụ nhà hàng</h3>
        <div class="arrows-serve"><img src="images/border.png" alt="border"></div>
        <div class="inst-grids">
            <div class="col-md-3 services-gd text-center wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
                    <a href="{{url('start/menu')}}" class="hi-icon"><img src="images/serve1.png" alt=" "/></a>
                </div>
                <h4>Xem thực đơn</h4>

            </div>
            <div class="col-md-3 services-gd text-center wow slideInDown" data-wow-duration="1s" data-wow-delay=".2s">
                <div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
                    <a href="{{route('getIndexBooking')}}" class="hi-icon"><img src="images/serve2.png" alt=" "/></a>
                </div>
                <h4>Đặt bàn</h4>

            </div>
            <div class="col-md-3 services-gd text-center wow slideInUp" data-wow-duration="1s" data-wow-delay=".2s">
                <div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
                    <a href="#" class="hi-icon"><img src="images/serve3.png" alt=" "/></a>
                </div>
                <h4>Công thức nấu ăn</h4>

            </div>
            <div class="col-md-3 services-gd text-center wow slideInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
                    <a href="#" class="hi-icon"><img src="images/serve4.png" alt=" "/></a>
                </div>
                <h4>Công thức gia vị</h4>

            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<!-- //service-type-grid -->
<!--start-services-->
<div class="team-section" id="team">
    <div class="container">

        <h3 class="tittle">Đầu bếp của nhà hàng</h3>
        <div class="arrows-serve"><img src="images/border.png" alt="border"></div>
        <div class="box2">
            <div class="col-md-3 s-1 wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                <a href="#">
                    <div class="view view-fifth">
                        <img src="images/chef1.jpg" alt="chef">
                        <div class="mask">
                            <h4>Bếp trưởng</h4>
                            <p style="font-style: italic;">"Nếu có càng nhiều người trong chúng ta coi trọng thức ăn,
                                những lời chúc tụng và các bài hát hơn là tích trữ vàng, thế giới này hẳn đã vui vẻ hơn
                                nhiều."</p>

                        </div>

                    </div>
                </a>
                <h3>Phạm Tuấn Hải</h3>
            </div>
            <div class="col-md-3 s-2 wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                <a href="#">
                    <div class="view view-fifth">
                        <img src="images/chef2.jpg" alt="chef">
                        <div class="mask">
                            <h4>Bếp phó</h4>
                            <p style="font-style: italic;">"Đồ ăn chính là biểu tượng của tình yêu khi ta không tìm ra
                                từ ngữ nào để diễn tả"</p>
                        </div>

                    </div>
                </a>
                <h3>Victoria</h3>
            </div>
            <div class="col-md-3 s-3 wow slideInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <a href="#">
                    <div class="view view-fifth">
                        <img src="images/chef3.jpg" alt="chef">
                        <div class="mask">
                            <h4>Đầu bếp</h4>
                            <p style="font-style: italic;">"Một chế độ ăn lành mạnh làm sao thiếu được rau củ quả. Tôi
                                gợi ý dùng bánh cà rốt, bánh mỳ bí ngòi và bánh bí ngô*."</p>
                        </div>
                    </div>
                </a>
                <h3>Jim Davis</h3>
            </div>
            <div class="col-md-3 s-4 wow slideInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <a href="#">
                    <div class="view view-fifth">
                        <img src="images/chef4.jpg" alt="chef">
                        <div class="mask">
                            <h4>Đầu bếp</h4>
                            <p style="font-style: italic;">"Nếu bạn thực sự muốn kết bạn, hãy đi tới nhà ai đó và ngồi
                                ăn với anh ta... Người mà cho bạn đồ ăn thì cũng cho bạn trái tim của họ."</p>
                        </div>
                    </div>
                </a>
                <h3>Rosie Wilson</h3>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--end-team-->

<!--start-banner-bottom-->
<!--/reviews-->
<div id="review" class="reviews">
    <div class="col-md-6 test-left-img">
    </div>
    <div class="col-md-6 test-monials">
        <h3 class="tittle">Lời khen tặng</h3>
        <div class="arrows-serve test"><img src="images/border.png" alt="border"></div>
        <!--//screen-gallery-->
        <div class="sreen-gallery-cursual">
            <!-- required-js-files-->
            <link href="css/owl.carousel.css" rel="stylesheet">
            <script src="js/owl.carousel.js"></script>
            <script>
                $(document).ready(function () {
                    $("#owl-demo").owlCarousel({
                        items: 1,
                        lazyLoad: true,
                        autoPlay: true,
                        navigation: false,
                        navigationText: false,
                        pagination: true
                    });
                });
            </script>
            <!--//required-js-files-->
            <div id="owl-demo" class="owl-carousel">
                <div class="item-owl">
                    <div class="test-review">
                        <p class="wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s"
                           style="font-style: italic;"><img src="images/left-quotes.png" alt=""> Nhà hàng phục vụ chuyên
                            nghiệp, không khí thoải mái, món ăn ngon. Rất thích hợp cho những bữa tiệc. <img
                                    src="images/right-quotes.png" alt=""></p>
                        <img src="images/t3.jpg" class="img-responsive" alt=""/>
                        <h5 class="wow bounceIn" data-wow-duration=".8s" data-wow-delay=".2s">Trần Tiến Dũng</h5>
                    </div>
                </div>
                <div class="item-owl">
                    <div class="test-review">
                        <p class="wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s"
                           style="font-style: italic;"><img src="images/left-quotes.png" alt="">Nhà hàng đậm chất Việt
                            Nam. Ở đây tôi có thể thưởng thức được gần như tất cả các món ngon của Việt Nam.<img
                                    src="images/right-quotes.png" alt=""></p>
                        <img src="images/t2.jpg" class="img-responsive" alt=""/>
                        <h5 class="wow bounceIn" data-wow-duration=".8s" data-wow-delay=".2s">Dennis Pal</h5>
                    </div>
                </div>
                <div class="item-owl">
                    <div class="test-review">
                        <p class="wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s"
                           style="font-style: italic;"><img src="images/left-quotes.png" alt=""> Chuyến đi công tác sẽ
                            rất tuyệt vời nếu như bạn có thể ăn những món ngon. Cảm ơn nhà hàng đã cho tôi được thưởng
                            thức những món ngon như vậy. <img src="images/right-quotes.png" alt=""></p>
                        <img src="images/t1.jpg" class="img-responsive" alt=""/>
                        <h5 class="wow bounceIn" data-wow-duration=".8s" data-wow-delay=".2s">Martin H.Wilson</h5>
                    </div>
                </div>
            </div>
            <!--//screen-gallery-->
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!--//reviews-->
<!--reservation-->
<div class="reservation" id="reservation">
    <div class="container">
        <div class="reservation-info">
            <h3 class="tittle reserve">Đặt bàn</h3>
            <div class="arrows-reserve"><img src="images/border.png" alt="border"></div>
            <div class="book-reservation wow slideInUp" data-wow-duration="1s" data-wow-delay=".5s">
                <form action="{{url('auth/login')}}" method="post">
                    <div class="col-md-4 form-left">
                        <label><i class="glyphicon glyphicon-calendar"></i> Ngày :</label>
                        <input type="date">
                    </div>
                    <div class="col-md-4 form-left">
                        <label><i class="glyphicon glyphicon-user"></i> Số người :</label>
                        <select class="form-control">
                            <?php
                            for ($i = 1; $i <= 10; $i++)
                                echo "<option value=" . $i . ">" . $i . "</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 form-right">
                        <label><i class="glyphicon glyphicon-time"></i> Thời gian :</label>
                        <input type="time">
                    </div>
                    <div class="clearfix"></div>
                    <div class="start wow flipInX" data-wow-duration="1s" data-wow-delay=".5s">
                        <a href="{{route('getIndexBooking')}}" class="hvr-bounce-to-bottom">Đặt bàn</a>
                    </div>
                </form>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--//reservation-->

<!--Gallery-->
<div class="gallery" id="gallery">
    <div class="container">
        <h3 class="tittle">Thực đơn</h3>
        <div class="arrows-serve"><img src="images/border.png" alt="border"></div>
        <div class="gallery-grids">
            <?php
            $homes = DB::table('home')->select('name', 'image', 'content', 'type')->where('type', '=', 1)->orderByRaw('RAND()')->paginate(2);
            ?>
            @foreach ($homes as $item)
                <div class="col-md-6 baner-top wow fadeInRight animated" data-wow-delay=".5s">
                    <a href="{{ asset('images/'.$item->image) }}" class="b-link-stripe b-animate-go  swipebox">
                        <div class="gal-spin-effect vertical ">
                            <img src="{{ asset('images/'.$item->image) }}" alt=""/>
                            <div class="gal-text-box">
                                <div class="info-gal-con">
                                    <h4>{{$item->name}}</h4>
                                    <span class="separator"></span>
                                    <p>{{$item->content}}</p>
                                    <span class="separator"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <?php
            $homeSmall = DB::table('home')->select('name', 'image', 'content', 'type')->where('type', '=', 0)->paginate(4);
            ?>
            @foreach ($homeSmall as $item)
                <div class="col-md-3 baner-top ban-mar wow fadeInUp animated" data-wow-delay=".5s">
                    <a href="{{ asset('images/'.$item->image) }}" class="b-link-stripe b-animate-go  swipebox">
                        <div class="gal-spin-effect vertical ">
                            <img src="{{ asset('images/'.$item->image) }}" alt=" "/>
                            <div class="gal-text-box">
                                <div class="info-gal-con">
                                    <h4>{{$item->name}}</h4>
                                    <span class="separator"></span>
                                    <p>{{$item->content}}</p>
                                    <span class="separator"></span>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <?php
            $homes = DB::table('home')->select('name', 'image', 'content', 'type')->where('type', '=', 1)->orderByRaw('RAND()')->paginate(2);
            ?>
            @foreach ($homes as $item)
                <div style="margin-top: 30px;" class="col-md-6 baner-top wow fadeInRight animated" data-wow-delay=".5s">
                    <a href="{{ asset('images/'.$item->image) }}" class="b-link-stripe b-animate-go  swipebox">
                        <div class="gal-spin-effect vertical ">
                            <img src="{{ asset('images/'.$item->image) }}" alt=""/>
                            <div class="gal-text-box">
                                <div class="info-gal-con">
                                    <h4>{{$item->name}}</h4>
                                    <span class="separator"></span>
                                    <p>{{$item->content}}</p>
                                    <span class="separator"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="start wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">
        <a href="{{action('StartController@danhsachmonan', ['id' => 1, 'alias' => 'khaivi'])}}<?=ARTICLE_SUFFIX?>"
           class="hvr-bounce-to-bottom">Xem thực đơn</a>
    </div>
</div>
<!-- //gallery -->

<!--bottom-->
<div class="bottom">
    <div class="container">
        <div class="bottom-top">
            <h3 class=" wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">Chúng tôi đang chia sẻ</h3>
            <span>Những bữa tiệc ngon</span>
            <p class="wow slideInDown" data-wow-duration="1s" data-wow-delay=".5s">Lorem Ipsum is simply dummy text of
                the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text ever
                since, Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            <div class="start wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">
                <a href="{{route('getNews')}}" class="hvr-bounce-to-bottom">Đọc tiếp</a>
            </div>
        </div>
    </div>
</div>

<!--/contact-->
<div class="section-contact" id="contact">
    <div class="container">
        <div class="contact-main">
            <div class="col-md-6 contact-grid wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                <h3 class="tittle wow bounceIn" data-wow-duration=".8s" data-wow-delay=".2s">Liên hệ với chúng tôi</h3>
                <div class="arrows-three"><img src="images/border.png" alt="border"></div>
                <p class="wel-text wow fadeInDown" data-wow-duration=".8s" data-wow-delay=".4s">Nhà hàng xin chân thành
                    cảm ơn quý khách đã ghé thăm nhà hàng. Quý khách có thể để lại lời nhắn tại đây. </p>
                <form id="filldetails" action="{{route('postMessage')}}" method="POST" class="form-horizontal">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Bạn tên gì?" required
                               style="width: 320px;margin-left: 120px;" class="form-control input"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="example@email.com" required
                               style="width: 320px;margin-left: 120px;" class="form-control input"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Số điện thoại" required maxlength="11"
                               style="width: 320px;margin-left: 120px;" class="form-control input"/>
                    </div>
                    <div class="form-group">
                        <textarea rows="2" name="msg" placeholder="Lời nhắn..." required class="form-control"
                                  style="width: 320px;margin-left: 120px;"/></textarea>
                    </div>
                    <div class="form-group" data-wow-duration="1s" data-wow-delay=".5s" style="margin-right: 295px;">
                        <button type="submit" value="send" name="send" href="" class="butselect hvr-bounce-to-bottom"
                                style="width: 76px;">Gửi
                        </button>
                    </div>
                </form>

            </div>
            <div class="col-md-6 contact-in wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                <h4 class="info">Thông tin của nhà hàng </h4>
                <div class="con-top">
                    <h4>Tp. Hồ Chí Minh</h4>
                    <ul>
                        <li>Nguyễn Văn Bảo, P.4, Gò Vấp, TP.HCM</li>
                        <li>Thời gian mở : từ 7h00 đến 23h00</li>
                        <li>Tel: (+84) 1656064982 &nbsp;&nbsp;&nbsp;(+84) 974227399</li>
                        <li>Email: buitrongdungcfc@gmail.com &nbsp;&nbsp;&nbsp;tranhoanghai35@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--map-->
        <div class="map wow fadeInDown" data-wow-duration=".8s" data-wow-delay=".5s" style="">
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3295.353457614039!2d106.68588245189297!3d10.822194051406848!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1479721197322"
                    width="100%" height="400" frameborder="0" style="border:0;margin-bottom: 15px;" allowfullscreen>
            </iframe>
        </div>
        <!--//map-->
    </div>
</div>
</div>
<!--//contact-->
<!--footer-->
<div class="footer text-center">
    <div class="container">
        <!--logo2-->
        <div class="logo2 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
            <img src="{{asset('images/hubahuba.png')}}" height="135" width="260">
        </div>
        <!--//logo2-->
        <a href="single.html" class="flag_tag2">Tìm kiếm nhà hàng?</a>
        <ul class="social wow slideInDown" data-wow-duration="1s" data-wow-delay=".3s">
            <li><a href="#" class="tw"></a></li>
            <li><a href="#" class="fb"> </a></li>
            <li><a href="#" class="in"> </a></li>
            <li><a href="#" class="dott"></a></li>
            <div class="clearfix"></div>
        </ul>
        <p class="copy-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Copyright&nbsp;&copy; 2017
            Hubahuba - Restaurant | Design by <a href="#">Hubahuba</a></p>

    </div>
</div>
<!--start-smooth-scrolling-->
<script type="text/javascript">
    $(document).ready(function () {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
<!--end-smooth-scrolling-->
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover"
                                                                         style="opacity: 1;"> </span></a>

</body>

<!-- Mirrored from p.w3layouts.com/demos/apr-2016/05-04-2016/honest_food/web/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Sep 2016 07:41:30 GMT -->
</html>