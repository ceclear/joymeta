<!DOCTYPE html>
<html>
    <title>名车联</title>
    <head></head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <body>
        <div style="text-align: center;padding: 10px 0px;font-size: 14px">
            <h3>{{$data['title']}}</h3>
        </div>

        <div style="padding-top:10px;border-top:1px #ccc solid; font-size: 14px" >
            {!! $data['content'] !!}
        </div>

    </body>
</html>

<style>
    body{
        padding: 15px;
        font-size:2rem;
        color:#333;
    }

</style>
