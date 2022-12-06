@extends("layouts.main")
@section('title','数字乡村基底平台')
@section('description','数字乡村基底平台')
@section('keywords','数字乡村基底平台')
@section("content")
    <style>
        .banner-a{
            background: linear-gradient(0deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)), #548634;
            border-radius: 4px !important;
            border: none;
            padding: 10px 40px;
        }
        .div-title{
            width: 674px;
            height: 198px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(16px);
            /* Note: backdrop-filter has minimal browser support */

            border-radius: 10px !important;
            margin: auto;
        }
        .div-title-first{
            font-family: 'OPPOSans';
            font-style: normal;
            font-weight: 400;
            font-size: 60px;
            /* identical to box height, or 133% */
            color: #25480F;
            height: 85px;
            line-height: 132px;
        }
        .div-title-second{
            /*width: 374px;*/
            height: 22px;
            font-family: 'OPPOSans';
            font-style: normal;
            font-weight: 400;
            font-size: 22px !important;
            line-height: 85px;
            /* identical to box height, or 100% */
            color: #25480F;
            letter-spacing: normal;!important;
        }
    </style>
    {{--    banner--}}
    <section id="text-carousel-intro-section" class="parallax" data-stellar-background-ratio="0.5"
             style="background-image: url(https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/slider-bg.jpg);background-position: 0px 138px">

        <div class="container">
            <div class="caption text-center text-white" data-stellar-ratio="0.7" style="top: 340px">

                <div id="owl-intro-text" class="owl-carousel">
                    <div class="item">
                        <div class="div-title">
                            <h1 class="div-title-first">数字乡村基底平台</h1>
                            <p class="div-title-second">物联网乡村基础数据整合、可视化平台</p>
                        </div>
                        <div class="extra-space-l"></div>

                        <div>
                            <a class="btn btn-blank banner-a" id="enter_map" href="{{route('u3d-map')}}" role="button">进入元田</a>
                            <a class="btn btn-blank banner-a" style="margin-left: 40px" href="{{route('u3d-ability')}}"
                               role="button">合作咨询</a>
                        </div>

                    </div>

                    {{--                    <div class="item">--}}
                    {{--                        <h1>Join with us</h1>--}}
                    {{--                        <p>To the greatest Journey</p>--}}
                    {{--                        <div class="extra-space-l"></div>--}}
                    {{--                        <a class="btn btn-blank" href="" target="_blank" role="button">View More!</a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="item">--}}
                    {{--                        <h1>I'm Unika</h1>--}}
                    {{--                        <p>One Page Responsive Theme</p>--}}
                    {{--                        <div class="extra-space-l"></div>--}}
                    {{--                        <a class="btn btn-blank" href="" target="_blank" role="button">View More!</a>--}}
                    {{--                    </div>--}}
                </div>

            </div> <!-- /.caption -->
        </div> <!-- /.container -->

    </section>


    {{--    视频播放--}}
{{--    <section id="cta-section">--}}
{{--        <div class="cta">--}}
{{--            <div class="container">--}}
{{--                <div class="row" style="text-align: center">--}}
{{--                    <video controls="controls" autoplay="autoplay" muted=“muted” loop="loop" src="company.mp4"--}}
{{--                           style="width: 1000px;height: 573px"></video>--}}
{{--                </div> <!-- /.row -->--}}
{{--            </div> <!-- /.container -->--}}
{{--        </div>--}}
{{--    </section>--}}
    {{--    产品特色--}}
{{--    <section id="portfolio-section" class="page bg-style1" style="display: none">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="portfolio">--}}
{{--                        <!-- Begin page header-->--}}
{{--                        <div class="page-header-wrapper">--}}
{{--                            <div class="container">--}}
{{--                                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">--}}
{{--                                    <h2>产品特色</h2>--}}
{{--                                    <div class="devider"></div>--}}
{{--                                    <p class="subtitle">What we are proud of</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- End page header-->--}}
{{--                        <div class="portfoloi_content_area">--}}
{{--                            <div class="portfolio_menu" id="filters">--}}
{{--                                <ul>--}}
{{--                                    <li class="active_prot_menu"><a href="#porfolio_menu" data-filter="*">all</a></li>--}}
{{--                                    <li><a href="#porfolio_menu" data-filter=".websites">websites</a></li>--}}
{{--                                    <li><a href="#porfolio_menu" data-filter=".webDesign">web design</a></li>--}}
{{--                                    <li><a href="#porfolio_menu" data-filter=".appsDevelopment">apps development</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="#porfolio_menu" data-filter=".GraphicDesign">graphic design</a></li>--}}
{{--                                    <li><a href="#porfolio_menu" data-filter=".responsive">responsive</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio_content">--}}
{{--                                <div class="row" id="portfolio">--}}
{{--                                    <div class="col-xs-12 col-sm-4 appsDevelopment">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p1.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Skull Awesome</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 GraphicDesign">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p2.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Photo Frame</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 responsive">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p3.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Hand Shots</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 webDesign websites">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p4.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Night Abstract</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 appsDevelopment websites">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img//portfolio/p5.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Joy of Independence</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 GraphicDesign">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p6.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Night Crawlers</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 responsive">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p7.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Last Motel</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 GraphicDesign">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p8.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Dirk Road</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-4 websites">--}}
{{--                                        <div class="portfolio_single_content">--}}
{{--                                            <img src="img/portfolio/p9.jpg" alt="title"/>--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)">Old is Gold</a>--}}
{{--                                                <span>Subtitle</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    {{--    about us--}}
{{--    <section id="about-section" class="page bg-style1" style="display: none">--}}
{{--        <!-- Begin page header-->--}}
{{--        <div class="page-header-wrapper">--}}
{{--            <div class="container">--}}
{{--                <div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">--}}
{{--                    <h2>关于我们</h2>--}}
{{--                    <div class="devider"></div>--}}
{{--                    <p class="subtitle">简介</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End page header-->--}}

{{--        <!-- Begin rotate box-1 -->--}}
{{--        <div class="rotate-box-1-wrapper">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <a href="#" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0">--}}
{{--                            <span class="rotate-box-icon"><i class="fa fa-users"></i></span>--}}
{{--                            <div class="rotate-box-info">--}}
{{--                                <h4>Who We Are?</h4>--}}
{{--                                <p>Lorem ipsum dolor sit amet set, consectetur utes anet adipisicing elit, sed do--}}
{{--                                    eiusmod tempor incidist.</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <a href="#" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0.2s">--}}
{{--                            <span class="rotate-box-icon"><i class="fa fa-diamond"></i></span>--}}
{{--                            <div class="rotate-box-info">--}}
{{--                                <h4>What We Do?</h4>--}}
{{--                                <p>Lorem ipsum dolor sit amet set, consectetur utes anet adipisicing elit, sed do--}}
{{--                                    eiusmod tempor incidist.</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <a href="#" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0.4s">--}}
{{--                            <span class="rotate-box-icon"><i class="fa fa-heart"></i></span>--}}
{{--                            <div class="rotate-box-info">--}}
{{--                                <h4>Why We Do It?</h4>--}}
{{--                                <p>Lorem ipsum dolor sit amet set, consectetur utes anet adipisicing elit, sed do--}}
{{--                                    eiusmod tempor incidist.</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <a href="#" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0.6s">--}}
{{--                            <span class="rotate-box-icon"><i class="fa fa-clock-o"></i></span>--}}
{{--                            <div class="rotate-box-info">--}}
{{--                                <h4>Since When?</h4>--}}
{{--                                <p>Lorem ipsum dolor sit amet set, consectetur utes anet adipisicing elit, sed do--}}
{{--                                    eiusmod tempor incidist.</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                </div> <!-- /.row -->--}}
{{--            </div> <!-- /.container -->--}}
{{--        </div>--}}
{{--        <!-- End rotate box-1 -->--}}

{{--        <div class="extra-space-l"></div>--}}

{{--        <!-- Begin page header-->--}}
{{--        <div class="page-header-wrapper">--}}
{{--            <div class="container">--}}
{{--                <div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">--}}
{{--                    <h4>Our Skills</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End page header-->--}}

{{--        <!-- Begin Our Skills -->--}}
{{--        <div class="our-skills">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-sm-6">--}}
{{--                        <div class="skill-bar wow slideInLeft" data-wow-delay="0.2s">--}}
{{--                            <div class="progress-lebel">--}}
{{--                                <h6>Photoshop & Illustrator</h6>--}}
{{--                            </div>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"--}}
{{--                                     aria-valuemax="100" style="width: 75%;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-6">--}}
{{--                        <div class="skill-bar wow slideInRight" data-wow-delay="0.2s">--}}
{{--                            <div class="progress-lebel">--}}
{{--                                <h6>WordPress</h6>--}}
{{--                            </div>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0"--}}
{{--                                     aria-valuemax="100" style="width: 85%;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-6">--}}
{{--                        <div class="skill-bar wow slideInLeft" data-wow-delay="0.4s">--}}
{{--                            <div class="progress-lebel">--}}
{{--                                <h6>Html & Css</h6>--}}
{{--                            </div>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0"--}}
{{--                                     aria-valuemax="100" style="width: 95%;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-6">--}}
{{--                        <div class="skill-bar wow slideInRight" data-wow-delay="0.4s">--}}
{{--                            <div class="progress-lebel">--}}
{{--                                <h6>Javascript</h6>--}}
{{--                            </div>--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"--}}
{{--                                     aria-valuemax="100" style="width: 70%;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div> <!-- /.row -->--}}
{{--            </div> <!-- /.container -->--}}
{{--        </div>--}}
{{--        <!-- End Our Skill -->--}}
{{--    </section>--}}
    {{--    联系我们--}}
{{--    <section id="contact-section" class="page text-white parallax" data-stellar-background-ratio="0.5"--}}
{{--             style="display:none;background-image: url(img/map-bg.jpg);">--}}
{{--        <div class="cover"></div>--}}

{{--        <!-- Begin page header-->--}}
{{--        <div class="page-header-wrapper">--}}
{{--            <div class="container">--}}
{{--                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">--}}
{{--                    <h2>联系我们</h2>--}}
{{--                    <div class="devider"></div>--}}
{{--                    --}}{{--                    <p class="subtitle">联系我们</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End page header-->--}}

{{--        <div class="contact wow bounceInRight" data-wow-delay="0.4s">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-sm-6">--}}
{{--                        <div class="contact-info">--}}
{{--                            <h4>地址</h4>--}}
{{--                            <ul class="contact-address">--}}
{{--                                <li><i class="fa fa-map-marker fa-lg"></i>&nbsp;深圳市福田区沙头街道天安社区泰然四路25号天安创新科技广场一期B座1012B室--}}
{{--                                </li>--}}
{{--                                <li><i class="fa fa-phone"></i>&nbsp; 4000705070</li>--}}
{{--                                --}}{{--                                <li><i class="fa fa-print"></i>&nbsp; 1 -234 -456 -7890</li>--}}
{{--                                <li><i class="fa fa-envelope"></i> info@yourdomain.com</li>--}}
{{--                                --}}{{--                                <li><i class="fa fa-skype"></i> Unika-Design</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-6">--}}
{{--                        <div class="contact-form">--}}
{{--                            <h4>站内信</h4>--}}
{{--                            <form role="form">--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control input-lg" placeholder="名字" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="email" class="form-control input-lg" placeholder="邮箱" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control input-lg" placeholder="标题" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <textarea class="form-control input-lg" rows="5" placeholder="内容"--}}
{{--                                              required></textarea>--}}
{{--                                </div>--}}
{{--                                <button type="submit" class="btn wow bounceInRight" data-wow-delay="0.8s">提交</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div> <!-- /.row -->--}}
{{--            </div> <!-- /.container -->--}}
{{--        </div>--}}
{{--    </section>--}}
    {{--    页脚--}}
{{--    <footer class="text-off-white" style="display: none">--}}

{{--        <div class="footer-top">--}}
{{--            <div class="container">--}}
{{--                <div class="row wow bounceInLeft" data-wow-delay="0.4s">--}}

{{--                    <div class="col-sm-6 col-md-4">--}}
{{--                        <h4>友情链接</h4>--}}
{{--                        <ul class="imp-links">--}}
{{--                            <li><a href="">About</a></li>--}}
{{--                            <li><a href="">Services</a></li>--}}
{{--                            <li><a href="">Press</a></li>--}}
{{--                            <li><a href="">Copyright</a></li>--}}
{{--                            <li><a href="">Advertise</a></li>--}}
{{--                            <li><a href="">Legal</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-6 col-md-4">--}}
{{--                        <h4>Subscribe</h4>--}}
{{--                        <div id="footer_signup">--}}
{{--                            <div id="email">--}}
{{--                                <form id="subscribe" method="POST">--}}
{{--                                    <input type="text" placeholder="Enter email address" name="email" id="address"--}}
{{--                                           data-validate="validate(required, email)"/>--}}
{{--                                    <button type="submit">Submit</button>--}}
{{--                                    <span id="result" class="section-description"></span>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut--}}
{{--                            labore et dolore magna aliqua.</p>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-12 col-md-4">--}}
{{--                        <h4>Recent Tweets</h4>--}}
{{--                        <div class="single-tweet">--}}
{{--                            <div class="tweet-content"><span>@Unika</span> Excepteur sint occaecat cupidatat non--}}
{{--                                proident--}}
{{--                            </div>--}}
{{--                            <div class="tweet-date">1 Hour ago</div>--}}
{{--                        </div>--}}
{{--                        <div class="single-tweet">--}}
{{--                            <div class="tweet-content"><span>@Unika</span> Excepteur sint occaecat cupidatat non--}}
{{--                                proident uku shumaru--}}
{{--                            </div>--}}
{{--                            <div class="tweet-date">1 Hour ago</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div> <!-- /.row -->--}}
{{--            </div> <!-- /.container -->--}}
{{--        </div>--}}


{{--    </footer>--}}
    <a href="#" class="scrolltotop" style="bottom:8px;right:24px;line-height:43px;background: #fff;border-radius: 4px !important;width: 48px !important;height: 48px !important;border: none !important;-webkit-transform:none;transform:none"><i style="-webkit-transform:none;transform:none" class="fa fa-arrow-up"></i></a>
    <script>
        $(function () {
            var _t = '{{$_t}}';
            if (_t == 'null') {
                $('#reg').css('display', 'block');
                $('#profile').css('display', 'none');
                // $('#enter_map').attr('href','javascript:void(0)');
                localStorage.removeItem('_u_t');
            }
        })
    </script>
@endsection
