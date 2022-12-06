<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>签约</title>
		<script type="text/javascript">
			var oHtml = document.documentElement;
			   getSize();
			   window.onresize=getSize;
			   function getSize(){
			       var screenWidth = oHtml.clientWidth;
			       oHtml.style.fontSize = screenWidth/7.5 + 'px';
			   }
		</script>
		<style type="text/css">
			*{
				margin: 0;
				padding: 0;
				font-size: 0;
			}
			.signupimg{
				width: 1.28rem;
				padding-top: 1.6rem;
				display: inline-block;
			}
			.box{
				width: 100%;
				text-align: center;
			}
			.signupfont{
				font-size: .32rem;
				font-weight: bold;
				color: #222;
				padding-top: .2rem;
			}
			.signupbtn{
				font-size: .28rem;
				color: #FFFFFF;
				width: calc(100% - 1.2rem);
				height: .8rem;
				background-color: #CC1731;
				position: fixed;
				bottom: .8rem;
				left: .6rem;
				border: none;
				border-radius: .1rem;
			}
		</style>
	</head>
	<body>
		<div class="box">
            @if($sign_contract_status)
                <img src="http://imgybf.qqybf.com/image_url/6267b39ba94fda3ecf344b6851bc581d.png"  class="signupimg">
                <p class="signupfont">{{ $sign_contract_message }}</p>
                <input type="button" value="去提现" class="signupbtn" onclick="signingSuccess()">
            @else
                <img src="http://imgybf.qqybf.com/image_url/843f61f8ce679385aea74e2bffdf890c.png" class="signupimg">
                <p class="signupfont">{{ $sign_contract_message }}</p>
                <input type="button" value="关闭页面" class="signupbtn" onclick="closeHandler()">
            @endif
		</div>
	</body>
    <script>
        function signingSuccess()
        {
            if(window.webkit && window.webkit.messageHandlers){
                // ios
                window.webkit.messageHandlers.signingSuccess.postMessage(null);
            }else{
                // android
                android_zhd.signingSuccess();
            }
        }

        function closeHandler()
        {
            if(window.webkit && window.webkit.messageHandlers){
                // ios
                window.webkit.messageHandlers.closeHandler.postMessage(null);
            }else{
                // android
                android_zhd.closeHandler();
            }
        }
    </script>
</html>
