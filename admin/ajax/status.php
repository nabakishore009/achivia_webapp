
<?php
if(isset($_POST['table']) && isset($_POST['column']) && isset($_POST['id'])) {
include_once("../library/adminconfig.php");
include_once("../include/link_page.php");     $db= new Db_Operation();     $db
->Boolean_Update($_POST['table'],$_POST['column'],array(array('WHERE','id',$_POST['id'])));     
	
}


?>