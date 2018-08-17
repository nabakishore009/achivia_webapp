<?php
include("library/adminconfig.php");
$db = new Db_Operation();
if (!empty($_GET['id'])) {
    // $seoservices_sql = executeQuery($conn, "select * from mng_services where subcategory_id='{$_GET['subid']}'");
   $db->Fetch(TABLE_TEST_PREPARATION,NULL,NULL," where id=".$_GET['id']);
$seo_r=$db->Data[0];

    //echo pre($seo_rr);
    // $main_service=getsingleRow($seo_rr);
    // $seo_r['og_url']="https://www.achivia.in/upload_images/".$main_service['image'];
// } else {
//     $seoservices_sql = executeQuery($conn, "select * from mng_cmspages where id=2");
//     $main_service=getsingleRow(executeQuery($conn,"select category_name,image from  mng_services where id not in(4,6) order by sortorder asc limit 1 "));
//     $seo_r['og_url']="https://www.achivia.in/upload_images/".$main_service['image'];
 }
//}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        
   

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

     <script src='https://www.google.com/recaptcha/api.js'></script>

        <link rel="stylesheet" href="<?php echo WEB_ADDRESS ?>css/smk-accordion.css" />
        <script type="text/javascript" src="<?php echo WEB_ADDRESS ?>js/smk-accordion.js"></script>

        <!-- Top Menu -->

        <!-- banner -->


        <div class="about-us-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $seo_r['test_name']; ?></h2>
                        <ul>
                           <a href="<?php echo WEB_ADDRESS ?>"> <li>Home / </li> </a>
                           <a href="<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $seo_r['page_url']; ?>"> <li><?php echo $seo_r['test_name']; ?></li></a>

                        </ul>
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
                        <div class="inner-page">

                            <?= html_entity_decode(strip_tags(html_entity_decode(@$seo_r['description'])));?>

                        </div>


                        <div class="panel-group" id="accordion">
                            <?php
                            $href2 = '';
                              $db->Fetch(TABLE_SUB_TEST_PREPARATION,NULL,NULL," where tid={$_GET['id']} AND status=1 order by sortorder asc");
                         
                            
                            $count = 1;
                            foreach($db->Data as $v){
                                $href2 = "pointer" . $v['id'];
                                ?>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a id="prepointer<?= $v['id'] ?>" <?php if (!empty($_GET['id']) && isset($_GET['id'])) { ?> data-toggle="collapse" <?php } ?> href="#<?php print $href2; ?>">
                                                <?php echo $v['section_name'] ?></a>
                                          
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
                        <?php include("common/testpreparation_sidebar.php"); ?>
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
                                            message: "required"

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
                
                if($('.link_img').length){
                $('.link_img').click(function(){

                var target_url=$(this).attr('alt');
                window.open(target_url);
                //window.location.href=target_url;
                })
                //setTimeout(function(){alert($('#link_url').attr("style"));$('#link_url').css("opacity","1.00");alert($('#link_url').attr("style"));}, 5000)
               
                }
                

            });
            function gotoTargetpg(url){
            window.location.href=url;
            }
        </script>

    </body>
</html>