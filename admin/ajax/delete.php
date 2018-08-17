	<?php
if(isset($_POST['table']) && isset($_POST['id']))
{
	include_once("../library/adminconfig.php");
include_once("../include/link_page.php"); 
	$db= new Db_Operation();
	if($_POST['table']=="tour_category"){
	    $db->Fetch('tours',NULL,array(array('WHERE','category_id',$_POST['id'])));
		if(($db->DataCount)==0){
			$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		}else{
		print "Please delete Tours under this category and then Delete this category";
		}
	
		}if($_POST['table']=="banner"){
		$db->Fetch('banner',NULL,array(array('where','id',$_POST['id'])));
		foreach($db->Data as $k){
		unlink("../Uploads/".$k['banner']);
		}

		// $db->Delete('tours_image',array(array('WHERE','tour_id',$_POST['id'])));
		// $db->Delete('tour_days',array(array('WHERE','tour_id',$_POST['id'])));
		$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		echo "Deleted Successfully";
		}if($_POST['table']=="testimonials"){
		$db->Fetch('testimonials',NULL,array(array('where','id',$_POST['id'])));
		foreach($db->Data as $k){
		unlink("../Uploads/".$k['image']);
		}
		$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		echo "Deleted Successfully";
		}
		if($_POST['table']=="gallery"){
		$db->Fetch('gallery',NULL,array(array('where','id',$_POST['id'])));
		foreach($db->Data as $k){
		unlink("../Uploads/".$k['image']);
		}
		$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		echo "Deleted Successfully";
		}
       if($_POST['table']=="how_it_works"){
		$db->Fetch('how_it_works',NULL,array(array('where','id',$_POST['id'])));
		foreach($db->Data as $k){
		unlink("../Uploads/".$k['image']);
		}
		$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		echo "Deleted Successfully";
		}
		if($_POST['table']=="mng_blogs"){
		$db->Fetch('mng_blogs',NULL,array(array('where','id',$_POST['id'])));
		foreach($db->Data as $k){
		unlink("../Uploads/".$k['blogimage']);
		}
		$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		echo "Deleted Successfully";
		}
		else{
		$db->Delete($_POST['table'],array(array('WHERE','id',$_POST['id'])));
		}
}


?>