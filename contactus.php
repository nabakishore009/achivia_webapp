<?php
include("library/adminconfig.php");
$db = new Db_Operation();
$page_name="";

   $db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=5");
$seo_r=$db->Data[0];

if (isset($_POST['stage']) && $_POST['stage'] == "contactus") {
if ($_POST["g-recaptcha-response"] == '') {
$msg = "ERROR: You are a machine not human.Please try again";
} else {
Static_Operation::Data_clean();
$fname=$_POST['fname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$company=$_POST['interest_in'];
$msg=$_POST['message'];
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
<b>Interested In:</b></td>
<td style="padding-top: 4px; padding-bottom: 4px">
' . $company . '</td>
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
// $insertsql = "insert into mng_contactquery set page_type='contact us',fname='{$fname}',email='{$email}',phone='{$phone}',company='{$company}',msg='{$msg}',ip='{$ip}',add_date='{$add_date}'";
// $db->runSql($insertsql);
 $subject=" Contact Us-form Result ";
$admin_mail = "nabakishore@inflexi.com";

if (Static_Operation :: sendmail($sample_msg, $subject, $admin_mail, $fname, $admin_mail)) {
        $db->Insert("mng_contactquery",array('page_type'=>'contact us','fname'=>$fname,'email'=>$email,'phone'=>$phone,'company'=>$company,'msg'=>$msg,'ip'=>$ip,'add_date'=>$add_date));
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
<head>
<?php include("common/seo.php"); ?>
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
<h2>Contact Us</h2>
<ul>
<a href="<?php echo WEB_ADDRESS; ?>"><li>Home / </li> </a>
<a href="<?php echo WEB_ADDRESS ?>contact"> <li>Contact</li></a>
<ul>
</div>
</div>
</div>
</div>

<!-- banner -->

<!-- body -->
<?php   $db->Fetch(TABLE_CONTACT,NULL,NULL," where id=1");
$contact=$db->Data[0]; ?>
<div class="bout-text1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="padding-bottom-60 contact-address">
<iframe src="<?php echo $contact['map']; ?>" width="1140" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
</div>
<div class="row">
<div class="col-md-9">
<div class="contact-form-body"> 
<div class="contact-form-header">
<h3 class="padding-bottom-30">Write to Us</h3>
<p>Send an email. All fields with an <span class="red-text">*</span> are required.</p>
</div>
 <center style="color:red;"><?php if(isset($msg)){ echo $msg; unset($msg);}?></center>
<form id="form121" name="form121" method="post" action="">
<input type="hidden" name="stage" value="contactus">
<div class="row">
<div class="col-md-6 padding-bottom-15">
<label for="name"><span class="red-text">*</span> Name</label>
<input type="text" name="fname" id="fname" class="form-control" id="name">
</div>
<div class="col-md-6 padding-bottom-15">
<label for="email"><span class="red-text">*</span> Email</label>
<input type="text" name="email" id="email" class="form-control" id="email">
</div>
<div class="col-md-6 padding-bottom-15">
<label for="phone"><span class="red-text">*</span> Phone</label>
<input type="text" name="phone" id="phone" class="form-control" id="phone">
</div>
<div class="col-md-6 padding-bottom-15">
<label for="company"><span class="red-text">*</span> Interested In</label>
<select name="interest_in" id="interest_in" class="form-control">
<option value="">Select One</option>  
<option value="Study Abroad">Study Abroad</option>
<option value="IELTS">IELTS</option>
<option value="TOEFL">TOEFL</option>
<option value="PTE">PTE</option>
<option value="Language Classes">Language Classes</option>

</select>    

</div>
<div class="col-md-12 padding-bottom-15">
<label for="message">Message</label>
<textarea name="message" id="message" class="form-control" id="message"></textarea> 
</div>

</div>
<div class="row"><div class="col-md-12 padding-bottom-15">
<div class="g-recaptcha" data-sitekey="6LeELCwUAAAAAN-y70Gr99linfUHWGDw3SGFLCE7" style="transform:scale(0.78);transform-origin:0 0"></div></div>
</div>

<input name="button" id="button" class="contact-submit-but" value="Submit" type="submit">
<!--<input type="submit" class="btn-view g-recaptcha contact-submit-but"
data-sitekey="6Ld91ycUAAAAAANd39QREcemifjTLMysGIur1W3a"
data-callback="submitForm1"
value="Submit"/>-->
</form>
</div>
</div>
<div class="col-md-3">
<div class="contact-sidebar">
<h3 class="padding-bottom-30">Cantact Info</h3>
<h5>Address</h5>
<p><?php echo $contact['address']; ?></p>
<h5>Phone</h5>
<p>
<?php echo $contact['phn_no']; ?><br>
</p>
<h5>Whatsapp</h5>
<p><?php echo $contact['name']; ?></p>
<h5>Email</h5>
<p><?php echo $contact['email']; ?></p>
</div> 
</div>
</div>
</div>    
</div>
<!-- body -->

<!-- Footer Top -->
<?php include("common/footer.php"); ?>
<!-- Footer -->
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>-->
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

<script type="text/javascript">
$(function () {
var flag = 0;
$("#form121").validate({
rules: {
fname: "required",
email: {
required: true,
email: true
},
phone: {
required: true,
number: true
},
interest_in: "required",
message: "required"

},
messages: {
fname: "please enter your name",
email: "please enter your email address",
phone: "please enter your phone number",
company: "please enter your company",
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

$('#form121').submit();
}
</script>
</body>
</html>