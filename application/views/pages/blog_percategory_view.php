      <div class="blog">
                  <!-- blog item-->
                  <?php
                  if(!empty($posts)):
                  foreach($posts as $post):?>
                    <div class="blog-item well">
                        <a href="<?php echo site_url('blog/post/view/'.$post->article_url);?>"><h2><?php echo $post->article_title;?></h2></a>
                        <div class="blog-meta clearfix">
                          <p class="pull-left">
                              <i class="icon-user"></i> by <a href="#"><?php echo $post->users->name; ?></a> | <i class="icon-folder-close"></i> Kategori <a href="#"><?php echo $post->blog_categories->category_name;?></a> | <i class="icon-calendar"></i> <?php echo dateindo($post->date); ?>
                          </p>
                          <p class="pull-right"><i class="icon-comment pull"></i> <a href="<?php echo site_url('blog/post/view/'.$post->article_url.'#comments');?>"><?php echo total_comment($post->article_id);?> Komentar</a></p>
                      </div>
                      <p><img src="<?php echo base_url('assets/img/article/'.$post->picture);?>" width="100%" alt="" /></p>
                      <p>
                          <?php
                            $cont = word_limiter($post->content,50);
                            $cont2 = html_entity_decode($cont);
                            echo $cont2; 
                          ?>
                      </p>
                      <a class="btn btn-link" href="#">Selengkapnya <i class="icon-angle-right"></i></a>
                    </div>
                  <!-- End Blog Item -->
                  <?php endforeach;
                  else:
                     echo "<h4>belum ada data!</h4>";
                  endif;
                  ?>

              <div class="gap"></div>

              <!-- Pagination -->
              <?php echo $pagination; ?>
              <!--end pagination-->


        </div>