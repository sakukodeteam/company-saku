 <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Form
                        <small><?php echo ucfirst($this->router->fetch_class()); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin4739');?>"><i class="fa fa-dashboard"></i> home</a></li>
                        <li><a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>">Service</a></li>
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
                                   <form role="form" method="POST" id="form-service" action="<?php echo site_url('admin4739/service/save');?>">
                                        <input type="hidden" name="serv-id" id="serv-id" value="<?php echo $serv_id;?>"/>
                                        <!--body form-->
                                        <br />
                                        <div class="row">
                                            <!--notif success form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-success alert-dismissable" id="success-form-service" style="display: none">
                                                    
                                                </div>
                                            </div>
                                            <!--end notif success form-->
                                            <!--notif error form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-danger alert-dismissable" id="error-form-service" style="display :none">
                                                                                                        
                                                </div>
                                            </div>
                                            <!--end notif error form-->
                                        </div>
                                        <div class="row">
                                            <!-- left column form -->
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Service Name</label>
                                                        <input name="serv-name" value="<?php echo $serv_name; ?>" type="text" class="form-control" placeholder="Nama Layanan"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Icon</label>
                                                        <input name="icon" value="<?php echo $icon; ?>" type="text" class="form-control" placeholder="Icon"/>
                                                </div>  
                                            </div><!--end left-column-form-->
                                            <!--right column form-->
                                            <div class="col-lg-6 col-xs-12">
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
    $("#form-service").submit(function(event){
        event.preventDefault();
        animateLoad();
        clearError();
        clearNotif();
        var formData = new FormData($(this)[0]);
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
            }else if(data.status == true){
                if(data.load == 0){
                    animateHide();
                    if(data.clearform == true){
                        resetForm($('#form-service'));
                    }
                    showNotif(data.msg);
                }else{
                    var url = "<?php echo site_url('admin4739/service');?>";
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
    $("#error-form-service").html("");
    $("#error-form-service").slideUp("fast");
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-service").html(icon+msg);
    $("#error-form-service").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-service").html(icon+msg);
    $("#success-form-service").slideDown();
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
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
    $("#success-form-service").html("");
    $("#success-form-service").slideUp("fast");
}
</script>