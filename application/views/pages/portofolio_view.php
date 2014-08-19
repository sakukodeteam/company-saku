  <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?php echo site_url();?>">Beranda</a> <span class="divider">/</span></li>
                        <li class="active"><?php echo $title; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->     

    <section id="portfolio" class="container main">    
        <ul class="gallery col-4">
            <?php 
            if(!empty($portofolios)):
            foreach($portofolios as $porto): ?>
            <!--Item 1-->
            <li>
                <div class="preview">
                    <img alt="<?php echo $porto->portofolio_name;?>" src="<?php echo base_url('assets/img/portofolio/thumb/'.$porto->picture);?>">
                    <div class="overlay">
                    </div>
                    <div class="links">
                        <a data-toggle="modal" href="#modal-<?php echo $porto->portofolio_id;?>"><i class="icon-eye-open"></i></a><a href="<?php echo $porto->url;?>"><i class="icon-link"></i></a>                                
                    </div>
                </div>
                <div class="desc">
                    <h5><?php echo $porto->portofolio_name;?></h5>
                    <small><?php echo $porto->description;?></small>
                </div>
                <div id="modal-<?php echo $porto->portofolio_id;?>" class="modal hide fade">
                    <a class="close-modal" href="javascript:;" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></a>
                    <div class="modal-body">
                        <img src="<?php echo base_url('assets/img/portofolio/full/'.$porto->picture);?>" alt="<?php echo $porto->portofolio_name;?>" width="100%" style="max-height:400px">
                    </div>
                </div>                 
            </li>
            <!--/Item 1-->   
            <?php endforeach; 
            else:
                echo "<h4>Data masih kosong..</h4>";
            endif;
            ?>
        </ul>
        
    </section>