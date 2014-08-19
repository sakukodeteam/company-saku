 <style type="text/css">
        .box-header{
            border-bottom: 1px solid #eee !important;
        }
        .item .item-sub{
            margin-left: 50px !important;
        }
        .form-control .form-popover{
            width:120px;
        }
        .popover {
            max-width:400px;
        }
</style>
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Detail 
                        <small>Article</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-dashboard"></i> Article</a></li>
                        <li class="active">Detail</li>
                    </ol>
                </section>
                                
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <?php
                        if(!empty($post)): ?>
                        <!-- detail article -->
                        <div class="col-xs-12" id="article">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $post->article_title; ?></h3>
                                    <div class="box-tools pull-right">
                                        <div class="box-tools pull-right">
                                        <i class="fa fa-user"></i> <span class="text-info">by : <?php echo $post->users->username; ?></a></span>&nbsp;&nbsp;
                                        <i class="fa fa-calendar"></i> <?php echo dateindo($post->date); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <!--notice success-->
                                    <?php
                                    if($this->session->flashdata('notif-success')):
                                    ?>
                                    <br>
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Success!</b> <?php echo $this->session->flashdata('notif-success'); ?>
                                    </div>
                                    <?php endif ?>
                                    <!--notice error-->
                                    <?php
                                    if($this->session->flashdata('notif-error')):
                                    ?>
                                    <br>
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Error!</b> <?php echo $this->session->flashdata('notif-error'); ?>
                                    </div>
                                    <?php endif ?>
                                    <p>
                                        <?php
                                            $content = html_entity_decode($post->content);
                                            echo $content; 
                                        ?>
                                    </p>
                                </div><!-- /.box-body -->
                                <div class="box-footer" id="footer-article">
                                    <a class="btn btn-primary btn-xs" href="<?php echo site_url('admin4739/article/');?>">Back</a>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('admin4739/article/edit/'.$post->article_id);?>">Edit</a>
                                    <button class="btn btn-xs bg-purple btn-status" data-placement="top" data-toggle="popover" data-title="change status" data-container="body" type="button" data-html="true">Change status</button>
                                    <a class="btn btn-danger btn-xs btn-delete" id="<?php echo $post->article_id; ?>">Delete</a>
                                    <a class="badge bg-purple pull-right" data-toggle="tooltip" title="Status"><?php echo $post->status; ?></a>
                                    <span class="badge bg-orange pull-right" data-toggle="tooltip" title="Category"><?php echo $post->blog_categories->category_name;?></span>
                               
                                    <div id="popover-content" class="hide">
                                      <form class="form-inline form-status" role="form" method="POST" action="<?php echo site_url('admin4739/article/change_status');?>">
                                        <div class="form-group">
                                          <input type="hidden" name="id" value="<?php echo $post->article_id; ?>">
                                          <select class="form-control form-popover" name="status">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                          </select>                                  
                                        </div>
                                         <button type="submit" class="btn btn-primary bg-purple">Update</button> 
                                      </form>
                                    </div>
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->
                        </div>
                        <!--end article -->
                        <!-- detail comments -->
                        <div class="col-xs-12" id="comments">
                            <!-- Comments box -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-comments-o"></i> Comments (<?php echo total_comment($post->article_id);?>)</h3>
                                    <div class="box-tools pull-right">
                                        <div class="btn-group">                                          
                                            <a title="delete All " class="btn btn-default btn-sm" href="<?php echo site_url('admin4739/article/delete_all_comment/'.$post->article_id);?>" onclick="return confirm('Are you sure delete all comments?');"><i class="fa fa-square text-red"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- body comment-->
                                <div class="box-body chat" id="chat-box">
                                    <!-- comment item -->
                                    <?php
                                    foreach($post->blog_comments as $comments):  
                                        if($comments->parent_id == 0):    
                                    ?>
                                    <div class="item">
                                        <img src="<?php echo base_url('assets/img/avatar/'.$comments->avatar);?>" alt="user image" class="online"/>
                                       
                                        <p class="message">
                                            <a href="#" class="name">
                                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $comments->date;?></small>
                                                    <?php echo $comments->name;?>
                                            </a>
                                            <?php echo $comments->content;?>
                                        </p>
                                        <p><a href="<?php echo site_url('admin4739/article/delete_comment/'.$comments->comment_id.'/'.$post->article_id);?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure delete this comment?');" >delete</a></p>
                                        <!-- reply comments -->
                                        <?php
                                        foreach($post->blog_comments as $comments2):
                                        if($comments2->parent_id !=0 && $comments2->parent_id == $comments->comment_id):?>
                                        <div class="item item-sub">
                                            <hr>
                                            <img src="<?php echo base_url('assets/img/avatar/'.$comments2->avatar);?>" alt="user image" class="online"/>
                                            <p class="message">
                                                <a href="#" class="name">
                                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $comments2->date;?></small>
                                                    <?php echo $comments2->name;?>
                                                </a>
                                                <?php echo $comments2->content;?>
                                            </p>
                                            <p><a href="<?php echo site_url('admin4739/article/delete_comment/'.$comments2->comment_id.'/'.$post->article_id);?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure delete this comment?');" >delete</a></p>
                                        </div><!-- /.item --> 
                                        <?php
                                        endif;
                                        endforeach;
                                        ?>                                       
                                        <!--end reply comments-->
                                        <!-- form reply comment -->
                                        <div class="item item-sub">
                                            <hr>
                                            <form class="form-reply" method="POST" id="form-reply-<?php echo $comments->comment_id;?>" action="<?php echo site_url('admin4739/article/reply_comment/'.$post->article_id.'/'.$comments->comment_id);?>">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Type comment..." name="comment-reply"/>
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-comment"></i></button>
                                                </div>
                                            </div>
                                            </form>
                                            <div class="input-group">
                                                <br>
                                                <div class="alert alert-danger alert-dismissable" style="display: none" id="error-reply-<?php echo $comments->comment_id;?>">
                                                    Error Notice
                                                </div>
                                            </div>
                                        </div>
                                        <!--end form reply comment-->
                                    </div><!-- /.item -->
                                    <!-- comments item -->
                                    <hr>
                                    <?php 
                                        endif;
                                        endforeach;
                                    ?>
                                </div><!-- /.body comment -->
                                <!-- form comment -->
                                <div class="box-footer">
                                    <form role="form" id="comment-form" method="POST" action="<?php echo site_url('admin4739/article/send_comment/'.$post->article_id);?>">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Type comment..."/ name="comment">
                                            <div class="input-group-btn">
                                                <button class="btn btn-success" type="submit"><i class="fa fa-comment"></i></button>
                                            </div>
                                        </div>
                                    </form>                                    
                                </div><!--end form comment -->
                                <div class="box-footer">
                                        <br />
                                        <div class="alert alert-danger alert-dismissable" style="display:none" id="error-comment">
                                        
                                        </div>
                                </div>
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="display: none" id="overlay-load"></div>
                                <div class="loading-img" id="animate-load"style="display:none"></div>
                                <!-- end loading -->
                            </div><!-- /.box (comments box) -->
                        </div><!-- end comments -->
                        <?php
                        else:
                            echo '<div class="col-xs-12">';
                            echo '<p>Article not found!.</p>';
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                </section><!-- /.content -->
                   

<script>
    $(document).ready(function(){

        $( document ).on( "click", ".btn-delete", function() {
            var conf = confirm("Are you sure delete this data?");
            var id = $(this).attr('id');
            if(conf){
               $.ajax({
               type: "GET",
               url: "<?php echo site_url('admin4739/'.$this->router->fetch_class().'/delete');?>",
               dataType : "json",
               data: "id="+id,
               success: function(data){
                   if(data.status == true){
                        var url = "<?php echo site_url('admin4739/'.$this->router->fetch_class()); ?>";
                        window.location.href = url;
                   }
               }
               });
            }
        });

        $("#comment-form").submit(function(event) {
            /* Act on the event */
            event.preventDefault();
            clearError();
            animateLoad();
            $.post(this.action, $(this).serialize(), function(data) {
                if(data.status == false){
                    animateHide();
                    showError(data.msg);
                }else if(data.status == true){
                    window.location.href += "#article";
                    location.reload();
                }else{
                    alert('Error System');
                }        
            },"json");
        });

        $(".form-reply").submit(function(event){
        event.preventDefault();
        var id = this.id.replace("form-reply-",'');

        $("#error-reply-"+id).html("");
        $("#error-reply-"+id).hide();
        animateLoad();
        $.post(this.action,$(this).serialize(),function(data){
            if(data.status == false){
                animateHide();
                $("#error-reply-"+id).html(data.msg);
                $("#error-reply-"+id).slideDown();
            }else if(data.status == true){
                animateHide();
                window.location.href += "#article";
                location.reload();
            }else{
                alert('Error System');
            }
        },"json")
         });

        $(".btn-status").popover({
            html: true, 
            content: function() {
                  return $('#popover-content').html();
                }
        });

        $('#footer-article').bind('.form-status','submit',function(event){
            event.preventDefault();
            $.post(this.action,$(this).serialize(), function(data) {
                console.log(this.serialize());
            },"json");
            return false;
        });


    });

function clearError()
{
    $("#error-comment").html("");
    $("#error-comment").slideUp("fast");
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-comment").html(icon+msg);
    $("#error-comment").slideDown();
}


function animateLoad()
{
    $("#overlay-load").fadeIn('fast');
    $("#animate-load").fadeIn('fast');
}

function animateHide()
{
    $("#overlay-load").fadeOut('fast');
    $("#animate-load").fadeOut('fast');
}
</script>