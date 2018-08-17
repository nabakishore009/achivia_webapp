<?php include("../library/adminconfig.php"); include("../include/link_page.php");
if (!isset($_SESSION['USER'])) {
session_destroy();
header('Location:login.php');
}

$db = new Db_Operation();

//message
if (isset($_SESSION['success_msg'])) {
$success_msg = $_SESSION['success_msg'];
unset($_SESSION['success_msg']);
}
if (isset($_SESSION['error_msg'])) {
$error_msg = $_SESSION['error_msg'];
unset($_SESSION['error_msg']);
}
//message


if (isset($_POST) && !empty($_POST)) {
if (isset($_POST['feedback2'])) {
$_POST['feedback2'] = htmlentities(addslashes($_POST['feedback2']));
}
if (isset($_POST['feedback'])) {
$_POST['feedback'] = htmlentities(addslashes($_POST['feedback']));
}

if (isset($_POST['id'])) {
if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
$db->FetchSingle(TABLE_TESTIMONIAL, 'image', array(array('where', 'id', $_POST['id'])));
if ($url = Static_Operation :: UploadImage($_FILES['image']['tmp_name'], '../Uploads/', $_FILES['image']['name'])) {
unlink("../Uploads/" . $db->DataStr);
}
} else {
$url = $_POST['image'];
}
if (isset($_FILES['bg_image']['name']) && $_FILES['bg_image']['name'] != "") {
$db->FetchSingle(TABLE_TESTIMONIAL, 'bg_image', array(array('where', 'id', $_POST['id'])));
if ($url_bg = Static_Operation :: UploadImage($_FILES['bg_image']['tmp_name'], '../Uploads/', $_FILES['bg_image']['name'])) {
unlink("../Uploads/" . $db->DataStr);
}
} else {
$url_bg = $_POST['bg_image'];
}
// var_dump(array('image' => $url,'bg_image' => $url_bg, 'name' => $_POST['name'], 'feedback' => $_POST['feedback2'], 'location' => str_replace("'","/",$_POST['location']),'course' => str_replace("'","/",$_POST['course']), array(array('where', 'id', $_POST['id']))));
// exit;

$_POST['location']=str_replace("'","/",$_POST['location']);
$_POST['course']=str_replace("'","/",$_POST['course']);
// var_dump($_POST);
// exit;
if ($db->Update(TABLE_TESTIMONIAL, array('image' => $url,'bg_image' => $url_bg, 'name' => $_POST['name'], 'feedback' => $_POST['feedback2'], 'location' =>$_POST['location'] ,'course' =>$_POST['course']), array(array('where', 'id', $_POST['id'])))) {
$_SESSION['success_msg'] = "Successfully Updated";
} else {
$_SESSION['success_msg'] = "Successfully Updated"; //if row not effected
}
} else {
if ($_FILES['image']['name'] != "" && $_FILES['bg_image']['name'] != "") {
$url = Static_Operation :: UploadImage($_FILES['image']['tmp_name'], '../Uploads/', $_FILES['image']['name']);
$url_bg = Static_Operation :: UploadImage($_FILES['bg_image']['tmp_name'], '../Uploads/', $_FILES['bg_image']['name']);
if ($db->Insert(TABLE_TESTIMONIAL, array('image' => $url,'bg_image' => $url_bg, 'name' => $_POST['name'], 'location' => str_replace("'","/",$_POST['location']),'course' => str_replace("'","/",$_POST['course']), 'feedback' => $_POST['feedback'], 'status' => 1,'date'=>TODAY))) {
$_SESSION['success_msg'] = "Successfully Inserted";
} else {
$_SESSION['error_msg'] = "Insert failed";
}
}
}
header('location:testimonial.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage Testimonial</title>

<!-- DataTables CSS -->
<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
</head>
<!-- <script>
    $("#modal-display").click(function(){
        alert("clicked");
    })
</script> -->
<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<?php include("../include/nav.php"); ?>
</nav>

<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h4><button type="button" id="modal-display" class="btn btn-success" data-toggle="modal" data-target="#ModalTestimonial">Add Testimonial</button></h4>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- Message -->  
<?php if (isset($success_msg)) { ?>         
<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<?= $success_msg; ?>
</div>
<?php }if (isset($error_msg)) { ?>    
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
Testimonial
</div>
<!-- /.panel-heading -->
<div class="panel-body">


<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>Image</th>
<th>BG Image</th>
<th>Name</th>
<th>Comment</th>
<th>Course</th>
<th>University</th>
<th>Status</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php
$xx = 1;
$db->Fetch(TABLE_TESTIMONIAL, NULL, NULL, " order by id DESC");
foreach ($db->Data as $v) {
?>                                    
<tr class="odd gradeX" id="row<?= $xx; ?>">
<td>
<?php if (isset($v['email'])) { ?>
<img src="<?= WEB_ADDRESS . $v['image'] ?>" style="height:75px;" onerror="this.src='../images/default.png';"><?php } else { ?>
<img src="<?= UPLOADS_PATH . $v['image'] ?>" style="height:75px;" onerror="this.src='../images/default.png';">
<?php } ?></td>
<td>
<?php if (isset($v['email'])) { ?>
<img src="<?= WEB_ADDRESS . $v['bg_image'] ?>" style="height:75px;" onerror="this.src='../images/default.png';"><?php } else { ?>
<img src="<?= UPLOADS_PATH . $v['bg_image'] ?>" style="height:75px;" onerror="this.src='../images/default.png';">
<?php } ?></td>
<td><?= $v['name'] ?><br><?= $v['email'] ?><br><?= $v['phone'] ?></td>
<?php $data=html_entity_decode($v['feedback']);?>
<td><?= substr(strip_tags(html_entity_decode($data, ENT_QUOTES, 'UTF-8')),0,200)?></td>

<td><?= $v['course'] ?></td>
<td><?= $v['location'] ?></td>
<td>

<div class="onoffswitch">
<input type="checkbox" onClick="status('<?= TABLE_TESTIMONIAL; ?>', 'status', '<?= $v['id'] ?>')"  name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?= $v['id'] ?>" <?php
if ($v['status'] == 1) {
echo "checked";
}
?> >
<label class="onoffswitch-label" for="myonoffswitch<?= $v['id'] ?>">
<span class="onoffswitch-inner"></span>
<span class="onoffswitch-switch"></span>
</label>
</div>                                            

</td>
<td align="center" class="center"><a href="javascript:" onClick="show_dialog(<?= $v['id'] ?>)"  data-toggle="modal" data-target="#editModal1"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
<td align="center"class="center"><a href="javascript:" onClick="delete_col('<?= TABLE_TESTIMONIAL; ?>', 'row<?= $xx; ?>', '<?= $v['id'] ?>')"><i class="fa fa-trash-o fa-2x"></i></a></td>
</tr>
<?php
$xx++;
}
?>                                        
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
<div class="modal fade" id="ModalTestimonial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<form  action="" method="post" enctype="multipart/form-data">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Add New Testimonial</h4>
</div>
<div class="modal-body">
<div class="form-group">
<label>Name</label>
<input type="text" class="form-control" name="name" required>
</div>
<div class="form-group">
<label>Image</label>
<input type="file" name="image" accept="image/*" required>
</div>
<div class="form-group">
<label>Background Image</label>
<input type="file" name="bg_image" accept="image/*" required>
</div>
<div class="form-group">
<label>Course</label>
<input type="text" class="form-control"  name="course" required>
</div>
<div class="form-group">
<label>University</label>
<input type="text" class="form-control"  name="location" required>
</div>

<div class="form-group">
<label>Comment</label>
<textarea name="feedback"></textarea>
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
<div class="modal fade" id="editModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<script>
$(document).ready(function() {
$('#dataTables-example').DataTable({
responsive: true
});
});
</script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<input type="text" id="from_date" class="form-control dtcls"  name="testimonial_date"  required>

<!--DATE PICKER-->        
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
$(function () {
$(".from_date").datepicker({
dateFormat: 'yy-mm-dd'
});
});
</script>


<script type="text/javascript">
function show_dialog(str) {

$.post("../ajax/model.php", {"choice": "testimonial", "id": str}, function (respond) {
// alert(respond);
$("#modal-content").html(respond);
});
}
</script>


</script><script language="javascript" type="text/javascript" src="../library/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">



tinyMCE.init({
// General options

mode: "exact",
theme: "simple",
elements: "feedback,feedback2",
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
