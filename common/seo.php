<?php
// $actual_link="https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$seo_r['og_url']="https://www.achivia.in/images/achivia_test.jpg";
?>
 <title><?php echo $seo_r['meta_title'] ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name='description' content='<?php echo $seo_r['meta_description'] ?>' />
<meta name='keywords' content="<?php echo $seo_r['meta_keyword'] ?>">
 <?php if(!empty($seo_r['seo_nofollow'])) { ?>
<meta name='robots' content='index,follow,archive,imageindex,snippet,noodp,noydir' />
<?php } else { ?>
       <meta name="ROBOTS" content="noindex,nofollow"/>
 <?php }
  ?>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />

<link rel="shortcut icon" href="https://www.achivia.in/images/favicon.png" type="image/x-icon">

<meta name="rating" content="General"> 
<meta name="audience" content="All"> 
<meta name="doc-type" content="Web Page"> 
<meta name="doc-class" content="Published">
<meta property="og:locale" content="en_US" />
<meta property='og:title' content='<?php echo $seo_r['meta_title'] ?>' />
<meta property='og:type' content='Website' />
<meta property='og:image:width' content='1200' />
<meta property='og:image:height' content='630' />

<meta property="og:image" content="<?php echo $seo_r['og_url'];?>" />
<meta property='og:image:type' content='image/jpeg' />
<meta property='og:publisher' content='Achivia' />
<meta property='og:site_name' content='Achivia' />
<meta property='og:description' content='<?php echo $seo_r['meta_description'];?>' />
<meta name='twitter:card' content='summary'>
<meta name='twitter:site' content='Achivia'>
<meta name='twitter:title' content='Homepage- Carousel Test'>
<meta name='twitter:description' content='<?php echo $seo_r['meta_description'] ?>'>
<meta name='twitter:url' content='http://www.achivia.in/'>