<?php
include("../library/adminconfig.php");
session_destroy();
header('Location:login.php');
?>