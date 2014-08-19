 <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Form
                        <small><?php echo ucfirst($this->router->fetch_class()); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin4739');?>"><i class="fa fa-dashboard"></i> home</a></li>
                        <li><a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>">Slider</a></li>
                        <li class="active">Form</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                        </div>
                        <div class="col-md-12">
                            <!-- Primary box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Data</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                   <?php if($check == 'valid'): ?>
                                   <!-- form -->
                                   <form role="form" method="POST" id="form-slide" action="<?php echo site_url('admin4739/slider/save');?>">
                                        <input type="hidden" name="slide-id" id="slide-id" value="<?php echo $slide_id;?>"/>
                                        <!--body form-->
                                        <br />
                                        <div class="row">
                                            <!--notif success form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-success alert-dismissable" id="success-form-slide" style="display: none">
                                                    
                                                </div>
                                            </div>
                                            <!--end notif success form-->
                                            <!--notif error form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-danger alert-dismissable" id="error-form-slide" style="display :none">
                                                                                                        
                                                </div>
                                            </div>
                                            <!--end notif error form-->
                                        </div>
                                        <div class="row">
                                            <!-- left column form -->
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                        <input name="title" value="<?php echo $slide_title; ?>" type="text" class="form-control" placeholder="Judul"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Background</label>
                                                        <input name="background" value="<?php echo $background; ?>" type="text" class="form-control" placeholder="Latar"/>
                                                </div> 
                                            </div><!--end left-column-form-->
                                            <!--right column form-->
                                            <div class="col-lg-6 col-xs-12">
                                              
                                                <?php if(empty($slide_id)): ?>
                                                <div class="form-group">
                                                    <label for="picture">Picture/Photo</label>
                                                    <input name="picture" type="file" id="">
                                                </div>
                                                <?php 
                                                else:
                                                    echo '<div class="form-group">';
                                                    echo '<label>Picture/Photo</label><br>';
                                                    echo '<p class="text-primary"><a href="'.site_url('admin4739/slider/change-picture/'.$slide_id).'" data-toggle="tooltip" data-placement="top" title="change picture">'.$picture.' </a></p>';
                                                    echo '</div>';
                                                endif; ?>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="desc" class="form-control" rows="4" placeholder="Deskripsi"><?php echo $desc; ?></textarea>
                                                </div>
                                            </div><!--end right-column-form-->
                                        </div><!--end-body-form-->
                                       
                                        
                                   
                                   
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                               
                                                <button type="submit" name="submit" value="0" class="btn btn-success btn-flat"><?php echo $btn_submit; ?></button>
                                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat"><?php echo $btn_submit; ?> and go back list</button>
                                                <a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>" class="btn btn-warning btn-flat">Cancel</a>
                                    
                                 </form><!-- end form -->
                                 <?php
                                   else:
                                        echo '<h4>Data tidak ditemukan!';
                                    endif;
                                    ?>
                                 </div><!-- /.box-footer-->
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
    $("#form-slide").submit(function(event){
        event.preventDefault();
        animateLoad();
        var formData = new FormData($(this)[0]);
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
                showError(data.msg);
            }else if(data.status == 'error-upload'){
                animateHide();
                clearNotif();
                showError(data.msg);
            }else if(data.status == true){
                if(data.load == 0){
                    animateHide();
                    if(data.clearForm == true){
                        resetForm($('#form-slide'));
                    }
                    showNotif(data.msg);
                }else{
                    var url = "<?php echo site_url('admin4739/slider');?>";
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
    $("#error-form-slide").html("");
    $("#error-form-slide").slideUp("fast");
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-slide").html(icon+msg);
    $("#error-form-slide").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-slide").html(icon+msg);
    $("#success-form-slide").slideDown();
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
    $("#success-form-slide").html("");
    $("#success-form-slide").slideUp("fast");
}
</script>