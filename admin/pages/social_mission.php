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

if(isset($_GET['id']) && !empty($_GET['id'])){
	$db->Fetch(TABLE_MNG_SOCIAL,NULL,array(array('where','id',$_GET['id'])));	
	$pages=$db->Data[0];
}
if(isset($_POST) && !empty($_POST))
{
if($db->Update(TABLE_MNG_SOCIAL,$_POST,array(array('where','id',$_GET['id']))))
							{
								$_SESSION['success_msg']="Social Links Successfully Updated";
							}else{
								$_SESSION['success_msg']="Social Links Successfully Updated";//if row not effected

							}

		
		header('Location:social_mission.php?id='.$_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Social Icons</title>
  
    
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
                    <h1 class="page-header">Manage Social Icons</h1>
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
                            Icons
                        </div>
                        <div class="panel-body"> 
								<form role="form" method="get" action="">
                                  		<div class="form-group">
                                            <label>Choose Social Site</label>
                                            <select class="form-control" name="id" onChange="this.form.submit();">
                                            <option value="">Choose Social Site</option>
                                            <?php
											$db->Fetch(TABLE_MNG_SOCIAL,NULL,NULL);
											foreach($db->Data as $v){
											?>
                                            <option value="<?=$v['id'];?>" <?php if($v['id']==@$_GET['id']){ echo "selected";}?>><?=$v['name'];?></option>
                                            <?php 
											}
											?>
                                            </select>
                                        </div>
								</form>
                       </div>
                       
                    </div>
                 </div>
                
           <?php if(isset($_GET['id'])){ ?> 
			<form role="form" method="post" action="">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic
                        </div>
                        <div class="panel-body"> 
                        
                        
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                  		<div class="form-group">
                                            <label>Url</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-<?= @$pages['name'];?>"></i>
                                            </span>
                                            <input type="url" class="form-control" name="url" value="<?= @$pages['url'];?>">
                                            </div>
                                        </div>
                                        
									
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                          
                            <input type="submit" class="btn btn-outline btn-success btn-lg btn-block" 
                            value="Update">
                            <br><br>
                        </div>
                        <!-- /.panel-body -->
                    </div> 
                    <!-- /.panel -->
                </div>
            </form>
                
          <?php }?>     
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




<script language="javascript" type="text/javascript" src="../library/tiny_mce/tiny_mce.js"></script>
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
<script type="text/javascript">
function callurl(str){
if(str!=""){ $("#msg").show();$("#msg").val('');
  $.post( "..ajax/function.php",{ "choice":"pageurl","pageurl":str }, function( response ){
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
