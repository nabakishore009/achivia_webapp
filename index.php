<?php

include("library/adminconfig.php");
$db = new Db_Operation();

$db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=1");

$seo_r=$db->Data[0];
if(isset($_POST['action'])&& $_POST['action']=="popupsubmit"){
    Static_Operation::Data_clean();
    // var_dump($_POST);
    // exit;
    $page=$_POST['page']; 
    $fname =  $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['preferred_country'];
$apply_date = TODAY;
$ip=USER_IP;
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
            <b>Preferred Country :</b></td>
            <td style="padding-top: 4px; padding-bottom: 4px">
            ' . $country . '</td>
        </tr>
                </table>';
 //$insertsql = "insert into mng_contactquery set page_type='home',fname='{$fname}',email='{$email}',phone='{$phone}',preferred_country='{$country}',ip='{$ip}',add_date='{$apply_date}'"; 
 
  // $db->runSql($insertsql);
   
      $subject="$country.:Query/Information Result ";
   //$admin_mail = "nabakishore@inflexi.com";

    
       $admin_mail = "education@achivia.in";
      
        if (Static_Operation :: sendmail($sample_msg, $subject, $admin_mail, $fname,  $admin_mail)) {
            $db->Insert("mng_contactquery",array('page_type'=>'home','fname'=>$fname,'email'=>$email,'phone'=>$phone,'preferred_country'=>$country,'ip'=>$ip,'add_date'=>$apply_date));
            //$db->runSql($insertsql);
    $message = "Your message has been sent. Thank you! ";
}
else{
  $message = "Mail not send. Sorry!!"; 
}
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
        <!-- Owl Carousel -->

        <script>
            $(document).ready(function () {
                $("#you-study").owlCarousel({
                    autoPlay: 3000,
                    items: 3,
                    itemsDesktop: [1199, 3],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1],
                    pagination: true
                });

            });
        </script>

        <script>
            $(document).ready(function () {
                $("#tab1").owlCarousel({
                    autoPlay: 3000,
                    items: 3,
                    itemsDesktop: [1199, 3],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1],
                    pagination: true
                });

            });
        </script>

        <script>
            $(document).ready(function () {
                $("#tab2").owlCarousel({
                    autoPlay: 3000,
                    items: 3,
                    itemsDesktop: [1199, 3],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1],
                    pagination: true
                });

            });
        </script>

        <script>
            $(document).ready(function () {
                $("#tab3").owlCarousel({
                    autoPlay: 3000,
                    items: 3,
                    itemsDesktop: [1199, 3],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1],
                    pagination: true
                });

            });
        </script>

<script>
 <script type="text/javascript"> 
$(document).ready(function() { 
$(".home-testimonial-panel").owlCarousel({ 
autoPlay: 3000, 
items : 1, 
itemsDesktop : [1199,1], 
itemsTablet : [768,1], 
itemsMobile : [479,1], 
pagination: true
}); 
}); 
</script> 
</script>
        <!-- Tab -->  
        <link href="css/easy-responsive-tabs.css?t=<?php echo time();?>" rel="stylesheet"> 
        <script src="js/easyResponsiveTabs.js?t=<?php echo time();?>"></script>  
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script type="text/javascript">
            var popupmsg = "";
            var Timer;
            var TotalSeconds;
            function CreateTimer(TimerID, Time) {
                Timer = document.getElementById(TimerID);
                TotalSeconds = Time;
                if (popupmsg != '') {
                    window.setTimeout("callPopup()", 500);
                } else {
                    window.setTimeout("callPopup()", 500);
                }
            }
            function callPopup() {          
                
                $('#hidden_popup').trigger('click')
            }
            var timer = 0;
            timer = parseInt(timer);
            window.onload = CreateTimer("timer", timer);

        </script>    
    </head>
    <body>

        <!-- Hearder -->
        <?php include("common/header.php"); ?>
        <!-- Hearder -->

        <!-- Top Menu -->
        <?php include("common/menu.php"); ?>

        <!-- Top Menu -->

        <!-- banner section start -->
        <?php include("common/banner.php"); ?>
        <!-- banner text end -->

        <!-- new  section-->


        <!-- section -->

        <!-- Home Services -->
        <div class="home-services"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Our Services</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

                <!-- Row2 -->
                <div class="row">
                    <?php
                        $db->Fetch(TABLE_SERVICES,NULL,NULL," where show_home=1 AND status=1 order by id ASC");
                         foreach($db->Data as $v){
                        ?>
                        <div class="col-md-4">
                            <div class="service-box">
                                <a href="<?= WEB_ADDRESS;?>services/<?php echo $v['url']; ?>">  <div class="service-logo"><img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['banner'];?>&h=64&w=64&zc=0" alt="<?= $v['img_tags'] ?>"></div></a>
                                <a href="<?= WEB_ADDRESS;?>services/<?php echo $v['url']; ?>"> <h3><?php echo $v['services_name']; ?></h3></a>
                                <?php $data=html_entity_decode(@$v['description']);?>
                                <p><?php echo substr(strip_tags(html_entity_decode($data, ENT_QUOTES, 'UTF-8')), 0, 210); ?>..</p>
                                <div class="text-center"><a href="<?= WEB_ADDRESS;?>services/<?php echo $v['url']; ?>">Read More</a></div>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>     
                <!-- Row2 -->



                <!-- Row4 -->
                <div class="services-button">
                    <a href="<?= WEB_ADDRESS;?>services" class="btn-service btn-md">VIEW ALL</a> 
                </div>
                <!-- Row4 -->

            </div>  
        </div>
        <!-- Our Services -->

        <!-- Where can you study -->
        <div class="where-section"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Where can you study</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

                <!-- Row2 -->
                <div class="row">
                    <div id="you-study">
                        <!--box-->
                        <?php
                       $db->Fetch(TABLE_COUNTRY,NULL,NULL," order by id DESC");
                        foreach($db->Data as $v){
                            ?>
                            <div class="col-md-12"> 
                                <div class="study-box">
                                    <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['image'];?>&w=371&h=258" alt="image">
                                    <div class="gradiant">
                                        <div class="red-border"></div>
                                        <h3><a href="<?php echo WEB_ADDRESS ?>country/<?php echo $v['page_url']; ?>"><?php echo $v['country_name']; ?></a></h3>
                                        <div class="left-box">
                                            <p><a href='<?php echo WEB_ADDRESS ?>country/<?php echo $v['page_url']; ?>'><?php $v['image_text']=str_replace("/","'",$v['image_text']);echo stripslashes($v['image_text']) ?></a></p>
                                        </div>
                                        <div class="right-box">
                                            <a href='<?php echo WEB_ADDRESS ?>country/<?php echo $v['page_url']; ?>'><img src="images/button.png" alt="banner"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <!--box-->

                    </div>
                </div>     
                <!-- Row2 -->
            </div>  
        </div>
        <!-- Where can you study -->
       
        <!-- Test Preparation -->
        <div class="test-preparation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Test Preparation</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>

                <div class="row">
                    <div id="parentHorizontalTab">
                       
                        <div class="resp-tabs-container hor_1">
                            <div>
                                <div id="tab1">
                                    <?php
                                    $db->Fetch(TABLE_TEST_PREPARATION,NULL,NULL," where status=1 order by sortorder ASC");
                                     foreach($db->Data as $v){
                                        ?>
                                        <div class="col-md-12 item2"> 
                                            <div class="servise-page">
                                                <a href='<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $v['page_url']; ?>'><img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['image'];?>&w=371&h=258" alt="<?php echo $v['image_alt']; ?>"></a>
                                                <div class="servise-page-text">
                                                    <a href='<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $v['page_url']; ?>'><h3><?php echo $v['test_name']; ?></h3></a>
                                                    <p class="paddding-bottom-20"> <?php echo substr(strip_tags($v['short_contents']), 0, 200); ?> </p>
                                                    <a href='<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $v['page_url']; ?>'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>

                                </div>
                                <!-- end-->


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Test Preparation 
        <!-- Home Testimonial -->
   <div class="home-testimonial"> 
    <div class="container">
    <!-- Row1 -->
      <div class="row">
        <div class="col-md-12 text-center">
            <h2>Testimonial</h2>
            <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
        </div>
      </div>
      <!-- Row1 -->

      <!-- Row2 -->
      <div class="row">
          
          <div class="col-md-12">
             <div class="home-testimonial-panel">
                <?php $db->Fetch(TABLE_TESTIMONIAL,NULL,NULL," where status=1 order by id DESC");
                                     foreach($db->Data as $v){ ?>

                <!-- box -->
                 <div class="home-testimonial-box">
                 <img src="<?= WEB_ADDRESS;?>images/uni-1.jpg" alt="banner"></a>
                  <div class="home-testimonial-body">
                    <div class="row">
                  <div class="col-md-3">
                    <div class="home-testimonial-box-img"><img src="<?=UPLOADS_PATH.$v['image'];?>" alt="user"></a></div></div>
                  <div class="col-md-9">
                      <a href="javascript:">
              
                  <h5><?php echo $v['name']; ?></h5>
                <div class="home-testimonial-box-footer"><?php echo str_replace("/","'",@$v['course']); ?><br>
<?php echo str_replace("/","'",@$v['location']); ?></div>

                <div class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                <div class="home-testimonial-box-data"><?php $testimonial=html_entity_decode($v['feedback']);?><?= strip_tags(html_entity_decode($testimonial, ENT_QUOTES, 'UTF-8'))?>

                </div>
                <div class="quote"><i class="fa fa-quote-right" aria-hidden="true"></i></div>              
                </a>
                  </div>
                </div>
                  </div>
                </div>
                <!-- box -->
<?php }  ?>
                

                
             </div>
          </div>
     
         
          
      </div>     
      <!-- Row2 -->
    </div>  
  </div>
<!-- Home Testimonial -->     
        <!-- How it work -->
        <div class="work-section"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>How it works</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

                <!-- Row2 -->
                <div class="row">
                    <?php
                  $db->Fetch(TABLE_HOW_IT_WORKS,NULL,NULL," order by id ASC");
foreach($db->Data as $v){
                        ?>
                        <div class="col-md-4">
                            <div class="work-box">
                                <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['icon'];?>" alt="icon">
                                <h5><?php echo stripslashes($v['contents']); ?></h5>
                            </div>
                        </div> 
                    <?php }
                    ?>
                </div>     
                <!-- Row2 -->
            </div>  
        </div>
            
        <span style="display:none;"><i class="fa fa-lock" aria-hidden="true"  data-toggle="modal" data-target="#myModal" id="hidden_popup"></i></span>
        <!-- How it work -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-body">
                   
                    <form id='signupform' name='signupform' role="form" method="post" action="" onsubmit="return validatepopupFrm()">
                        <input type="hidden" name='action' value="popupsubmit">
                        <div class="col-lg-12">
                            <div class="panel panel-default" style="border:none;">
                                <div class="panel-heading">
                                     
                                    <!--<button type="button" class="close" data-dismiss="modal"></button>-->
                                    <img src="images/close.png" width="25" height="25" class="modalclose" data-dismiss="modal" style="float:right;cursor: pointer;"/>
                                     Need anything specific? Let us help you..
                                </div>
                                <center><span style="color:red;"><?php if(isset($message)){ echo $message; unset($message);}?></span></center>
                                <div class="panel-body"> 
                                    
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type='text' name='fname' id='popup_fname' class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type='email' name='email' id='popup_email' class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type='text' name='phone' id="popup_phone" class="form-control" pattern="[0-9]{10}" title="Provide Valid Mobile No">
                                        </div>
                                        <div class="form-group">
                                            <label>Preferred Country</label>
                                            <input type='text' name='preferred_country' id="popup_country" class="form-control">
                                        </div>
                                         <input type="submit"  class="btn btn-outline btn-primary btn-lg btn-block" value="Submit">
                                    </div>


                                   
                                    <br><br>
                                </div>
                                <!-- /.panel-body -->
                            </div> 
                            <!-- /.panel -->
                        </div>
                    </form>
                </div>

                <!--</div>-->

            </div>
        </div>
        <!-- Modal End--> 

        <!-- Footer Top -->
        <?php include("common/footer.php"); ?>
        <!-- Footer -->
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
        <script type="text/javascript">
                        $(function () {
                            $("#form1").validate({
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
                                    term_condition: "required",
                                    course: "required",
                                    preferred_country: "required",
                                    intake_year: "required",
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

                            //popup form validation



                        });
                        function validatepopupFrm() {

                            if ($('#popup_fname').val() == '') {
                                alert("Please enter full name");
                                $('#popup_fname').focus();
                                return false;
                            }
                            if ($('#popup_email').val() == '') {
                                alert("Please enter email adrress");
                                $('#popup_email').focus();
                                return false;
                            }
                            if ($('#popup_email').val() != '') {
                                if ($('#popup_email').val().indexOf("@") == -1 || $('#popup_email').val().indexOf(".") == -1 || $('#popup_email').val().indexOf(" ") != -1 || $('#popup_email').val().length < 6)
                                {
                                    alert("Please Enter a Valid Email.");
                                    $('#popup_email').focus();
                                    return false;
                                }

                            }
                            if ($('#popup_phone').val() == '') {
                                alert("Please enter phone number");
                                $('#popup_phone').focus();
                                return false;
                            }
                            if ($('#popup_country').val() == '') {
                                alert("Please enter your preferred country");
                                $('#popup_country').focus();
                                return false;
                            }
                        }
                        function submitForm() {
                            $('#form1').submit();
                        }

        </script>

        <style type="text/css">
            .panel-default > .panel-heading{
                background-color:#2e6da4 !important;
                color:#fff !important;
            } 

        </style>
        <!-- Tab Plug-in Initialisation -->


    </body>
</html>