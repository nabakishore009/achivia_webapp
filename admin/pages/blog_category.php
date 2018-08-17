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
    $db->Delete(TABLE_BLOG_CATEGORY, array(array('where', 'id', $_GET['del_id'])));
    header('Location:blog_category.php');
    }


    if (isset($_GET['id']) && !empty($_GET['id'])) {
    if(isset($success_msg)){  
    ?> <script type="text/javascript">$.post("../library/pagemanipulate.php",function(respond){     
    });</script> <?php
    }
    $db->Fetch(TABLE_BLOG_CATEGORY, NULL, array(array('where', 'id', $_GET['id'])));

    $pages = $db->Data[0];
    }
if (isset($_GET['id']) && !empty($_GET['id'])){
    if (isset($_POST) && !empty($_POST)) {
    if ($db->Update(TABLE_BLOG_CATEGORY, $_POST, array(array('where', 'id', $_GET['id'])))) {
    $_SESSION['success_msg'] = "Successfully Updated";
    } else {

    $_SESSION['success_msg'] = "Successfully Updated"; //if row not effected
    }
    header('Location:blog_category.php?id=' . $_GET['id']);
    }
}
else{
        if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
    if ($db->Insert(TABLE_BLOG_CATEGORY, array('category_name' => $_POST['category_name'],'category_sorder' => $_POST['category_sorder'],'add_date' => TODAY,'ip' => USER_IP))) {
    $_SESSION['success_msg'] = "Successfully Inserted";
    header('Location:blog_category.php');
    } else {

    $_SESSION['error_msg'] = "Insert failed";
    }
    }
}
    ?>

    <!DOCTYPE html>

    <html lang="en">



    <head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Blog Category</title>



    <script type="text/javascript">

    function confirm_delete() {

    return confirm('Are you want to delete this?');

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

    <h1 class="page-header">Manage Blog Category

    <button class="btn btn-success" data-toggle="modal" data-target="#myModal" style="float:right">Add</button>

    <?php if (isset($_GET['id']) && !empty($_GET['id'])) { ?> <a href="blog_category.php?del_id=<?= $_GET['id'] ?>" style="float:right; margin-right:10px;margin-top:-5px" onclick="return confirm_delete()"><button class="btn btn-danger">Delete</button></a><?php } ?></h1>



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

    Choose Category

    </div>

    <div class="panel-body"> 

    <form role="form" method="get" action="">

    <div class="form-group">

    <label>Choose Category</label>

    <select class="form-control" name="id" onChange="this.form.submit();">

    <option value="">Choose Category</option>

    <?php
    $db->Fetch(TABLE_BLOG_CATEGORY, NULL, NULL);

    foreach ($db->Data as $v) {
    ?>

    <option value="<?= $v['id']; ?>" <?php
    if ($v['id'] == @$_GET['id']) {
    echo "selected";
    }
    ?>><?= $v['category_name']; ?></option>

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
    ?> onClick="status1('<?=TABLE_BLOG_CATEGORY;?>','status','<?= $_GET['id']?>')" > Check To Publish 

    </div>
    <form role="form" method="post" action="blog_category.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
    <div class="panel-body"> 





    <div class="row">

    <div class="col-lg-6">

        <div class="form-group">

    <label>Blog Category</label>

    <input type="text"  class="form-control" name="category_name" value="<?= @$pages['category_name']; ?>" required>
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
    </div>
    <div class="col-lg-6">
    <div class="form-group">

    <label>Sort Order</label>

    <input type="number"  class="form-control" name="category_sorder"
    value="<?= @$pages['category_sorder']; ?>" required>

    </div>
    

    </div>
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

    <h4 class="modal-title" id="myModalLabel">Add New Test</h4>

    </div>

    <div class="modal-body">

    <div class="form-group">

    <label>Blog Category</label>

    <input type="text"  class="form-control" name="category_name" required>

    </div>
    <div class="form-group">

    <label>Sort Order</label>

    <input type="number"  class="form-control" name="category_sorder" required>

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

    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>



    <!-- jQuery-

    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->

    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->

    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->

    <script src="dist/js/sb-admin-2.js"></script>








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

