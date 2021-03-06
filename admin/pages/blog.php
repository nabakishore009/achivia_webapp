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
    $db->FetchSingle(TABLE_BLOG,'banner',array(array('where','id',$_GET['del_id'])));
    unlink("../Uploads/".$db->DataStr);
    $db->FetchSingle(TABLE_BLOG,'images',array(array('where','id',$_GET['del_id'])));
    unlink("../Uploads/".$db->DataStr);
    $db->Delete(TABLE_BLOG, array(array('where', 'id', $_GET['del_id'])));
    header('Location:blog.php');
}
if (isset($_POST['newname']) && !empty($_POST['newname'])) {

    $_POST['newname'] = @htmlentities($_POST['newname']);
    if ($db->Insert(TABLE_BLOG, array('blog_name' => $_POST['newname']))) {
        $_SESSION['success_msg'] = "Blog Successfully Inserted";
        $id = $db->DataId;
        header('Location:blog.php?id=' . $id);
    } else {

        $_SESSION['error_msg'] = "Insert failed";
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if(isset($success_msg)){  
        ?> <script type="text/javascript">$.post("../library/pagemanipulate.php",function(respond){     
        });</script> <?php
    }
    $db->Fetch(TABLE_BLOG, NULL, array(array('where', 'id', $_GET['id'])));

    $pages = $db->Data[0];
}

if (isset($_POST) && !empty($_POST)) {

    $_POST['description'] = @htmlentities($_POST['description']);

    $_POST['title'] = @htmlentities($_POST['title']);



    if ($db->Update(TABLE_BLOG, $_POST, array(array('where', 'id', $_GET['id'])))) {
        $_SESSION['success_msg'] = "Successfully Updated";

    } else {

$_SESSION['success_msg'] = "Successfully Updated"; //if row not effected
}



if ($_FILES['img']['name'] != "") {

    $url = Static_Operation :: UploadImage($_FILES['img']['tmp_name'], '../Uploads/', $_FILES['img']['name']);

    $db->Update(TABLE_BLOG, array('banner' => $url), array(array('where', 'id', $_GET['id'])));
}

if ($_FILES['img2']['name'] != "") {

    $url = Static_Operation :: UploadImage($_FILES['img2']['tmp_name'], '../Uploads/', $_FILES['img2']['name']);

    $db->Update(TABLE_BLOG, array('images' => $url), array(array('where', 'id', $_GET['id'])));
}

if ($_FILES['img3']['name'] != "") {

    $url = Static_Operation :: UploadImage($_FILES['img3']['tmp_name'], '../Uploads/', $_FILES['img3']['name']);

    $db->Update(TABLE_BLOG, array('page_image' => $url), array(array('where', 'id', $_GET['id'])));
}


header('Location:blog.php?id=' . $_GET['id']);
}
?>

<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>BLOG</title>



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

                    <h1 class="page-header">Manage Blog

                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal" style="float:right">Add Blog</button>

                        <?php if (isset($_GET['id']) && !empty($_GET['id'])) { ?> <a href="blog.php?del_id=<?= $_GET['id'] ?>" style="float:right; margin-right:10px;margin-top:-5px" onclick="return confirm_delete()"><button class="btn btn-danger">Delete This Blog</button></a><?php } ?></h1>



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

                                    Choose Blog

                                </div>

                                <div class="panel-body"> 

                                    <form role="form" method="get" action="">

                                        <div class="form-group">

                                            <label>Choose Blog</label>

                                            <select class="form-control" name="id" onChange="this.form.submit();">

                                                <option value="">Choose a Page</option>

                                                <?php
                                                $db->Fetch(TABLE_BLOG, NULL, NULL);

                                                foreach ($db->Data as $v) {
                                                    ?>

                                                    <option value="<?= $v['id']; ?>" <?php
                                                    if ($v['id'] == @$_GET['id']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?= $v['blog_name']; ?></option>

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
                                    ?> onClick="status1('<?=TABLE_BLOG;?>','status','<?= $_GET['id']?>')" > Check To Publish 

                                </div>
                                <form role="form" method="post" action="blog.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
                                    <div class="panel-body"> 





                                        <div class="row">

                                            <div class="col-lg-6">

                                                <div class="form-group">

                                                    <label>Blog Name</label>

                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="fa fa-paperclip"></i>

                                                        </span>

                                                        <input class="form-control" name="blog_name" value="<?= @$pages['blog_name']; ?>">

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label>Page Heading</label>

                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="fa fa-leaf"></i>

                                                        </span>

                                                        <input class="form-control" name="title" value="<?= @$pages['title']; ?>">

                                                    </div>

                                                </div>
                                                <div class="form-group">

                                                    <label>Name</label>

                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="fa fa-leaf"></i>

                                                        </span>

                                                        <textarea class="form-control" name="name"><?= @$pages['name']; ?></textarea>

                                                    </div>

                                                </div>



                                                <div class="form-group">

                                                    <label>Url</label>

                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="fa fa-link"></i>

                                                        </span>

                                                        <input class="form-control" name="url" onChange="callurl(this.value);" id="pageurl"  value="<?= @$pages['url']; ?>" required>

                                                    </div>

                                                    <p style="display:none" id="msg"></p>

                                                </div>
                                                <div class="form-group">
                                                    <label>AMP Url</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-link"></i>
                                                        </span>
                                                        <input class="form-control" name="amp_url"  value="<?= @$pages['amp_url']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <label>Date</label>

                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>

                                                        </span>

                                                        <input type="text" class="form-control from_date" s name="datee" value="<?= @$pages['datee']; ?>" required>

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label>Banner</label>

                                                    <input type="file" name="img">

                                                    <input type="hidden" name="banner" value="<?= $pages['banner']; ?>"><br>

                                                    <div id="img<?= $pages['id']; ?>">

                                                        <?php if ($pages['banner']) { ?>

                                                        <img src="<?=
                                                        UPLOADS_PATH;
                                                        echo $pages['banner'];
                                                        ?>" height="150px">

                                                        <a href="javascript:" class="btn btn-danger" style="margin-top:95px !important" onClick="removeimg('<?= TABLE_BLOG; ?>', 'img<?= $pages['id']; ?>', '<?= $pages['id']; ?>', 'banner')">Remove</a>

                                                        <?php } ?></div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label>Image Tag</label>

                                                        <input class="form-control" name="img_tags" value="<?= @$pages['img_tags']; ?>">



                                                    </div>



                                                </div>

                                                <!-- /.col-lg-6 (nested) -->

                                                <div class="col-lg-6">



                                                    <div class="form-group">

                                                        <label>Page Title</label>

                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="fa fa-text-width"></i>

                                                            </span>

                                                            <input class="form-control" name="meta_name"  value="<?= @$pages['meta_name']; ?>">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label>Meta Keywords</label>

                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="fa fa-key"></i>

                                                            </span>

                                                            <input class="form-control" name="meta_keywords"  value="<?= @$pages['meta_keywords']; ?>">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label>Meta Description</label>

                                                        <textarea class="form-control"  name="meta_description" rows="5"><?= @$pages['meta_description']; ?></textarea>

                                                    </div>

                                                    <div class="form-group">

                                                        <label>Image</label>

                                                        <input type="file" name="img2">

                                                        <input type="hidden" name="images" value="<?= $pages['images']; ?>"><br>

                                                        <div id="imge<?= $pages['id']; ?>">

                                                            <?php if ($pages['images']) { ?>

                                                            <img src="<?=
                                                            UPLOADS_PATH;
                                                            echo $pages['images'];
                                                            ?>" height="150px">

                                                            <a href="javascript:" class="btn btn-danger" style="margin-top:95px !important" onClick="removeimg('<?= TABLE_BLOG; ?>', 'imge<?= $pages['id']; ?>', '<?= $pages['id']; ?>', 'images')">Remove</a>

                                                            <?php } ?></div>

                                                        </div>
                                                        <div class="form-group">

                                                            <label>Image Tag</label>

                                                            <input class="form-control" name="img_text" value="<?= @$pages['img_text']; ?>">



                                                        </div>
                                                        <div class="form-group">

                                                            <label>Page Image</label>

                                                            <input type="file" name="img3">

                                                            <input type="hidden" name="page_image" value="<?= $pages['page_image']; ?>"><br>

                                                            <div id="imga<?= $pages['id']; ?>">

                                                                <?php if ($pages['page_image']) {?>


                                                                <img src="<?=
                                                                UPLOADS_PATH;
                                                                echo $pages['page_image'];
                                                                ?>" height="150px">

                                                                <a href="javascript:" class="btn btn-danger" style="margin-top:95px !important" onClick="removeimg('<?= TABLE_BLOG; ?>', 'imga<?= $pages['id']; ?>', '<?= $pages['id']; ?>', 'page_image')">Remove</a>

                                                                <?php } ?></div>

                                                            </div>

                                                            <div class="form-group">

                                                                <label>Image Tag</label>

                                                                <input class="form-control" name="page_tag" value="<?= @$pages['page_tag']; ?>">



                                                            </div>







                                                        </div> 

                                                        <!-- /.col-lg-6 (nested) -->

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sort Description</label>
                                                        <textarea rows=5 name="sort_description" class="form-control"><?= @$pages['sort_description']; ?></textarea><br>
                                                    </div>

                                                    <!-- /.row (nested) --><textarea name="description"><?= @$pages['description']; ?></textarea><br>



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

                                                <h4 class="modal-title" id="myModalLabel">Add New Page</h4>

                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group">

                                                    <label>Blog Name</label>

                                                    <input type="text"  class="form-control" name="newname" required>

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

                            <script src="//code.jquery.com/jquery-1.10.2.js"></script>

                            <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

                            <script>

                                $(function () {

                                    $(".from_date").datepicker({
                                        dateFormat: 'yy-mm-dd'

                                    });

                                });

                            </script>

                            <!--DATE PICKER-->    



<!-- jQuery-

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->

<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->

<script src="dist/js/sb-admin-2.js"></script>







<script language="javascript" type="text/javascript" src="../Library/tiny_mce/tiny_mce.js"></script>

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

