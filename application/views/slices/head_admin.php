        <meta charset="UTF-8">
        <title><?php if (!empty($title)) echo $title.' | '; ?> Admin by Sakukode</title>
        <?php echo chrome_frame(); ?>
        <?php echo view_port(); ?>
        <?php echo $meta; ?>
        <!-- bootstrap 3.0.2 -->
        <?php echo add_css('admin/bootstrap.min'); ?>
        <!-- font Awesome -->
        <?php echo add_css('admin/font-awesome.min'); ?>
        <!-- Ionicons -->
        <?php echo add_css('admin/ionicons.min'); ?>
        <!-- Theme style -->
        <?php echo add_css('admin/AdminLTE'); ?>
        <?php echo $css; ?>

        <?php echo jquery('2.0.2'); ?>
