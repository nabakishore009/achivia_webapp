<?php
include("library/adminconfig.php");
$db = new Db_Operation();
$page_name="";
if (!empty($_GET['id'])) {
   $db->Fetch(TABLE_COUNTRY,NULL,NULL," where id=".$_GET['id']);
$seo_r=$db->Data[0];
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
           <?php include("common/stylesheet.php"); ?>

        
       
  



<!-- slider -->


        <style>
            .error1{
                color:#F2F2F2;
            }
        </style>
        
    </head>
    <body>

        <!-- Hearder -->
        <?php include("common/header.php"); ?>
        <!-- Hearder -->

        <!-- Top Menu -->
        <?php include("common/menu.php"); ?>

     <!--    <link href="<?php echo WEB_ADDRESS ?>css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo WEB_ADDRESS ?>css/owl.theme.css" rel="stylesheet">
        <script src="<?php echo WEB_ADDRESS ?>js/owl.carousel.js"></script> -->
        <!-- Top Menu -->

        <!-- banner -->

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <link rel="stylesheet" href="<?php echo WEB_ADDRESS ?>css/smk-accordion.css" />
        <script type="text/javascript" src="<?php echo WEB_ADDRESS ?>js/smk-accordion.js"></script>

        <div class="about-us-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <?php if (!empty($_GET['id'])){?>
                        <h2><?php echo $seo_r['country_name']; ?></h2> 
                         
                       <?php } ?>
                        <ul>
                             <a href="<?php echo WEB_ADDRESS ?>"><li>Home / </li></a>
                            
                            <?php
                          

                            if (!empty($_GET['id'])) {
                                ?>
                                <a href="<?= WEB_ADDRESS;?>country/<?php echo $seo_r['page_url']; ?>"><li><?php echo $seo_r['country_name']?></li></a>
                                <?php
                            }
                            ?>
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
                     
                        <div class="padding-bottom-30"><img src="<?=UPLOADS_PATH.$seo_r['bannerimage'];?>" alt="<?php echo $seo_r['banner_text']; ?>" class="img-responsive"></div>
                        
                        <div class="country">
                            <?= html_entity_decode(strip_tags(html_entity_decode(@$seo_r['description'])));?>
                        </div>




                        <div class="panel-group" id="accordion">
                            <?php
                            $href2 = '';
                              $db->Fetch(TABLE_COUNTRY_DETAILS,NULL,NULL," where cid={$_GET['id']} order by sorder asc");
                         
                            
                            $count = 1;
                            foreach($db->Data as $v){
                                $href2 = "pointer" . $v['id'];
                                ?>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a id="prepointer<?= $v['id'] ?>" <?php if (!empty($_GET['id']) && isset($_GET['id'])) { ?> data-toggle="collapse" <?php } ?> href="#<?php print $href2; ?>">
                                                <?php echo $v['pointer'] ?></a>
                                          
                                        </h4>
                                    </div>
                                    <div id="<?php print $href2; ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php
                                            if (!empty($_GET['id']) && isset($_GET['id'])) {
                                            
                                                echo  html_entity_decode(strip_tags(html_entity_decode(@$v['description']))); 
                                            } ?>
                                        </div>

                                    </div>
                                </div>

                                <?php
                                $count++;
                            }
                            ?>


                        </div>

     
                              
                    </div>
                    <div class="col-md-4">
                     
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
        <script src="<?php echo WEB_ADDRESS; ?>js/navAccordion.min.js"></script>
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
       <!--  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
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
                                                date1: "required",
                                                message: "required",
                                                term_condition:"required"
                                            },
                                            messages: {
                                                fname: "please enter your name",
                                                email: "please enter your email address",
                                                phone: "please enter your phone number",
                                                course: "please enter your company",
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
        </script> -->
<!--         <script>
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
        </script> -->
        <style>
        h3{
        .panel-body h3{
         text-transform:none !important;
         }
        }
        </style>
//         <script>
//     $(document).ready(function () {
      
//         $("#county_slide").owlCarousel({

//             autoPlay: 3000,
//             items: 5,
//             itemsDesktop: [1199, 5],
//             itemsTablet: [768, 3],
//             itemsMobile: [479, 2],
//             pagination: false
//         });

//     });
// </script>

    </body>
</html>