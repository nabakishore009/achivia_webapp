<?php
include("includes/Db_Config.php");
$seo_r = getsinglerow(executeQuery($conn, "select * from mng_media"));
$galleryimages = executeQuery($conn, "select * from mng_galleryimages order by sortorder asc");
if (getTotalrows($galleryimages) > 0) {
    $resimages = getallRows($galleryimages);
}
$allvideos = executeQuery($conn, "select * from mng_videos");
if (getTotalrows($allvideos) > 0) {
    $resvideos = getallRows($allvideos);
}
//echo pre($resimages);
//echo pre($resvideos);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
  <!-- fancybox -->
  <link rel="stylesheet" type="text/css" href="<?php echo SITEURL?>css/jquery.fancybox.min.css">
  <script src="<?php echo SITEURL?>js/jquery.fancybox.min.js"></script>

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
                        <h2>Gallery</h2>
                        <ul>
                            <li>Home / </li> 
                            <li>Gallery</li>
                            <ul>
                                </div>
                                </div>
                                </div>
                                </div>

                                <!-- banner -->

                                <!-- body -->

                                <div class="bout-text2">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>Images</h2>
                                                <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                                            </div>
                                        </div>
                                        <div class="row padding-bottom-30">
                                            <?php
                                            if (!empty($resimages)) {
                                                foreach ($resimages as $key => $image_r) {
                                                    ?>
                                                    <div class="col-md-4 padding-bottom-30">
                                                        <div class="gallery-box">
                                                            <a href="<?php echo SITEURL . "gallery/" . $image_r['image_name'] ?>" data-fancybox="images" data-width="800" data-height="500">
                                                                <img src="<?php echo SITEURL . "gallery/" . $image_r['image_name'] ?>" class="img-responsive" />
                                                                <span class="hover-serch"><i class="fa fa-search" aria-hidden="true"></i></span>
                                                            </a> 
                                                        </div>
                                                    </div>     
                                                <?php }
                                                ?>


                                            <?php } ?>
                                        </div>




                                        <div class="row padding-bottom-30">
                                            <div class="col-md-12 text-center">
                                                <h2>Videos</h2>
                                                <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                            if (!empty($resvideos)) {
                                                foreach ($resvideos as $key => $video_r) {
                                                      $image = video_image($video_r['video_url']);
                                                    ?>
                                           <div class="col-md-4 padding-bottom-30">
                                                <div class="gallery-box">
                                                    <a href="<?php echo $video_r['video_url'];?>" data-fancybox="images" data-width="800" data-height="500">
                                                        <img src="<?php echo  $image?>" class="img-responsive" />
                                                        <span class="hover-serch2"><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                                <?php }
                                            }
                                            ?>
                                            
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

                                <!-- fancybox -->
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("[data-fancybox]").fancybox({
                                        });

                                    });
                                </script>


                                </body>
                                </html>