<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin4739');?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <h4 class="page-header">
                        Nice Today
                    </h4>
                       <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        Pray <sup style="font-size: 20px">(Doa)</sup>
                                    </h3>
                                    <p>
                                        before starting the activity
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cloud"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Berdoa sebelum beraktivitas
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        Prayer <sup style="font-size: 20px">(Shalat)</sup>
                                    </h3>
                                    <p>
                                        if the time has come
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-alarm-outline"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Shalat jika sudah masuk waktunya
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>
                                        Eat <sup style="font-size: 20px">(Makan)</sup>
                                    </h3>
                                    <p>
                                        Do Not Forget :D
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-coffee"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Jangan Lupa Makan :D
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                    <h4 class="page-header">
                        Total Reports
                    </h4>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total_article; ?>
                                    </h3>
                                    <p>
                                        Articles
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clipboard"></i>
                                </div>
                                <a href="<?php echo site_url('admin4739/article');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total_portofolio; ?>
                                    </h3>
                                    <p>
                                        Portofolio
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-images"></i>
                                </div>
                                <a href="<?php echo site_url('admin4739/portofolio');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total_team; ?>
                                    </h3>
                                    <p>
                                        Sakukode Teams
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-friends"></i>
                                </div>
                                <a href="<?php echo site_url('admin4739/team');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total_message; ?>
                                    </h3>
                                    <p>
                                        Messages
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-chatbubble-working"></i>
                                </div>
                                <a href="<?php echo site_url('admin4739/message');?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">                       
                          <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Company Profile</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <td width="200">Company Name</td>
                                            <td>:</td>
                                            <td><?php echo company('company_name');?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?php echo company('email');?></td>
                                        </tr>
                                        <tr>
                                            <td>Website</td>
                                            <td>:</td>
                                            <td><?php echo company('url');?></td>
                                        </tr>
                                        <tr>
                                            <td>Tagline</td>
                                            <td>:</td>
                                            <td><?php echo company('tagline');?></td>
                                        </tr>
                                        <tr>
                                            <td>Adress</td>
                                            <td>:</td>
                                            <td><?php echo company('address');?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone / Hp</td>
                                            <td>:</td>
                                            <td><?php echo company('phone');?> / <?php echo company('hp');?></td>
                                        </tr>
                                        <tr>
                                            <td>Profile</td>
                                            <td>:</td>
                                            <td><?php echo company('profile');?></td>
                                        </tr>
                                        <tr>
                                            <td>Since </td>
                                            <td>:</td>
                                            <td><?php echo dateindo(company('date'));?></td>
                                        </tr>
                                        <tr>
                                            <td>Logo </td>
                                            <td>:</td>
                                            <td><img src="<?php echo base_url('assets/img/'.company('logo'));?>" alt="logo sakukode"/></td>
                                        </tr>

                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div>
                        <div class="col-xs-12">
                            <a class="btn bg-olive btn-flat">Edit Profile</a>
                            <a class="btn bg-maroon btn-flat">Change Logo</a>
                        </div>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->