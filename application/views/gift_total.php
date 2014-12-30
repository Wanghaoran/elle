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

    <div class="well">
        <p class="lead">参与活动总人数：<strong class="text-success"><?=$num+3000?></strong> 人</p>
        <p>更多统计信息请访问：<a target="_blank" href="http://new.cnzz.com/v1/login.php?siteid=1253773780">CNZZ统计报表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;查看密码：elle_kelly</p>
    </div>

    <div class="panel panel-info" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">奖品剩余数量及中出统计</div>
        <div class="panel-body">

            <ul class="list-inline">
                <?php if($gift_1 == 0): ?>
                    <li>双色票夹：<span class="label label-danger"><?=$gift_1?></span> 个</li>
                <?php else: ?>
                    <li>双色票夹：<span class="label label-success"><?=$gift_1?></span> 个</li>
                <?php endif; ?>
                <?php if($gift_2 == 0): ?>
                    <li>时尚旅行袋：<span class="label label-danger"><?=$gift_2?></span> 个</li>
                <?php else: ?>
                    <li>时尚旅行袋：<span class="label label-success"><?=$gift_2?></span> 个</li>
                <?php endif; ?>
                <?php if($gift_3 == 0): ?>
                    <li>非凡马挂件：<span class="label label-danger"><?=$gift_3?></span> 个</li>
                <?php else: ?>
                    <li>非凡马挂件：<span class="label label-success"><?=$gift_3?></span> 个</li>
                <?php endif; ?>
                <?php if($gift_4 == 0): ?>
                    <li>斜挎包：<span class="label label-danger"><?=$gift_4?></span> 个</li>
                <?php else: ?>
                    <li>斜挎包：<span class="label label-success"><?=$gift_4?></span> 个</li>
                <?php endif; ?>
                <?php if($gift_5 == 0): ?>
                    <li>天猫优惠券：<span class="label label-danger"><?=$gift_5?></span> 个</li>
                <?php else: ?>
                    <li>天猫优惠券：<span class="label label-success"><?=$gift_5?></span> 个</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Table -->
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>头像</th>
                <th>微信昵称</th>
                <th>性别</th>
                <th>用户语言</th>
                <th>城市</th>
                <th>省份</th>
                <th>国家</th>
                <th>奖品类型</th>
                <th>中奖时间</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($all_user as $key => $value): ?>
                <tr>
                    <td><?=$value['id']?></td>
                    <td><img src="<?=$value['headimgurl']?>" width="30"></td>
                    <td><?=$value['nickname']?></td>
                    <?php if($value['sex'] == 1): ?>
                        <td>男</td>
                    <?php elseif($value['sex'] == 2): ?>
                        <td>女</td>
                    <?php else: ?>
                        <td>未知</td>
                    <?php endif; ?>
                    <td><?=$value['language']?></td>
                    <td><?=$value['city']?></td>
                    <td><?=$value['province']?></td>
                    <td><?=$value['country']?></td>
                    <?php if($value['gift'] == 1): ?>
                        <td>双色票夹</td>
                    <?php elseif($value['gift'] == 2): ?>
                        <td>时尚旅行袋</td>
                    <?php elseif($value['gift'] == 3): ?>
                        <td>非凡马挂件</td>
                    <?php elseif($value['gift'] == 4): ?>
                        <td>斜挎包</td>
                    <?php elseif($value['gift'] == 5): ?>
                        <td>天猫优惠券</td>
                    <?php else: ?>
                        <td>未知</td>
                    <?php endif; ?>
                    <td><?=$value['time']?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>



    <div class="footer">
        <p>&copy; Uniquead 2014</p>
    </div>

</div>



</body>
</html>