<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Data
                        <small><?php echo $caption; ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin4739');?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $caption; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Primary box -->
                            <div class="box box-primary">
                                <div class="box-header" data-toggle="tooltip">
                                    <h3 class="box-title">Table <?php echo $caption; ?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <!--notice success-->
                                    <?php
                                    if($this->session->flashdata('notif-success')):
                                    ?>
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
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Error!</b> <?php echo $this->session->flashdata('notif-error'); ?>
                                    </div>
                                    <?php endif ?>
                                    <!--button add data-->
                                    <p><a class="btn bg-olive btn-flat" href="<?php echo site_url($path_add);?>">Add Data</button></a>
                                    <!--data table-->
                                    <table id="data-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <?php
                                                foreach($header_table as $k => $th): ?>
                                                <th><?php echo $th; ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <p>
                                    <i class="fa fa-fw fa-level-up"></i> <a href="#" class="select-all">check all</a> / <a href="#" class="unselect-all">uncheck all</a> / <a href="#" id="delete-all">delete selected</a>
                                    </p>
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
                


 <!-- page script -->
<script type="text/javascript">
    $(document).ready(function(){
        
        var oTable = $('#data-table').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": '<?php echo site_url($path_table);?>',
                "bJQueryUI": false,
                "iDisplayStart ":20,
                "oLanguage": {
            "sProcessing": ""
        },
        "oLanguage": {
            "sInfo": 'Showing _END_ Sources.',
            "sInfoEmpty": 'No entries to show',
            "sEmptyTable": "No Sources found currently, <a href='#'>please add at least one.</a>",
            "sProcessing": ""
        },  
        "fnInitComplete": function() {
               // oTable.fnAdjustColumnSizing();
         },
        'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            },
         "aoColumnDefs": [
            <?php echo $width_tr; ?>
            <?php echo $sort; ?>
        ]
        });

        $( document ).on( "click", ".btn-del", function() {
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
                        location.reload();
                   }
               }
               });
            }
        });

        $('.select-all').click(function(e){
            e.preventDefault();
            $('input', oTable.fnGetNodes()).prop('checked',true);
        });

        $('.unselect-all').click(function(e){
            e.preventDefault();
            $('input', oTable.fnGetNodes()).prop('checked',false);
        });

        $('#delete-all').click(function(e) {
              e.preventDefault();
              var conf = confirm("Are you sure delete this data?");
              if(conf){
                    var idArray = $('#data-table input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                    }).get();
                
                if(idArray != ''){
                    $.post("<?php echo site_url('admin4739/'.$this->router->fetch_class().'/delete_many');?>",{data:idArray},function(data){
                        if(data.status == true)
                        {
                            location.reload();
                        }    
                    },"json");
                }else{
                    alert('Error System. No data selected')     
                }
              }else{
                  oTable.fnDraw();
              }
        });

    });
</script>