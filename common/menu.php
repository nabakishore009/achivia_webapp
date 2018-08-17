<div class="menu-section"> 
<div class="container">
<div class="row">
<div class="col-md-3">
<div class="logo">
<a href="<?php echo WEB_ADDRESS ?>"><img src="<?php echo WEB_ADDRESS ?>images/logo.png" alt="logo"></a>
</div>
</div>

<div class="col-md-9">
<ul id="jetmenu" class="jetmenu blue">
<li><a href="<?php echo WEB_ADDRESS ?>">Home</a></li>
<li><a href="<?php echo WEB_ADDRESS ?>about">ABOUT US</a></li>


<!-- service start -->
<li><a href="<?php echo WEB_ADDRESS ?>services">Our Services</a>
<div class="megamenu full-width">
<div class="row">
<div class="col-md-12">
<?php
$db->Fetch(TABLE_SERVICES,NULL,NULL," order by id ASC");
foreach($db->Data as $v){
?>

<div class="col-md-3 text-center">
<ul>
  <li class="title uni-img"><a href="<?php echo WEB_ADDRESS ?>services/<?php echo $v['url']; ?>" class="bold">
        <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['images'];?>" alt="<?php echo $v['img_text']; ?>">
      <?php echo $v['services_name']; ?></a>
  </li> 
</ul>
</div>      

<?php } ?>
</div>
</div>
</div>
</li>  
<!-- service end -->
<!-- study Abroad start -->
<li><a href="javascript:">Study Abroad </a>
<div class="megamenu full-width">
<div class="row">
<div class="col-md-12">
<?php
$db->Fetch(TABLE_COUNTRY,NULL,NULL," order by id ASC");
foreach($db->Data as $v){
?>

<div class="col-md-3 text-center">
<ul>
  <li class="title uni-img"><a href="<?php echo WEB_ADDRESS ?>country/<?php echo $v['page_url']; ?>" class="bold">
        <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['image'];?>" alt="<?php echo $v['image_text']; ?>">
      <?php echo $v['country_name']; ?></a>
  </li> 
</ul>
</div>      

<?php } ?>
</div>
</div>
</div>
</li>  
<!-- study Abroad end -->
 
<li><a href="<?php echo WEB_ADDRESS; ?>test-preparation">Test Preparation</a>
<li><a href="<?php echo WEB_ADDRESS; ?>blog">Blog</a></li>
<li><a href="<?php echo WEB_ADDRESS; ?>contact">Contact</a></li>

</ul>
</div>
</div>
</div>
</div>
</div>