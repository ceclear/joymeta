@extends("layouts.main")
@section('title','数字乡村基底平台-登录')
@section('description','数字乡村基底平台')
@section('keywords','数字乡村基底平台')
@section("content")
    <section id="prices-section" class="page" style="padding:200px 0">

        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                    <h2>账号登录</h2>
                    <div class="devider"></div>
                    <p class="subtitle">登录享受更多</p>
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
                        <div class="panel panel-default" style="width: 400px;margin:auto;-webkit-box-shadow:none">
                            <div id="post_err" style="text-align: center;color: red"></div>
                            <ul class="list-group text-center">
                                <li class="list-group-item">
                                    <i class="layui-icon layui-icon-username" style="width: 24px;height: 24px;color:#909399;position: absolute;top:21px;left: 20px"></i>
                                    <input class="form-control input-lg" style="padding-left: 40px" id="username" type="text" placeholder="请输入账号" autocomplete="off">
                                </li>
                                <li class="list-group-item">
                                    <i class="layui-icon layui-icon-password" style="width: 24px;height: 24px;color:#909399;position: absolute;top:21px;left: 20px"></i>
                                    <input class="form-control input-lg" id="password" style="padding-left: 40px" type="password" placeholder="请输入登录密码">
                                </li>

                                <li class="list-group-item" style="float: right">
                                    <a style="cursor: pointer;text-decoration: none">忘记密码?</a>
                                </li>

                            </ul>
                            <div class="panel-footer text-center" style="background-color:transparent;border-top: none;margin-top:20px">
                                <a style="padding: 10px 46px;border-radius: 2px !important;" class="btn btn-default" id="btn_submit">登录</a>
                            </div>
                            <div class="panel-footer text-center" style="background-color:transparent;border-top: none;padding-top:0px">
                                <a style="cursor: pointer;text-decoration: none"  href="{{route('u3d-register')}}">注册</a>
                            </div>
                        </div>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>
        <!-- End prices -->
    </section>
    <style>
        .input-lg{
            font-size: 14px;
        }
    </style>
    <script>
        layui.use(['layer'], function () {
            ll = layui.layer;
        });
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
                if (username == '') {
                    ll.msg('请输入账号');
                    return;
                }
                if (password == '') {
                    ll.msg('请输入密码');
                    return;
                }

                ll.load(2);
                $.ajax({
                    url: 'api/user/login_pass',
                    type: 'post',
                    data: {username:username,password:password},
                    dataType: 'json',
                    timeout: 2000,
                    success:function (rel){
                        ll.closeAll('loading');
                        if (rel.status == 0) {
                            localStorage.setItem('_u_t', rel.data.token);
                            window.location.href = '/'
                        } else {
                            ll.msg(rel.msg);
                            // $('#post_err').html('注册失败');
                        }
                    },
                    error:function (){
                        ll.closeAll('loading');
                        ll.msg('网络错误,稍后再试');
                    },
                    complete:function (){
                        ll.closeAll('loading');
                    }
                });
                // $.post('/api/user/login_pass', {
                //     username: username,
                //     password: password
                // }, function (rel) {
                //     console.log(rel)
                //     ll.closeAll('loading');
                //     if (rel.status == 0) {
                //         localStorage.setItem('_u_t', rel.data.token);
                //         window.location.href = '/'
                //     } else {
                //         ll.msg(rel.msg);
                //         // $('#post_err').html('注册失败');
                //     }
                // })


            })
        })
    </script>
@endsection
