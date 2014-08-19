 <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Change Picture
                        <small><?php echo ucfirst($this->router->fetch_class()); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin4739'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>"><i class="ion ion-ios7-folder"></i> <?php echo ucfirst($this->router->fetch_class()); ?></a></li>
                        <li class="active">Change Picture</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Primary box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Changes Picture</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                   <form role="form" method="POST" action="<?php echo site_url($path_action); ?>" id="form-picture">
                                        <br />
                                        <!-- notif form-->
                                        <div class="row">
                                            <!--notif success form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-success alert-dismissable" id="success-form-pict" style="display: none">
                                                    
                                                </div>
                                            </div>
                                            <!--end notif success form-->
                                            <!--notif error form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-danger alert-dismissable" id="error-form-pict" style="display :none">
                                                                                                        
                                                </div>
                                            </div>
                                            <!--end notif error form-->
                                        </div><!--end notif form-->
                                        <!--body form-->
                                        <div class="row">
                                            <!-- left column form -->
                                            <div class="col-lg-4 col-xs-12">
                                                <div class="form-group">
                                                    <label>File Name</label>
                                                    <input type="text" name="newname" placeholder="nama file baru" class="form-control">
                                                    <p class="help-block">if it is empty,file name will follow default name</p>
                                                </div>
                                                <!-- file input-->
                                                <div class="form-group">
                                                    <label>New File :</label>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <input type="hidden" name="path" value="<?php echo $path; ?>">
                                                    <input type="hidden" name="filename" value="<?php echo $picture; ?>">
                                                    <input type="file" id="file" name="picture">
                                                    <br>
                                                    <label>Old File :</label>
                                                    <p class="help-block" id="pict-name"><?php echo $picture;?></p>
                                                </div>
                                            </div><!--end left-column-form-->
                                            <!--right column form-->
                                            <div class="col-lg-6 col-xs-12">
                                                <h5>Preview Picture</h5>
                                                <img src="<?php echo base_url($path); ?>" alt="<?php echo $picture;?>" class="img-thumbnail" id="prev-img">
                                            </div><!--end right-column-form-->
                                        </div><!--end-body-form-->
                                </div><!-- /.box-body -->
                                 <!--box footer-->
                                <div class="box-footer">
                                    <button type="submit" name="submit" value="0" class="btn btn-success btn-flat">Changes</button>
                                    <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat">Changes and go back list</button>
                                    <a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>" class="btn btn-warning btn-flat">Cancel</a>
                                </div><!--end box-footer-->
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->

    <!-- submit form-->
<script>
$(document).ready(function(){
    $("#form-picture").submit(function(event){
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
                animateHide();
                if(data.load == 0 ){
                    resetForm($('#form-picture'));
                    $("#prev-img").attr('src',data.path);
                    $("#pict-name").html(data.file);
                    showNotif(data.msg);
                }else{
                    url = "<?php echo site_url('admin4739/'.$this->router->fetch_class());?>";
                    window.location.href=url;
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
    $("#error-form-pict").html("");
    $("#error-form-pict").slideUp("slow");
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-pict").html(icon+msg);
    $("#error-form-pict").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-pict").html(icon+msg);
    $("#success-form-pict").slideDown();
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
    $("#success-form-pict").html("");
    $("#success-form-pict").slideUp("slow");
}
</script>