<?php
include("library/adminconfig.php");
$db = new Db_Operation();
$page_name="";

   $db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=6");
$seo_r=$db->Data[0];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>

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
                        <h2>Test Preparation</h2>
                        <ul>
                            <li><a href="<?php echo WEB_ADDRESS ?>" style="color: #fff;">Home</a> / </li> 
                            <li><a href="<?php echo WEB_ADDRESS ?>test-preparation" style="color: #fff;">Test Preparation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- banner -->

        <!-- body -->

        <div class="bout-text1">
            <div class="container">
                <div class="row"><!-- main-row-->
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
                                                <a href='<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $v['page_url']; ?>'><img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['image'];?>&w=371&258" alt="<?php echo $v['image_alt']; ?>"></a>
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
        <!-- body -->

        <!-- Footer Top -->
        <?php include("common/footer.php"); ?>


    </body>
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
</html>