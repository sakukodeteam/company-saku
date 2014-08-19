

    <!--Slider-->
    <section id="slide-show">
     <div id="slider" class="sl-slider-wrapper">

        <!--Slider Items-->    
        <div class="sl-slider">
            <?php foreach($sliders as $slide): ?>
            <!--Slider Item-->
            <div class="sl-slide <?php echo $slide->background; ?>" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="container">
                        <img class="pull-right" src="<?php echo base_url('assets/img/slider/'.$slide->image);?>" alt="<?php echo $slide->title; ?>" />
                        <h2><?php echo $slide->title; ?></h2>
                        <h3 class="gap"><?php echo $slide->description; ?></h3>
                    </div>
                </div>
            </div>
            <!--/Slider Item-->
            <?php endforeach; ?>
        </div>
        <!--/Slider Items-->

    <!--Slider Next Prev button-->
    <nav id="nav-arrows" class="nav-arrows">
        <span class="nav-arrow-prev"><i class="icon-angle-left"></i></span>
        <span class="nav-arrow-next"><i class="icon-angle-right"></i></span> 
    </nav>
    <!--/Slider Next Prev button-->

</div>
<!-- /slider-wrapper -->           
</section>
<!--/Slider-->

<section class="main-info">
    <div class="container">
        <div class="row-fluid">
            <div class="span9">
                <h4>Lebih dekat dengan kami</h4>
                <p class="no-margin">Anda ingin lebih mengenal Kami?atau ada sesuatu yang
                ingin Anda sampaikan dan tanyakan kepada kami?silahkan
                kirimkan pesan Anda dengan mengklik tombol di samping ini.
                </p>
            </div>
            <div class="span3">
                <a class="btn btn-success btn-large pull-right" href="<?php echo site_url('contact');?>">Kirim Pesan</a>
            </div>
        </div>
    </div>
</section>

<!--Services-->
<section id="services">
    <div class="container">
        <div class="center gap">
            <h3>Apa yang Kami tawarkan?</h3>
            <p class="lead">beberapa layanan jasa yang Kami tawarkan untuk Anda</p>
        </div>

        <div class="row-fluid">
            <?php 
            $i = 1;
            foreach($services as $service): ?>
            <div class="span4">
                <div class="media">
                    <div class="pull-left">
                        <i class="<?php echo $service->icon;?> icon-medium"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $service->service_name;?></h4>
                        <p><?php echo $service->description;?></p>
                    </div>
                </div>
            </div>  
            <?php 
            if($i%3 == 0): ?>
            </div>

            <div class="gap"></div>

            <div class="row-fluid">
            <?php 
            endif;
            $i++;
            endforeach; ?>

        </div>

        <div class="gap"></div>

    </div>
</section>
<!--/Services-->

<section id="recent-works">
    <div class="container">
        <div class="center">
            <h3>Portofolio Terbaru Kami</h3>
            <p class="lead">Lihatlah beberapa proyek terbaru yang telah Kami selesaikan untuk klien Kami yang berharga</p>
        </div>  
        <div class="gap"></div>
        <ul class="gallery col-4">
             
            <?php foreach($portofolios as $porto): ?>
            <!--Item 1-->
            <li>
                <div class="preview">
                    <img alt="<?php echo $porto->portofolio_name;?>" src="<?php echo base_url('assets/img/portofolio/thumb/'.$porto->picture);?>">
                    <div class="overlay">
                    </div>
                    <div class="links">
                        <a data-toggle="modal" href="#modal-<?php echo $porto->portofolio_id;?>"><i class="icon-eye-open"></i></a><a href="<?php echo $porto->url;?>" target="_BLANK"><i class="icon-link"></i></a>                          
                    </div>
                </div>
                <div class="desc">
                    <h5><?php echo $porto->description;?></h5>
                </div>
                <div id="modal-<?php echo $porto->portofolio_id;?>" class="modal hide fade">
                    <a class="close-modal" href="javascript:;" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></a>
                    <div class="modal-body">
                        <img src="<?php echo base_url('assets/img/portofolio/full/'.$porto->picture);?>" alt="<?php echo $porto->portofolio_name;?>" width="100%" style="max-height:400px">
                    </div>
                </div>
                            
            </li>
            <!--/Item 1-->          
            <?php endforeach; ?>
        </ul>
    </div>

</section>
<!-- SL Slider -->
<script type="text/javascript"> 
$(function() {
    var Page = (function() {

        var $navArrows = $( '#nav-arrows' ),
        slitslider = $( '#slider' ).slitslider( {
            autoplay : true
        } ),

        init = function() {
            initEvents();
        },
        initEvents = function() {
            $navArrows.children( ':last' ).on( 'click', function() {
                slitslider.next();
                return false;
            });

            $navArrows.children( ':first' ).on( 'click', function() {
                slitslider.previous();
                return false;
            });
        };

        return { init : init };

    })();

    Page.init();
});
</script>
<!-- /SL Slider -->