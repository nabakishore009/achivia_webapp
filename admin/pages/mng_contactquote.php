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

  <title>Manage Contact</title>
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

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              CONTACT DETAILS
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">


              <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Phn No</th>
                      <th>Email</th>
                      <th>Message</th>
                      <th>Course</th>
                      <th>Date</th>
                      <th>Country</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $xx=1;
                    $db->Fetch(TABLE_CONTACT_QUERY,NULL,NULL," order by id DESC");
                    foreach($db->Data as $v){
                      ?>                                    
                      <tr class="odd gradeX" id="row<?= $xx;?>">
                        <td align="center"><?= $xx?></td>
                        <td align="center"><?= $v['fname']?></td>
                        <td align="center"><?= $v['phone']?></td>
                        <td align="center"><?= $v['email']?></td>
                        <td align="center"><?= $v['msg']?></td>
                        <td align="center"><?= $v['course']?></td>
                        <td align="center"><?= $v['date']?></td>
                        <td align="center"><?= $v['preferred_country']?></td>

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
  </body>

  </html>
