    <?php include("../library/adminconfig.php"); include("../include/link_page.php");
    if (!isset($_SESSION['USER'])) {
    session_destroy();
    header('Location:login.php');
    }
    $db = new Db_Operation();
    if (isset($_SESSION['success_msg'])) {
    $success_msg = $_SESSION['success_msg'];
    unset($_SESSION['success_msg']);
    }
    if (isset($_SESSION['error_msg'])) {
    $error_msg = $_SESSION['error_msg'];
    unset($_SESSION['error_msg']);
    }

    //message

    if (isset($_GET['del_id']) && !empty($_GET['del_id'])) {
    $db->FetchSingle(TABLE_COUNTRY,'image',array(array('where','id',$_GET['del_id'])));
    unlink("../Uploads/".$db->DataStr);
    $db->FetchSingle(TABLE_COUNTRY,'bannerimage',array(array('where','id',$_GET['del_id'])));
    unlink("../Uploads/".$db->DataStr);
    $db->Delete(TABLE_COUNTRY, array(array('where', 'id', $_GET['del_id'])));
    header('Location:country.php');
    }
    if (isset($_POST['country_name']) && !empty($_POST['country_name'])) {

    $_POST['newname'] = @htmlentities($_POST['newname']);
    if ($db->Insert(TABLE_COUNTRY, array('country_name' => $_POST['country_name']))) {
    $_SESSION['success_msg'] = "Successfully Inserted";
    $id = $db->DataId;
    header('Location:country.php?id=' . $id);
    } else {

    $_SESSION['error_msg'] = "Insert failed";
    }
    }

    if (isset($_GET['id']) && !empty($_GET['id'])) {
    if(isset($success_msg)){  
    ?> <script type="text/javascript">$.post("../library/pagemanipulate.php",function(respond){     
    });</script> <?php
    }
    $db->Fetch(TABLE_COUNTRY, NULL, array(array('where', 'id', $_GET['id'])));

    $pages = $db->Data[0];
    }

    if (isset($_POST) && !empty($_POST)) {

    $_POST['description'] = @htmlentities(addslashes($_POST['description']));

    // $_POST['title'] = @htmlentities($_POST['title']);

$_POST['add_date']=TODAY;
$_POST['ip']=USER_IP;
// var_dump($_POST);
// exit;
$_POST['image_text']=str_replace("'","/",$_POST['image_text']);
    if ($db->Update(TABLE_COUNTRY, $_POST, array(array('where', 'id', $_GET['id'])))) {
    $_SESSION['success_msg'] = "Successfully Updated";

    } else {

    $_SESSION['success_msg'] = "Successfully Updated"; //if row not effected
    }



    if ($_FILES['image']['name'] != "") {

    $url = Static_Operation :: UploadImage($_FILES['image']['tmp_name'], '../Uploads/', $_FILES['image']['name']);

    $db->Update(TABLE_COUNTRY ,array('image' => $url), array(array('where', 'id', $_GET['id'])));
    }
        if ($_FILES['bannerimage']['name'] != "") {

    $url = Static_Operation :: UploadImage($_FILES['bannerimage']['tmp_name'], '../Uploads/', $_FILES['bannerimage']['name']);

    $db->Update(TABLE_COUNTRY ,array('bannerimage' => $url), array(array('where', 'id', $_GET['id'])));
    }
    header('Location:country.php?id=' . $_GET['id']);
    }
    ?>

    <!DOCTYPE html>

    <html lang="en">



    <head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Country</title>



    <script type="text/javascript">

    function confirm_delete() {

    return confirm('Are you want to delete this Blog');

    }

    </script>

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

    <h1 class="page-header">Manage Country

    <button class="btn btn-success" data-toggle="modal" data-target="#myModal" style="float:right">Add</button>

    <?php if (isset($_GET['id']) && !empty($_GET['id'])) { ?> <a href="country.php?del_id=<?= $_GET['id'] ?>" style="float:right; margin-right:10px;margin-top:-5px" onclick="return confirm_delete()"><button class="btn btn-danger">Delete</button></a><?php } ?></h1>



    </div>

    <!-- /.col-lg-12 -->

    </div>

    <!-- /.row -->

    <!-- Message -->  

    <?php if (isset($success_msg)) { ?>      
        <script type="text/javascript">$.post("../library/pagemanipulate.php",function(respond){     
        });</script>       

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

    Choose Country

    </div>

    <div class="panel-body"> 

    <form role="form" method="get" action="">

    <div class="form-group">

    <label>Choose Country</label>

    <select class="form-control" name="id" onChange="this.form.submit();">

    <option value="">Choose a Country</option>

    <?php
    $db->Fetch(TABLE_COUNTRY, NULL, NULL);

    foreach ($db->Data as $v) {
    ?>

    <option value="<?= $v['id']; ?>" <?php
    if ($v['id'] == @$_GET['id']) {
    echo "selected";
    }
    ?>><?= $v['country_name']; ?></option>

    <?php
    }
    ?>

    </select>

    </div>

    </form>

    </div>



    </div>

    </div>



    <?php if (isset($_GET['id'])) { ?> 



    <div class="col-lg-12">

    <div class="panel panel-default">

    <div class="panel-heading">

    <input type="checkbox"   name="status" <?php
    if ($pages['status'] == 1) {
    echo "checked";
    }
    ?> onClick="status1('<?=TABLE_COUNTRY;?>','status','<?= $_GET['id']?>')" > Check To Publish 

    </div>
    <form role="form" method="post" action="country.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
    <div class="panel-body"> 





    <div class="row">

    <div class="col-lg-6">

    <div class="form-group">

    <label>Page Name</label>

    <div class="input-group">

    <span class="input-group-addon"><i class="fa fa-paperclip"></i>

    </span>

    <input class="form-control" name="page_name" value="<?= @$pages['page_name']; ?>">

    </div>

    </div>

    <div class="form-group">

    <label>Page Heading</label>

    <div class="input-group">

    <span class="input-group-addon"><i class="fa fa-leaf"></i>

    </span>

    <input class="form-control" name="page_heading" value="<?= @$pages['page_heading']; ?>">

    </div>

    </div>
    <div class="form-group">

    <label>Meta Title</label>

    <div class="input-group">

    <span class="input-group-addon"><i class="fa fa-leaf"></i>

    </span>

   <input class="form-control" name="meta_title" value="<?= @$pages['meta_title']; ?>">

    </div>

    </div>



    <div class="form-group">

    <label>Url</label>

    <div class="input-group">

    <span class="input-group-addon"><i class="fa fa-link"></i>

    </span>

    <input class="form-control" name="page_url" onChange="callurl(this.value);" id="pageurl"  value="<?= @$pages['page_url']; ?>" required>

    </div>

    <p style="display:none" id="msg"></p>

    </div>
    <div class="form-group">

<label>Banner Image</label>

<input type="file" name="bannerimage">

<input type="hidden" name="bannerimage" value="<?= $pages['bannerimage']; ?>"><br>

<div id="imge<?= $pages['id']; ?>">

<?php if ($pages['bannerimage']) { ?>

<img src="<?=
UPLOADS_PATH;
echo $pages['bannerimage'];
?>" height="150px">

 <a href="javascript:" class="btn btn-danger" style="margin-top:95px !important" onClick="removeimg('<?= TABLE_COUNTRY; ?>', 'imge<?= $pages['id']; ?>', '<?= $pages['id']; ?>', 'bannerimage')">Remove</a>

<?php } ?></div>

</div>
<div class="form-group">

<label>Banner Tag</label>

<input class="form-control" name="banner_text" value="<?= @$pages['banner_text']; ?>">



</div>
    </div>

    <!-- /.col-lg-6 (nested) -->

    <div class="col-lg-6">

    <div class="form-group">

    <label>Meta Keywords</label>

    <div class="input-group">

    <span class="input-group-addon"><i class="fa fa-key"></i>

    </span>

    <input class="form-control" name="meta_keyword"  value="<?= @$pages['meta_keyword']; ?>">

    </div>

    </div>

    <div class="form-group">

    <label>Meta Description</label>

    <textarea class="form-control"  name="meta_description" rows="5"><?= @$pages['meta_description']; ?></textarea>

    </div>
        <div class="form-group">

    <label>Sort Order</label>

    <div class="input-group">

    <span class="input-group-addon"><i class="fa fa-key"></i>

    </span>

    <input type="number" class="form-control" name="sorder"  value="<?= @$pages['sorder']; ?>">

    </div>

    </div>

    <div class="form-group">

    <label>Image</label>

    <input type="file" name="image">

    <input type="hidden" name="image" value="<?= $pages['image']; ?>"><br>

    <div id="imge<?= $pages['id']; ?>">

    <?php if ($pages['image']) { ?>

    <img src="<?=
    UPLOADS_PATH;
    echo $pages['image'];
    ?>" height="150px">

    <a href="javascript:" class="btn btn-danger" style="margin-top:95px !important" onClick="removeimg('<?= TABLE_COUNTRY; ?>', 'imge<?= $pages['id']; ?>', '<?= $pages['id']; ?>', 'image')">Remove</a>

    <?php } ?></div>

    </div>
    <div class="form-group">

    <label>Sort Description</label>

    <input class="form-control" name="image_text" value="<?= @$pages['image_text']; ?>">



    </div>
    </div> 

    <!-- /.col-lg-6 (nested) -->

    </div>
    <!-- /.row (nested) --><textarea name="description"><?= html_entity_decode(@$pages['description']); ?></textarea><br>



    <input type="submit" class="btn btn-outline btn-success btn-lg btn-block" value="Update">

    <br><br>

    </div>
    </form>
    <!-- /.panel-body -->

    </div> 

    <!-- /.panel -->

    </div>





    <?php } ?>     

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

    <h4 class="modal-title" id="myModalLabel">Add New Country</h4>

    </div>

    <div class="modal-body">

    <div class="form-group">

    <label>Country Name</label>

    <input type="text"  class="form-control" name="country_name" required>

    </div>



    </div>

    <div class="modal-footer">

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

    <button type="submit" class="btn btn-primary">Save Page</button>

    </div>

    </form>

    </div>



    </div>

    <!-- /.modal-dialog -->

    </div>

    <!-- /.modal -->

    <!--DATE PICKER-->        

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<!-- 
    <script src="//code.jquery.com/jquery-1.10.2.js"></script> -->

    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

    <script>

    $(function () {

    $(".from_date").datepicker({
    dateFormat: 'yy-mm-dd'

    });

    });

    </script>

    <!--DATE PICKER-->    

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

    <script type="text/javascript">

    function callurl(str) {

    if (str != "") {
    $("#msg").show();
    $("#msg").val('');

    $.post("../ajax/function.php", {"choice": "pageurl", "pageurl": str}, function (response) {

    var response = response.split('|');

    $('#pageurl').val(response[0]);

    if (response[1] > 0) {

    $("#msg").html('This url is not available');

    $('#pageurl').val('');

    $('#pageurl').focus();

    $("#msg").fadeOut(4000);

    }

    });

    }
    }

    function status1(table,column,id){

    $.post("../ajax/status.php",{"table":table,"column":column,"id":id},function(respond){     
    });
    }



    </script>





    </body>



    </html>

