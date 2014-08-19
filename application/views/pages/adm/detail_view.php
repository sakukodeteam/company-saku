<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Detail
                        <small><?php echo ucfirst($this->router->fetch_class());?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin4739');?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li> <a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>">
                            <?php echo ucfirst($this->router->fetch_class());?></li></a>
                        <li class="active">detail</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                             <!-- Primary box -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo ucfirst($this->router->fetch_class());?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-info btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-info btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <?php
                                    if(!empty($data)):
                                ?>
                                <div class="box-body table-responsive no-padding">
                                     <table class="table table-hover">
                                        <?php 
                                        foreach($data as $k => $v): ?>
                                        <tr>
                                            <td width="35%"><?php echo $k; ?></td>
                                            <td width="5%">:</td>
                                            <td width ="60%"><?php echo $v; ?></td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    else:
                                        echo "<div class='box-body'><h4>Data tidak ditemukan!</h4>";
                                        endif;
                                        ?>                                        
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <?php
                                    if(!empty($data)):
                                    ?>
                                    <a href="<?php echo site_url($path_edit); ?>" class="btn bg-olive btn-flat">Edit</a>
                                    <button class="btn btn-danger btn-flat btn-delete" id="<?php echo $id; ?>">Delete</button>
                                    <a href="<?php echo site_url('admin4739/'.$this->router->fetch_class());?>" class="btn btn-primary btn-flat">Go Back List</a>
                                    <?php endif; ?>
                                </div><!-- /.box-footer-->
                                 <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="display: none"></div>
                                <div class="loading-img" style="display:none"></div>
                                <!-- end loading -->
                            </div><!-- /.box -->
                        </div>
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

    });
</script>