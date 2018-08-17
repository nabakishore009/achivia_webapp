<?php
include("../library/adminconfig.php"); include("../include/link_page.php");
$db = new Db_Operation();

if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['choice']) && $_POST['choice'] == "facelities") {
$db->Fetch(TABLE_FACELITIES, NULL, array(array('where', 'id', $_POST['id'])));
$model = $db->Data[0];
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $_POST['id']; ?>" />
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">Edit <?= $model['name']; ?></h4>
</div>
<div class="modal-body">
<div class="form-group">
<label>Facelities</label>
<input type="text" required="required" class="form-control" name="name" value="<?= @$model['name']; ?>" id="facelities_model" onChange="checkunique('<?= TABLE_FACELITIES; ?>', 'name', 'facelities_msg_edit', this.value, '<?= $_POST['id']; ?>', 'facelities_model');" />
</div>
<p style="display:none; color:#FF0000" id="facelities_msg_edit"></p>
<div class="form-group">
<label>Icon</label>
<img src="<?=
UPLOADS_PATH;
echo $model['logo'];
?>" />
<input type="file" name="logo" accept="image/*">
<input type="hidden" name="image" value="<?= @$model['logo']; ?>">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success" id="btn2">Save changes</button>
</div>
</form>
<script>
function checkunique(Table, col_name, msg_id, vaalue, id, model_id) {
$("#" + msg_id).show();
$("#" + msg_id).html('');
$("#btn2").attr('disabled', 'disabled');
vaalue = jQuery.trim(vaalue);
if (vaalue != "") {
$.post("ajax/function.php", {"checkunique": "checkunique", "Table": Table, "col_name": col_name, "field_val": vaalue, "col_id": id}, function (respond) {

if (respond > 0) {
$("#" + model_id).val('');
$("#" + msg_id).html('Already exists Please try another one');
$("#" + msg_id).hide(5000);
} else {

$("#btn2").removeAttr('disabled');
}
});
}
}

</script>

<?php } ?>


<?php
/////////////////table banner
if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['choice']) && $_POST['choice'] == "banner") {
$db->Fetch(TABLE_BANNER, NULL, array(array('where', 'id', $_POST['id'])));
$model = $db->Data[0];
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $_POST['id']; ?>" />
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">Edit Banner</h4>
</div>
<div class="modal-body">
<div class="form-group">
<label>Banner Title</label>
<input type="text" required="required" class="form-control" name="tag" value="<?= @$model['tag']; ?>">
</div>
<div class="form-group">
<label>Sort Order</label>
<input type="text" required="required" class="form-control" name="sort_order" value="<?= @$model['sort_order']; ?>">
</div>
<div class="form-group">
<label>Banner</label>
<img src="<?=
UPLOADS_PATH;
echo $model['banner'];
?>"  style="height:85px"/>
<input type="file" name="banner" accept="image/*">
<input type="hidden" name="image" value="<?= @$model['banner']; ?>">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success">Save changes</button>
</div>
</form>
<?php } ?>
<?php
/////////////////table gallery
if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['choice']) && $_POST['choice'] == "gallery") {
$db->Fetch(TABLE_GALLERY, NULL, array(array('where', 'id', $_POST['id'])));
$model = $db->Data[0];
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $_POST['id']; ?>" />
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">Edit Image</h4>
</div>
<div class="modal-body">
<div class="form-group">
<label>Image Title</label>
<input type="text" required="required" class="form-control" name="tag" value="<?= @$model['tag']; ?>">
</div>
<div class="form-group">
<label>Image</label>
<img src="<?=
UPLOADS_PATH;
echo $model['image'];
?>"  style="height:85px"/>
<input type="file" name="banner" accept="image/*">
<input type="hidden" name="image" value="<?= @$model['image']; ?>">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success">Save changes</button>
</div>
</form>
<?php } ?>
<?php
/////////////////table testimonial
if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['choice']) && $_POST['choice'] == "testimonial") {
$db->Fetch(TABLE_TESTIMONIAL, NULL, array(array('where', 'id', $_POST['id'])));
$model = $db->Data[0];
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $_POST['id']; ?>" />
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">Edit Image</h4>
</div>
<div class="modal-body">
<div class="form-group">
<label>Name</label>
<input type="text" class="form-control" name="name" value="<?= @$model['name']; ?>" required>
</div>
<div class="form-group">
<label>Image</label>
<img src="<?=
UPLOADS_PATH;
echo $model['image'];
?>"  style="height:85px"/>
<input type="file" name="image" accept="image/*">
<input type="hidden" name="image" value="<?= @$model['image']; ?>">
</div>
<div class="form-group">
<label>Background Image</label>
<img src="<?=
UPLOADS_PATH;
echo $model['bg_image'];
?>"  style="height:85px"/>
<input type="file" name="bg_image" accept="image/*">
<input type="hidden" name="bg_image" value="<?= @$model['bg_image']; ?>">
</div>
<div class="form-group">
<label>Course</label>
<input type="text" class="form-control"  name="course" value="<?= str_replace("/","'",@$model['course']); ?>" required>
</div>
<div class="form-group">
<label>Location</label>
<input type="text" class="form-control"  name="location" value="<?= str_replace("/","'",@$model['location']); ?>" required>
</div>
<div class="form-group">
<label>Comment</label>
<textarea name="feedback2"><?= strip_tags(html_entity_decode(@$model['feedback'], ENT_QUOTES, 'UTF-8')); ?></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success">Save changes</button>
</div>
</form>
<?php } ?>

<?php
/////////////////table how it works
if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['choice']) && $_POST['choice'] == "universitylogos") {
$db->Fetch(TABLE_UNIVERSITY_LOGOS, NULL, array(array('where', 'id', $_POST['id'])));
$model = $db->Data[0];
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $_POST['id']; ?>" />
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">Edit Data</h4>
</div>
<div class="modal-body">
	 <div class="form-group">
      <label>University Name</label>
      <input type="text" class="form-control" name="university_name" value="<?= @$model['university_name']; ?>">
  </div>
  <div class="form-group">
      <label>Link</label>
      <input type="text" class="form-control" name="link_url" value="<?= @$model['link_url']; ?>">
  </div>
  <div class="form-group">
      <label>Sort Order</label>
      <input type="number" class="form-control" name="sortorder" value="<?= @$model['sortorder']; ?>">
  </div>

<div class="form-group">
<label>Image</label>
<img src="<?=
UPLOADS_PATH;
echo $model['image'];
?>"  style="height:85px"/>
<input type="file" name="banner" accept="image/*">
<input type="hidden" name="image" value="<?= @$model['image']; ?>">
</div>
	<div class="form-group">
<label>Image Title</label>
<input type="text" class="form-control"  name="alt_tag" value="<?= @$model['alt_tag']; ?>" required>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success">Save changes</button>
</div>
</form>
<?php } 
////////////////table how it works
if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['choice']) && $_POST['choice'] == "how_it_works") {
$db->Fetch(TABLE_HOW_IT_WORKS, NULL, array(array('where', 'id', $_POST['id'])));
$model = $db->Data[0];
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $_POST['id']; ?>" />
<div class="modal-header">
<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
<h4 class="modal-title">Edit Data</h4>
</div>
<div class="modal-body">
	<div class="form-group">
<label>Image Title</label>
<input type="text" class="form-control"  name="tag" value="<?= @$model['alt_tag']; ?>" required>
</div>
<div class="form-group">
<label>Image</label>
<img src="<?=
UPLOADS_PATH;
echo $model['image'];
?>"  style="height:85px"/>
<input type="file" name="banner" accept="image/*">
<input type="hidden" name="image" value="<?= @$model['image']; ?>">
</div>
<div class="form-group">
<label>Sort Order</label>
<input type="number" class="form-control"  name="sort_order" value="<?= @$model['sort_order']; ?>" required>
</div>
<div class="form-group">
<label>Comment</label>
<textarea name="content1"><?= strip_tags(html_entity_decode(@$model['content'], ENT_QUOTES, 'UTF-8')); ?></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success">Save changes</button>
</div>
</form>
<?php } ?>


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
tinyMCE.init({
// General options

mode: "exact",
theme: "simple",
elements: "content,content1",
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
