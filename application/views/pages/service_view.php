<section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?php echo $title;?></h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?php echo site_url();?>">Beranda</a> <span class="divider">/</span></li>
                        <li class="active"><?php echo $title;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->       

    
    <section class="services">
        <div class="container">
            <div class="row-fluid">
                <?php
                if(!empty($services)):
                $i = 1;
                foreach($services as $serv): ?>
                <div class="span4">
                    <div class="center">
                        <i style="font-size: 48px" class="<?php echo $serv->icon;?> icon-large"></i>
                        <p> </p>
                        <h4><?php echo $serv->service_name; ?></h4>
                        <p><?php echo $serv->description; ?></p>
                    </div>
                </div>
            <?php
            if($i%3 == 0):?>
            </div>
            <hr>
            <div class="row-fluid">
            <?php endif;
            $i++;
            endforeach;
            else:
                echo "<h4>Data masih kosong..</h4>";
            endif;
            ?>
        </div>        

            <hr>

            <div class="center">
                <a class="btn btn-primary btn-large" href="#">Request a free quote</a>
            </div>
            <p>&nbsp;</p>

        </div>
    </section>