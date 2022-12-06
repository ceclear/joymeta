var _dropData1 = [
    {
        title: 'menu item 2'
        ,
        templet: '<img src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/u66.png" style="width: 160px;float: right;margin-top: 24px"> <p style="color: black;font-size: 14px;font-weight: 700;">1.十多个大范甘迪饭盒放国际化</p>南斗村位于福建德化县国宝乡中部略偏东北，与佛岭、上洋、祥云、内坂和厚德村毗邻。 '
        ,
        id: 101
        ,
        href: '#'
    },
    {type: '-'}, //分割线
    {
        title: 'menu item 2'
        ,
        templet: '<img src="https://xy-pub.oss-cn-shenzhen.aliyuncs.com/adm_images/u66.png" style="width: 160px;float: right"> 位于福建德化县国宝乡中部略偏东北，与佛岭、上洋、祥云、内坂和厚德村毗邻。 '
        ,
        id: 101
        ,
        href: '#'
    }
];

var _inputFlag = false;
function searchMarker(kk) {
    if (!_inputFlag &&( kk.trim() == '' || kk == 'undefined')) {
        return;
    }
    _inputFlag = true;
    var data = {_k: kk}
    var signData = {_k: kk}
    var _s = getSign(signData)
    var _dropData = [
        {
            title: 'menu item 2'
            ,
            templet: '暂无对应村庄'
            ,
            id: -1
            ,
            href: 'javascript:void(0)'

        }
    ];
    map.remove(markerShow);
    markerShow = [];
    $.ajax({
        url: 'api/village/marker',
        headers: setHeader(_t, _s),
        type: 'get',
        data: data,
        dataType: 'json',
        timeout: 2000,
        success: function (rel) {
            // var _dropData=[];

            var _data = rel.data;
            if (rel.status == 0) {
                if (_data && _data.length > 0) {
                    _dropData = dropDataAdd(_data);
                }
                _s_markers = rel.data;
                // 添加一些分布不均的点到地图上,地图上添加三个点标记，作为参照
                var num = 0;
                _s_markers.forEach(function (marker) {
                    num++;

                    var _lab = "<div class='search-lable-show'>" + num + "</div>";
                    var _m_show = "<div class='search-lable-move-show'>" + num + "</div>";
                    var _o_show = "<div class='search-lable-out-show'>" + num + "</div>";
                    let aa = new AMap.Marker({
                        map: map,
                        // icon: endIcon,
                        icon: '/dw.png',
                        position: [marker.position[0], marker.position[1]],
                        // label: {content: marker.id},
                        label: {content: _lab},
                        // title:marker.content,
                        // clickable:false,
                        offset: new AMap.Pixel(0, 0),
                        anchor: 'bottom-center',
                    });
                    markerShow.push(aa)
                    aa.on('mousemove', function () {
                        aa.setLabel({
                            direction: 'top',
                            // label:{content:_lab},
                            offset: new AMap.Pixel(0, 0),  //设置文本标注偏移量
                            content: "<div class='info'>" + marker.content + _m_show + "</div>", //设置文本标注内容
                        });
                    });
                    aa.on('mouseout', function () {
                        aa.setLabel({
                            content: "<div>" + _o_show + "</div>",
                        });
                    });
                    var flag = true;
                    var first = false;
                    //地图缩放事件
                    map.on('zoomend', function () {
                        if (first) {
                            first = false;
                            return;
                        }
                        flag = true;
                    });

                    aa.on('click', function (e) {
                        console.log(flag, 3)
                        if (flag) {
                            // var path = [
                            //     [118.22759, 25.60841],
                            //     [118.22760, 25.60795],
                            //     [118.22876, 25.60834],
                            //     [118.22755, 25.60833]
                            // ]
                            var path = marker.path;
                            var polygon = new AMap.Polygon({
                                path: path,
                                strokeColor: "#2b8cbe",
                                strokeWeight: 2,
                                strokeOpacity: 1,
                                fillOpacity: 0.1,
                                fillColor: '#ccebc5',
                                zIndex: 50,
                            });
                            polygon.on('mouseover', () => {
                                polygon.setOptions({
                                    fillOpacity: 0.7,
                                    fillColor: '#7bccc4'
                                })
                            })
                            polygon.on('mouseout', () => {
                                polygon.setOptions({
                                    fillOpacity: 0.5,
                                    fillColor: '#ccebc5'

                                })
                            })

                            map.add(polygon)
                            map.setZoom(14.8)
                            map.setCenter(marker.position)
                            // map.setFitView([polygon])//换setCenter方式
                            flag = false;
                            first = true;
                        } else {
                            first = false;
                            var _btnTxt = '进入' + marker.content;
                            _layer.open({
                                type: 2,
                                title: false,
                                btn: [_btnTxt],
                                btnAlign: 'c',
                                area: ['430px','600px'],
                                moveType: 1,
                                shade: 0.5,
                                content:['/tc?vv='+marker.id,'no'],
                                yes: function () {
                                    flag = true;
                                    if(marker.domain==''){
                                        _layer.msg('当前村庄未配置域名');
                                        return false;
                                    }
                                    // window.location.href = 'http://'+marker.domain+'.joy-meta.com?_v='+marker.id+'&token=' + _t;
                                    var _datas, _signDatas = {}
                                    var _ss = getSign(_signDatas)
                                    if (_t) {
                                        _layer.load(2);
                                        $.ajax({
                                            url: 'api/user/main',
                                            headers: setHeader(_t, _ss),
                                            type: 'get',
                                            data: _datas,
                                            dataType: 'json',
                                            timeout: 2000,
                                            success: function (rel) {
                                                if (rel.status == 0) {
                                                    window.location.href = 'http://'+marker.domain+'.joy-meta.com?_v='+marker.id+'&token=' + _t;
                                                }else {
                                                    _layer.msg('请登录进入',function (){
                                                        window.location.href='https://www.joy-meta.com/login';
                                                    });
                                                }
                                            },
                                            error: function () {

                                            },
                                            complete: function () {
                                                _layer.closeAll('loading');
                                            }

                                        });

                                    }else {
                                        _layer.msg('请登录进入',function (){
                                            window.location.href='https://www.joy-meta.com/login';
                                        });
                                    }
                                },

                            })
                        }

                    });
                });


                // $(document).on('mouseenter', '.layui-menu-body-title', function () {
                //     var _index=$(this).find('input').eq(0).val();
                //     console.log(_index)
                //     markerShow[_index].setIcon('/dw3.png')
                //     markerShow[0].setIcon('/dw3.png')
                // });

            } else {

                setTimeout(function () {
                    _layer.msg(rel.msg);
                }, 1600)
                // if (rel.status == 100007) {
                //     setTimeout(function () {
                //         localStorage.removeItem('_u_t');
                //         window.location.href = '/'
                //     }, 1600)
                // }
            }
        },
        error: function () {

            _dropInit.reload({
                elem: '#demo100',
                data: _dropData,
                show: true,
                click: function (item) {
                    clickSearch(item)
                }
            });

        },
        complete: function () {
            _dropInit.reload({
                elem: '#demo100',
                data: _dropData,
                show: true,
                click: function (item) {
                    clickSearch(item)
                }
            });
            //绑定事件
            $('.layui-menu-body-title').bind('mouseenter', function () {
                if (markerShow && markerShow.length > 0) {
                    var _index = $(this).find('input').eq(0).val();
                    setTimeout(function () {
                        markerShow[_index].setIcon('/dw3.png')
                    }, 100)

                }

            });
            $('.layui-menu-body-title').bind('mouseover', function () {
                if (markerShow && markerShow.length > 0) {
                    for (var m in markerShow) {
                        markerShow[m].setIcon('/dw.png');
                    }
                }
            })
        }

    });
}


function initMapMarker() {
    var data = {}
    var signData = {}
    var _s = getSign(signData)
    // return;
    $.ajax({
        url: 'api/village/marker',
        headers: setHeader(_t, _s),
        type: 'get',
        data: data,
        dataType: 'json',
        timeout: 10000,
        success: function (rel) {
            // $('#container').css('display', 'block');

            _layer.closeAll('loading');
            if (rel.status == 0) {
                _layer.closeAll('loading');
                markers = rel.data;
                // 添加一些分布不均的点到地图上,地图上添加点标记，作为参照
                markers.forEach(function (marker) {
                    let aa = new AMap.Marker({
                        map: map,
                        // icon: endIcon,
                        icon: '/dw.png',
                        position: [marker.position[0], marker.position[1]],
                        // label:{content:marker.content},
                        // title:marker.content,
                        // clickable:false,
                        offset: new AMap.Pixel(0, 0),
                        anchor: 'bottom-center',
                    });
                    markerShow.push(aa)

                    aa.on('mousemove', function () {
                        aa.setLabel({
                            direction: 'top',
                            offset: new AMap.Pixel(0, 0),  //设置文本标注偏移量
                            content: "<div class='info'>" + marker.content + "</div>", //设置文本标注内容
                        });
                    });
                    aa.on('mouseout', function () {
                        aa.setLabel({});
                    });
                    var flag = true;
                    var first = false;
                    //地图缩放事件
                    map.on('zoomend', function () {
                        if (first) {
                            first = false;
                            return;
                        }
                        flag = true;
                    });
                    aa.on('click', function (e) {
                        console.log(flag, 2)
                        if (flag) {
                            // var path = [
                            //     [118.22759, 25.60841],
                            //     [118.22760, 25.60795],
                            //     [118.22876, 25.60834],
                            //     [118.22755, 25.60833]
                            // ]
                            var path = marker.path;
                            var polygon = new AMap.Polygon({
                                path: path,
                                strokeColor: "#2b8cbe",
                                strokeWeight: 2,
                                strokeOpacity: 1,
                                fillOpacity: 0.1,
                                fillColor: '#ccebc5',
                                zIndex: 50,
                            });
                            polygon.on('mouseover', () => {
                                polygon.setOptions({
                                    fillOpacity: 0.7,
                                    fillColor: '#7bccc4'
                                })
                            })
                            polygon.on('mouseout', () => {
                                polygon.setOptions({
                                    fillOpacity: 0.5,
                                    fillColor: '#ccebc5'

                                })
                            })

                            map.add(polygon)
                            map.setZoom(14.8)
                            map.setCenter(marker.position)
                            // map.setFitView([polygon])//换setCenter方式
                            flag = false;
                            first = true;
                        } else {
                            first = false;
                            var _btnTxt = '进入' + marker.content;
                            _layer.open({
                                type: 2,
                                title: false,
                                btn: [_btnTxt],
                                btnAlign: 'c',
                                anim: 5,
                                area: ['430px','600px'],
                                moveType: 1,
                                shade: 0.5,
                                content:['/tc?vv='+marker.id,'no'],
                                yes: function () {
                                    flag = true;
                                    if(marker.domain==''){
                                        _layer.msg('当前村庄未配置域名');
                                        return false;
                                    }

                                    var _datas, _signDatas = {}
                                    var _ss = getSign(_signDatas)
                                    if (_t) {
                                        _layer.load(2);
                                        $.ajax({
                                            url: 'api/user/main',
                                            headers: setHeader(_t, _ss),
                                            type: 'get',
                                            data: _datas,
                                            dataType: 'json',
                                            timeout: 2000,
                                            success: function (rel) {
                                                if (rel.status == 0) {
                                                    window.location.href = 'http://'+marker.domain+'.joy-meta.com?_v='+marker.id+'&token=' + _t;
                                                }else {
                                                    _layer.msg('请登录进入',function (){
                                                        window.location.href='https://www.joy-meta.com/login';
                                                    });
                                                }
                                            },
                                            error: function () {

                                            },
                                            complete: function () {
                                                _layer.closeAll('loading');
                                            }

                                        });

                                    }else {
                                        _layer.msg('请登录进入',function (){
                                            window.location.href='https://www.joy-meta.com/login';
                                        });
                                    }

                                },

                            })
                        }

                    });
                });
            } else {
                _layer.closeAll('loading');
                setTimeout(function () {
                    _layer.msg(rel.msg);
                }, 1600)
                // if (rel.status == 100007) {
                //     console.log(rel)
                //     setTimeout(function () {
                //         localStorage.removeItem('_u_t');
                //         window.location.href = '/'
                //     }, 1600)
                // }
            }
        },
        error: function () {
            _layer.closeAll('loading');
            _layer.msg('请求超时！')
        },
        failed: function () {
            _layer.closeAll('loading');
            _layer.msg('请求超时！！')
        }

    });

}

function clickSearch(item) {
    var _id = item.id;
    // console.log(markerShow[_id],123,markerShow[_id].position)
    var path = _s_markers[_id].path;
    var polygon = new AMap.Polygon({
        path: path,
        strokeColor: "#2b8cbe",
        strokeWeight: 2,
        strokeOpacity: 1,
        fillOpacity: 0.1,
        fillColor: '#ccebc5',
        zIndex: 50,
    });
    polygon.on('mouseover', () => {
        polygon.setOptions({
            fillOpacity: 0.7,
            fillColor: '#7bccc4'
        })
    })
    polygon.on('mouseout', () => {
        polygon.setOptions({
            fillOpacity: 0.5,
            fillColor: '#ccebc5'

        })
    })
    map.add(polygon)
    map.setZoom(14.8)
    map.setCenter(_s_markers[_id].position)
    // console.log(markerShow[_id])
    markerShow[_id].emit('click')
}

function dropDataAdd(_data) {
    var returnData = [];
    for (var c in _data) {
        var n = parseInt(c) + 1;
        var _arr = {};
        _arr['templet'] = '<img src="' + _data[c].thumb + '" style="width: 160px;float: right"><input type="hidden" value="' + c + '"><p style="color: black;font-size: 14px;font-weight: 700;">' + n + '.' + _data[c].content + '</p>' + _data[c].info
        // _arr['id'] = _data[c].id;
        _arr['id'] = c;
        _arr['href'] = 'javascript:void(0)'
        returnData.push(_arr);
        if (c < _data.length - 1) {
            returnData.push({type: '-'})
        }
    }
    return returnData;
}
