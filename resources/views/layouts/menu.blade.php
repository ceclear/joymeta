<header id="header" class="header-main">

    <!-- Begin Navbar -->
    <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->

        <div class="container" style="width:100%">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="margin-left: 200px;margin-top:10px" class="navbar-brand page-scroll" href="/"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="" href="/">数字乡村基底</a></li>
                    {{--                    <li><a class="page-scroll" href="/#about-section">关于我们</a></li>--}}
                    <li><a class="" href="javascript:void(0);">关于我们</a></li>
                    <li><a class="" href="javascript:void(0);">校企合作</a></li>
                    <li><a class="" href="javascript:void(0);">教程</a></li>
                    <li><a class="" href="javascript:void(0);">演示申请</a></li>
                    {{--                    <li><a class="page-scroll" href="/#contact-section">联系我们</a></li>--}}
                    <li><a class="" href="javascript:void(0);">联系我们</a>

                    </li>
                    <li><a>|</a></li>
                    <li id="reg"><a href="{{route('u3d-login')}}">登录/注册</a></li>
                    <li id="profile" class="has-menu">
                        <a href="javascript:void(0);">
                            <i class="layui-icon layui-icon-username"
                               style="width: 24px;height: 24px;color:#909399;position: absolute;top:23px;left: -22px"></i>
                            个人中心
                        </a>
                        <ul class="dropdown" style="display: none">
                            <li><a class="logout" href="javascript:void(0);">退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
    <!-- End Navbar -->
    <style>
        .navbar-nav > li {
            margin-right: 50px;
        }

        #profile {
            display: none;
        }

        .navbar-right li > ul.dropdown {
            position: absolute;
            left: 0;
            top: 100%;
            z-index: 999;
            min-width: 130px;
            white-space: nowrap;
            background: #363940;
            -webkit-box-shadow: 0px 13px 25px -12px rgba(0, 0, 0, 0.25);
            -moz-box-shadow: 0px 13px 25px -12px rgba(0, 0, 0, 0.25);
            box-shadow: 0px 13px 25px -12px rgba(0, 0, 0, 0.25);
        }

        .navbar-right li > ul.dropdown li {
            display: block;
            border-bottom: 1px solid #5f5f5f;
            text-align: left;
            margin-top: 2px;
        }

        .navbar-right ul.dropdown li:first-child > a {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-right li > ul.dropdown li:last-child {
            border: none;
        }

        .navbar-right ul.dropdown li a {
            width: 100%;
            background: none;
            padding: 0 0 0 15px;
            line-height: 40px;
            font-weight: 600;
            font-size: 12px;
            color: #ffffff;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            clear: both;
            position: relative;
            outline: 0;
            z-index: 1;
            transition-delay: 0.1s;
            -o-transition: all .3s linear;
            -moz-transition: all .3s linear;
            -webkit-transition: all .3s linear;
            transition: all .3s linear;
        }

        .navbar-right ul.dropdown li a:hover {
            color: #777777;
        }

        .layui-layer-btn0{
            border-color: #333333 !important;
            background-color: #333333 !important;
            margin-right: 40px !important;
        }
        .layui-layer-page{
            border-radius: 4px !important;
        }

    </style>
    <script src="js/common.js"></script>
    <script>
        var _layer;
        layui.use(['layer'], function () {
            _layer = layui.layer;
        });
        $(function () {

            $(".navbar-right .has-menu").bind("mouseenter", function () {
                $(this).find(">ul").stop().slideDown('medium', null)
            }).bind("mouseleave", function () {
                $(this).find(">ul").stop().slideUp('medium', null)
            });

            var _t = localStorage.getItem('_u_t');
            var data, signData = {}
            var _s = getSign(signData)
            if (_t) {
                $.ajax({
                    url: '{{route('user-main')}}',
                    headers: setHeader(_t, _s),
                    type: 'get',
                    data: data,
                    dataType: 'json',
                    timeout: 2000,
                    success: function (rel) {
                        if (rel.status == 0) {
                            $('#reg').css('display', 'none');
                            $('#profile').css('display', 'block');
                            {{--$('#enter_map').attr('href', '{{route('u3d-map')}}');--}}
                        }
                    },
                    error: function () {

                    },
                    complete: function () {

                    }

                });

            }

            $('.logout').bind('click', function () {
                if (_t) {
                    layer.open({
                        type: 1
                        ,title: false //不显示标题栏
                        ,closeBtn: false
                        ,area: ['430px','120px']
                        ,shade: 0.5
                        ,id: 'logout' //设定一个id，防止重复弹出
                        ,btn: ['确认', '取消']
                        ,btnAlign: 'c'
                        ,moveType: 1 //拖拽模式，0或者1
                        ,content: '<div style="font-weight: 300;text-align: center;height: 64px;line-height: 64px">确定退出当前账号吗？</div>'
                        ,success: function(layero){

                            var btn = layero.find('.layui-layer-btn');
                            btn.find('.layui-layer-btn0').click(function (){
                                $.ajax({
                                    url: '{{route('user-logout')}}',
                                    headers: setHeader(_t, _s),
                                    type: 'post',
                                    data: data,
                                    dataType: 'json',
                                    timeout: 2000,
                                    success: function (rel) {
                                        if (rel.status == 0) {
                                            localStorage.removeItem('_u_t');
                                            $('#reg').css('display', 'block');
                                            $('#profile').css('display', 'none');
                                        }
                                    },
                                    error: function () {

                                    },
                                    complete: function () {

                                    }

                                });
                            });


                        }
                    });

                }

            });
        })
    </script>
</header>

