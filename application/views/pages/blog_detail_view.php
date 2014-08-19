 <div class="blog">
    <?php
    if(!empty($post)): ?>
                    <div class="blog-item well">
                        <a href=""><h2><?php echo $post->article_title;?></h2></a>
                        <div class="blog-meta clearfix">
                            <p class="pull-left">
                              <i class="icon-user"></i> by <a href="#"><?php echo $post->users->username; ?></a> | <i class="icon-folder-close"></i> Kategori <a href="#"><?php echo $post->blog_categories->category_name;?></a> | <i class="icon-calendar"></i> <?php echo dateindo($post->date); ?>
                            </p>
                          <p class="pull-right"><i class="icon-comment pull"></i> <a href="#comments"><?php echo total_comment($post->article_id);?> Komentar</a></p>
                      </div>
                      <p><img src="<?php echo base_url('assets/img/article/'.$post->picture);?>" width="100%" alt="" /></p>
                      <p>
                        <?php
                            $content = html_entity_decode($post->content);
                            echo $content; 
                          ?>
                      </p>

                      <div class="tag">
                        Tag : 
                        <?php
                        $tags = explode(',', $post->keyword);
                        foreach($tags as $k => $v): ?>
                        <a href="#"><span class="label label-success"><?php echo ucfirst($v);?></span></a> 
                        <?php endforeach; ?>
                    </div>                       

                    <div class="user-info media box">
                        
                        <div class="media-body">
                            <h4>Bagikan Artikel :</h4>
                            <div class="author-meta">
                                <a class="btn btn-social btn-facebook" href="#"><i class="icon-facebook"></i></a> <a class="btn btn-social btn-google-plus" href="#"><i class="icon-google-plus"></i></a> <a class="btn btn-social btn-twitter" href="#"><i class="icon-twitter"></i></a> <a class="btn btn-social btn-linkedin" href="#"><i class="icon-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <p>&nbsp;</p>
                    
                    <div id="comments" class="comments">

                        <h4><?php echo total_comment($post->article_id);?> Komentar</h4>
                        <!-- comment list -->
                        <div class="comments-list">
                            <?php
                            foreach($post->blog_comments as $comments): 
                                if($comments->parent_id == 0):    
                            ?>
                            <div class="comment media">
                                <div class="pull-left">
                                    <img class="avatar" src="<?php echo base_url('assets/img/avatar/'.$comments->avatar);?>" alt="" />  
                                </div>
                                <div class="media-body">
                                    <strong>Oleh : <a href="#"><?php echo $comments->name;?></a></strong><br>
                                    <small><?php echo dateindo($comments->date);?></small><br>
                                    <p><?php echo $comments->content;?></p>
                                    <p><a href="#" class="btn-reply" id="<?php echo $comments->comment_id;?>">Reply</a></p> 

                                    <!--block comment-reply-->
                                    <?php
                                    foreach($post->blog_comments as $comments2):
                                    if($comments2->parent_id !=0 && $comments2->parent_id == $comments->comment_id):?>
                                    <div class="media-body">
                                        <div class="pull-left" style="margin-right:10px">
                                            <img class="avatar" src="<?php echo base_url('assets/img/avatar/'.$comments2->avatar);?>" alt="" />  
                                        </div>
                                        <div class="media-body">
                                            <strong>Oleh : <a href="#"><?php echo $comments2->name;?></a></strong><br>
                                            <small><?php echo dateindo($comments2->date);?></small><br>
                                            <p><?php echo $comments2->content;?></p>
                                        </div>
                                    </div>
                                    <br />
                                    <?php
                                    endif;
                                    endforeach;
                                    ?>
                                    <!--end-block-reply--> 
                                    <!--form reply comment-->
                                    <div class="media-body" style="display:none" id="<?php echo 'formreply-'.$comments->comment_id;?>">
                                        <form class="form-reply" id="form-reply-<?php echo $comments->comment_id;?>" method="POST" action="<?php echo site_url('post/reply_comment/'.$post->article_id.'/'.$comments->comment_id);?>">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <input type="text" name="name2" required="required" class="input-block-level" placeholder="Nama *" />
                                                </div>
                                                <div class="span4">
                                                    <input type="email" name="email2" class="input-block-level" placeholder="Email" />
                                                </div>
                                                <div class="span4">
                                                    <input type="url" name="url2" class="input-block-level" placeholder="Website" />
                                                </div>
                                            </div>
                                                <textarea rows="8" name="comment2" required="required" id="comment2" class="input-block-level" placeholder="Komentar *"></textarea>
                                                <input type="submit" value="Tulis Komentar" class="btn btn-large btn-primary" />
                                        </form>
                                    </div><!--end form-reply-comment-->
                                    <div class="notice-error" style="display:none" id="error-reply-<?php echo $comments->comment_id;?>">
                                    </div>
                                </div>
                            </div>
                            <?php 
                                endif;
                                endforeach;
                            ?>

                        </div> <!--end comment list-->

                        <!-- Start Comment Form -->
                            <!--notice success form
                            <div class="noticeform-comment">
                                <p>komentar sukses. terima kasih anda sudah berkomentar.</p>
                            </div> -->
                            <?php 
                            if($this->session->flashdata('success')){
                                echo $this->session->flashdata('success');
                            }
                            ?>
                            <!--end notices success form-->
                        <div class="comment-form">
                            <h4>Tinggalkan Komentar</h4>
                            <p> kolom yang bertanda (*) harus diisi. Penggunaan tag html akan diabaikan.</p>
                            <form name="comment-form" id="comment-form" method="POST" action="<?php echo site_url('post/send_comment/'.$post->article_id);?>">
                                <div class="row-fluid">
                                    <div class="span4">
                                        <input type="text" name="name" class="input-block-level" placeholder="Nama *" />
                                    </div>
                                    <div class="span4">
                                        <input type="text" name="email" class="input-block-level" placeholder="Email" />
                                    </div>
                                    <div class="span4">
                                        <input type="url" name="url" class="input-block-level" placeholder="Website" />
                                    </div>
                                </div>
                                <textarea rows="8" name="comment" class="input-block-level" placeholder="Komentar *"></textarea>
                                <input type="submit" value="Tulis Komentar" class="btn btn-large btn-primary" />
                            </form>
                        </div>
                        <div class="notice-error" style="display:none" id="error-comment">
                            
                        </div>
                        <!-- End Comment Form -->

                    </div>

                </div>
                <!-- End Blog Item -->
            <?php 
            else:
                echo "<h4>artikel tidak ditemukan!</h4>";
            endif;
            ?>
            </div>
<!-- script submit form to send email/message -->
<script>
$(document).ready(function(){
    $("#comment-form").submit(function(event){
        event.preventDefault();
        $("#error-comment").html("");
        $("#error-comment").hide();
        $.post(this.action,$(this).serialize(),function(data){
            if(data.status == false){
                $("#error-comment").html(data.msg);
                $("#error-comment").slideDown();
            }else if(data.status == true){
                location.reload();
            }else{
                alert(data.msg);
            }
        },"json")
    });

    $(".form-reply").submit(function(event){
        event.preventDefault();
        var id = this.id.replace("form-reply-",'');

        $("#error-reply-"+id).html("");
        $("#error-reply-"+id).hide();
        $.post(this.action,$(this).serialize(),function(data){
            if(data.status == false){
                $("#error-reply-"+id).html(data.msg);
                $("#error-reply-"+id).slideDown();
            }else if(data.status == true){
                location.reload();
            }else{
                alert(data.msg);
            }
        },"json")
    });

    $(".btn-reply").click(function(e){
        e.preventDefault();
        var id = this.id;
        $("#formreply-"+id).slideToggle("slow");
    });
});
</script>