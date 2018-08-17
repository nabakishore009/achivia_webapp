<?php
include("includes/Db_Config.php");
$cmsseo_sql = executeQuery($conn, "select * from mng_newspageseo");
$cms_seo = getsingleRow($cmsseo_sql);
$seo_r['meta_description'] = $cms_seo['meta_description'];
$seo_r['page_name'] = $cms_seo['page_name'];
$seo_r['meta_title'] = $cms_seo['meta_title'];
$seo_r['seo_nofollow'] = $cms_seo['seo_nofollow'];
$seo_r['meta_keyword'] = $cms_seo['meta_keyword'];
?><!DOCTYPE html>
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
                        <h2>News & Events</h2>
                        <ul>
                            <li><a href="<?php echo SITEURL ?>">Home</a> / </li> 
                            <li>News & Events</li>
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
                        <h2>News & Events</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div> 
                <!-- News And Events -->
                <div class="news-section"> 
                    <div class="container">
                        <!-- Row2 -->
                        <div class="row">
                            <?php
                            $news_events_sql = executeQuery($conn, "select * from mng_newsevents");
                            while ($news_events = getsingleRow($news_events_sql)) {
                                ?>
                                <div class="col-md-4">
                                    <div class="news-box">
                                        <a href='news_events.php?newsid=<?php echo $news_events['id']; ?>'><img src="<?php echo SITEURL ?>timthumb.php?src=news_images/<?php echo $news_events['newsevent_image']; ?>&w=371&258" alt="banner"></a>
                                        <div class="news-text">
                                            <a href='news_events.php?newsid=<?php echo $news_events['id']; ?>'>   <h3><?php echo $news_events['newsevent_title']; ?></h3></a>
                                            <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("d M Y", strtotime($news_events['newsevent_dt'])); ?>
                                            <p><?php echo word_limiter(strip_tags($news_events['details']), 50); ?>..</p>
                                            <a href='news_events.php?newsid=<?php echo $news_events['id']; ?>'><h4>Learn More <img src="images/news-butt.png" alt="banner"></h4></a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>

                        </div>     
                        <!-- Row2 -->


                    </div>  
                </div>
                <!-- News And Events -->


            </div>
        </div>   
        <!-- body -->

        <!-- Footer Top -->
        <?php include("common/footer.php"); ?>


    </body>
</html>