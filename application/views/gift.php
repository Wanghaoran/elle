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
            "img_url": "http://elle.cnhtk.cn/public/images/icon.jpg",
            "img_width": "200",
            "img_height": "200",
            "link": "http://elle.cnhtk.cn/friend?uid=<?=$this->session->userdata('elle_wechat_id')?>",
            "desc":  "ELLE来送圣诞礼物啦，快来点击领取哦~",
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

<div style="display: none;">
    <script src="http://s95.cnzz.com/stat.php?id=1253773780&web_id=1253773780" language="JavaScript"></script>
</div>
</body>

</html>