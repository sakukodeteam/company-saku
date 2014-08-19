 <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?php echo $title;?></h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?php echo site_url(); ?>">Beranda</a> <span class="divider">/</span></li>
                        <li class="active"><?php echo $title;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->   

    <section id="about-us" class="container main">
        <div class="row-fluid">
            <div class="span6">
                <h2>Profile Kami</h2>
                <p><?php echo company('profile');?></p>
            </div>
            <div class="span6">
                <h2>Skill</h2>
                <div>
                    <div class="progress"><div class="bar" style="width: 80%; text-align:left; padding-left:10px;">Wordpress</div></div>
                    <div class="progress progress-warning"><div class="bar" style="width: 70%; text-align:left; padding-left:10px;">Joomla</div></div>
                    <div class="progress progress-info"><div class="bar" style="width: 60%; text-align:left; padding-left:10px;">Drupal</div></div>
                    <div class="progress progress-danger"><div class="bar" style="width: 90%; text-align:left; padding-left:10px;">Magento</div></div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Meet the team -->
        <h1 class="center">Tim Kami</h1>

        <hr>

        <div class="row-fluid">
            <?php
            if(!empty($teams)):
            foreach($teams as $team): ?>
            <div class="span3">
                <div class="box">
                    <p><img src="<?php echo base_url('assets/img/team/'.$team->picture);?>" alt="<?php echo $team->firstname;?>-<?php echo $team->lastname;?>" ></p>
                    <h5><?php echo $team->firstname; echo "&nbsp;"; echo $team->lastname; ?></h5>
                    <p class="text-info"><?php echo $team->job; ?></p>
                    <p><?php echo $team->description; ?></p>
                    <a class="btn btn-social btn-facebook" href="<?php echo $team->fb_account; ?>"><i class="icon-facebook"></i></a>  <a class="btn btn-social btn-twitter" href="<?php echo $team->twitter_account; ?>"><i class="icon-twitter"></i></a>
                </div>
            </div>
            <?php endforeach;
            else:
                echo "<h4>Data Masih Kosong..</h4>";
            endif; ?>
        </div>
        <p>&nbsp;</p>     
</section>