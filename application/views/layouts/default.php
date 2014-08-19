<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <?php echo $head; ?>
</head>

<body>

<!--Header-->
<header class="navbar navbar-fixed-top">
    <?php echo $header; ?>
</header>
<!-- /header -->

    <!--content -->
        <?php echo $content; ?>
    <!--end-content-->

<!--Bottom-->
<section id="bottom" class="main">
    <!--Container-->
    <div class="container">
        <?php echo $bottom; ?>
    </div>
    <!--/container-->

</section>
<!--/bottom-->

<!--Footer-->
<footer id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span5 cp">
                &copy; 2014 Sakukode Design By <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
            </div>
            <!--/Copyright-->

            <div class="span6">
                <?php $result = socmed(); 
                if(!empty($result)): ?>
                <ul class="social pull-right">
                    <?php foreach($result as $row):?>
                    <li><a href="<?php echo $row->url;?>"><i class="<?php echo $row->icon;?>"></i></a></li>
                    <?php endforeach; ?>                   
                </ul>
                <?php endif;?>
            </div>

            <div class="span1">
                <a id="gototop" class="gototop pull-right" href="#"><i class="icon-angle-up"></i></a>
            </div>
            <!--/Goto Top-->
        </div>
    </div>
</footer>
<!--/Footer-->

<!--js -->
<?php echo add_js('vendor/bootstrap.min'); ?>
<?php echo add_js('main.js') ;?>
<?php echo $js; ?>


</body>
</html>
