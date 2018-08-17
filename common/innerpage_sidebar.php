
<?php
if (isset($_POST['fname'])) {
      if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
       
    } else {
        Static_Operation::Data_clean();
    $fname =  $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $preferred_country =$_POST['preferred_country'];
        $intake_year = $_POST['intake_year'];
        $apply_date = TODAY;

      
          $msg = $_POST['message'];
        $sample_msg = ' <table width="570" border="0" cellpadding="5" cellspacing="1" >
  
                
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>&nbsp;Full Name :</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $fname . '</td>
        </tr>       
        <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Email :</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $email . '</td>
        </tr>
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Phone :</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $phone . '</td>
        </tr>
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Course :</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $_POST['course'] . '</td>
        </tr>
               <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Preferred country:</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $preferred_country . '</td>
        </tr>
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Intake Year:</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $intake_year . '</td>
        </tr>
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Message:</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $msg . '</td>
        </tr>
                <td width="184" height="0"></td>
                  <td width="102"></td>
                  </tr>
                </table>';

$ip=USER_IP;
  // $insertsql = "insert into mng_contactquery set page_type='home',fname='{$fname}',email='{$email}',phone='{$phone}',msg='{$msg}',courses='{$course}',preferred_country='{$preferred_country}',intake_year='{$intake_year}',ip='{$ip}',add_date='{$add_date}'"; 
   //$db->runSql($insertsql);
   $subject=" Inner-form Result ";
   //$admin_mail = "nabakishore@inflexi.com";
   $body = $sample_msg;
      $admin_mail = "education@achivia.in";
        if (Static_Operation :: sendmail($body, $subject, $admin_mail, $fname, $admin_mail)) {
        $db->Insert("mng_contactquery",array('page_type'=>'home','fname'=>$fname,'email'=>$email,'phone'=>$phone,'msg'=>$msg,'courses'=>$course,'preferred_country'=>$preferred_country,'intake_year'=>$intake_year,'ip'=>$ip,'add_date'=>$apply_date));
    $msg = "Your message has been sent. Thank you! ";
}
else{
    $msg = "Mail not send. Sorry!!"; 
}
    }
}
?>
<?php if($page_name!="register"){?>
<div class="banner-form2" style="padding-bottom: 25px;">
    <div class="banner-form2-header"><h2 style="text-align:center !important;">Register With Us!</h2></div>
    <div class="banner-form2-body" >
  <center><?php if(isset($msg)){ echo $msg; unset($msg);}?></center>
        <form id="form1" name="form1" method="post" action="">
            <?php if (!empty($_GET['id'])) { ?>
                <input type="hidden" name="countrypage" value="fromcountry" >
            <?php } ?> 
            <?php if (!empty($_GET['id'])) { ?>
                <input type="hidden" name="aboutuspage" value="fromaboutus" class="form-textbox" >
                <input type="hidden" name="pid" value="<?php echo $_GET['id']?>" class="form-textbox" >
            <?php } ?> 
            <div class="row"> 
                <div class="col-md-12 padding-5a">
                    <input type="text" name="fname" id="fname" placeholder="Enter Name" class="form-textbox"  required/>
                </div>    
                <label for="fname" generated="true" class="error1" style="display:none;">please enter your name</label>
                <div class="col-md-6 padding-5a">
                    <input type="email" name="email" id="email" placeholder="Email" class="form-textbox" required/>
                </div>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="phone" id="phone"  placeholder="Phone"  class="form-textbox"  pattern="[0-9]{10}" title="Provide Valid Phone No" required/>
                </div>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="course" id="course"  placeholder="Course Interested"  class="form-textbox"/>
                </div>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="preferred_country" id="preferred_country" placeholder="Preferred Country" class="form-textbox" />
                </div>

                <div class="col-md-12 padding-5a">
                    <input type="text" name="intake_year" id="intake_year" placeholder="Intake Year" class="form-textbox" />
                </div>

                <div class="col-md-12 padding-5a">
                    <textarea name="message" id="msgg" cols="45" class="form-textarea"  placeholder="Enter Message" rows="5"></textarea>


                </div>
                <div class="col-md-12 padding-5">
                    <div class="row">
                        <div class="col-md-1 col-xs-1"><input type="checkbox" name="term_condition" checked="true" ></div>
                        <div class="col-md-10 col-xs-10">I have read and agree to the  <a href="term-condition.php" style="text-decoration: none;" target="_blank">Terms and Conditions</a>
                         <label for="term_condition" generated="true" class="error" style="display:none;"></label>

                        </div>
                    </div>	   

                </div>
            </div>
            <div class="row" style="margin-top: 5px;">
                <div class="col-md-12  padding-5">
                    <center><div class="g-recaptcha position-capcha2" data-sitekey="6LeELCwUAAAAAN-y70Gr99linfUHWGDw3SGFLCE7"></div></center>
                </div>
            </div>
            <div class="row" style="margin-top: 5px;">
                <div class="col-md-12  padding-5">
                    <input type="submit" class="button-submit" value="Register">
                </div>
            </div>
        </form>
    </div>
</div>
<?php }?>
<div class="sitebar">
    <div class="sitebar-header">
        <h2 style="text-align:center ">Study Abroad </h2>
    </div>
    <div class="sitebar-body">        
        <!-- Navigation -->
        <nav class="mainNav">
            <ul>
                <?php
            
$db->Fetch(TABLE_COUNTRY,NULL,NULL," order by id DESC");
foreach($db->Data as $v){
?>
                  

                    <li><a href="<?php echo WEB_ADDRESS ?>country/<?php echo $v['page_url']; ?>"><?php echo (strtoupper($v['country_name'])); ?> </a></li>

                <?php }
                ?>
            </ul>
        </nav>
        <!-- Navigation -->
    </div>
</div>

<div class="sitebar">
    <div class="sitebar-header">
        <h2 style="text-align:center ">Test Preparation</h2>
    </div>
    <div class="sitebar-body">        
        <!-- Navigation -->
        <nav class="mainNav">
          
            <ul>
                           <?php
        
                                    $db->Fetch(TABLE_TEST_PREPARATION,NULL,NULL," where status=1 order by sortorder ASC");
                                     foreach($db->Data as $v){
                                        ?> 
                    <li><a href='<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $v['page_url']; ?>'><?php echo $v['test_name']; ?> </a></li>  
                <?php }
                ?>

            </ul>
          
        </nav>
        <!-- Navigation -->
    </div>
</div>

<div class="news-owlcarousel">
    <div class="row">
        <div class="col-md-12">
            <div class="quick-links margin-bottom">
                <h2>Recent Blogs</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="news-carousel">
                          <?php
            
$db->Fetch(TABLE_BLOG_MNG,NULL,NULL," order by blog_dt desc limit 2 ");
foreach($db->Data as $blog_rec){
?>
                <div class="col-md-12">
                    <div class="news-box">
                        <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$blog_rec['blogimage'];?>&w=371&258" alt="banner">
                        <div class="news-text">
                            <h3><?php echo $blog_rec['blogname']; ?></h3>
                            <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("d M Y", strtotime($blog_rec['blog_dt'])); ?>
                            <?php if (!empty($blog_rec['details'])) { ?><p><?php echo word_limiter(strip_tags($blog_rec['details']), 30); ?></p><?php } ?>
                            <a href='<?php echo WEB_ADDRESS ?>blog/<?php echo $blog_rec['url']; ?>'><h4>Learn More <img src="<?php echo WEB_ADDRESS ?>images/news-butt.png" alt="banner"></h4></a>
                        </div>
                    </div>
                </div>
            <?php }
            ?> 
        </div>
        <div class="services-button">
            <a href="<?php echo WEB_ADDRESS ?>blog" class="btn-service btn-md">VIEW ALL</a> 
        </div>

    </div>
</div>


                            <script>
                                $(document).ready(function () {
                                    $("#news-carousel").owlCarousel({
                                        autoPlay: 3000,
                                        items: 1,
                                        itemsDesktop: [1199, 1],
                                        itemsTablet: [768, 1],
                                        itemsMobile: [479, 1],
                                        pagination: true
                                    });

                                });
                            </script>