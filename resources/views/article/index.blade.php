<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div style="text-align: center;padding: 10px 0px;">
            <h3>{{$data['title']}}</h3>
        </div>

        <div style="padding-top:10px;border-top:1px #ccc solid;" >
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