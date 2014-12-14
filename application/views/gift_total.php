<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>ELLE - 『点亮水晶球，赢圣诞好礼』活动数据统计系统</title>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$this->config->base_url()?>public/bootstarp/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$this->config->base_url()?>public/upload/css/upload.css">
    <script src="<?=$this->config->base_url()?>public/js/respond.js"></script>
</head>
<body>

<div role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">ELLE - 『点亮水晶球，赢圣诞好礼』活动数据统计系统</a>
        </div>
    </div>
</div>


<div class="container">

    <div class="panel panel-info" style="margin-top: 50px;">
        <!-- Default panel contents -->
        <div class="panel-heading">奖品剩余数量及中出统计</div>
        <div class="panel-body">

            <ul class="list-inline">
                <li>双色票夹：<span class="label label-success"><?=$gift_1?></span> 个</li>
                <li>时尚旅行袋：<span class="label label-success"><?=$gift_2?></span> 个</li>
                <li>非凡马挂件：<span class="label label-success"><?=$gift_3?></span> 个</li>
                <li>斜挎包：<span class="label label-success"><?=$gift_4?></span> 个</li>
                <li>天猫优惠券：<span class="label label-success"><?=$gift_5?></span> 个</li>
            </ul>
        </div>

        <!-- Table -->
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>



    <div class="footer">
        <p>&copy; Uniquead 2014</p>
    </div>

</div>



</body>
</html>