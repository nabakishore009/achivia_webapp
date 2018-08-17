<?php
include("library/adminconfig.php");
$db = new Db_Operation();
$page_name="register";

$db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=9");
$seo_r=$db->Data[0];
if (isset($_POST['stage']) && $_POST['stage'] == "registration") {
       if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
    } else {
        Static_Operation::Data_clean();
    $fname = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $intake = $_POST['intake'];
    $course = $_POST['interested_course'];
    $country = $_POST['interested_country'];
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
            <b>Intake :</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $intake . '</td>
        </tr>
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Course:</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $course . '</td>
        </tr>
        </tr>
                <tr>
            <td width="35%" align="right" style="padding-right: 5px; padding-top: 4px; padding-bottom: 4px">
            <b>Country:</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' .  $country . '</td>
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


     // print $sample_msg;
     //  exit;
$ip=USER_IP;
$add_date=TODAY;

//   $insertsql = "insert into mng_registrationqueries set name='{$fname}',email='{$email}',phone='{$phone}',message='{$msg}',intake='{$intake}',interested_course='{$course}',interested_country='{$country}',ip='{$ip}',add_date='$add_date'"; 
//       $db->runSql($insertsql);
       $admin_mail = "education@achivia.in";
   // $admin_mail = "nabakishore@inflexi.com";
        $subject=" Registration Result ";
 if (Static_Operation :: sendmail($sample_msg, $subject, $admin_mail, $fname, $admin_mail)) {
       $db->Insert("mng_registrationqueries",array('name'=>$fname,'email'=>$email,'phone'=>$phone,'message'=>$msg,'interested_country'=>$country,'interested_course'=>$course,'intake'=>intake,'ip'=>$ip,'add_date'=>$add_date));
    $msg = "Your message has been sent. Thank you! ";
}
else{
    $msg = "Mail not send. Sorry!!"; 
}      
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><?php include("common/seo.php"); ?>
<?php include("common/stylesheet.php"); ?>
<link href="css/owl.carousel.css" rel="stylesheet">
<link href="css/owl.theme.css" rel="stylesheet">
<script src="js/owl.carousel.js"></script>
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
<h2><?php
if (!empty($seo_r['page_name'])) {
echo $seo_r['page_name'];
}
?></h2>
<ul> 
<a href="<?php echo WEB_ADDRESS; ?>">   <li>Home / </li> </a>
<a href="<?php echo WEB_ADDRESS ?>register"> <li><?php
if (!empty($seo_r['page_name'])) {
echo $seo_r['page_name'];
}
?></li></a>
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

<!-- booking form -->
<div class="banner-form2">
<div class="banner-form2-header"><h2 style="text-align:center;">Register with us!</h2></div>
<div class="banner-form2-body">
     <center><?php if(isset($msg)){ echo $msg; unset($msg);}?></center>
<form id="form1" name="form1" method="post" action="">
<input type="hidden" name="stage" value="registration">
<div class="row"> 
<div class="col-md-6 padding-5a">
<input type="text" name="name" id="name" placeholder="Full Name"  class="form-textbox" />
</div>
<div class="col-md-6 padding-5a">
<input type="text" name="email" id="email" placeholder="Email Id"  class="form-textbox" />
</div>    
<div class="col-md-6 padding-5a">
<input type="text" name="phone" id="phone" placeholder="Contact no"  class="form-textbox" />
</div>
<div class="col-md-6 padding-5a">
<input type="text" name="intake" id="intake" placeholder="Intake"  class="form-textbox" />
</div>
<div class="col-md-6 padding-5a">
<div class="dropdown2">
<select name="interested_course"   class="form-textbox">
<option value="0">Course Interested In</option>
<?php
$db->Fetch(TABLE_TEST_PREPARATION,array(test_name,id),NULL," where status=1 order by id ASC");
                         foreach($db->Data as $v){
?>
<option value="<?php echo $v['test_name']; ?>"><?php echo $v['test_name']; ?></option>
<?php }
?>
?>

</select>
</div>
</div>
<div class="col-md-6 padding-5a">
<div class="dropdown2">
<select name="interested_country"  class="form-textbox">
<option value="0">Country Interested In</option>
<?php
$db->Fetch(TABLE_COUNTRY,array(country_name,id),NULL," where status=1 order by id ASC");
                         foreach($db->Data as $v){
?>
<option value="<?php echo $v['country_name']; ?>"><?php echo $v['country_name']; ?></option>
<?php }
?>
</select>
</div>
</div>                   
<div class="col-md-12 padding-5a">
<textarea name="message" id="textarea" cols="45" class="form-textarea" placeholder="Message"></textarea>
</div>
<div class="col-md-12 padding-5">
<div class="row">
<div class="col-md-1 col-xs-1"><input type="checkbox" checked="checked" name="term_condition" value="1"></div>
<div class="col-md-10  col-xs-10">I have read and agree to the  <a href="term-condition.php" style="text-decoration: none;" target="_blank">Terms and Conditions</a>
<br>
<label for="term_condition" generated="true" class="error"></label>
</div>
</div>	   

</div>
</div>
<div class="row" style="margin-top: 5px;">
<div class="col-md-3  padding-5">
<div class="row"><div class="col-md-3 padding-bottom-5">
<div class="g-recaptcha" data-sitekey="6LeELCwUAAAAAN-y70Gr99linfUHWGDw3SGFLCE7" style="transform:scale(0.78);transform-origin:0 0"></div></div>
</div>       
</div>
</div>
<div class="row" style="margin-top: 5px;">
<div class="col-md-4  padding-5">
<input name="button" id="button" class="button-submit" value="Register" type="submit">
</div>
</div>
</form>
</div>
</div>
<!-- booking form -->
</div>
<div class="col-md-4">
<!-- booking form -->
<?php include("common/innerpage_sidebar.php"); ?>

<!-- Accordion -->


</div>
<br>
</div><!-- row end-1 -->


</div>
</div> 
<!-- body -->

<!-- Footer Top -->
<?php include("common/footer.php"); ?>
<!-- Footer -->

<!-- navAccordion -->
<script src="js/navAccordion.min.js"></script>
<script>
jQuery(document).ready(function () {

//Accordion Nav
jQuery('.mainNav').navAccordion({
expandButtonText: '<i class="fa fa-plus"></i>', //Text inside of buttons can be HTML
collapseButtonText: '<i class="fa fa-minus"></i>'
},
function () {
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
term_condition: "required",
intake: "required",
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
</body>
</html>