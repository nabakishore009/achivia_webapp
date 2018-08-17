<?php
include("includes/Db_Config.php");
$cmsseo_sql = executeQuery($conn, "select * from mng_cmspages where id=8");

while ($cms_seo = getsingleRow($cmsseo_sql)) {
    $seo_r['meta_description'] = $cms_seo['meta_description'];
    $seo_r['page_name'] = $cms_seo['page_name'];
    $seo_r['meta_title'] = $cms_seo['meta_title'];
    $seo_r['seo_nofollow'] = $cms_seo['seo_nofollow'];
    $seo_r['meta_keyword'] = $cms_seo['meta_keyword'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->

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
                        <li>Home / </li> 
                        <li>About Us</li>
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
                                            <?php
                                            $cms_sql = executeQuery($conn, "select * from mng_cmspages where id=8");
                                            while ($cmspage = getsingleRow($cms_sql)) {
                                                ?>
                                                <div class="padding-bottom-30"><img src="<?php echo SITEURL ?>timthumb.php?src=upload_images/<?php echo $cmspage['image']; ?>&h=290&w=780&zc=1" class="img-responsive"></div>
                                             <div class="servise-page-text">   <?php echo $cmspage['contents']; ?> </div>
                                            <?php }
                                            ?>
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


                            </body>
                            </html>