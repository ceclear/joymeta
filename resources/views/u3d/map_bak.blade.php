<style>
    .page-loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 99999;
        background: #FFF url(../img/page-loader.gif) center center no-repeat;
    }
</style>
<script src="inc/jquery/jquery-1.11.1.min.js"></script>
<div class="page-loader"></div>
<div id="container" style="display: none"></div>
<style>
    #container {
        width: 100%;
        height: 100%;
    }

    .info {
        position: relative;
        margin: 0;
        top: 0;
        right: 0;
        min-width: 0;
        padding: 0.55rem 1.25rem;
        border-radius: 0.25rem;
        background-color: white;
        width: auto;
        border-width: 0;
        box-shadow: 0 2px 6px 0 rgb(114 124 245 / 50%);
    }

    .amap-logo {
        display: none !important;
    }

    .weather {
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        position: fixed;
        top: 1rem;
        background-color: white;
        width: auto;
        min-width: 11rem;
        border-width: 0;
        right: 1rem;
        box-shadow: 0 2px 6px 0 rgb(114 124 245 / 50%);
        box-sizing: border-box;
        font-size: 12px;
        font-weight: 300;
        color: #111213;;
    }

    .amap-marker-label {
        position: absolute;
        z-index: 2;
        border: none;
        /*background-color: #fff;*/
        white-space: nowrap;
        cursor: default;
        padding: 0px;
        font-size: 12px;
        line-height: 14px;
    }
</style>
{{--<div class="weather">--}}
{{--    <img src="/dw2.png" style="width: 20px;height: 20px;vertical-align: middle">--}}
{{--    信息窗体可在地图任意位置打开--}}
{{--</div>--}}
{{--<div onclick="test()">卫星</div>--}}


<script type="text/javascript">
    window._AMapSecurityConfig = {
        securityJsCode: 'e33af5c2830fbce26dbdbd104c92ca7e',
    }
</script>
<script type="text/javascript"
        src="https://webapi.amap.com/maps?v=1.4.15&key=d6f94d44e51953776c207b1198d01e1d&plugin=AMap.Scale,AMap.HawkEye,AMap.ControlBar,AMap.MouseTool,AMap.PolyEditor"></script>
<script>
    {{--    var markers = {!! $map_arr !!};--}}
    var markers = '';
    $(function() {
        // Animate loader off screen
        $(".page-loader").fadeOut("slow",function (){
            // window.location.href='/'
            var _t=localStorage.getItem('_u_t')
            if(!_t){
                window.location.href='/';
                return;
            }else {
                $('#container').css('display','block');
                //获取地图标点集
                var token=localStorage.getItem('_u_t');
                $.get('api/village/marker?token='+token,function (rel){
                    markers=rel.data;
                    //初始化地图
                    var map = new AMap.Map('container', {
                        zoom: 5, //初始地图级别
                        viewMode: '3D', //开启3D视图,默认为关闭

                        center: [104.384668, 39.071464], //初始地图中心点
                        mapStyle: "amap://styles/412c36c8c1c23151dd5a7734225e6fd8"
                    });
                    //绘制图形
                    // var mouseTool = new AMap.MouseTool(map);


                    //工具添加
                    var scale = new AMap.Scale(),

                        controlBar = new AMap.ControlBar({
                            position: {
                                bottom: '-120px',
                                right: '10px',
                            }
                        });

                    map.addControl(scale);
                    map.addControl(controlBar);
                    //创建点标记
                    // 创建两个点标记
                    // var m1 = new AMap.Marker({
                    //     position: [116.49, 39.9],
                    //     Label:'bbbbbbbb'
                    // });
                    // var m2 = new AMap.Marker({
                    //     position: [100.29, 39.9],
                    //     direction:'top',
                    //     label:{content:'2222'},
                    // });
                    // map.add(m1);
                    // map.add(m2);
                    //
                    // var lnglat = new AMap.LngLat(116.49, 39.9);
                    // var marker = new AMap.Marker({position: lnglat, map});
                    // marker.on('click', function () {
                    //     console.log(111)
                    // });

                    // var markers = [{
                    //     position: [110.205467, 39.907761],
                    //     content:'南斗村'
                    // }, {
                    //     position: [116.368904, 39.913423]
                    // }, {
                    //     position: [99.305467, 39.807761]
                    // }];


                    // 创建一个 icon
                    var endIcon = new AMap.Icon({
                        size: new AMap.Size(50, 66),
                        image: '//a.amap.com/jsapi_demos/static/demo-center/icons/poi-marker-default.png',
                        // imageSize: new AMap.Size(135, 40),
                        // imageOffset: new AMap.Pixel(-95, -3)
                    });

                    // 添加一些分布不均的点到地图上,地图上添加三个点标记，作为参照
                    markers.forEach(function (marker) {
                        let aa = new AMap.Marker({
                            map: map,
                            // icon: endIcon,
                            icon: '/dw.png',
                            position: [marker.position[0], marker.position[1]],
                            // label:{content:marker.content},
                            // title:marker.content,
                            offset: new AMap.Pixel(0, 0),
                            anchor: 'bottom-center',
                        });
                        aa.on('mousemove', function () {
                            aa.setLabel({
                                direction: 'top',
                                offset: new AMap.Pixel(10, 0),  //设置文本标注偏移量
                                content: "<div class='info'>" + marker.content + "</div>", //设置文本标注内容
                            });
                        });
                        aa.on('mouseout', function () {
                            aa.setLabel({});
                        });
                        aa.on('click', function (e) {

                            // console.log(marker.content)
                            // var path = [
                            //     [118.22759, 25.60841],
                            //     [118.22760, 25.60795],
                            //     [118.22876, 25.60834],
                            //     [118.22755, 25.60833]
                            // ]
                            var path = marker.path;
                            var polygon = new AMap.Polygon({
                                path: path,
                                strokeColor: "#FFFFFF",
                                strokeWeight: 2,
                                strokeOpacity: 0.2,
                                fillOpacity: 0.1,
                                fillColor: '#1791fc',
                                zIndex: 50,
                            })

                            map.add(polygon)
                            map.setFitView([polygon])
                        });
                    });
                });


            }
        });
    });


    //天气
    // AMap.plugin('AMap.Weather', function() {
    //     //创建天气查询实例
    //     var weather = new AMap.Weather();
    //
    //     //执行实时天气信息查询
    //     weather.getForecast('北京市', function(err, data) {
    //         console.log(err, data);
    //     });
    // });
    function test() {
        console.log(111)
        var tlayer = new AMap.TileLayer.Satellite();
        tlayer.setMap(map);
    }
</script>

