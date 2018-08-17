<?php
include("library/adminconfig.php");
$db = new Db_Operation();
if (!empty($_GET['id'])) {
   $db->Fetch(TABLE_BLOG_MNG,NULL,NULL," where id=".$_GET['id']);
$seo_r=$db->Data[0];
// $page_name='abc';
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php include("common/seo.php");?>
 <?php include("common/stylesheet.php");?>
  <!-- slider -->

</head>
<body>

  <!-- Hearder -->
 <?php include("common/header.php");?>
<!-- Hearder -->

<!-- Top Menu -->
<?php include("common/menu.php");?>

<!-- Top Menu -->

<!-- banner -->

<div class="about-us-banner">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
      <h2><?php echo $seo_r['blogname'];?></h2>
		 
      <ul>
      <a href="<?php echo WEB_ADDRESS;?>"><li>Home / </li></a> 
      <a href="<?php echo WEB_ADDRESS;?>blog"><li>Blog / </li></a>
     <a href="<?php echo WEB_ADDRESS ?>blog/<?php echo $seo_r['url']; ?>"> <li><?php echo ucwords(strtolower($seo_r['blogname']));?></li></a>
		 
       <ul>
       </div>
     </div>
   </div>
 </div>
 
 <!-- banner -->

 <!-- body -->

 <div class="blog-body">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
         
      <div><!-- left-side-body -->
          <div class="padding-bottom-30">
            <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$seo_r['blogimage']; ?>&w=848&h=440" class="img-responsive">
          </div> 
          <div class="blog-text">
           <h2><?php echo $seo_r['blogname'];?></h2>
        
           <div class="heading-bottom padding-bottom-30">
            <ul>
              <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>By Admin</a></li>
              <!--<li><a href="#"><i class="fa fa-tags" aria-hidden="true"></i>Business</a></li>-->
            </ul>
          </div>
         <div class="text-desc"> <?= html_entity_decode(strip_tags(html_entity_decode(@$seo_r['description'])));?>
             </div>
        </div>
       <?php /* ?> <div class="blog-social-icon padding-bottom-30">
          <ul>
            <li>Share This:</li>
             <?php foreach ($social_query as $socialicon){
               ?>
            <li><a href="#"><i class="<?php echo $socialicon['site_code'];?>" aria-hidden="true"></i></a></li>
            
             <?php } ?>
          </ul>
        </div><?php */ ?>
      </div>
          
          <!-- left-side-body -->
    </div>
        
<?php include("common/blog_sidebar.php");?>
        
 </div><!-- firstrow -->
</div>
</div>

<!-- body -->

<!-- Footer Top -->
<?php include("common/footer.php");?>
<!-- Footer -->

<!-- navAccordion -->
<script src="js/navAccordion.min.js"></script>
<script>
  jQuery(document).ready(function(){

      //Accordion Nav
      jQuery('.mainNav').navAccordion({
        expandButtonText: '<i class="fa fa-plus"></i>',  //Text inside of buttons can be HTML
        collapseButtonText: '<i class="fa fa-minus"></i>'
      }, 
      function(){
        console.log('Callback')
      });
      
    });
  </script>
  <!-- navAccordion -->


</body>
</html>