<?php
include("includes/Db_Config.php");
$cms_seo = getsingleRow(executeQuery($conn, "select * from mng_termcondition"));
$seo_r['meta_description'] = $cms_seo['meta_description'];
$seo_r['page_name'] = $cms_seo['page_name'];
$seo_r['meta_title'] = $cms_seo['meta_title'];
$seo_r['seo_nofollow'] = $cms_seo['seo_nofollow'];
$seo_r['meta_keyword'] = $cms_seo['meta_keyword'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
        <script src="js/owl.carousel.js"></script>

        <!-- slider -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
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
                    <h2>About Us</h2>
                    <ul>
                        <a href="<?php echo SITEURL ?>"><li>Home / </li></a>
                        <a href="<?php echo SITEURL ?>page.php?pid=8"><li>About Us</li></a>
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
                                        <div class="col-md-12">
                                            <?php echo $cms_seo['contents'] ?>
                                        </div>
                                      
                                    </div>
                                </div>    
                            </div>
                            <!-- body -->

                            <!-- Footer Top -->
                            <?php include("common/footer.php"); ?>
                            <!-- Footer -->

                            <!-- navAccordion -->
                            <script src="<?php echo SITEURL ?>js/navAccordion.min.js"></script>
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
                                                                fname: "required",
                                                                email: {
                                                                    required: true,
                                                                    email: true
                                                                },
                                                                phone: {
                                                                    required: true,
                                                                    number: true
                                                                },
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