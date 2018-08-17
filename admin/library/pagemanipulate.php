<?php include("adminconfig.php");
$db=new Db_Operation();
function getCmsPageurl($pageid) {

	$db=new Db_Operation();

    $db->FetchSingle(TABLE_ALL_PAGES,'url',array(array('where','id',$pageid)));

    return $db->DataStr;

}



$filename = '../../.htaccess';

$accesscontent="";

$accesscontent .= "RewriteEngine on 

RewriteCond %{REQUEST_FILENAME} !-f  

ErrorDocument 404 ".WEB_ADDRESS."404.php

RewriteRule ^admin/.*$ - [PT]

#RewriteRule ^([^\.]+)$ $1.php 

#Top Links

#RewriteCond %{HTTP_HOST} !^www.
#RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [R=301,L]

<IfModule mod_expires.c>
ExpiresActive On
ExpiresDefault 'access plus 10 days'
ExpiresByType text/css 'access plus 1 week'
ExpiresByType text/plain 'access plus 1 month'
ExpiresByType image/gif 'access plus 1 month'
ExpiresByType image/png 'access plus 1 month'
ExpiresByType image/jpeg 'access plus 1 month'
ExpiresByType application/x-javascript 'access plus 1 month'
ExpiresByType application/javascript 'access plus 1 week'
ExpiresByType application/x-icon 'access plus 1 year'
</IfModule>

";



//normal pages



$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('1'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ index.php [NC,L]\n";
//404 page setting
$accesscontent= $accesscontent. "RewriteRule ^404/?$ 404.php [NC,L]\n";
// $team_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('12'));
// $accesscontent = $accesscontent . "RewriteRule ^{$team_pgurl}/?$ team.php [NC,L]\n";

// $blog_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('13'));
// $accesscontent = $accesscontent . "RewriteRule ^{$blog_pgurl}/?$ blog.php [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('3'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ services.php [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('4'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ blog.php [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('5'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ contactus.php [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('6'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ test_preparation.php [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('7'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ page.php?id=7 [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('8'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ page.php?id=8 [NC,L]\n";
$home_pgurl = Static_Operation :: removeSpchar(getCmsPageurl('9'));
$accesscontent = $accesscontent . "RewriteRule ^{$home_pgurl}/?$ register.php [NC,L]\n";

$db->Fetch(TABLE_BLOG_MNG,NULL,NULL);
	foreach($db->Data as $v)
	{
			$url=Static_Operation :: removeSpchar($v['url']);
			if($url){
			$accesscontent = $accesscontent . "RewriteRule ^blog/".$url."/?$ blog_details.php?id=".$v['id']."  [QSA]\n";
			
			}
	}
    $db->Fetch(TABLE_BLOG_CATEGORY,NULL,NULL);
    foreach($db->Data as $v)
    {
            $url=Static_Operation :: removeSpchar($v['url']);
            if($url){
            $accesscontent = $accesscontent . "RewriteRule ^".$url."/?$ blog.php?id=".$v['id']."  [QSA]\n";
            }
    }
$db->Fetch(TABLE_SERVICES,NULL,NULL);
    foreach($db->Data as $v)
    {
            $url=Static_Operation :: removeSpchar($v['url']);
            if($url){
            $accesscontent = $accesscontent . "RewriteRule ^services/".$url."/?$ services.php?id=".$v['id']."  [QSA]\n";
            }
    }
    $db->Fetch(TABLE_COUNTRY,NULL,NULL);
    foreach($db->Data as $v)
    {
            $url=Static_Operation :: removeSpchar($v['page_url']);
            if($url){
            $accesscontent = $accesscontent . "RewriteRule ^country/".$url."/?$ university.php?id=".$v['id']."  [QSA]\n";
            }
    }
        $db->Fetch(TABLE_TEST_PREPARATION,NULL,NULL);
    foreach($db->Data as $v)
    {
            $url=Static_Operation :: removeSpchar($v['page_url']);
            if($url){
            $accesscontent = $accesscontent . "RewriteRule ^test-preparation/".$url."/?$ test_details.php?id=".$v['id']."  [QSA]\n";
            }
    }
// //$accesscontent 	=	$accesscontent."ErrorDocument 404 /sunset_safari/404.php";







fopen($filename, 'w');

if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'w+')) {
        print "Cannot open file ($filename)";
        exit;
    }
    // Write $somecontent to our opened file.

    if (fwrite($handle, $accesscontent) === FALSE) {
        print "Cannot write to file ($filename)";
        exit;
    }
    fclose($handle);
} else {
    print "The file $filename is not writable";
}
//***************************************************************************************

?>
