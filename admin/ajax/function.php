<?php 
	include("../library/adminconfig.php");
	$db= new Db_Operation();
if(isset($_POST['choice']) && $_POST['choice']=="pageurl"){

    $str=$_POST['pageurl'];
    $str = str_replace("%", "-", $str);
    $str = preg_replace('/\s\&+/', '-', $str);
    $str = preg_replace("/\s/", "-", $str);
    $str = preg_replace('/\-\-+/', '-', $str);
    $str = str_replace("(", "-", $str);
    $str = str_replace(")", "-", $str);
    $str = str_replace("(", "-", $str);
    $str = str_replace(")", "_", $str);
    $str = str_replace("_", "-", $str);
    $str = str_replace("&", "-", $str);
    $str = str_replace("'", "-", $str);
    $str = preg_replace('/\-\-+/', '-', $str);
    $str = ltrim($str, '-');
    $str = rtrim($str, '-');
    $str = strtolower($str);
    print  $str;
	print "|";
	$db->Fetch(TABLE_BLOG_MNG,NULL,array(array('where','url',$str)));
	print $db->DataCount;
	$db->Fetch(TABLE_SERVICES,NULL,array(array('where','url',$str)));
	print $db->DataCount;
	$db->Fetch(TABLE_ALL_PAGES,NULL,array(array('where','url',$str)));
	print $db->DataCount;

	exit;
}


if(isset($_POST['id']) && $_POST['image_url']!=""){
	print $fname=$_POST['image_url'];
	if($db->Delete(TABLE_TOURS_IMAGE,array(array('where','id',$_POST['id']))))
	{
	$uploadDir =UPLOAD_DIR;
    $thumbnailDir = UPLOAD_DIR_THUMB;
    @unlink($uploadDir . $fname);
    @unlink($thumbnailDir . $fname);
	}
}

if(isset($_POST['choice']) && $_POST['choice']=="deleteimg"){

	$db->FetchSingle($_POST['table'],$_POST['field'],array(array('where','id',$_POST['id'])));
	$img=$db->DataStr;
	
	$uploadDir =UPLOADS_PATH;
	if($db->Update($_POST['table'],array($_POST['field']=>''),array(array('where','id',$_POST['id'])))){
	@unlink("../Uploads/".$img);
	}
}



if(isset($_POST['checkunique']) && $_POST['checkunique']=="checkunique"){
	if(isset($_POST['id']) && !empty($_POST['id'])){
	$db->Fetch($_POST['Table'],NULL,array(array('where',$_POST['col_name'],$_POST['field_val']),array('and',$_POST['col_name'].' !',$_POST['col_id'])));
	print $db->DataCount;
	}else{
	$db->Fetch($_POST['Table'],NULL,array(array('where',$_POST['col_name'],$_POST['field_val'])));
	print $db->DataCount;
	}
}



if(isset($_POST['password']) && !empty($_POST['password'])){
	
	$password=md5($_POST['password'].SALT);
	$db->Fetch(TABLE_USER,NULL,array(array('where','password',$password),array('and','id',$_SESSION['USER']['id'])));
	print $db->DataCount;
	
}

?>

