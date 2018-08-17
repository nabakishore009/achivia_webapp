<?php include("../library/adminconfig.php");
//var_dump($_SESSION);
if(isset($_SESSION['USER'])){
	if(isset($_SESSION['USER']['id']) || isset($_SESSION['USER']['email']) || $_SESSION['USER']['status']==1)
	{
		header('Location:index.php');
	}
}

$db=new Db_Operation();

if(isset($_POST['choice']) && $_POST['choice']=="checkcaptcha")
{
	print $_SESSION['captcha'];//return captcha code
	exit;
}
if(isset($_POST['email']) && !empty($_POST['email'])){	

			$db->Fetch(TABLE_USER,NULL,array(array('where','user_name',$_POST['email'])),' limit 1');
			$count_tempuser=$db->DataCount;
            echo $count_tempuser;
            exit;
			if($count_tempuser>0){
			$tempuser=$db->Data[0];
					$mail_id=$tempuser['email'];
					$MyPassword="similipal".rand();
					$Password=md5(SALT.$MyPassword);
					$db->Update(TABLE_USER,array('password'=>$Password),array(array('where','email',$mail_id)));				
					$msg = '<table width="100%" border="0">
						<tr>
						<td colspan="2" align="center"><img src="' . WEB_ADDRESS . 'images/logo-banner.png"></td>
						</tr>
						<tr>
						<td colspan="2" style="font-weight:bold">Dear ' . $tempuser['name'] . '</td>
						</tr>
						<tr>
						<td>Here is your Temporary Password Please login and Change the password</td>
						<td>' . $MyPassword. '</td>
						</tr>
						<tr>
						<td colspan="2"><a href="'. WEB_ADDRESS .'/admin/login.php">Please Login</a></td>
						</tr>
						</table>';
						$subject = "Forgot Password SunsetSafari";
						$name = $tempuser['name'];
						if (Static_Operation :: sendmail($msg, $subject, $mail_id, $name, $email)) {
							echo "msg";
							exit;
							$_SESSION['msg'] = "Mail Send ! We send you a tempory password please login and change the password";
						} else {
							$_SESSION['msg'] = "Mail Not Send ! Please Try Again";
						}
					
			}
					
					 header('Location:login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Admin :: Forgot Password</title>
<!-- Bootstrap start -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap end -->

<script>
  function checkcaptcha(str){$("#msg2").html('').show(); 
 
	  $.post("login.php",{"choice":"checkcaptcha"},function(respond){ 
					$("#returncaptcha").val(respond);
			});
  }
  
  
  function submitform(){
	  if($("#returncaptcha").val()==$("#captchaform").val()){
		  
		return true;  
	  }else{
		  $("#captchaform").val('');
		$("#captchaform").focus();
		$("#msg2").html('<b  style="color: #F00">Captcha not match</b>');
		$("#msg2").hide(5000);
		return false;  
	  }
	  
  }
</script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Reset Password</h3>
        </div>
        <div class="panel-body">
          <form role="form" action="" method="post" id="form"  onSubmit="return submitform();">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
              </div>
              <div class="checkbox"> <img src="<?= ADMIN_PATH . LIBRARY_PATH ?>captcha/captcha.php" id="captcha" />
                                  <a href="javascript:" onclick="document.getElementById('captcha').src = '<?= ADMIN_PATH . LIBRARY_PATH ?>captcha/captcha.php?' + Math.random();
                                  document.getElementById('captcha-form').focus();" 
                                  id="change-image"><i class="fa fa-refresh"></i></a>
                                  <input type="text" autofocus placeholder="Enter Security code" class="form-control" name="captcha" id="captchaform" autocomplete="off" onFocus="checkcaptcha(this.value)" required><div id="msg2"></div>
              </div>
              
              <!-- Change this to a button or input when using this as a form -->
              <input type="hidden" name="returncaptcha" id="returncaptcha">
              <button  type="submit" id="loginbtn" class="btn btn-lg btn-success btn-block">Reset Password</button>
              <center> <a href="login.php">Back</a> </center>
            </fieldset>
          </form>
        </div>
      </div>
      <center>
       
      </center>
    </div>
  </div>
</div>
</body>
<!-- jQuery Start-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script> 
<script src="../dist/js/sb-admin-2.js"></script>
<!-- jQuery End -->
</html>
