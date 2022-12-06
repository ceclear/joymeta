<!doctype html>
<html lang="zh-CN">
<head>
    <title>数字乡村基底平台-编辑</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="https://www.layuicdn.com/layui-v2.5.5/css/layui.css" media="all">
    <script src="https://www.layuicdn.com/layui-v2.5.5/layui.js"></script>
    <script src="js/common.js"></script>
</head>
<body>
@if(empty($error))
    <div class="layui-form layuimini-form" style="margin:10px 20px 0 0 ">
        <?= \Form::getInstance()->input_submit('确认保存', 'class="layui-btn" lay-submit lay-filter="saveBtn"', 'class="layui-btn layui-btn-primary"')->create() ?>
    </div>
@else
    <div>
        <script>
            layui.use(['layer'], function () {
                var layer = layui.layer;
                layer.alert('{{$error}}', function () {
                    layer.closeAll();
                });
            });

        </script>
    </div>
@endif
{{--<div> <img src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/u66.png"></div>--}}

@if(empty($error))
    <script>
        // var tt = localStorage.getItem('tt');
        // console.log(22,tt)
        layui.use(['layer', 'upload', 'element', 'form'], function () {

            var layer = layui.layer,
                form = layui.form,
                $ = layui.$;

            function generateRdStr() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (var i = 0; i < 10; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                return text;
            }

            var upload = layui.upload,
                element = layui.element;
            $("input[input_type='file']").parent().append("<ul class='upload_box' style='overflow:hidden;_zoom:1;padding-left:0px;'></ul>");
            $('ul.upload_box').each(function (i) {
                $('ul.upload_box').eq(i).append($('ul.upload_box').eq(i).siblings("input[input_type='file']"));
            });
            $("input[input_type='file']").wrap("<li  style='width: 150px;height: 150px;background: #EFEFEF;float:  left;overflow:hidden;border: 4px dashed #ddd;margin-right: 10px; position: relative;margin-bottom: 10px;'></li>")
            $('ul.upload_box li').each(function (i) {
                var upload_item = $('ul.upload_box li').eq(i),
                    id_name = generateRdStr();
                upload_item.attr('id', id_name);
                upload_item.append("<div class='add' style='font-size: 80px; color: #CCCCCC;width: 100%;text-align: center;line-height: 150px;position: relative;z-index: 1'>+</div>")
                upload_item.append("<div class='preview' style='width: 100%;height: 100%;position: absolute;z-index: 2;top: 0px;'></div>")
                upload_item.append("<div class='layui-progress' lay-showPercent='yes' style='position: relative;z-index: 3;bottom: 16px;' lay-filter='" + id_name + "_process' >"
                    + "<div class='layui-progress-bar' lay-percent='0%'></div>"
                    + "</div>");
                upload_item.append("<div class='remove'  style='z-index:3;position: absolute;width: 14px;height: 14px;line-height:14px;text-align:center;background: #E9523F;color:#fff;overflow:hidden;border-radius:5px;right: 0px;top: 17px;'>X</div>");
                $('#' + id_name + ' .remove').hide();
                $('#' + id_name + ' .preview').hide();
                $('#' + id_name + ' .layui-progress').hide();
                $('#' + id_name + ' .remove').on('click', function () {
                    $('#' + id_name + ' .remove').hide();
                    $('#' + id_name + ' .preview').hide();
                    $('#' + id_name + ' .layui-progress').hide();
                    $('#' + id_name + ' .layui-progress').find('.layui-progress-bar').removeClass('layui-bg-red');
                })
                var init_val = $('#' + id_name).find("input[type='text']").hide().val() || '';
                if (init_val.length > 0) {
                    $('#' + id_name + ' .remove').show();
                    $('#' + id_name + ' .preview').css({
                        'background': 'url(' + init_val + ')',
                        'background-repeat': 'no-repeat',
                        'background-size': '100% 100%',
                    }).show();
                }
                var uploadIns = upload.render({
                    elem: '#' + id_name + ' .add'
                    ,
                    url: '/api/upload/servicePutFile'
                    ,
                    field: 'file'
                    ,
                    data: {token: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJzaGEyNTYifQ==.eyJpc3MiOiJLZW5ueSBIdSBKV1QiLCJpYXQiOjE2NjM2NjMwMDQsImV4cCI6MTc1Njk3NTAwNCwiYXVkIjoiaHR0cDpcL1wveGlhbmd5b3UudGVzdCIsInN1YiI6IkFsbCBKV1QiLCJ1aWQiOjEwMDEyN30=.cb1ddf8c63ef614e38806945f592428f7926d2b6b17b82f064a17d57b277e24e'}
                    ,
                    method: 'post'
                    ,
                    before: function (obj) {

                    }
                    ,
                    choose: function (obj) {
                        $('#' + id_name + ' .remove').show();
                        $('#' + id_name + ' .layui-progress').show();
                        obj.preview(function (index, file, result) {
                            $('#' + id_name + ' .preview').css({
                                'background': 'url(' + result + ')',
                                'background-repeat': 'no-repeat',
                                'background-size': '100% 100%',
                            }).show();
                        });
                    }
                    ,
                    progress: function (n, elem) {
                        var percent = n + '%' //获取进度百分比
                        element.progress(id_name + '_process', percent); //可配合 layui 进度条元素使用
                    }
                    ,
                    done: function (res) {
                        if (res.code != 0) {
                            layer.alert(res.msg || '上传失败')
                        } else {
                            $('#' + id_name).find("input[type='text']").attr({value: res.data.url || ''});
                            // layer.msg(res.msg || '上传成功', {
                            //     icon: 1,
                            //     time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            // });
                        }
                    }
                    ,
                    error: function () {
                        layer.alert('上传失败')
                        $('#' + id_name + ' .layui-progress').find('.layui-progress-bar').addClass('layui-bg-red');
                    }
                });
            })

            //自定义验证规则
            // form.verify({
            //     此’title‘替换’required‘即可
            //     title: function (value) {
            //         if (value.length < 5) {
            //             return '标题至少得5个字符啊';
            //         }
            //     }
            //     , pass: [
            //         /^[\S]{6,12}$/
            //         , '密码必须6到12位，且不能出现空格'
            //     ]
            //     , content: function (value) {
            //         layedit.sync(editIndex);
            //     }
            // });
            //监听提交

            form.on('submit(saveBtn)', function (data) {
                layer.load();
                // setTimeout(function(){
                //     layer.closeAll('loading');
                // }, 2000);
                // layer.alert(JSON.stringify(data.field), {
                //     title: '最终的提交信息'
                // })

                layer.confirm('确定保存吗?', {icon: 3, title: '提示'}, function (index) {
                    layer.close(index);

                    var _t = '{{$_tt}}';
                    var _data = JSON.parse(JSON.stringify(data.field));
                    var _s = getSign(data.field)
                    $.ajax({
                        url: data.form.action,
                        type: 'post',
                        data: _data,
                        headers: setHeader(_t, _s),
                        dataType: 'json',
                        timeout: 5000,
                        success: function (res) {
                            if (res.status == 0) {
                                layer.msg(res.msg || '提交成功');
                                setTimeout(function () {
                                    parent.window.location.reload();
                                }, 2000)
                            } else {
                                layer.msg(res.msg)
                            }
                        },
                        error: function () {
                            layer.msg('网络错误')
                        },
                        complete: function () {
                            layer.closeAll('loading');
                        }
                    })

                }, function () {
                    layer.closeAll('loading');
                });

                return false;

                $.post(
                    data.form.action,
                    data.field,
                    function (res) {
                        layer.closeAll('loading');
                        if (res.code == 0) {
                            // layer.alert(res.msg || '提交成功')
                            layer.msg(res.msg || '提交成功');
                            setTimeout(function () {
                                parent.window.location.reload();
                            }, 2000)
                        } else {
                            layer.msg(res.msg);
                            // layer.msg(res.msg, {
                            //     icon: 1,
                            //     time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            // }, function () {
                            //     //do something
                            //     parent.window.location.reload();
                            // });
                        }
                    }
                )
                return false;
            });
        });
    </script>
@endif
@if(empty($error) && Form::getInstance()->type_in('date'))
    <script>
        layui.use(['laydate'], function () {
            var laydate = layui.laydate;
            //日期选择初始化
            laydate.render({
                elem: '[input_type=date]',
                type: 'date',
            })
        })
    </script>
@endif


</body>
</html>
