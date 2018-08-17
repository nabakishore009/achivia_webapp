<?php
include("includes/Db_Config.php");
if (!empty($_GET['newsid'])) {
    $_SESSION['newsid'] = $_GET['newsid'];
    $newsseo_sql = executeQuery($conn, "select * from mng_newsevents where id={$_GET['newsid']}");
} else {
    header("Location:index.php");
}
$news_seo = getsingleRow($newsseo_sql);
//  print pre($news_seo);
$seo_r['meta_description'] = $news_seo['meta_description'];
$seo_r['page_name'] = $news_seo['page_name'];
$seo_r['meta_title'] = $news_seo['meta_title'];
$seo_r['seo_nofollow'] = $news_seo['seo_nofollow'];
$seo_r['meta_keyword'] = $news_seo['meta_keyword'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <link href="css/flexslider.css" rel="stylesheet"/>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type="text/javascript" src="js/jquery.flexslider.js"></script>
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
                    <?php $newsname = getsinglerow(executeQuery($conn, "select id,newsevent_title from mng_newsevents where id={$_GET['newsid']}")); ?>
                    <h2><?php echo $newsname['newsevent_title']; ?></h2>
                    <ul>
                        <li>Home / </li> 
                        <li><?php echo $newsname['newsevent_title']; ?></li>
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
                    <?php
                    if (!empty($_GET['newsid'])) {
                        $news_sql = executeQuery($conn, "select * from mng_newsevents where id={$_GET['newsid']}");
                    }
                    while ($news_events = getsingleRow($news_sql)) {
                        ?>
                        <div class="padding-bottom-30">
                            <img src="news_images/<?php echo $news_events['newsevent_image']; ?>" class="img-responsive">

                        </div>

                        <div class="servise-page-text">
                            <?php echo $news_events['details']; ?>
                        </div>
                    <?php }
                    ?>
                    <?php
                    $galleryimages = getRows($conn, "mng_galleryimages", '', 'news_id', $_GET['newsid'], 'sortorder');
                    ?>
                    <!-- Gallery Start -->
                    <section class="slider">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <?php foreach ($galleryimages as $key => $image) { ?>
                                    <li>
                                        <img src="<?php echo SITEURL ?>gallery/<?php echo $image['image_name']; ?>" alt="">
                                    </li> 
                                <?php }
                                ?> 


                            </ul>
                        </div>

                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php foreach ($galleryimages as $key => $thumbimage) { ?>
                                    <li>
                                        <img src="<?php echo SITEURL ?>timthumb.php?src=gallery/<?php echo $thumbimage['image_name']; ?>&h=76&w=120&zc=0" >
                                    </li> 
                                <?php }
                                ?> 


                            </ul>
                        </div>
                    </section>
                    <!-- Gallery End -->
                </div>
                <div class="col-md-4">
                    <?php if ($_COOKIE['msg']) { ?>  
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
    <script type="text/javascript">

        $(window).load(function () {
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 120,
                itemMargin: 5,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel",
                start: function (slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>

</body>
</html>