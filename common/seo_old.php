<?php
$actual_link="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="images/favicon-blue.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon-blue.ico" type="image/x-icon">

  <title><?php echo $seo_r['meta_title'] ?></title>
  <meta name="description" content="<?php echo $seo_r['meta_description'] ?>">
  <meta name="author" content="<?php echo SITEURL?>">
  <?php if(!empty($seo_r['seo_nofollow'])) { ?>
  <meta name="ROBOTS" content="index,follow"/>
  <?php } else { ?>
       <meta name="ROBOTS" content="noindex,nofollow"/>
 <?php }
  ?>
  <meta name="keywords" content="<?php echo $seo_r['meta_keyword'] ?>">
  <link rel="canonical" href="<?php echo $actual_link;?>">
  
  