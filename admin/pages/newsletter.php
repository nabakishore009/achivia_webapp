<?php include("../library/adminconfig.php"); include("../include/link_page.php");
if (!isset($_SESSION['USER'])) {
    session_destroy();
    header('Location:login.php');
}

$db=new DB_Operation();
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Newsletter</title>
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
                            Newsletter
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                        
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sl no</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Ip</th>
                                            <th>Country</th>
                                           
                                        </tr>
                                    </thead>
                                                                        <tbody>
<?php $xx=1;
$db->Fetch(TABLE_NEWSLETTER,NULL,NULL," order by id DESC");
foreach($db->Data as $v){
?>                                    
                                        <tr class="odd gradeX" id="row<?= $xx;?>">
                                            <td><?= $xx;  ?></td>
                                           <td align="center"><?= $v['email']?></td>
                                           <td align="center"><?= $v['add_date']?></td>
                                           <td align="center"><?= $v['ip']?></td>
                                            <td align="center"><?= $v['country']?></td>
                                          
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
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

                        



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
        <script type="text/javascript">
            function show_dialog(str){
                $.post("../ajax/model.php",{"choice":"gallery","id":str},function(respond){
                $("#modal-content").html(respond);
                });
            }
        </script>
</body>
 
</html>
