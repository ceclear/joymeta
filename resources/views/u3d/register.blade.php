@extends("layouts.main")
@section('title','数字乡村基底平台-注册')
@section('description','数字乡村基底平台')
@section('keywords','数字乡村基底平台')
@section("content")
    <section id="prices-section" class="page" style="padding:162px 0">

        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                    <h2>账号注册</h2>
                    <div class="devider"></div>
                    <p class="subtitle">注册享受更多</p>
                </div>
            </div>
        </div>
        <!-- End page header-->

        <div class="extra-space-l"></div>

        <!-- Begin prices -->
        <div class="prices">
            <div class="container">
                <div class="row">

                    <div style="width: 100%" class="price-box col-sm-6 col-md-3 wow flipInY" data-wow-delay="0.3s">
                        <div class="panel panel-default" style="width: 560px;margin:auto;-webkit-box-shadow:none">
                            <input type="hidden" id="client" value="">
                            <ul class="list-group text-center">
                                <li class="list-group-item">
                                    <i class="layui-icon layui-icon-username" style="width: 24px;height: 24px;color:#909399;position: absolute;top:21px;left: 20px"></i>
                                    <input class="form-control input-lg" data-tag="username" style="padding-left: 40px"
                                           id="username" type="text" placeholder="请输入账号" autocomplete="off">
                                    {{--                                    <span class="err_span"></span>--}}
                                </li>
                                {{--                                <li class="list-group-item">--}}
                                {{--                                    <input class="form-control input-lg" id="mobile" maxlength="11" type="text"--}}
                                {{--                                           placeholder="请输入手机号">--}}
                                {{--                                </li>--}}
                                <li class="list-group-item">
                                    <i class="layui-icon layui-icon-password" style="width: 24px;height: 24px;color:#909399;position: absolute;top:21px;left: 20px"></i>
                                    <input class="form-control input-lg" data-tag="password"
                                           id="password" type="password" style="padding-left: 40px"
                                           placeholder="请输入登录密码">
                                    {{--                                    <span class="err_span"></span>--}}
                                </li>

                                <li class="list-group-item" style="height: 70px">
                                    <div style="width: 100%;float: left;">
                                        <i class="layui-icon layui-icon-auz" style="width: 24px;height: 24px;color:#909399;position: absolute;top:21px;left: 20px"></i>
                                        <input class="form-control input-lg" style="padding-left: 40px"
                                               data-tag="captcha_code" id="captcha_code" maxlength="4" type="text"

                                               placeholder="请输入图形验证码">
                                        {{--                                        <span class="err_span"></span>--}}
                                    </div>
                                    <div
                                        style="position: absolute; right: 26px;margin-top: 4px">
                                        <a style="cursor: pointer" onclick="getCaptcha()"><img id="captcha" src=""></a>
                                    </div>
                                </li>
                                {{--                                <li class="list-group-item">--}}
                                {{--                                    <input class="form-control input-lg" id="mobile_code" type="text" placeholder="请输入手机短信验证码">--}}
                                {{--                                </li>--}}
                            </ul>
                            {{--                            <div id="post_err" style="margin-top: 12px;text-align: center;color: red"></div>--}}
                            <div class="panel-footer text-center" style="background-color:transparent;border-top: none">
                                <a href="javascript:void(0);" id="btn_submit"
                                   style="padding: 10px 46px;border-radius: 2px !important;" class="btn btn-default"
                                >立即注册</a>
                            </div>
                            <div class="panel-footer text-center"
                                 style="background-color:transparent;border-top: none;padding-top: 0px">
                                <a style="cursor: pointer;text-decoration: none" href="{{route('u3d-login')}}">登录</a>
                            </div>
                        </div>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>
        <!-- End prices -->
    </section>
    <style>
        .input-lg {
            font-size: 14px;
            float: left;
            /*width: 260px;*/
        }

        ul > li {
            height: 77px;
        }

        .err_span {
            width: 200px;
            float: left;
            height: 25px;
            line-height: 25px;
            padding-left: 6px;
            text-align: left;
            color: red;
        }
    </style>
    <script>
        getCaptcha();
        var ll;
        var flag = false;
        layui.use(['layer'], function () {
            ll = layui.layer;
        });

        function getCaptcha() {
            // return;
            $.get('/api/captcha/index', function (data) {
                $('#captcha').attr('src', data.data.captcha);
                $('#client').val(data.data.client);
            })
        }

        function checkCode(obj) {
            var v = $(obj).val();
            if (v.length == 4) {
                var client = $('#client').val();
                var code = $('#captcha_code').val();
                $.get('api/captcha/validate?client=' + client + "&code=" + code, function (res) {
                    $('#captcha_code').next().html('');
                    if (res.status != 10000) {
                        flag = true;
                    } else {
                        flag = false;
                        $('#captcha_code').next().html(res.msg);
                    }
                })
            }
            return;
        }

        function checkUser(obj) {
            var pname = $(obj).data('tag');
            var val = $(obj).val();
            if (!val) {
                flag = false;
                return;
            }
            $(obj).next().html('');
            $('#post_err').html('')
            $.get('/api/user/u3d-reg-check?' + pname + '=' + val, function (data) {
                if (data.data.err_msg != '') {
                    $(obj).next().html(data.data.err_msg)
                    flag = false;
                    // $(obj).focus();
                } else {
                    flag = true;
                }
            })
        }

        $(function () {
            $(window).keydown(function (e){
                if(e.keyCode==13){
                    $('#btn_submit').click();
                }
            })
            $('#btn_submit').click(function () {
                // var ee = document.getElementsByClassName('err_span');
                // var bb = document.getElementsByClassName('input-lg');
                // for (var i = 0; i < ee.length; i++) {
                //     if (bb[i].value == '' || ee[i].innerHTML != '') {
                //         if (bb[i].value == '') {
                //             $('#post_err').html('请完善注册信息');
                //         }
                //         flag = false;
                //         return;
                //     }
                // }

                var username = $('#username').val();
                var password = $('#password').val();
                var code = $('#captcha_code').val();
                var client = $('#client').val();
                if (username == '') {
                    ll.msg('请输入账号');
                    return;
                }
                if (password == '') {
                    ll.msg('请输入密码');
                    return;
                }
                if (code == '') {
                    ll.msg('请输入验证码');
                    return;
                }
                ll.load(2);
                $.post('/api/user/register', {
                    username: username,
                    password: password,
                    captcha: code,
                    client: client
                }, function (rel) {
                    console.log(rel)
                    ll.closeAll('loading');
                    if (rel.status == 0) {
                        localStorage.setItem('_u_t', rel.data.token);
                        window.location.href = '/'
                    } else {
                        ll.msg(rel.msg);
                        getCaptcha();
                        // $('#post_err').html('注册失败');
                    }
                })


            })
        })
    </script>
@endsection

