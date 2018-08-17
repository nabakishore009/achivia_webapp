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

$db->Fetch(TABLE_ABOUT,NULL,array(array('where','id',1)));    
$pages=$db->Data[0];
// var_dump($pages);

if(isset($pages)){
if(isset($_POST) && !empty($_POST)){
   $_POST['description']=Static_Operation :: replaceSingleQuote($_POST['description']);
$_POST['sort_details']=Static_Operation :: replaceSingleQuote($_POST['sort_details']);
if($db->Update(TABLE_ABOUT,$_POST,array(array('where','id',1)))){

$_SESSION['success_msg']="About Successfully Updated";
}else{
$_SESSION['success_msg']="About Successfully Updated";//if row not effected

}
header('Location:about_manage.php');
}
if ($_FILES['image']['name'] != "") {
$db->FetchSingle(TABLE_ABOUT,'image',array(array('where','id',1)));
unlink("../Uploads/".$db->DataStr);

$url = Static_Operation :: UploadImage($_FILES['image']['tmp_name'], '../Uploads/', $_FILES['image']['name']);

$db->Update(TABLE_ABOUT, array('image' => $url), array(array('where', 'id', 1)));
}
}
else{
if(isset($_POST) && !empty($_POST)){

$url = Static_Operation :: UploadImage($_FILES['image']['tmp_name'], '../Uploads/', $_FILES['image']['name']);
$feedback=Static_Operation :: replaceSingleQuote($_POST['feedback']);
$sort_details=Static_Operation :: replaceSingleQuote($_POST['sort_details']);
if($db->Insert(TABLE_ABOUT,array('image'=>$url,'heading'=>$_POST['heading'],'description'=>$feedback,'sort_details'=>$sort_details,'alt_tag'=>$_POST['alt_tag']))){
$_SESSION['success_msg']="About Successfully Added";
}else{
$_SESSION['success_msg']="About Successfully Added";//if row not effected

}
header('Location:about_manage.php');
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage About</title>


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
<h1 class="page-header">Manage About</h1>
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



<form role="form" method="post" action="" enctype="multipart/form-data">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
Basic
</div>
<div class="panel-body"> 


<div class="row">
<div class="col-lg-6">


<div class="form-group">
<label>Page Heading</label>
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-leaf"></i>
</span>
<input type="text" class="form-control" name="heading" value="<?= @$pages['heading'];?>">
</div>
</div>

<div class="form-group">
<label>Details</label>
<textarea name="description" >
<?= strip_tags(@$pages['description']);?>
</textarea>
</div>


</div>
<!-- /.col-lg-6 (nested) -->
<div class="col-lg-6">

<div class="form-group">
<label>Sort Details</label>
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-phone"></i>
</span>
<input class="form-control" name="sort_details"  value="<?= @$pages['sort_details'];?>">
</div>
</div>

<div class="form-group">
<label>Image</label>
<input type="file" name="image" accept="image/*">
</div>


</div> 
<!-- /.col-lg-6 (nested) -->
<div class="col-lg-6">
<?php if($pages) {?>
<div class="form-group">
<label>Icon</label>
<img src="<?=
UPLOADS_PATH;
echo $pages['image'];
?>" height="100px" width="100px"/>

<input type="hidden" name="image" value="<?= @$pages['image']; ?>">
</div>
<?php } ?>
<div class="form-group">
<label>Alt Tag</label>
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-phone"></i>
</span>
<input class="form-control" name="alt_tag"  value="<?= @$pages['alt_tag'];?>">
</div>
</div>
</div>
</div>

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
<script language="javascript" type="text/javascript" src="../library/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">



tinyMCE.init({
// General options

mode: "exact",
theme: "simple",
elements: "description,feedback2",
skin: "default",
height: "100",
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

</body>

</html>
