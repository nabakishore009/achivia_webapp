<?php
include("library/adminconfig.php");
$db = new Db_Operation();
if (!empty($_GET['id'])) {
   $db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=".$_GET['id']);
$seo_r=$db->Data[0];
// var_dump($seo_r);
// exit;
$page_name='abc';
}
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
                    <h2><?php echo $seo_r['page_name']?></h2>
                    <ul>
                        <a href="<?php echo WEB_ADDRESS ?>"><li>Home / </li></a>
                        <a href="<?= WEB_ADDRESS;?><?php echo $seo_r['url']; ?>"><li><?php echo $seo_r['page_name']?></li></a>
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
                                            
                                                <?php if(!empty( $seo_r['banner'])){?>
                                                <div class="padding-bottom-30"><img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$seo_r['banner'];?>&h=290&w=780&zc=1" class="img-responsive" alt=<?= $seo_r["img_tags"]?>></div>
                                                <?php } ?>
                                                <div class="inner-page">  <?= html_entity_decode(strip_tags(html_entity_decode(@$seo_r['description'])));?>  </div>
                                            <?php 
                                            ?>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <?php if (isset($_COOKIE['msg'])) { ?>  
                                                <!--message-->
                                                <div class="alert alert-success">
                                                    <a href="#" class="close" data-dismiss="alert" onClick="$('.alert').hide('slow');">&times;</a>
                                                    <strong>Notification!</strong> <?php print $_COOKIE['msg']; ?>
                                                </div>
                                                <!--message-->
                                            <?php } ?>
                                            <!-- booking form -->
                                            <?php include("common/innerpage_sidebar.php"); ?>

                                            <!-- Accordion -->


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
                                                                term_condition:"required",
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