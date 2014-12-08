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
            $('#test').christmassnow({
                snowflaketype: 23, // 1 to 25 types of flakes are available change the number from 1 to 25. each one contain different images.
                snowflakesize: 2, //snowflakesize is 1 then it get the size of the image as random , if the snowflakesize is 2 means size of the image as custom
                snowflakedirection: 1, // 1 means default no wind (top to bottom), 2 means random, 3 means left to right and 4 means  right to left
                snownumberofflakes: 4, // number of flakes is user option
                snowflakespeed: 10, // falling speed of flake 10 sec is default
                flakeheightandwidth: 15 // if you are mention that option flakesize is 2 then this flakeheightandwidth should work values are in pixels 16*16.
            });
        });
    </script>
</head>
<body>

<div class="box" id="bb">
    <div class="test" id="test"><img src="<?=$this->config->base_url()?>/public/images/img1.jpg"/>
        <div class="jiangpin">
            <a href="<?=$this->config->base_url()?>/gift"></a>
        </div>
    </div>
    <canvas id="cas"></canvas>
</div>

<!--雪花-->
<div class="drop"></div>
<script type="text/javascript" charset="utf-8">
    //alert(document.getElementById("bb").scrollHeight);
    var canvas = document.getElementById("cas"),ctx = canvas.getContext("2d");
    var x1,y1,a=30,timeout,totimes = 100,jiange = 30;
    canvas.width = document.getElementById("bb").clientWidth;
    canvas.height = canvas.width*1.575;
    //alert(canvas.width);
    //alert(canvas.height);
    var img = new Image();
    img.src = "<?=$this->config->base_url()?>/images/start.jpg";

    img.onload = function(){
        ctx.drawImage(img,0,0,canvas.width,canvas.height)
        //ctx.fillRect(0,0,canvas.width,canvas)
        tapClip()


    }

    //通过修改globalCompositeOperation来达到擦除的效果
    function tapClip(){
        var hastouch = "ontouchstart" in window?true:false,
            tapstart = hastouch?"touchstart":"mousedown",
            tapmove = hastouch?"touchmove":"mousemove",
            tapend = hastouch?"touchend":"mouseup";

        ctx.lineCap = "round";
        ctx.lineJoin = "round";
        ctx.lineWidth = a*2;
        ctx.globalCompositeOperation = "destination-out";

        canvas.addEventListener(tapstart , function(e){
            clearTimeout(timeout)
            e.preventDefault();

            x1 = hastouch?e.targetTouches[0].pageX:e.clientX-canvas.offsetLeft;
            y1 = hastouch?e.targetTouches[0].pageY:e.clientY-canvas.offsetTop;

            ctx.save();
            ctx.beginPath()
            ctx.arc(x1,y1,1,0,2*Math.PI);
            ctx.fill();
            ctx.restore();

            canvas.addEventListener(tapmove , tapmoveHandler);
            canvas.addEventListener(tapend , function(){
                canvas.removeEventListener(tapmove , tapmoveHandler);

                timeout = setTimeout(function(){

                    var imgData = ctx.getImageData(0,0,canvas.width,canvas.height);
                    var dd = 0;
                    for(var x=0;x<imgData.width;x+=jiange){
                        for(var y=0;y<imgData.height;y+=jiange){
                            var i = (y*imgData.width + x)*4;
                            if(imgData.data[i+3] >0){
                                dd++
                            }
                        }
                    }

                    if(dd/(imgData.width*imgData.height/(jiange*jiange))<0.8){
                        //console.log(123456);
                        canvas.className = "noOp";
                        //alert("qq");
                    }
                },totimes)
            });
            function tapmoveHandler(e){
                clearTimeout(timeout)
                e.preventDefault()
                x2 = hastouch?e.targetTouches[0].pageX:e.clientX-canvas.offsetLeft;
                y2 = hastouch?e.targetTouches[0].pageY:e.clientY-canvas.offsetTop;

                ctx.save();
                ctx.moveTo(x1,y1);
                ctx.lineTo(x2,y2);
                ctx.stroke();
                ctx.restore()

                x1 = x2;
                y1 = y2;
            }
        })
    }

</script>

</body></html>