<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投资大亨</title>
    <link rel="icon" type="image/GIF" href="res/favicon.ico"/>
    <meta name="screen-orientation" content="portrait" />
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="full-screen" content="yes"/>
    <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>
    <meta name="full-screen" content="yes" />
    <meta name="imagemode" content="force" />
    <meta name="browsermode" content="application" />
    <!--"width": "device-width", "initial-scale": "1.0"-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" id="cocosMetaElement" />
    <style>
        body, canvas, div {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
    </style>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body style="padding:0; margin: 0; background: #000;">
<canvas id="gameCanvas" width="640" height="1008" style="display:block"></canvas>

<div id="fishGame-loading" style="display:none">
    <div id="loading" class="ani-loading"></div>
</div>
<!--加载界面-->
<div id="loadingView">
    <div id="loadingImage"></div>
    <div id="loadingText-container" align="center">
        <p id="loadingText">加载中...0%</p>
    </div>
</div>

<div id="shareGuide"></div>

<div id="portraitTip">
    <div id="portraitImage"></div>
</div>
</body>
<script type="text/javascript">

    var __LOADING__ = 10000, __LOADING__NOW__ = 0;
    var __LOADING_INTERVAL_ID__ = setInterval(function(){
        __LOADING__NOW__ += 100;
        var percent = ~~((__LOADING__NOW__/__LOADING__)*100);

        if(percent > 100)percent = 100;

        var loadingText = document.getElementById("loadingText");
        loadingText.innerHTML = "加载中..."+(percent)+"%";

        if(percent >= 100){
            clearInterval(__LOADING_INTERVAL_ID__);
        }
    }, 100);

</script>
<script src="src/Config.js?tr=123"></script>
<script src='./js/WeixinApi.js'></script>
<script type="text/javascript">
    WeixinApi.ready(function(Api) {
        window.__WX_SHARE_SUCC_CALLBACK = null;
        window.__WX_SHARE_FAIL_CALLBACK = null;
        // 微信分享的数据
        window.__WX_SHARE_DATA = fishGame.__GET_DEFAULT_SHARE_INFO__();

        // 分享的回调
        var wxCallbacks = {
            // 分享被用户自动取消
            cancel : function(resp) {
                // 你可以在你的页面上给用户一个小Tip，为什么要取消呢？
                //alert("分享被取消，msg=" + resp.err_msg);
                __WX_SHARE_FAIL_CALLBACK && __WX_SHARE_FAIL_CALLBACK();
            },
            // 分享失败了
            fail : function(resp) {
                // 分享失败了，是不是可以告诉用户：不要紧，可能是网络问题，一会儿再试试？
                // alert("分享失败，msg=" + resp.err_msg);
                __WX_SHARE_FAIL_CALLBACK && __WX_SHARE_FAIL_CALLBACK();
            },
            // 分享成功
            confirm : function(resp) {
                // 分享成功了，我们是不是可以做一些分享统计呢？
                //alert("分享成功，msg=" + resp.err_msg);
                __WX_SHARE_SUCC_CALLBACK && __WX_SHARE_SUCC_CALLBACK();
            },
            // 整个分享过程结束
            all : function(resp,shareTo) {
                // 如果你做的是一个鼓励用户进行分享的产品，在这里是不是可以给用户一些反馈了？
                //alert("分享" + (shareTo ? "到" + shareTo : "") + "结束，msg=" + resp.err_msg);
            }
        };

        Api.hideToolbar();

        // 用户点开右上角popup菜单后，点击分享给好友，会执行下面这个代码
        Api.shareToFriend(null, wxCallbacks);

        // 点击分享到朋友圈，会执行下面这个代码
        Api.shareToTimeline(null, wxCallbacks);

        // iOS上，可以直接调用这个API进行分享，一句话搞定
        Api.generalShare(null,wxCallbacks);
    });
</script>
<script src = "game.min.js"></script>
<script src = "main.js"></script>

</html>