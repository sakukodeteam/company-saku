<div class="widget search">
            <form method="GET" action="<?php echo site_url('blog/search'); ?>">
                <input type="text" class="input-block-level" name="keyword" placeholder="Cari Artikel">
            </form>
        </div>
        <!-- /.search -->
        <!--
        <div class="widget ads">
            <div class="row-fluid">
                <div class="span6">
                    <a href="#"><img src="images/ads/ad1.png" alt=""></a>
                </div>

                <div class="span6">
                    <a href="#"><img src="images/ads/ad2.png" alt=""></a>
                </div>
            </div>
            <p> </p>
            <div class="row-fluid">
                <div class="span6">
                    <a href="#"><img src="images/ads/ad3.png" alt=""></a>
                </div>

                <div class="span6">
                    <a href="#"><img src="images/ads/ad4.png" alt=""></a>
                </div>
            </div>
        </div>
        <!-- /.ads -->

        <div class="widget widget-popular">
            <h3>Posting Terbaru</h3>
            <div class="widget-blog-items">
                <!-- recent post-->
                <?php $posts = post(5); 
                if(!empty($posts)):
                foreach($posts as $post): ?>
                <div class="widget-blog-item media">
                    <div class="pull-left">
                        <div class="date">
                            <span class="month"><?php echo dateindo2($post->date,'mon');?></span>
                            <span class="day"><?php echo dateindo2($post->date,'tgl');?></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <a href="<?php echo site_url('blog/post/view/'.$post->article_url);?>"><h5><?php echo $post->article_title; ?></h5></a>
                    </div>
                </div>
                <?php endforeach;
                else:
                    echo "<h4>Belum ada data!</h4>";
                endif;
                ?>
            </div>                        
        </div>
        <!-- End Popular Posts -->        

        <div class="widget">
            <h3>Kategori Blog</h3>
            <div>
                <div class="row-fluid">
                    <div class="span6">
                        <?php $categories = category();
                        if(!empty($categories)): ?>
                        <ul class="unstyled">
                            <?php
                            foreach($categories as $cat): ?>
                            <li><a href="<?php echo site_url('blog/categories/'.$cat->category_url);?>"><?php echo $cat->category_name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php
                        else:
                            echo "<h4>belum ada data!</h4>";
                        endif;
                        ?>
                    </div>
                </div>

            </div>                       
        </div>
        <!-- End Category Widget -->
        <!--
        <div class="widget">
            <h3>Tag/Keyword</h3>
            <ul class="tag-cloud unstyled">
                <li><a class="btn btn-mini btn-primary" href="#">CSS3</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">HTML5</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">WordPress</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">Joomla</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">Drupal</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">Bootstrap</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">jQuery</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">Tutorial</a></li>
                <li><a class="btn btn-mini btn-primary" href="#">Update</a></li>
            </ul>
        </div> 
        <!-- End Tag Cloud Widget 

        <div class="widget">
            <h3>Arsip</h3>
            <ul class="archive arrow">
                <li><a href="#">May 2013</a></li>
                <li><a href="#">April 2013</a></li>
                <li><a href="#">March 2013</a></li>
                <li><a href="#">February 2013</a></li>
            </ul>
        </div> 
        <!-- End Archive Widget -->   