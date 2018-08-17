<?php
include("includes/Db_Config.php");
if($_GET['rid']){
	$_SESSION['rid']=$_GET['rid'];
        $seo_r=getsinglerow(executeQuery($conn,"select * from mng_cmspages where id={$_GET['rid']}"));
} else {
  $seo_r=getsinglerow(executeQuery($conn,"select * from mng_cmspages where id=12"));
}
$_SESSION['page_heading']=$seo_r['page_heading'];
?>
<!DOCTYPE html>
<html lang="en">
<head><?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
		  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

  <!-- Hearder -->
   <?php include("common/header.php"); ?>
<!-- Hearder -->

<!-- Top Menu -->
  <?php include("common/menu.php"); ?>

<!-- Top Menu -->

<!-- banner -->

<div class="about-us-banner">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
      <h2><?php if(!empty( $seo_r['page_heading'])) { echo $seo_r['page_heading']; } ?></h2>
      <ul> 
       <li>Home / </li> 
       <li><?php if(!empty( $seo_r['page_heading'])) { echo $seo_r['page_heading']; }?></li>
       <ul>
       </div>
     </div>
   </div>
 </div>

 <!-- banner -->

 <!-- body -->
 <div class="bout-text1">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
	  <?php if ($_COOKIE['msg']) { ?>  
            <!--message-->
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" onClick="$('.alert').hide('slow');">&times;</a>
                <strong>Notification!</strong> <?php print $_COOKIE['msg']; ?>
            </div>
            <!--message-->
         <?php } ?>
        <!-- booking form -->
        <div class="banner-form2">
          <div class="banner-form2-header"><h2><?php if(!empty( $seo_r['page_heading'])) { echo $seo_r['page_heading']; } else { echo "Register with us"; }?></h2></div>
          <div class="banner-form2-body">
            <form id="form1" name="form1" method="post" action="process.php">
			<input type="hidden" name="stage" value="registration">
             <div class="row"> 
               <div class="col-md-6 padding-5a">
                 <input type="text" name="name" id="name" placeholder="Full Name" />
               </div>
               <div class="col-md-6 padding-5a">
                 <input type="text" name="email" id="email" placeholder="Email Id" />
               </div>    
               <div class="col-md-6 padding-5a">
                 <input type="text" name="phone" id="phone" placeholder="Contact no" />
               </div>
               <div class="col-md-6 padding-5a">
                 <input type="text" name="intake" id="intake" placeholder="Intake" />
               </div>
               <div class="col-md-6 padding-5a">
                 <div class="dropdown2">
                  <select name="interested_course" class="dropdown-select2">
                     <option value="0">Course Interested In</option>
					 <?php 
					 $courses_sql=executeQuery($conn,"select id,subcategory_id,category_name from mng_services where subcategory_id=6");
					 while($courses=getsingleRow($courses_sql)){ ?>
						 <option value="<?php echo $courses['category_name'];?>"><?php echo $courses['category_name'];?></option>
					<?php }
					 ?>
					 ?>
                    
                  </select>
                 </div>
               </div>
               <div class="col-md-6 padding-5a">
                 <div class="dropdown2">
                  <select name="interested_country" class="dropdown-select2">
                     <option value="0">Country Interested In</option>
					 <?php
					 $country_namesql=executeQuery($conn,"select id,country_name from mng_country");
					 while($country=getsinglerow($country_namesql)){ ?>
						 <option value="<?php echo $country['country_name'];?>"><?php echo $country['country_name'];?></option>
				<?php	 }
					 ?>
                   </select>
                 </div>
               </div>                   
               <div class="col-md-12 padding-5a">
                 <textarea name="message" id="textarea" cols="45" class="textarea-height" placeholder="Mandatory Details"></textarea>
               </div>
             </div>
             <div class="row" style="margin-top: 5px;">
              <div class="col-md-3  padding-5">
              <div class="row"><div class="col-md-3 padding-bottom-5">
                                                       <div class="g-recaptcha" data-sitekey="6LcjhCoUAAAAADB5yZhIdWJnDsX8ngzc-DR3kNji" style="transform:scale(0.78);transform-origin:0 0"></div></div>
                                            </div>       <input name="button" id="button" class="button-submit" value="Submit" type="submit">
               </div>
             </div>
           </form>
         </div>
       </div>
       <!-- booking form -->
     </div>
     <div class="col-md-4">
       <!-- Accordion -->
       <div class="sitebar margin-top-0px">
        <div class="sitebar-header">
          <h2>Our Services</h2>
        </div>
        <div class="tab-image"><img src="images/serice-tab.png" class="img-responsive" alt="logo"></div>
        <div class="sitebar-body">    
         <!-- Navigation -->
       <nav class="mainNav">
            <ul>
                <li><a href="<?php echo SITEURL ?>">Home</a></li>
                <?php
                $cms_sql = executeQuery($conn, "select * from mng_cmspages limit 1 offset 2");
                while ($aboutus = getsingleRow($cms_sql)) {
                    ?>
                    <li><a href="<?php echo SITEURL ?>page.php?pid=<?php echo $aboutus['id']; ?>"><?php echo ucwords($aboutus['page_name']); ?></a></li>
                <?php }
                ?>
                <li><a href="services.php">Our Services</a>
                    <ul>
                        <?php
                        $cat_sql = executeQuery($conn, "select * from mng_services where subcategory_id=2");
                        while ($services = getsingleRow($cat_sql)) {
                            $has_submenu = getTotalrows(executeQuery($conn, "select * from mng_services where subcategory_id={$services['id']}"));
                            ?>
                            <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services['id']; ?>"><?php echo $services['category_name']; ?></a>

                                <?php
                                $cat_sql1 = executeQuery($conn, "select * from mng_services where subcategory_id={$services['id']}");
                                $has_submenu1 = getTotalrows($cat_sql1);
                                if ($has_submenu1 > 0) {
                                    print "<ul>";
                                    while ($services1 = getsingleRow($cat_sql1)) {
                                        ?>
                                    <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services1['id']; ?>"><?php echo $services1['category_name']; ?></a>

                                        <?php
                                        $cat_sql2 = executeQuery($conn, "select * from mng_services where subcategory_id={$services1['id']}");
                                        $has_submenu2 = getTotalrows($cat_sql2);
                                        if ($has_submenu2 > 0) {
                                            print "<ul>";
                                            while ($services2 = getsingleRow($cat_sql2)) {
                                                ?>
                                            <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services2['id']; ?>"><?php echo $services2['category_name']; ?></a>

                                                <?php
                                                $cat_sql3 = executeQuery($conn, "select * from mng_services where subcategory_id={$services2['id']}");
                                                $has_submenu3 = getTotalrows($cat_sql3);
                                                if ($has_submenu3 > 0) {
                                                    print "<ul>";
                                                    while ($services3 = getsingleRow($cat_sql3)) {
                                                        ?>
                                                    <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services3['id']; ?>"><?php echo $services3['category_name']; ?></a></li>

                                                <?php } ?> </ul>
                                        <?php } ?>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        <?php }
                        ?>
                        </li>

                    <?php } ?> 
                    </ul><?php } ?>     </li>  

            <?php } ?></ul> 

            </li>
            <li><a href="#">Universities</a>
                <ul>
                    <?php
                    $country_sql = executeQuery($conn, "select * from mng_country");
                    while ($country = getsingleRow($country_sql)) {
                        ?>
                        <li><a href="university.php?cid=<?php echo $country['id']; ?>"><?php echo $country['country_name']; ?></a>
                            <ul>
                                <?php
                                $country_sql_pointer = executeQuery($conn, "select * from mng_countrypagedetails where cid={$country['id']}");
                                while ($pointer = getsingleRow($country_sql_pointer)) {
                                    ?>
                                    <li><a href="#pointer<?= $pointer['id'] ?>" style="text-transform: capitalize"><?php echo strtolower($pointer['pointer']) ?></a></li>
                                    <?php } ?>
                            </ul>
                        </li>

                    <?php }
                    ?>

                </ul>
            </li>
            <li><a href="blog.php">Blogs</a></li>
            <li><a href="#">Career</a>
                <ul>
                    <li><a href="#">Internship</a></li>
                </ul>
            </li>
            <li><a href="#">Gallery</a>
                <ul>
                    <li><a href="<?php echo SITEURL?>gallery.php">Events & Upcoming University visits</a></li>
                </ul>
            </li>
            <li><a href="<?php echo SITEURL;?>register_page.php">Apply Online</a>
                <ul>
                    <?php
                    $form_name_r = executeQuery($conn, "select * from mng_cmspages where id in(9,10,11)");
                    while ($formname = getsingleRow($form_name_r)) { ?>
					<li><a href="<?php echo SITEURL?>register_page.php?rid=<?php echo $formname['id'];?>"><?php echo $formname['page_heading'];?></a></li> 
		
				<?php	}	?>
                 
                </ul>
            </li>
            <li><a href="contactus.php">Contact us</a></li>
            </ul>
        </nav>
  <!-- Navigation -->
</div>
</div>
<!-- Accordion -->
</div>
<br>
</div><!-- row end-1 -->
<div class="row">
<div class="col-md-8">
<div class="register-page" style="padding-top:10px !important">
       <?php echo $seo_r['contents'];?>
          </div>
      </div>    
</div><!-- row end-2 -->

</div>
</div> 
<!-- body -->

<!-- Footer Top -->
   <?php include("common/footer.php"); ?>
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

 <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
                                <script type="text/javascript">
                                $(function () {
                                    $("#form1").validate({
                                        rules: {
                                            name: "required",
                                            email: {
                                                required: true,
                                                email: true
                                            },
                                            phone: {
                                                required: true,
                                                number: true
                                            },
											intake:"required",
                                           interested_course: "required",
                                         interested_country: "required",
                                            message: "required"

                                        },
                                        messages: {
                                            fname: "please enter your name",
                                            email: "please enter your email address",
                                            phone: "please enter your phone number",
                                            interested_course: "please enter your company",
											interested_country: "please enter your company",
                                            message: "plaese enter your message"
                                        },
                                        submitHandler: function (form) {
                                            if (grecaptcha.getResponse().length == 0)
                                                {
                                                    alert("Confirm captcha");
                                                    return false;
                                                } else {
                                                   form.submit();
                                                }
                                        }
                                    });
                                });
                                function submitForm() {
                                    $('#form1').submit();
                                }
                            </script>
</body>
</html>