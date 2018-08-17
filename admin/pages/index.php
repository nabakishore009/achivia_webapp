<?php include("../library/adminconfig.php"); include("../include/link_page.php");

if (!isset($_SESSION['USER'])) {
    session_destroy();
    header('Location:login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Achivia | Home </title>


</head>

<body>

    <div id="wrapper">
       <?php include("../include/nav.php"); ?>
       <?php include("../include/index_data.php"); ?>
   </div>
</body>

</html>
