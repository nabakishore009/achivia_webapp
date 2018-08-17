<?php
include("includes/Db_Config.php");

if (!empty($_GET['stage']) && $_GET['stage'] == "search") {
    print "select * from mng_blogs where blogname LIKE '%{$_GET['searchtext']}%' or details LIKE '%{$_GET['searchtext']}%'";
    $query = executeQuery($conn, "select * from mng_blogs where blogname LIKE '%{$_GET['searchtext']}%' or details LIKE '%{$_GET['searchtext']}%'");
}
if (isset($_POST['userdetails']) && $_POST['userdetails'] == "signup") {
    $data = $_POST['page'];
    $check_user = getsingleRow(executeQuery($conn, "select id,email from mng_userslogin where email='{$data['email']}'"));
    if ($check_user['email'] && !empty($check_user['email'])) {
        $_SESSION['uid'] = $check_user['id'];
    } else {
        $insert = inserttoDb($conn, "mng_userslogin", $data);
        if ($insert) {
            $_SESSION['uid'] = $insert;
        }
    }


   header("Location:university.php?cid={$_SESSION['cid']}");
}
if (isset($_POST['countrypage']) && $_POST['countrypage'] == "fromcountry") {
   if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
        setcookie("msg", $msg, time() + 3);
        header("Location:university.php?cid={$_SESSION['cid']}#msg");
    } else {
    $fname = db_escape($conn, $_POST['fname']);
    $email = db_escape($conn,  $_POST['email']);
    $phone = db_escape($conn,  $_POST['phone']);
    $course = db_escape($conn,  $_POST['course']);
    $apply_date = '';
        if (!empty($_POST['date1'])) {
            $date_arr = explode("/", $_POST['date1']);
            $apply_date = $date_arr[2] . "-" . $date_arr[1] . "-" . $date_arr[0];
        }
      
          $msg = stripslashes(db_escape($conn,  $_POST['message']));
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
			<b>Date:</b></td>
			<td style="padding-top: 4px; padding-bottom: 4px">
			' . $_POST['date1'] . '</td>
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
       // exit;


   $insertsql = "insert into mng_contactquery set page_type='university',fname='{$fname}',email='{$email}',phone='{$phone}',msg='{$msg}',courses='{$course}',date='{$apply_date}',ip='{$_SERVER['REMOTE_ADDR']}',add_date='NOW()'";
     executeQuery($conn, $insertsql);
        require_once('class.phpmailer.php');
        $admin_mail = "soumya@inflexi.com";
        //$admin_mail = "smrc_bbsr@hotmail.com";
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $body = $sample_msg;

        $mail->From = $email;
        $mail->FromName = $fname;

        $mail->Subject = "Message received from ACHIVIA Website";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($body);

        $mail->AddAddress("{$admin_mail}", "");
        
        

        if (!$mail->Send()) {
            echo "";
        } else {
            echo "";
        }
        $msg = "Your message has been sent. Thank you! ";
        setcookie("msg", $msg, time() + 3);

        header("Location:university.php?cid={$_SESSION['cid']}#msg");
        exit;
    }
}

if (isset($_POST['aboutuspage']) && $_POST['aboutuspage'] == "fromaboutus") {
   if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
        setcookie("msg", $msg, time() + 3);
        header("Location:page.php?pid={$_SESSION['pid']}#msg");
    } else {
    $fname = db_escape($conn, $_POST['fname']);
    $email = db_escape($conn,  $_POST['email']);
    $phone = db_escape($conn,  $_POST['phone']);
    $course = db_escape($conn,  $_POST['course']);
    $apply_date = '';
        if (!empty($_POST['date1'])) {
            $date_arr = explode("/", $_POST['date1']);
            $apply_date = $date_arr[2] . "-" . $date_arr[1] . "-" . $date_arr[0];
        }
      
          $msg = stripslashes(db_escape($conn,  $_POST['message']));
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
			<b>Date:</b></td>
			<td style="padding-top: 4px; padding-bottom: 4px">
			' . $_POST['date1'] . '</td>
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
       // exit;


   $insertsql = "insert into mng_contactquery set page_type='about us',fname='{$fname}',email='{$email}',phone='{$phone}',msg='{$msg}',courses='{$course}',date='{$apply_date}',ip='{$_SERVER['REMOTE_ADDR']}',add_date='NOW()'";
     executeQuery($conn, $insertsql);
        require_once('class.phpmailer.php');
        $admin_mail = "soumya@inflexi.com";
        //$admin_mail = "smrc_bbsr@hotmail.com";
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $body = $sample_msg;

        $mail->From = $email;
        $mail->FromName = $fname;

        $mail->Subject = "Message received from ACHIVIA Website";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($body);

        $mail->AddAddress("{$admin_mail}", "");
        
        

        if (!$mail->Send()) {
            echo "";
        } else {
            echo "";
        }
        $msg = "Your message has been sent. Thank you! ";
        setcookie("msg", $msg, time() + 3);

        header("Location:page.php?pid={$_SESSION['pid']}#msg");
        exit;
    }
}

if (isset($_POST['stage']) && $_POST['stage'] == "bannerform") {
      if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
        setcookie("msg", $msg, time() + 3);
        header("Location:index.php");
    } else {
    $fname = db_escape($conn, $_POST['fname']);
    $email = db_escape($conn,  $_POST['email']);
    $phone = db_escape($conn,  $_POST['phone']);
    $course = db_escape($conn,  $_POST['course']);
    $apply_date = '';
        if (!empty($_POST['date1'])) {
            $date_arr = explode("/", $_POST['date1']);
            $apply_date = $date_arr[2] . "-" . $date_arr[1] . "-" . $date_arr[0];
        }
      
          $msg = stripslashes(db_escape($conn,  $_POST['message']));
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
			<b>Date:</b></td>
			<td style="padding-top: 4px; padding-bottom: 4px">
			' . $_POST['date1'] . '</td>
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


      //print $sample_msg;
      // exit;


   $insertsql = "insert into mng_contactquery set page_type='home',fname='{$fname}',email='{$email}',phone='{$phone}',msg='{$msg}',courses='{$course}',date='{$apply_date}',ip='{$_SERVER['REMOTE_ADDR']}',add_date='NOW()'"; 
     executeQuery($conn, $insertsql);
        require_once('class.phpmailer.php');
        $admin_mail = "kiran@inflexi.com";
        //$admin_mail = "smrc_bbsr@hotmail.com";
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $body = $sample_msg;

        $mail->From = $email;
        $mail->FromName = $fname;

        $mail->Subject = "Message received from ACHIVIA Website";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($body);

        $mail->AddAddress("{$admin_mail}", "");
        
        

        if (!$mail->Send()) {
            echo "";
        } else {
            echo "";
        }
        $msg = "Your message has been sent. Thank you! ";
        setcookie("msg", $msg, time() + 3);

        header("Location:index.php");
        exit;
    }
}

if (isset($_POST['stage']) && $_POST['stage'] == "registration") {
	   if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
        setcookie("msg", $msg, time() + 3);
        header("Location:register_page.php?rid={$_SESSION['rid']}");
    } else {
    $fname = db_escape($conn, $_POST['name']);
    $email = db_escape($conn,  $_POST['email']);
    $phone = db_escape($conn,  $_POST['phone']);
    $intake = db_escape($conn,  $_POST['intake']);
	$course = db_escape($conn,  $_POST['interested_course']);
	$country = db_escape($conn,  $_POST['interested_country']);
	$msg = stripslashes(db_escape($conn,  $_POST['message']));
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


   $insertsql = "insert into mng_registrationqueries set name='{$fname}',email='{$email}',phone='{$phone}',message='{$msg}',intake='{$intake}',interested_course='{$course}',interested_country='{$country}',ip='{$_SERVER['REMOTE_ADDR']}',add_date='NOW()'"; 
     executeQuery($conn, $insertsql);
        require_once('class.phpmailer.php');
        $admin_mail = "kiran@inflexi.com";
        //$admin_mail = "smrc_bbsr@hotmail.com";
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $body = $sample_msg;

        $mail->From = $email;
        $mail->FromName = $fname;

        $mail->Subject = "Message received from ACHIVIA  Website {$_SESSION['page_heading']} page ";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($body);

        $mail->AddAddress("{$admin_mail}", "");
        
        

        if (!$mail->Send()) {
            echo "";
        } else {
            echo "";
        }
        $msg = "Your message has been sent. Thank you! ";
        setcookie("msg", $msg, time() + 3);

        header("Location:register_page.php?rid={$_SESSION['rid']}");
        exit;
    }
}

if (isset($_POST['aboutuspage']) && $_POST['aboutuspage'] == "newsandevents") {
   if ($_POST["g-recaptcha-response"] == '') {
        $msg = "ERROR: You are a machine not human.Please try again";
        setcookie("msg", $msg, time() + 3);
        header("Location:news_events.php?newsid={$_SESSION['newsid']}#msg");
    } else {
    $fname = db_escape($conn, $_POST['fname']);
    $email = db_escape($conn,  $_POST['email']);
    $phone = db_escape($conn,  $_POST['phone']);
    $course = db_escape($conn,  $_POST['course']);
    $apply_date = '';
        if (!empty($_POST['date1'])) {
            $date_arr = explode("/", $_POST['date1']);
            $apply_date = $date_arr[2] . "-" . $date_arr[1] . "-" . $date_arr[0];
        }
      
          $msg = stripslashes(db_escape($conn,  $_POST['message']));
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
			<b>Date:</b></td>
			<td style="padding-top: 4px; padding-bottom: 4px">
			' . $_POST['date1'] . '</td>
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


      //  print $sample_msg;
      //  exit;


   $insertsql = "insert into mng_contactquery set page_type='news&event',fname='{$fname}',email='{$email}',phone='{$phone}',msg='{$msg}',courses='{$course}',date='{$apply_date}',ip='{$_SERVER['REMOTE_ADDR']}',add_date='NOW()'";
     executeQuery($conn, $insertsql);
        require_once('class.phpmailer.php');
        $admin_mail = "soumya@inflexi.com";
        //$admin_mail = "smrc_bbsr@hotmail.com";
        $mail = new PHPMailer(); // defaults to using php "mail()"
        $body = $sample_msg;

        $mail->From = $email;
        $mail->FromName = $fname;

        $mail->Subject = "Message received from ACHIVIA Website";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($body);

        $mail->AddAddress("{$admin_mail}", "");
        
        

        if (!$mail->Send()) {
            echo "";
        } else {
            echo "";
        }
        $msg = "Your message has been sent. Thank you! ";
        setcookie("msg", $msg, time() + 3);

        header("Location:news_events.php?newsid={$_SESSION['newsid']}#msg");
        exit;
    }
}