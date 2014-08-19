<!DOCTYPE html>
<html>
    <head>
       <?php echo $head_admin; ?>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
           <?php echo $header_admin; ?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php echo $sidebar_admin; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
               <?php echo $content; ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


       
        <!-- Bootstrap -->
        <?php echo add_js('admin/bootstrap.min'); ?>
        <!-- AdminLTE App -->
        <?php echo add_js('admin/AdminLTE/app'); ?>
        <?php echo $js; ?>
    </body>
</html>