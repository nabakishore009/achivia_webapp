<?php include("../library/adminconfig.php"); include("../include/link_page.php");
if (!isset($_SESSION['USER'])) {
    session_destroy();
    header('Location:login.php');
}


$db=new Db_Operation();

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

	$db->Fetch(TABLE_CONTACT,NULL,array(array('where','id',1)));	
	$pages=$db->Data[0];
    // var_dump($pages);
if(isset($pages)){
if(isset($_POST) && !empty($_POST)){
if($db->Update(TABLE_CONTACT,$_POST,array(array('where','id',1)))){
								$_SESSION['success_msg']="Contact Successfully Updated";
							}else{
								$_SESSION['success_msg']="Contact Successfully Updated";//if row not effected

							}
		header('Location:contact_manage.php');
}
}
else{
    if(isset($_POST) && !empty($_POST)){
if($db->Insert(TABLE_CONTACT,array('name'=>$_POST['name'],'email'=>$_POST['email'],'phn_no'=>$_POST['phn_no'],'address'=>$_POST['address'],'map'=>$_POST['map']))){
                                $_SESSION['success_msg']="Contact Successfully Added";
                            }else{
                                $_SESSION['success_msg']="Contact Successfully Added";//if row not effected

                            }
        header('Location:contact_manage.php');
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Contact</title>
   
    
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
                    <h1 class="page-header">Manage Contact</h1>
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
               
                
       
			<form role="form" method="post" action="">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic
                        </div>
                        <div class="panel-body"> 
                        
                        
                            <div class="row">
                                <div class="col-lg-6">
                                   
                                  	
                                  		<div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i>
                                            </span>
                                            <input type="email" class="form-control" name="email" value="<?= @$pages['email'];?>">
                                            </div>
                                        </div>
                                  

										<div class="form-group">
                                            <label>Address</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-location-arrow"></i>
                                            </span>
                                            <input class="form-control" name="address"  value="<?= @$pages['address'];?>">
                                            </div>
                                        </div>

                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                
                                  		<div class="form-group">
                                            <label>Phone No</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i>
                                            </span>
                                            <input class="form-control" name="phn_no"  value="<?= @$pages['phn_no'];?>">
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <label>Whats App</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa  fa-whatsapp"></i>
                                            </span>
                                            <input class="form-control" name="name"  value="<?= @$pages['name'];?>">
                                            </div>
                                        </div>
   
                                </div> 
                                             <div class="form-group">
                                            <label>Map</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa  fa-map"></i>
                                            </span>
                                            <input class="form-control" name="map"  value="<?= @$pages['map'];?>">
                                            </div>
                                        </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                           <div id="map_canvas" style="width:100%; height:100px"></div>
                            <input type="submit" class="btn btn-outline btn-success btn-lg btn-block" value="Update">
                            <br><br>
                        </div>
                        <!-- /.panel-body -->
                    </div> 
                    <!-- /.panel -->
                </div>
            </form>
                
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




<script type="text/javascript">
function callurl(str){
if(str!=""){ $("#msg").show();$("#msg").val('');
  $.post( "../ajax/function.php",{ "choice":"pageurl","pageurl":str }, function( response ){
		var response=response.split('|');
		$('#pageurl').val(response[0]);
		if(response[1]>0){
		$("#msg").html('This url is not available');	
		$('#pageurl').val('');
		$('#pageurl').focus();
		$("#msg").fadeOut(4000);
		}
});
}}

</script>


</body>

</html>
