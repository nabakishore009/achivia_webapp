<?php include("../library/adminconfig.php"); include("../include/link_page.php");
if (!isset($_SESSION['USER'])) {
    session_destroy();
    header('Location:login.php');
}

$db=new DB_Operation();

//message
if(isset($_SESSION['success_msg'])){
$success_msg=$_SESSION['success_msg'];
unset($_SESSION['success_msg']); 
} 
if(isset($_SESSION['error_msg'])){
$error_msg=$_SESSION['error_msg'];
unset($_SESSION['error_msg']);
}
//message

if(isset($_POST) && !empty($_POST)){   
	
	if(isset($_POST['id'])){ 
							if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!="")
							{
								$db->FetchSingle(TABLE_BANNER,'banner',array(array('where','id',$_POST['id'])));
								if($url=Static_Operation :: UploadImage($_FILES['banner']['tmp_name'],'../Uploads/',$_FILES['banner']['name']))
								{unlink("../Uploads/".$db->DataStr);}
							}else{
								$url=$_POST['image'];
							}
							// $size = getimagesize(UPLOADS_PATH.$url); 
							// $imagewidth=$size[0];
							// $imageheight=$size[1];
							// if($imagewidth>1000 && $imageheight>720)
							// { 
									if($db->Update(TABLE_BANNER,array('banner'=>$url,'tag'=>$_POST['tag'],'sort_order'=>$_POST['sort_order']),array(array('where','id',$_POST['id']))))
							{
								$_SESSION['success_msg']="Banner Successfully Updated";
							}else{
								$_SESSION['error_msg']="Banner Update failed";
							}
													 							
							// }else{
								
							// 	if($db->Update(TABLE_BANNER,array('banner'=>$url,'tag'=>$_POST['tag']),array(array('where','id',$_POST['id']))))
							// {
							// 	$_SESSION['success_msg']="Banner Successfully Updated";
							// }else{
							// 	$_SESSION['error_msg']="Banner Update failed";
							// }
							// }
	}else{
				if($_FILES['banner']['name']!="")
				{
							$url=Static_Operation :: UploadImage($_FILES['banner']['tmp_name'],'../Uploads/',$_FILES['banner']['name']);
                
							// $size = getimagesize(UPLOADS_PATH.$url);
							// $imagewidth=$size[0];
							// $imageheight=$size[1];
							// if($imagewidth>1000 && $imageheight>720){
            
							if($db->Insert(TABLE_BANNER,array('banner'=>$url,'tag'=>$_POST['tag'],'sort_order'=>$_POST['sort_order'],'status'=>1)))
							{
								$_SESSION['success_msg']="Banner Successfully Inserted";
							}else{
								$_SESSION['error_msg']="Banner Insert failed";
							}
							
							// }
       //        else{

       //          ?><script type="text/javascript">alert("image has less height & width")</script><?php
       //        }
				}
	}
	header('location:banner.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Banner</title>
    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	     <?php include("../include/nav.php"); ?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                       <h4><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Banner</button></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
   <!-- Message -->  
   <?php if(isset($success_msg)){?>         
        <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?= $success_msg; ?>
        </div>
   <?php }if(isset($error_msg)){?>    
        <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?= $error_msg; ?>
        </div>
    <?php } ?>
   <!-- Message End -->  
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Banner
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                        
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Banner image</th>
                                            <th width="50%">Name</th>
                                            <th>Sort order</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                                                        <tbody>
<?php $xx=1;
$db->Fetch(TABLE_BANNER,NULL,NULL," order by id DESC");
foreach($db->Data as $v){
?>                                    
                                        <tr class="odd gradeX" id="row<?= $xx;?>">
                                            <td><img src="<?= UPLOADS_PATH; echo $v['banner']?>" style="height:85px; width:170px"></td>
                                            <td align="center"><?= $v['tag']?></td>
                                            <td align="center"><?= $v['sort_order']?></td>
                                            <td>
                                            
                                            <div class="onoffswitch">
                                                <input type="checkbox" onClick="status('<?=TABLE_BANNER;?>','status','<?= $v['id']?>')"  name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?= $v['id']?>" <?php if($v['status']==1){ echo "checked";} ?> >
                                                <label class="onoffswitch-label" for="myonoffswitch<?= $v['id']?>">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>                                            
                      
                                            </td>
                                            <td align="center" class="center"><a href="javascript:" onClick="show_dialog(<?= $v['id']?>)"  data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                                            <td align="center"class="center"><a href="javascript:" onClick="delete_col('<?=TABLE_BANNER;?>','row<?= $xx;?>','<?= $v['id']?>')"><i class="fa fa-trash-o fa-2x"></i></a></td>
                                        </tr>
<?php $xx++;}?>                                        
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                  <form  action="" method="post" enctype="multipart/form-data">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title" id="myModalLabel">Add New Banner</h4>
                                      </div>
                                      <div class="modal-body">
                                                  <div class="form-group">
                                                      <label>Banner Title</label>
                                                      <input type="text" class="form-control" name="tag">
                                                  </div>
                                                      <div class="form-group">
                                                      <label>Sort Order</label>
                                                      <input type="number" class="form-control" name="sort_order">
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Banner</label>
                                                      <input type="file" name="banner" accept="image/*">
                                                  </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                  </form>
                                  </div>

                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                          <!-- Modal foredit -->
                          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content"  id="modal-content">
                                  <form  action="" method="post" enctype="multipart/form-data">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title" id="myModalLabel">Edit Facelities</h4>
                                      </div>
                                      <div class="modal-body">
 											<center> <img src="../images/input-spinner.gif" id="input-spinner"></center>                                      
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                  </form>
                                  </div>

                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->




    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
		<script type="text/javascript">
			function show_dialog(str){
				$.post("../ajax/model.php",{"choice":"banner","id":str},function(respond){
				$("#modal-content").html(respond);
				});
			}
        </script>
</body>
  <style>
.onoffswitch {
    position: relative; width: 86px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 50px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 24px; padding: 0; line-height: 24px;
    font-size: 18px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 12px;
    background-color: #34A7C1; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 12px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 31px; margin: -3.5px;
    background: #FFFFFF;
    border: 2px solid #999999; border-radius: 50px;
    position: absolute; top: 0; bottom: 0; right: 58px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}

</style>
</html>
