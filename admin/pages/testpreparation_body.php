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

if(isset($_GET['id'])){ 
if($db->Update(TABLE_SUB_TEST_PREPARATION,array('section_name'=>$_POST['section_name'],'sortorder'=>$_POST['sortorder'],'status'=>1,'description'=>htmlentities(addslashes($_POST['description']))),array(array('where','id',$_GET['id']))))
{
$_SESSION['success_msg']="Successfully Updated";
}else{
$_SESSION['error_msg']="Update failed";
}
}else{
if($db->Insert(TABLE_SUB_TEST_PREPARATION,array('tid'=>$_POST['tid'],'section_name'=>$_POST['section_name'],'sortorder'=>$_POST['sortorder'],'status'=>1,'description'=>@htmlentities(addslashes($_POST['description'])))))
{
$_SESSION['success_msg']="Successfully Inserted";
}else{
$_SESSION['error_msg']="Insert failed";
}
}
header('location:testpreparation_body.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage Test Body</title>
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
<h4><a href="testpreparation_body.php?ch=add"><button class="btn btn-success">Add Section</button></a></h4>
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
<?php if(isset($_GET['ch'])){ ?>
  <?php if(isset($_GET['id'])){
 $db->Fetch(TABLE_SUB_TEST_PREPARATION, NULL, array(array('where', 'id', $_GET['id'])));
$pages = $db->Data[0];
// var_dump($pages);
// exit;
}
   ?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
Add New Test Body
</div>
<!-- /.panel-heading -->
<div class="panel-body">
  <?php if(isset($_GET[id])){?>
    <form role="form" method="post" action="testpreparation_body.php?id=<?=$_GET[id]?>&ch=edit" enctype="multipart/form-data">
    <?php }else {?>
<form role="form" method="post" action="testpreparation_body.php" enctype="multipart/form-data">
<?php } ?>
<div class="panel-body"> 
<div class="row">

<div class="col-lg-6">

<div class="form-group">

<div class="form-group">

<label>Choose Test</label>

<select class="form-control" name="tid">



<?php
if(isset($_GET[id])){ ?>
<option value="<?= $v['id']; ?>" <?php
 if(isset($_GET['id'])) {
$db->FetchSingle(TABLE_TEST_PREPARATION,'test_name',array(array('where','id',@$pages['tid'])));
}
?>><?= $db->DataStr ?></option>
<?php 
}
else{
  ?><option value="">Choose a Test</option> <?php
$db->Fetch(TABLE_TEST_PREPARATION, NULL, NULL);

foreach ($db->Data as $v) {
?>

<option value="<?= $v['id']; ?>" <?php
if ($v['id'] == @$_GET['id']) {
echo "selected";
}
?>><?= $v['test_name']; ?></option>

<?php
}
}
?>

</select>

</div>

<div class="form-group">

<label>Section Name</label>

<div class="input-group">

<span class="input-group-addon"><i class="fa fa-leaf"></i>

</span>

<input class="form-control" name="section_name" value="<?= @$pages['section_name']; ?>">

</div>

</div>

</div>
</div>
<!-- /.col-lg-6 (nested) -->

<div class="col-lg-6">
<div class="form-group">

<label>Sort Order</label>

<div class="input-group">

<span class="input-group-addon"><i class="fa fa-key"></i>

</span>

<input type="number" class="form-control" name="sortorder"  value="<?= @$pages['sortorder']; ?>">

</div>

</div>
</div> 

<!-- /.col-lg-6 (nested) -->


<!-- /.row (nested) --><textarea name="description"><?= html_entity_decode(@$pages['description']); ?></textarea><br>



<input type="submit" class="btn btn-outline btn-success btn-lg btn-block" value="Save">

<br><br>

</div>
</form>

</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>

<?php  } else { ?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
Manage Test Body
</div>
<!-- /.panel-heading -->
<div class="panel-body">


<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>Sl no</th>
<th>Test Id</th>
<th>Section</th>
<th>order</th>
<th>Status</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php $xx=1;
$db->Fetch(TABLE_SUB_TEST_PREPARATION,NULL,NULL," order by id DESC");
foreach($db->Data as $v){
?>                                    
<tr class="odd gradeX" id="row<?= $xx;?>">
<td><?= $xx;  ?></td>
<td><?= $v['tid']?></td>
<td><?= $v['section_name']?></td>
<td><?= $v['sortorder']?></td>
<td>

<div class="onoffswitch">
<input type="checkbox" onClick="status('<?=TABLE_SUB_TEST_PREPARATION;?>','status','<?= $v['id']?>')"  name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?= $v['id']?>" <?php if($v['status']==1){ echo "checked";} ?> >
<label class="onoffswitch-label" for="myonoffswitch<?= $v['id']?>">
<span class="onoffswitch-inner"></span>
<span class="onoffswitch-switch"></span>
</label>
</div>                                            

</td>
<td align="center" class="center"><a href="testpreparation_body.php?id=<?= $v['id']?>&ch=edit"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
<td align="center"class="center"><a href="javascript:" onClick="delete_col('<?=TABLE_SUB_TEST_PREPARATION;?>','row<?= $xx;?>','<?= $v['id']?>')"><i class="fa fa-trash-o fa-2x"></i></a></td>
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
<?php } ?>
<!-- /.row -->

<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


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
<script language="javascript" type="text/javascript" src="../library/tiny_mce/tiny_mce.js"></script>

<script language="javascript" type="text/javascript">







tinyMCE.init({
// General options



mode: "exact",
theme: "advanced",
elements: "description",
skin: "default",
height: "400",
width: "100%",
relative_urls: false,
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
</html>
