<?php 
@session_start();
	
define('ERROR',true);	//for production and compeletion stage
define('SALT','trQwePLm'); // not more than 8 characters before
define('KEY','bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffasd230p');
//define all address
ini_set('display_errors', 'OFF');
ini_set('safe_mode', 'On');//Removed in PHP 5.4.0.
ini_set('safe_mode_gid', 'On');//Removed in PHP 5.4.0.
ini_set('disable_functions', 'php_uname, getmyuid, getmypid, passthru, leak, listen, diskfreespace, tmpfile, link, ignore_user_abord, shell_exec, dl, set_time_limit, exec, system, highlight_file, source, show_source, fpaththru, virtual, posix_ctermid, posix_getcwd, posix_getegid, posix_geteuid, posix_getgid, posix_getgrgid, posix_getgrnam, posix_getgroups, posix_getlogin, posix_getpgid, posix_getpgrp, posix_getpid, posix, _getppid, posix_getpwnam, posix_getpwuid, posix_getrlimit, posix_getsid, posix_getuid, posix_isatty, posix_kill, posix_mkfifo, posix_setegid, posix_seteuid, posix_setgid, posix_setpgid, posix_setsid, posix_setuid, posix_times, posix_ttyname, posix_uname, proc_open, proc_close, proc_get_status, proc_nice, proc_terminate, phpinfo');

ini_set('register_globals', 'ON');//for production Off

ini_set('expose_php', 'Off');//for version
ini_set('Mail.add_x_header', 'Off');//for mail() remove header in mail about file name
ini_set('allow_url_fopen', 'Off');
ini_set('allow_url_include', 'Off');
//server configrutation
define('WEB','phpsecurity');
define('WEB_ADDRESS','https://www.achivia.in/');
define('ADMIN_PATH','https://www.achivia.in/admin/');
define('LIBRARY_PATH','/library/');
define('IMAGE_PATH','/Images/');
define('INCLUDES_PATH','/Includes/');
define('UPLOADS_PATH','https://www.achivia.in/admin/Uploads/');
define('UPLOADS','/admin/Uploads/');
define('ADMIN','/admin/');
define('TIMTHUMB_ADDRESS','https://www.achivia.in/Uploads/');

define('UPLOAD_DIR',$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/Uploads/');
define('UPLOAD_DIR_THUMB',$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/Uploads/thumb/');


define("PHP_SELF",$_SERVER['PHP_SELF']);		//self page address
define("USER_IP",$_SERVER['REMOTE_ADDR']);		//user ip address

date_default_timezone_set('Asia/Calcutta');
//define("TODAY",'2014-09-11 09:00:17');
define("TODAY",date("Y-m-d H:i:s"));
define("DATEE",date("Y-m-d"));
define("TIMEE",date("H:i:s"));
// all messages
$error_no=0;
$Warning='<span class="help-inline">This Field Cannot be Empty.</span>';
//database tables
define('TABLE_USER', 'user_credential');
define('TABLE_USER_CONTACT', 'user_contact');
define('TABLE_USER_TRACK', 'visited_region');
define('TABLE_ABOUT', 'about');
define('TABLE_ALL_PAGES', 'all_pages');
define('TABLE_BANNER', 'banner');
define('TABLE_BLOG', 'blog');
define('TABLE_BLOG_MNG', 'mng_blogs');
define('TABLE_BLOG_CATEGORY', 'mng_blogcategory');
define('TABLE_CONTACT', 'contact');
define('TABLE_GALLERY', 'gallery');
define('TABLE_SERVICES', 'services');
define('TABLE_MNG_SOCIAL', 'social');
define('TABLE_TESTIMONIAL', 'testimonials');
define('TABLE_HOW_IT_WORKS', 'how_it_works');
define('TABLE_TEST_PREPARATION', 'mng_testpreparation');
define('TABLE_SUB_TEST_PREPARATION', 'mng_subtestpreparation');
define('TABLE_UNIVERSITY_LOGOS', 'mng_universitylogos');
define('TABLE_COUNTRY', 'mng_country');
define('TABLE_COUNTRY_DETAILS', 'mng_countrypagedetails');
define('TABLE_NEWSLETTER', 'newsletter');
define('TABLE_CONTACT_QUERY', 'mng_contactquery');
$msg=NULL;
$msg_success='<div class="alert alert-success"><strong>Data !</strong>Successfullly Inserted.</div>';			//msg=1
$msg_warning='<div class="alert alert-error"><strong>Oh snap !</strong>Error Occured While Inserting.</div>';	//msg=2
$msg_update='<div class="alert alert-success"><strong>Data !</strong>Successfullly Updated.</div>';				//msg=3
$msg_delete='<div class="alert alert-error"><strong>Data !</strong>Successfully Deleted.</div>';				//msg=4

	
error_reporting(0);
require_once("DB_Operation.php");	
require_once("Static_Operation.php");
require_once("Validation_rules.php");

function substr_word($body,$maxlength){
    if (strlen($body)<$maxlength) return $body;
    $body = substr($body, 0, $maxlength);
    $rpos = strrpos($body,' ');
    if ($rpos>0) $body = substr($body, 0, $rpos);
    return $body;
}