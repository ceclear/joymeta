<style>
    .page-loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 99999;
        /*background: #FFF url(../img/page-loader.gif) center center no-repeat;*/
    }

    #container {
        width: 100%;
        height: 100%;
    }

    .info {
        position: relative;
        margin: 0;
        top: -4px;
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
        background: none !important;
        white-space: nowrap;
        cursor: default;
        padding: 0px;
        font-size: 12px;
        line-height: 14px;
        /*top:-35px !important;*/

    }

    .search-lable-show {
        position: absolute;
        top: 6px;
        left: 12px;
        color: white;
        cursor: pointer;
        text-align: center;
    }

    .search-lable-move-show {
        position: absolute;
        top: 44px;
        left: 35px;
        color: white;
        cursor: pointer;
    }

    .search-lable-out-show {
        position: absolute;
        top: 6px;
        left: -3px;
        color: white;
        cursor: pointer;
    }

    .layui-anim-downbit {
        width: 435px;
    }

    .layui-menu-body-title a {
        width: 435px;
        white-space: normal;
    }

    .div-show {
        width: 280px;
        position: absolute !important;
        left: 0;
        right: 0;
        top: 25px;
        z-index: 2;
        /*background-color: #f7f7f7;*/
        color: rgba(0, 0, 0, .85);
        border-radius: 4px;
        font-size: 22px;
        text-align: center;
        margin: auto;
        height: 38px;
        line-height: 38px;
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(16px);
    }

    .bottom_div {
        width: 600px;
        /*height: 80px;*/
        position: absolute;
        z-index: 2;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        /*border: 1px solid red;*/
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(16px);
        border-radius: 4px 4px 0 0;
    }

    .div_tool {
        /*border: 1px solid #1F1F1F;*/
        width: 100px;
        height: 70px;
        cursor: pointer;
        text-align: center;
        line-height: 70px;
        float: left;
        margin: 0 25px;
    }

    .div_tool img {
        width: 30px;
        height: 30px;
        padding-top: 10px;
    }

    .div_tool p {
        margin-top: -20px;
        color: #1e1d1d;
    }

    .layui-layer-btn0{
        border-color: #333333 !important;
        background-color: #333333 !important;
    }
</style>
<title>????????????????????????</title>
<link rel="stylesheet" href="layui/css/layui.css">
<script src="inc/jquery/jquery-1.11.1.min.js"></script>
<script src="js/common.js"></script>
<script src="js/map_custom.js"></script>
<script src="layui/layui.js"></script>
{{--<div class="page-loader"></div>--}}
<div class="layui-inline" style="width: 435px;position: absolute;left: 30px;top: 25px;z-index: 2">
    <input name="" placeholder="??????????????????" class="layui-input" id="demo100">
</div>
<div class="layui-inline div-show">
    ??????????????????????????????
</div>
<div class="bottom_div">
    <div class="div_tool" onclick="setDefault(this)">
        <img src="img/data1.png">
        <p>????????????</p>
    </div>
    <div class="div_tool" onclick="toggleWx(this)">
        <img src="img/wx1.png">
        <p>????????????</p>
    </div>
    <div class="div_tool" onclick="toggleLw(this)">
        <img src="img/lw1.png">
        <p>????????????</p>
    </div>
    <div class="div_tool" onclick="toggleSS(this)">
        <img src="img/ss1.png">
        <p>????????????</p>
    </div>

</div>
<div id="container" style="display: block"></div>
<style>

</style>
{{--<div class="weather">--}}
{{--    <img src="/dw2.png" style="width: 20px;height: 20px;vertical-align: middle">--}}
{{--    ??????????????????????????????????????????--}}
{{--</div>--}}
{{--<div onclick="test()">??????</div>--}}


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
    var _s_markers = '';
    var markerShow = [];
    var _dropInit;
    var ss_visible = true;
    //???????????????
    var map = new AMap.Map('container', {
        zoom: 5, //??????????????????
        viewMode: '3D', //??????3D??????,???????????????
        center: [104.384668, 34.071464], //?????????????????????
        // mapStyle: "amap://styles/412c36c8c1c23151dd5a7734225e6fd8",
        mapStyle: "amap://styles/d0487bff3bd58d49af9f4e1fa8c81cfa",
        pitch: 40
    });
    //????????????
    var scale = new AMap.Scale();
    var controlBar = new AMap.ControlBar({
        position: {
            bottom: '-120px',
            right: '10px',
        }
    });
    map.addControl(scale);
    map.addControl(controlBar);
    //??????????????????
    var trafficLayer = new AMap.TileLayer.Traffic({
        zIndex: 10,
        zooms: [7, 22],
    });
    trafficLayer.hide();
    map.add(trafficLayer)

    var _layer;

    var _t = localStorage.getItem('_u_t') ?? ''
    layui.use(['layer', 'dropdown'], function () {
        _layer = layui.layer;
        dropdown = layui.dropdown;
        _layer.load(2);

        //???????????????
        _dropInit = dropdown.render();
        // dropdown.render({
        //     elem: '#demo100'
        //     , trigger: 'keyup'
        //     , data: _dropData
        //     , click: function (item) {
        //         layer.msg(item.title);
        //     }
        // });


        // $(document).on('mouseenter', '.layui-menu-body-title', function () {
        //     var _index=$(this).find('input').eq(0).val();
        //     console.log(_index)
        //     markerShow[_index].setIcon('/dw3.png')
        //     markerShow[0].setIcon('/dw3.png')
        // });
        // $(function () {
        //     $('#demo100').bind('compositionend',function () {
        //         searchMarker($(this).val())
        //     });
        // })
        //???????????????
        $(function () {
            var _flag = true;
            $('#demo100').on('compositionstart', function () {
                _flag = false;
            });
            $('#demo100').on('compositionend', function () {
                _flag = true;
            });
            $('#demo100').on('input', function () {
                setTimeout(function () {
                    if (_flag) {
                        searchMarker($('#demo100').val());
                    }
                }, 0);
            });
        });

        initMapMarker();

    });

    //????????????
    var wx_layer = new AMap.TileLayer.Satellite();
    //????????????
    var lw_layer = new AMap.TileLayer.RoadNet();
    //????????????
    var lc_layer=new AMap.Buildings({
        zooms: [16, 18],
        zIndex: 10,
        heightFactor: 2 //2?????????????????????3D?????????
    })

    map.add(lc_layer);
    var wx_visible = true;
    var lw_visible = true;

    function toggleSS(obj) {
        if (ss_visible) {
            $(obj).find('img').attr('src','img/ss.png');
            $(obj).find('p').css('color','#e4af86');
            trafficLayer.show();
            ss_visible = false;
        } else {
            trafficLayer.hide();
            ss_visible = true;
            $(obj).find('img').attr('src','img/ss1.png');
            $(obj).find('p').css('color','#1e1d1d');
        }
    }

    function toggleWx(obj) {
        if (wx_visible) {
            map.add(wx_layer)
            wx_visible = false;
            $(obj).find('img').attr('src','img/wx.png');
            $(obj).find('p').css('color','#e4af86');
        } else {
            map.remove(wx_layer)
            wx_visible = true;
            $(obj).find('img').attr('src','img/wx1.png');
            $(obj).find('p').css('color','#1e1d1d');
        }
    }

    function toggleLw(obj) {
        if (lw_visible) {
            map.add(lw_layer)
            lw_visible = false;
            $(obj).find('img').attr('src','img/lw.png');
            $(obj).find('p').css('color','#e4af86');

        } else {
            map.remove(lw_layer)
            lw_visible = true;
            $(obj).find('img').attr('src','img/lw1.png');
            $(obj).find('p').css('color','#1e1d1d');
        }
    }

    function setDefault() {
        map.setCenter([104.384668, 34.071464])
        map.setZoom(5,true)
    }
</script>

