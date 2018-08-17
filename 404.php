<?php
include("library/adminconfig.php");
$db = new Db_Operation();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="https://www.achivia.in/images/favicon.png" type="image/x-icon">
        <title>404 Not Found</title>
        
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
    </head>
    <body>

        <!-- Hearder -->
        <?php include("common/header.php"); ?>
        <!-- Hearder -->

        <!-- Top Menu -->
        <?php include("common/menu.php"); ?>

        <!-- Top Menu -->

        <!-- banner section start -->
        <div class="about-us-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Error Page</h2>
                        <ul>
                            <a href="https://www.achivia.in"><li>Home / </li> </a>
                            <a href="https://www.achivia.in/404.php"> <li>Error</li></a>
                            <ul>
                                </ul></ul></div>
                                </div>
                                </div>
                                </div>
        <!-- banner text end -->

        <!-- new  section-->

                                <div class="bout-text1">
                                    <div class="container">
                                        <div class="row">
               <div class="col-md-12 text-center">
               <div class="thanku_section">
                  <img src="<?php WEB_ADDRESS ?>images/error-icon.png">
                  <h1>Sorry !</h1>
                  <p>Error 404 Page You Search for Not Found.</p>
                               <a href="https://www.achivia.in" class="btn-blue">Back To Home</a>
               </div>
            </div> 
                 </div> 
                                                                              
                                    </div>    
                                </div>

        <!-- section -->

       
      

        <!-- Footer Top -->
        <?php include("common/footer_error.php"); ?>
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