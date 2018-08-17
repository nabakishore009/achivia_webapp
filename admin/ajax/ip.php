<?php
include("../library/adminconfig.php");
$db = new Db_Operation();
if (isset($_POST['choice']) && $_POST['choice'] == "ip"){
// $db->Fetch(TABLE_USER_TRACK,array('ip_block,id'),array(array('where','ip_addr',USER_IP)),"order by id desc limit 1");
//  $pages=$db->Data[0];
// 	if($pages['ip_block']==0){
//        echo "blocked";
// 	}
// 	else{
$location = file_get_contents('http://freegeoip.net/json/'.USER_IP);
 $loc=(array)json_decode($location);
$db->Insert(TABLE_USER_TRACK,array('ip_addr'=>USER_IP,'country'=>$loc['country_name'],'region_name'=>$loc['region_name'],'city'=>$loc['city'],'date_time'=>TODAY,'datee'=>TODAY,'ip_block'=>1));
//	}
}


?>