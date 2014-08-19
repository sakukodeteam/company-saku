   <script type="text/javascript">
            $(function() {
                //instance tokenfield input
                $('#keyword').tokenfield();

                // instance, using default configuration.
                CKEDITOR.replace('content');
                CKEDITOR.instances['content'].on('change', function() { CKEDITOR.instances['content'].updateElement() });

                //submit form
                $("#form-article").submit(function(event){
                    event.preventDefault();
                })

            });
        </script>
 <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Form
                        <small>Article</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Article</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Primary box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Article</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php if($check == 'valid'): ?>
                                    <!--form-->
                                    <form role="form" id="form-article" method="POST" action="<?php echo site_url('admin4739/article/save');?>">
                                        <input type="hidden" name="article-id" value="<?php echo $article_id; ?>">
                                        <!--form element-->
                                        
                                        <div class="form-group">
                                            <label>Title <small class="text-red">*</small></label>
                                            <input type="text" name="title" value="<?php echo $article_title; ?>" class="form-control" placeholder="Judul"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Keyword/Tag <small class="text-red">*</small></label>
                                            <input type="text" name="keyword" value="<?php echo $keyword; ?>" id="keyword" class="form-control" placeholder="Tag"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Category <small class="text-red">*</small></label>
                                            <select class="form-control" name="category">
                                            <?php  
                                              if($category_id == null): ?>
                                              <option value="">-- Select Category--</option>
                                              <?php else: ?>
                                              <option value="<?php echo $category_id;?>"><?php echo $category_name;?></option>
                                              <?php endif; ?>
                                              <?php 
                                              foreach($list_category as $category):
                                                if($category->category_id != $category_id):
                                              ?>
                                              <option value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></option>
                                              <?php 
                                              endif;
                                              endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Content <small class="text-red">*</small></label>
                                            <textarea name="content" class="form-control" rows="3" id="content"><?php echo $content; ?></textarea>
                                        </div>
                                        <?php if(empty($article_id)): ?>
                                        <div class="form-group">
                                            <label for="picture">Picture</label>
                                            <input name="picture" type="file">
                                        </div>
                                        <?php 
                                        else:
                                                echo '<div class="form-group">';
                                                echo '<label>Picture/Photo</label><br>';
                                                echo '<p class="text-primary"><a href="'.site_url('admin4739/article/change-picture/'.$article_id).'" data-toggle="tooltip" data-placement="top" title="change picture"><img src="'.base_url('assets/img/article/'.$picture).'"></a></p>';
                                                echo '</div>';
                                        endif; ?>
                                        <div class="form-group">
                                            <label>Select Status</label>
                                            <select class="form-control" name="status">
                                                <?php 
                                                $publish = ($status == 'publish') ? 'selected': '';
                                                $draft   = ($status == 'draft') ? 'selected' : '';
                                                ?>
                                                <option value="publish" <?php echo $publish;?>>Publish</option>
                                                <option value="publish" <?php echo $draft;?>>Draft</option>
                                            </select>
                                        </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <br />
                                        <div class="row">
                                            <!--notif success form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-success alert-dismissable" id="success-form-article" style="display: none">
                                                    
                                                </div>
                                            </div>
                                            <!--end notif success form-->
                                            <!--notif error form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-danger alert-dismissable" id="error-form-article" style="display :none">
                                                                                                        
                                                </div>
                                            </div>
                                            <!--end notif error form-->
                                    <button type="submit" name="submit" value="0" class="btn btn-success btn-flat"><?php echo $btn_submit; ?></button>
                                    <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat"><?php echo $btn_submit; ?> and go back list</button>
                                    <a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>" class="btn btn-warning btn-flat">Cancel</a>
                                </form><!--end-form-->
                                <?php
                                    else:
                                        echo '<h4>Data tidak ditemukan!';
                                    endif;
                                ?>
                                </div>
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="display: none" id="overlay-load"></div>
                                <div class="loading-img" id="animate-load"style="display:none"></div>
                                <!-- end loading -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->

<!-- submit form-->

<script>
$(document).ready(function(){
    $("#form-article").submit(function(event){
        event.preventDefault();
        animateLoad();
        var formData = new FormData($(this)[0]);
        console.log(formData);
        clearError();
        clearNotif();
        $.ajax({
        url:$(this).attr("action"),
        type: 'POST',
        dataType: 'json',
        data: formData,
        async: false,
        success: function (data) {
            if(data.status == false){
                animateHide();
                clearNotif();
                $("#error-form-article").focus();
                showError(data.msg);
            }else if(data.status == 'error-upload'){
                animateHide();
                clearNotif();
                showError(data.msg);
            }else if(data.status == true){
                if(data.load == 0){
                    animateHide();
                    if(data.clearForm == true){
                        resetForm($('#form-article'));
                    }
                    showNotif(data.msg);
                }else{
                    var url = "<?php echo site_url('admin4739/article');?>";
                    window.location.href = url;
                }
            }
        },
        cache: false,
        contentType: false,
        processData: false
        });
        return false;
    });

    
});

function clearError()
{
    $("#error-form-article").html("");
    $("#error-form-article").slideUp("fast");
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-article").html(icon+msg);
    $("#error-form-article").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-article").html(icon+msg);
    $("#success-form-article").slideDown();
}

function animateLoad()
{
    $("#overlay-load").show();
    $("#animate-load").show();
}

function animateHide()
{
    $("#overlay-load").hide();
    $("#animate-load").hide();
}

function clearNotif()
{
    $("#success-form-article").html("");
    $("#success-form-article").slideUp("fast");
}
</script>