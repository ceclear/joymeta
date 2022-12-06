<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
    <style>
        html,
        body,
        #container {
            width: 100%;
            height: 100%;
        }


    </style>
    <title>地图级别与中心点</title>
</head>

<body>
<div id="container"></div>
<div id="panel"></div>
<script type="text/javascript">
    window._AMapSecurityConfig = {
        securityJsCode:'e33af5c2830fbce26dbdbd104c92ca7e',
    }
</script>
<script src="https://webapi.amap.com/maps?v=2.0&key=d6f94d44e51953776c207b1198d01e1d&plugin=AMap.Scale,AMap.HawkEye,AMap.ToolBar,AMap.ControlBar"></script>

<script>

    //初始化地图
    var map = new AMap.Map('container', {
        zoom: 4.85, //初始地图级别
        viewMode:'3D', //开启3D视图,默认为关闭
        center: [104.384668,39.071464], //初始地图中心点
    });

    //工具添加
    var scale = new AMap.Scale(),
        toolBar = new AMap.ToolBar({
            position: {
                bottom: '30px',
                right: '40px'
            }
        }),
        controlBar = new AMap.ControlBar({
            position: {
                bottom: '110px',
                right: '10px',
            }
        });

    map.addControl(scale);
    map.addControl(toolBar);
    map.addControl(controlBar);
    //创建点标记
    // 创建两个点标记
    var m1 = new AMap.Marker({
        position: [116.49, 39.9]
    });
    var m2 = new AMap.Marker({
        position: [100.29, 39.9]
    });
    map.add(m1);
    map.add(m2);

    var lnglat = new AMap.LngLat(116.49,39.9);
    var marker = new AMap.Marker({position: lnglat, map});
    marker.on('click', function(){
        console.log(111)
    });

    //搜索


</script>
<div class="iptbox active" style="display: none">
    <input type="text" id="searchipt" placeholder="搜索位置" maxlength="256"  autocomplete="off"  class="active">

    <div id="searchbtn" class="usel">
        <i class="iconfont icon-search searchlogo icontip" style="display: block;"></i>

        <span id="searchloading" class="ring" style="display: none;"></span>
    </div>
</div>
</body>
<style>
    .iptbox {
        position: absolute;
        left: 50px;
        top: 35px;
        width: 265px;
        height: 45px;
        box-sizing: border-box;
        z-index: 2202;
        border-radius: 2px;
    }
    #searchipt {
        position: absolute;
        top: 12.5px;
        left: 0;
        z-index: 2200;
        border: none;
        width: 219px;
        padding: 0;
        letter-spacing: .5px;
        font-size: 14px;
    }
     #searchbtn {
        position: absolute;
        right: 0;
        top: 0;
        z-index: 9308;
        box-sizing: border-box;
        width: 45px;
        height: 45px;
    }
    .searchlogo {
        position: absolute;
        top: 8.5px;
        right: 8px;
        font-size: 19px;
        color: #7c8196;
        padding: 0 5px;
    }
    #panel {
        position: absolute;
        background-color: white;
        max-height: 90%;
        overflow-y: auto;
        top: 100px;
        right: 10px;
        width: 280px;
    }

</style>
</html>
