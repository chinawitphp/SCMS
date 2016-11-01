<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>success</title>
    <link href="/Public/assets/css/bs3/dpl.css" rel="stylesheet">
    <link href="/Public/assets/css/bs3/bui.css" rel="stylesheet">

</head>
<body>
<div class="demo-content">
    <div class="doc-content" style="margin-left: 2%;margin-top: 2%;">
        <div class="row">
            <div class="span10">
                <div class="tips tips-large tips-success">
                    <span class="x-icon x-icon-success"><i class="icon icon-ok icon-white"></i></span>
                    <div class="tips-content">
                        <h2><?php echo($message); ?></h2>
                        <p class="auxiliary-text">
                            你可以进行以下操作：
                        </p>
                        <p>
                            <a id="href" class="direct-lnk" title="返回" href="<?php echo($jumpUrl); ?>">返回</a>
                            <b id="wait"><?php echo($waitSecond); ?></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script end -->
</div>
</body>
</html>
<script type="text/javascript">
    (function () {
        var wait = document.getElementById('wait'), href = document.getElementById('href').href;
        var interval = setInterval(function () {
            var time = --wait.innerHTML;
            if (time <= 0) {
                location.href = href;
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();
</script>