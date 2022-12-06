@extends("layouts.main")
@section('title','数字乡村基底平台-合作咨询')
@section('description','合作咨询')
@section('keywords','合作咨询')
@section("content")
    <style>
        .layui-layer-btn0 {
            min-width: 160px;
            height: 40px !important;
            line-height: 40px !important;
            border-radius: 2px !important;
        }
    </style>
    <script>
        var _layer;
        layui.use(['layer'], function () {
            _layer = layui.layer;
            _layer.open({
                type: 1
                , title: false //不显示标题栏
                , closeBtn: false
                , area: '800px;'
                , anim: 5
                , shade: 0.8
                , id: 'LAY_layuipro' //设定一个id，防止重复弹出
                , btn: ['立即提交']
                , btnAlign: 'c'
                , moveType: 1 //拖拽模式，0或者1
                , content: '<div style="padding: 20px; line-height: 22px;  color: #1F1F1F; font-weight: 300;">' +
                    '<div style="text-align: center;font-size: 30px;color: #2980B9;margin: 20px">合作咨询</div>' +
                    '<div class="panel panel-default" style="border:none;-webkit-box-shadow:none">' +
                    '<ul class="list-group text-center">' +
                    '<li class="list-group-item" style="border:none;text-align: left"><label>请输入姓名<span style="color: red">*</span></label></li>' +
                    '<li class="list-group-item" style="border:none"><input data-tip="请填写姓名" class="form-control input-lg" type="text"></li>' +
                    '<li class="list-group-item" style="border:none;text-align: left"><label>请输入手机号</label><span style="color: red">*</span></li>' +
                    '<li class="list-group-item" style="border:none"><input data-tip="请填写手机号" class="form-control input-lg" type="text"></li>' +
                    '<li class="list-group-item" style="border:none;text-align: left"><label>请输入企业/组织名称</label><span style="color: red">*</span></li>' +
                    '<li class="list-group-item" style="border:none"><input data-tip="请填写企业/组织名称" class="form-control input-lg" type="text"></li>' +
                    '<li class="list-group-item" style="border:none;text-align: center"><label>欢迎扫码</label></li>' +
                    '<li class="list-group-item" style="border:none"><img width="250px" height="250px" src="/contact.jpg"></li>' +
                    '</ul>' +
                    '</div>' +
                    '</div>'

                , yes: function (index, layero) {
                    var inputs = $("input");
                    var flag = true;
                    inputs.each(function (i) {
                        var obj = $(inputs[i]);
                        if (obj.val() == '') {
                            obj.focus();
                            _layer.msg(obj.data('tip'));
                            flag = false;
                            return false;
                        }
                    })
                    if(flag){
                        _layer.msg('感谢您填写咨询信息，我们将在第一时间由专业顾问与您联系',{time:1500});
                        setTimeout(function (){
                            // _layer.close(index);
                            window.location.href='/'
                        },1500)

                    }
                }
            });
        });


    </script>
@endsection
