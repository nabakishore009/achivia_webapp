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
if(isset($_POST['password']) && !empty($_POST['password'])){
$password=md5(SALT.$_POST['newpassword']);
if($db->Update(TABLE_USER,array('password'=>$password),array(array('where','user_name',$_SESSION['USER']))))
							{
								$_SESSION['success_msg']="Password Has been Change Successfully";
							}else{
								$_SESSION['error_msg']="You Enter The Same password";//if row not effected

							}	

header('Location:changepwd.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change Password</title>
  
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
         <?php include("../include/nav.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change Password</h1>
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
    
    <div class="alert alert-danger alert-dismissable" id="msgg" style="display:none">
        
    </div>
   <!-- Message End -->  
            
            <div class="row">
               
                
          
			<form role="form" method="post" action="" onSubmit="return validate();">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Change Password
                        </div>
                        <div class="panel-body"> 
                        
                        
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                  		<div class="form-group">
                                            <label>Current Password</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password"  required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i>
                                            </span>
                                            <input type="password" class="form-control"  id="newpassword" name="newpassword" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Repet New Password</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i>
                                            </span>
                                            <input type="text" class="form-control" id="newpassword2" name="newpassword2" required>
                                            </div>
                                        </div>
									
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                          
                            <input type="submit" class="btn btn-outline btn-success btn-lg btn-block" value="Change Password">
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




<script language="javascript" type="text/javascript" src="../Library/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">



            tinyMCE.init({
                // General options

                mode: "exact",
                theme: "advanced",
                elements: "description,tab1_description,tab2_description,tab3_description,tab4_description,tab5_description,tab6_description",
                skin: "o2k7",
                height: "400",
                width: "100%",
                plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave,filemanager",
                // Theme options

                theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                //theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",

                theme_advanced_toolbar_location: "top",
                theme_notiadvanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,
                // Example word content CSS (should be your site CSS) this one removes paragraph margins

                content_css: "css/word.css",
                // Drop lists for link/image/media/template dialogs

                template_external_list_url: "lists/template_list.js",
                external_link_list_url: "lists/link_list.js",
                external_image_list_url: "lists/image_list.js",
                media_external_list_url: "lists/media_list.js",
                // Replace values for the template plugin

                template_replace_values: {
                    username: "Some User",
                    staffid: "991234"

                }

            });

        </script>
        
<script>
function validate(){ 
var firstpwd=$("#password").val();
var secondpwd=$("#newpassword").val();
var thirdpwd=$("#newpassword2").val();
$.post("ajax/function.php",{"password":firstpwd},function(respond){
	if(respond==0){
		$("#msgg").show();$("#msgg").html('');
		var message="Current Password Not Match";
		$("#msgg").html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+message);
		$("#msgg").fadeOut(6000);
		return false;
	}
});


if(secondpwd.length<6){
	var message="Password Must Ccontain Six Letter";
	$("#msgg").show();$("#msgg").html('');
	$("#msgg").html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+message);
	$("#msgg").fadeOut(6000);
	return false;
}

if(secondpwd!=thirdpwd){
	var message="Password Not Match";
	$("#msgg").show();$("#msgg").html('');
	$("#msgg").html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+message);
	$("#msgg").fadeOut(6000);

	return false;
}
return true;
}
</script>
<script type="text/javascript">
function callurl(str){
if(str!=""){ $("#msg").show();$("#msg").val('');
  $.post( "ajax/function.php",{ "choice":"pageurl","pageurl":str }, function( response ){
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
<script language="javascript" type="text/javascript" src="js/myscript.js"></script>
</body>

</html>
