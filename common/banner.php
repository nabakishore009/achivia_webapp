<?php
if (isset($_POST['stage']) && $_POST['stage'] == "bannerform") {
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
$add_date=TODAY;
  // $insertsql = "insert into mng_contactquery set page_type='home',fname='{$fname}',email='{$email}',phone='{$phone}',msg='{$msg}',courses='{$course}',preferred_country='{$preferred_country}',intake_year='{$intake_year}',ip='{$ip}',add_date='{$apply_date}'"; 
   //$db->runSql($insertsql);
   $subject=" Home-form Result ";
  // $admin_mail = "nabakishore@inflexi.com";
   $body = $sample_msg;
       $admin_mail = "education@achivia.in";
        if (Static_Operation :: sendmail($body, $subject, $admin_mail, $fname, $admin_mail)) {
             $db->Insert("mng_contactquery",array('page_type'=>'home','fname'=>$fname,'email'=>$email,'phone'=>$phone,'preferred_country'=>$preferred_country,'intake_year'=>$intake_year,'ip'=>$ip,'add_date'=>$apply_date));
    $msg = "Your message has been sent. Thank you! ";
}
else{
    $msg = "Mail not send. Sorry!!"; 
}
    }
}
?>
<div class="banner">
    <div class="callbacks_container">      
        <ul class="rslides" id="slider4">            

            <?php
            $db->Fetch(TABLE_BANNER,NULL,NULL," order by sort_order ASC");
foreach($db->Data as $v){
?>
                <li><a href="<?php echo WEB_ADDRESS ?>contactus" style="cursor: pointer"><img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['banner'];?>&w=1500&h=679&zc=3" alt="banner" alt="<?=$v['tag'];?>"></a>
               </li>

            <?php } ?>

        </ul>
    </div>
    <div class="clear"></div>
</div>
<!-- banner section end -->
<!-- banner text start -->
<div class="banner-form">
    <div class="banner-form-header"><h2>Register With Us!</h2></div>
    <div class="banner-form-body">
         <center><?php if(isset($msg)){ echo $msg; unset($msg);}?></center>
        <form id="form1" name="form1" method="post" action="">
            <input type="hidden" name="stage" value="bannerform">
            <div class="row"> 
                <div class="col-md-12 padding-5">
                    <input type="text" name="fname" id="fname" placeholder="Enter Name" class="form-textbox" />
                </div>    
                <div class="col-md-6 padding-5">
                    <input type="text" name="email" id="email" placeholder="Email" class="form-textbox" />
                </div>
                <div class="col-md-6 padding-5">
                    <input type="text" name="phone" id="phone" placeholder="Phone" class="form-textbox" />
                </div>
                <div class="col-md-6 padding-5">
                    <input type="text" name="course" id="course" placeholder="Course Interested" class="form-textbox"/>
                </div>
                <div class="col-md-6 padding-5">
                    <input type="text" name="preferred_country" id="preferred_country" placeholder="Preferred Country"  class="form-textbox"/>
                </div>  
                <div class="col-md-12 padding-5">
                    <input type="text" name="intake_year" id="intake_year" placeholder="Intake Year" class="form-textbox" />
                </div>
                <div class="col-md-12 padding-5">
                    <textarea name="message" id="msgg" cols="45" class="form-textarea" placeholder="Message"></textarea>
                </div>
                <div class="col-md-12 padding-5">
                    <div class="row">
                        <div class="col-md-1 col-xs-1"><input type="checkbox" name="term_condition" checked="checked" value="Car"></div>
                        <div class="col-md-10 col-xs-10">I have read and agree to the  <a href="term-condition.php" style="text-decoration: none;color:#fff;" target="_blank">Terms and Conditions</a><br>
                            <label for="term_condition" generated="true" class="error" style="display:none;"></label>
                        </div>
                    </div>	   

                </div>
            </div>
            <div class="row">
                <div class="col-md-12  padding-5">
                    <!-- 6LcjhCoUAAAAADB5yZhIdWJnDsX8ngzc-DR3kNji-->
                    <div class="captcha_height">
                        <center>
                            <div class="g-recaptcha position-capcha" data-sitekey="6LeELCwUAAAAAN-y70Gr99linfUHWGDw3SGFLCE7"   >
                            </div>
                        </center>
                    </div>

                </div>

            </div>
            <div class="row">

                <div class="col-md-12"> <input type="submit" class="button-submit" value="Submit Request"></div>
            </div>	
        </form>
    </div>
</div>




