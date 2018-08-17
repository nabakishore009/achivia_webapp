<div class="footer-top"> 
  <div class="container">
    <!-- Row1 -->
    <div class="row">
      <div class="col-md-6">
        <h2>Looking to study abroad?</h2>
      </div>
      <div class="col-md-6">
		<div class="looking">
        <a href="<?php echo SITEURL?>contactus.php" class="btn-border">Contact us for a free quote</a> 
		</div>
    </div>
  </div>
  <!-- Row1 -->
</div>  
</div>
<!-- Footer Top -->

<!-- Footer -->
<div class="footer-section"> 
  <div class="container">
    <!-- Row1 -->
    <div class="row border-bottom">
      <div class="col-md-5">
        <div class="about-footer padding-bottom-60">
         <h5>About Us</h5>
         <p> Achivia opens the door to personal growth and career development by placing students in
           <span><a href='<?php echo SITEURL;?>page.php?pid=8'><i>Read more..</i></a></span>
         </p>
         <div class="social-icon">
           <ul>
		   <?php
		   $socialicons=getallrows(executeQuery($conn,"select * from mng_sociallinks WHERE show_in_footer=1"));
		   foreach($socialicons as $social){ ?>
			 <li><a href="<?php echo $social['link_url'];?>"><div class="<?php echo $social['footer_code'];?>"></div></a></li>
               
		 <?php  }
		   ?>
             
           </ul>
         </div>
       </div>
     </div>
     <div class="col-md-2">
      <div class="info-footer padding-bottom-60">
       <h5>information</h5>
       <ul>
         <li><a href="<?php echo SITEURL;?>">Home</a></li>
         <li><a href="<?php echo SITEURL;?>page.php?pid=8">About Us</a></li>
         <li><a href="<?php echo SITEURL;?>services.php">Services</li>
         <li><a href="<?php echo SITEURL;?>blog.php">Blog</li>
         <li><a href="#">Careers</a></li>
       </ul>
     </div>
   </div>
   <div class="col-md-2">
     <div class="info-footer padding-bottom-60">
       <h5>Navigations</h5>
       <ul>
         <li><a href="#">Gallery</a></li>
         <li><a href="#">Apply Online</a></li>
         <li><a href="#">Universities</a></li>
         <li><a href="<?php echo SITEURL;?>contactus.php">Contact Us</a></li>
       </ul>
     </div>
   </div>
   <div class="col-md-3">
     <div class="subs-footer padding-bottom-60">
      <h5>subscribe to our latest news</h5>
      <form id="form1" name="form1" method="post" action="">
       <input name="textfield" id="textfield" placeholder="Type your email" class="border-field" type="text">
       <input name="button" id="button" class="news-btn" value="Submit" type="submit">
     </form>
   </div>
 </div>
</div>
<!-- Row1 -->

<!-- Row2 -->
<div class="row">
  <div class="col-md-6">
   <div class="copy-left">
    <p>&copy; <?php echo date("Y");?> achivia.com,  All Rights Reserved.</p>
  </div>
</div>
<div class="col-md-6">
  <div class="copy-right">
    <p>Powered by <a href="https://inflexi.com/">INFLEX</a></p>
  </div>
</div>
</div>
<!-- Row2 -->
</div>  
</div>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-596869f5bc14f9df"></script> 