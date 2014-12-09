<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>点亮水晶球，赢圣诞好礼</title>
    <meta http-equiv="Cache-Control" content="max-age=3600">
    <meta name="MobileOptimized" content="240">
    <meta name="apple-touch-fullscreen" content="YES">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="<?=$this->config->base_url()?>/public/css/common.css">
    <script type="text/javascript" src="<?=$this->config->base_url()?>/public/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->base_url()?>/public/js/christmassnow.js"></script>
    <script>
        $(document).ready(function() {
            $('body').christmassnow({
                snowflaketype: 23, // 1 to 25 types of flakes are available change the number from 1 to 25. each one contain different images.
                snowflakesize: 1, //snowflakesize is 1 then it get the size of the image as random , if the snowflakesize is 2 means size of the image as custom
                snowflakedirection: 1, // 1 means default no wind (top to bottom), 2 means random, 3 means left to right and 4 means  right to left
                snownumberofflakes: 4, // number of flakes is user option
                snowflakespeed: 20, // falling speed of flake 10 sec is default
                flakeheightandwidth: 15 // if you are mention that option flakesize is 2 then this flakeheightandwidth should work values are in pixels 16*16.
            });
        });

        //分享层
        function showShare(){
            $(".jpbox").hide();
            $("#popDiv1").show();
        }

        function closeShare(){
            $("#popDiv1").hide();
            $(".jpbox").show();
        }

        //活动规则
        function showActive(){
            $(".jpbox").hide();
            $("#popDiv2").show();
        }

        function closeActive(){
            $("#popDiv2").hide();
            $(".jpbox").show();
        }
    </script>

    <script type="text/javascript">
        var shareData = {
            "img_url": "",
            "img_width": "200",
            "img_height": "200",
            "link": "http://elle.cnhtk.cn/friend?uid=<?=$this->session->userdata('elle_wechat_id')?>",
            "desc":  "点亮水晶球，赢圣诞好礼",
            "title": "点亮水晶球，赢圣诞好礼"
        };
        document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
            WeixinJSBridge.call('hideToolbar');

            WeixinJSBridge.on('menu:share:timeline', function () {
                shareData.title = "点亮水晶球，赢圣诞好礼";
                WeixinJSBridge.invoke('shareTimeline',shareData, function (res) {
                    _report('send_msg', res.err_msg);
                });
            });

            //发送给好友
            WeixinJSBridge.on('menu:share:appmessage', function () {
                shareData.title = "点亮水晶球，赢圣诞好礼";
                WeixinJSBridge.invoke('sendAppMessage', shareData, function (res) {
                    _report('send_msg', res.err_msg);
                })
            });
        }, false);
    </script>
</head>
<body>
<!--pop start-->
<div id="popDiv1" class="mydiv">
    <img src="<?=$this->config->base_url()?>/public/images/share_ios.jpg"/>
    <a href="javascript:closeShare();" class="close1" title="关闭"></a>
</div>
<!--pop end-->
<!--pop start-->
<div id="popDiv2" class="mydiv">
    <img src="<?=$this->config->base_url()?>/public/images/hdgz_ios.jpg"/>
    <a href="javascript:closeActive();" class="close2" title="关闭"></a>
</div>
<!--pop end-->
<!--雪花-->
<div class="drop"></div>
<div class="jpbox">
    <img src="<?=$this->config->base_url()?>/public/images/jpbg.jpg"/>
    <div class="jpdiv"><img src="<?=$this->config->base_url()?>/public/images/img_jp<?=$gift_num?>.png"/></div>
    <div class="jpbtn"><a href="javascript:showShare();" class="btn_share"><img src="<?=$this->config->base_url()?>/public/images/btn_share.png"/></a><a href="javascript:showActive();" class="btn_hdgz"><img src="<?=$this->config->base_url()?>/public/images/btn_hdgz.png"/></a></div>
</div>

</body>

</html>