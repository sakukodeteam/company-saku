    <meta charset="utf-8">
    <title><?php if (!empty($title)) echo $title.' | '; ?> Sakukode</title>
    <?php echo chrome_frame(); ?>
    <?php echo $meta; ?>

    <!-- crayons and paint -->

    <?php echo add_css(array('bootstrap.min','bootstrap-responsive.min','font-awesome.min','main')); ?>
    <?php echo $css; ?>
    <!-- magical wizardry -->
    <?php echo jquery('1.9.1'); ?>
    <?php echo add_js('vendor/modernizr-2.6.2-respond-1.1.0.min'); ?>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

     <style type="text/css">
        .noticeform-comment{
            min-height: 30px;
            border:1px solid #2dcc70;
            background-color: #99ff99;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px;
        }
        .noticeform-comment p{
            color: #2dcc70;
            font-size: 16px;
        }
        .notice-error{
            min-height: 30px;
            border:1px solid #a94442;
            background-color: #ebccd1;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px;
        }
        .notice-error p{
            color: #a94442;
            font-size: 14px;
        }
    </style>