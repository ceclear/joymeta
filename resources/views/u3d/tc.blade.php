<style>
    .main_div {
        margin: auto;
        /*border: 1px solid red;*/
        /*height: 800px;*/
        width: 400px;
        border-radius: 6px;
    }

    .div-tc-title {
        text-align: center;
        color: #333333;
        font-family: 'Arial Negreta', 'Arial Normal', 'Arial', sans-serif;
        font-size: 21px;
        font-weight: 700;
    }

    .div-tc-h {
        color: #1e1d1d;
        padding-left: 20px;
    }

    .div-tc-h img {
        width: 20px;
        height: 20px;
        float: left;
    }

    .div-tc-fang {
        height: 70px;
        width: 42%;
        background-image: url("img/counter-bg.jpg");
        /*-moz-background-size: 100% 100%;*/
        background-size: 100% 100%;
        /*-webkit-filter: blur(2px);*/
        -moz-filter: blur(2px);
        -o-filter: blur(2px);
        -ms-filter: blur(2px);
        margin-left: 20px;
        float: left;
        cursor: pointer;
    }

    .div-tc-fang img {
        width: 35px;
        height: 35px;
        padding: 16px;
        float: left;
    }

    .div-tc-fang p {
        padding: 10px;
        color: white;
        font-family: 'Arial Normal', 'Arial', sans-serif;
        font-weight: 400;
        font-size: 13px;
    }

    .div-tc-block {
        height: 70px;
    }

    .div-tc-tip {
        float: left;
        margin-left: 20px;
        height: 20px;
        font-size: 12px;
        font-family: 'Arial Normal', 'Arial', sans-serif;
        color: #BAB1B1;
        font-weight: 400;
        width: 16%;
    }

    .div-tc-tip2 {
        float: left;
        margin-left: 19px;
        height: 20px;
        font-size: 12px;
        font-family: 'Arial Normal', 'Arial', sans-serif;
        color: #BAB1B1;
        font-weight: 400;
    }

    .div-tc-block2 {
        height: 20px;
        margin: 5px;
    }

</style>
<div class="main_div">
    <div class="div-tc-title">{{$info['name']}}</div>
    <div class="div-tc-h"><img src="img/data2.png">
        <p style="margin-left: 24px">数字乡村</p></div>
    <div class="div-tc-block">
        <div class="div-tc-fang">
            <img src="img/sz.png">
            <p>数字乡村</p>
        </div>
        <div class="div-tc-fang" onclick="showQuan()">
            <img src="img/qj.png">
            <p>360全景</p>
        </div>

    </div>
    <div class="div-tc-h"><img src="img/yx.png">
        <p style="margin-left: 24px">影像资料</p></div>
    <div class="div-tc-block">
        <div class="div-tc-fang" onclick="showPic()">
            <img src="img/tp.png">
            <p>图像资料</p>
        </div>
        <div class="div-tc-fang">
            <img src="img/yx1.png">
            <p>影像资料</p>
        </div>

    </div>

    <div class="div-tc-h"><img src="img/xm.png">
        <p style="margin-left: 24px">项目信息</p></div>
    <div class="div-tc-block2">
        <div class="div-tc-tip">乡村地址</div>
        <div class="div-tc-tip2">{{$info['address']}}</div>
    </div>
    <div class="div-tc-block2">
        <div class="div-tc-tip">乡村规划</div>
        <div class="div-tc-tip2">{{$info['plan']}}</div>
    </div>
    <div class="div-tc-block2">
        <div class="div-tc-tip">数字权属</div>
        <div class="div-tc-tip2">{{$info['ownership']}}</div>
    </div>
    <div class="div-tc-block2">
        <div class="div-tc-tip">乡村面积</div>
        <div class="div-tc-tip2">{{$info['acreage']}}</div>
    </div>
    <div class="div-tc-block2">
        <div class="div-tc-tip">乡村介绍</div>
        <div class="div-tc-tip2">{{$info['intro']}}</div>
    </div>
</div>

<div id="main_div" style="display: none;margin: auto;width: 400px;position: absolute;top: 0;left: 0;right: 0">
    <div class="div-tc-h"><img src="img/data2.png">
        <p style="margin-left: 24px">数字乡村</p></div>
    <div style="margin-top: 10px">
        <img width="400px"
             layer-src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/f7625eda5127441505adb65f808c4e86.jpg"
             src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/f7625eda5127441505adb65f808c4e86.jpg"
             alt="图片名">
    </div>
    <div style="margin-top: 10px">
        <img width="400px"
             layer-src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/1f4a52492288058e185549b0ac6a0a99.jpg"
             src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/1f4a52492288058e185549b0ac6a0a99.jpg"
             alt="adsa">
    </div>
</div>
<script src="layui/layui.js"></script>
<script src="inc/jquery/jquery-1.11.1.min.js"></script>
<script>
    var ll;
    layui.use(['layer'], function () {
        ll = layui.layer;

    });

    function showPic() {
        console.log(1)

        $.getJSON('/api/village/get-discover?vv=' + {{$info['id']}}, function (json) {
            layer.photos({
                photos: json.data
                , anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
            });
        });

    }

    function showQuan() {
        window.open("https://www.720yun.com/vr/36027qzOw4a")
    }

</script>

