  <?php
   include("../library/adminconfig.php");
  if (isset($_POST['choice']) && $_POST['choice'] == "checkcaptcha") {
  echo $_SESSION['captcha']; //return captcha code
  exit;
  }?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Login</title>
    <!-- Bootstrap start -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap end -->
  </head>
  <?php
  $db = new Db_Operation();
  if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  if (isset($_POST['email']) && !empty($_POST['email'])) {
     
    if ($db->Login($_POST['email'], $_POST['password'])) {
        
      $filename = '../Log/log.txt';
      if(file_exists($filename))
      {
        $data="\nNew Entry\nUSER NAME:".$_POST['email']."\nSESSION ID:".SESSION_ID."\nDATE:".TODAY.
        "\nIP ADDRESS:".USER_IP."\n---------------------------------";
        $file = fopen( $filename, "a" );
        fwrite( $file, $data);
        fclose( $file );
      } 
    //   echo $_SESSION['USER'];
    //   exit;
    echo "<script> location.href='index.php'; </script>";
    //   header('Location:http://inflexi.info/achivia/admin/pages/index.php');
    }
    else {
        
      $_SESSION['msg'] = "Incorrect Email Or Password";
      echo "<script> location.href='login.php'; </script>";
    }
  }

  ?>
  <body>


    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-panel panel panel-default">
            <div class="panel-heading">
              <!--<h3 class="panel-title">Please Sign In</h3>-->
              <img src="logo.png">
            </div>
            <div class="panel-body">
              <?php if (isset($msg)) { ?>
              <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= $msg; ?>
              </div>
              <?php } ?>
              <form role="form" action="" method="post" id="form"  onSubmit="return submitform();">
                <fieldset>
                  <div class="form-group">
                    <input class="form-control" placeholder="E-mail" id="email" name="email" type="email" autofocus required>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="" required>
                  </div>
                  <div class="form-group">
                  <div class="g-recaptcha" data-sitekey="6LdjhWYUAAAAAJsHRdHq07Si5ObVJoRr5FjMdKdg"></div>

                  </div>
                  <div class="form-group">

                  </div>
                  <div class="checkbox">
                    <label>
                      <input name="remember" type="checkbox" id="remember" value="Remember Me">Remember Me
                    </label>
                  </div>
                  <!-- Change this to a button or input when using this as a form -->
                  <input type="hidden" name="returncaptcha" id="returncaptcha">
                  <button  type="submit" id="loginbtn" class="btn btn-lg btn-success btn-block" onclick="logged();">Login</button>
                 
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>

  <!-- jQuery Start-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="../vendor/metisMenu/metisMenu.min.js"></script> 
  <script src="../dist/js/sb-admin-2.js"></script>
  <!-- jQuery End -->
  <!-- Js Start -->
  <script type="text/javascript">
    $('form').on('submit', function(e) {
  if(grecaptcha.getResponse() == "") {
    e.preventDefault();
    alert("You are a robot!");
  }
});
    function checkcaptcha(str) {
      $("#msg2").html('').show();

      $.post("login.php", {"choice": "checkcaptcha"}, function (respond) {
        $("#returncaptcha").val(respond);

      });
    }
    function logged(){
      $("#loginbtn").html('Please wait we logged you in <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
    }
    $("#remember").click(function(){
      if($(this).prop("checked") == true){
        localStorage.setItem("user",$("#email").val());
        localStorage.setItem("pass",$("#password").val());
      }
      else
      {
        localStorage.setItem("user","");
        localStorage.setItem("pass","");
      }
    })
    $(document).ready(function(){
      if(localStorage.getItem("user")!=null && localStorage.getItem("user")!="" && localStorage.getItem("pass")!=null && localStorage.getItem("pass")!=""){
        $("#email").val(localStorage.getItem("user"));
        $("#password").val(localStorage.getItem("pass"));
        $('#remember').prop('checked', true);
      }
    })
  </script>
  <!-- Js End -->
  </html>
