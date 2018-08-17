<?php
include("includes/Db_Config.php");
$seo_r=getsinglerow(executeQuery($conn,"select page_name,meta_title,meta_keyword,meta_description,seo_nofollow from mng_cmspages where id=7"));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
        <!-- Owl Carousel -->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
        <script src="js/owl.carousel.js"></script>
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


        <!-- Tab -->  
        <link href="css/easy-responsive-tabs.css" rel="stylesheet"> 
        <script src="js/easyResponsiveTabs.js"></script>  
 <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <!-- Hearder -->
        <?php include("common/header.php"); ?>
        <!-- Hearder -->

        <!-- Top Menu -->
        <?php include("common/menu.php"); ?>

        <!-- Top Menu -->

        <!-- banner section start -->
        <?php include("common/banner.php"); ?>
        <!-- banner text end -->



        <!-- Home Services -->
        <div class="home-services"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Our Services</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

                <!-- Row2 -->
                <div class="row">
                    <?php $fetch_homepage_services = executeQuery($conn, "select * from mng_services where show_to_homepg=1 and id in(5,6,7)");
                    while ($homepg_services = getsingleRow($fetch_homepage_services)) {
                        ?>
                        <div class="col-md-4">
                            <div class="service-box">
                                <a href="services.php?subid=<?php echo $homepg_services['id']; ?>">  <div class="service-logo"><img src="<?php echo SITEURL ?>timthumb.php?src=upload_images/<?php echo $homepg_services['icon'] ?>&h=64&w=64&zc=0" alt="banner"></div></a>
                                <a href="services.php?subid=<?php echo $homepg_services['id']; ?>"> <h3><?php echo $homepg_services['category_name']; ?></h3></a>
                                <p><?php echo substr(strip_tags($homepg_services['contents']), 0, 210); ?></p>
                             <!--<p><?php //echo word_limiter(strip_tags($homepg_services['contents']),28); ?></p>-->

                            </div>
                        </div>
                    <?php }
                    ?>

                </div>     
                <!-- Row2 -->

                <!-- Row3 -->
                <div class="row">
                    <?php $fetch_homepage_service = executeQuery($conn, "select * from mng_services where show_to_homepg=1 and id in(8,9,10)");
                    while ($homepg_service = getsingleRow($fetch_homepage_service)) {
                        ?>
                        <div class="col-md-4">
                            <div class="service-box">
                                <a href="services.php?subid=<?php echo $homepg_service['id']; ?>">   <div class="service-logo"><img src="<?php echo SITEURL ?>timthumb.php?src=upload_images/<?php echo $homepg_service['icon'] ?>&h=64&w=64&zc=0" alt="banner"></div></a>
                                <a href="services.php?subid=<?php echo $homepg_service['id']; ?>">  <h3><?php echo $homepg_service['category_name']; ?></h3></a>
                                <p><?php echo substr(strip_tags($homepg_service['contents']), 0, 210); ?></p>
                                    <!--<p><?php //echo word_limiter($homepg_service['contents'],28); ?></p>-->

                            </div>
                        </div>
                    <?php }
                    ?>

                </div>     
                <!-- Row3 -->

                <!-- Row4 -->
                <div class="services-button">
                    <a href="services.php" class="btn-service btn-md">VIEW ALL</a> 
                </div>
                <!-- Row4 -->

            </div>  
        </div>
        <!-- Our Services -->

        <!-- Where can you study -->
        <div class="where-section"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Where can you study</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

                <!-- Row2 -->
                <div class="row">
                    <div id="you-study">
                        <!--box-->
                        <?php
                        $country_sql = executeQuery($conn, "select *from mng_country");
                        while ($countries = getsingleRow($country_sql)) {
                            ?>
                            <div class="col-md-12"> 
                                <div class="study-box">
                                    <img src="<?php echo SITEURL ?>timthumb.php?src=upload_images/<?php echo $countries['image']; ?>&w=371&h=258" alt="countryimage">
                                    <div class="gradiant">
                                        <div class="red-border"></div>
                                        <h3><a href='university.php?cid=<?php echo $countries['id']; ?>'><?php echo $countries['country_name']; ?></a></h3>
                                        <div class="left-box">
                                            <p><a href='university.php?cid=<?php echo $countries['id']; ?>'><?php echo $countries['image_text']; ?></a></p>
                                        </div>
                                        <div class="right-box">
                                            <a href='university.php?cid=<?php echo $countries['id']; ?>'><img src="images/button.png" alt="banner"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <!--box-->

                    </div>
                </div>     
                <!-- Row2 -->
            </div>  
        </div>
        <!-- Where can you study -->

        <!-- News And Events -->
        <div class="news-section"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>NEWS AND EVENTS</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

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
                                    <?php echo word_limiter($news_events['details'], 150); ?>
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

        <!-- Test Preparation -->
        <div class="test-preparation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Test Preparation</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>

                <div class="row">
                    <div id="parentHorizontalTab">
                        <ul class="resp-tabs-list hor_1">
                            <li>Test Preparation</li>
                            <li>Language Centre</li>
                            <li>Language classes</li>
                        </ul>
                        <div class="resp-tabs-container hor_1">
                            <div>
                                <div id="tab1">
                                    <?php
                                    $test_preparation = executeQuery($conn, "select * from mng_testpreparation where test_type=0");
                                    while($test=getsinglerow($test_preparation)){ ?>
                                         <div class="col-md-12 item2"> 
                                        <div class="servise-page">
                                          <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $test['id'];?>'><img src="images/<?php echo $test['image'];?>" alt="<?php echo $test['image_alt'];?>"></a>
                                            <div class="servise-page-text">
                                             <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $test['id'];?>'><h3><?php echo $test['test_name'];?></h3></a>
                                                <p class="paddding-bottom-20"> <?php echo substr(strip_tags($test['details']),0,200);?>   </p>
                                                <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $test['id'];?>'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php    }
                                    ?>

                                </div>
                                <!-- end-->


                            </div>
                            <div>

                                <div id="tab2">
                                   <?php 
                                 $language_centersql = executeQuery($conn, "select * from mng_testpreparation where test_type=1");
                                 while($language_center=getsinglerow($language_centersql)){
                                       ?>
                                 <div class="col-md-12 item2">
                                        <div class="servise-page">
                                          <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $language_center['id'];?>'>  <img src="images/<?php echo $language_center['image'];?>" alt="<?php echo $language_center['image_alt'];?>"></a>
                                            <div class="servise-page-text">
                                              <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $language_center['id'];?>'>  <h3><?php echo $language_center['test_name'];?></h3></a>
                                                <p class="paddding-bottom-20"><?php echo substr(strip_tags($language_center['details']),0,200);?>    </p>
                                                <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $language_center['id'];?>'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>     
                                <?php } 
                                   ?> 

                                </div>
                            </div>

                            <div>
                                <div id="tab3">
                                    <?php 
                                 $language_classql = executeQuery($conn, "select * from mng_testpreparation where test_type=2");
                                 while($language_class=getsinglerow($language_classql)){ ?>
                                          <div class="col-md-12 item2">
                                        <div class="servise-page">
                                       <a href="<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $language_class['id'];?>"><img src="images/<?php echo $language_class['image'];?>" alt="<?php echo $language_class['image_alt'];?>"></a>
                                            <div class="servise-page-text">
                                            <a href="<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $language_class['id'];?>"><h3><?php echo $language_class['test_name'];?></h3></a>
                                                <p class="paddding-bottom-20"><?php echo substr(strip_tags($language_class['details']),0,200);?>      </p>
                                                <a href='<?php echo SITEURL?>test_preparation.php?test_id=<?php echo $language_class['id'];?>'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                       ?>
<!--                                    <div class="col-md-12 item2">
                                        <div class="servise-page">
                                            <img src="images/tab-image7.jpg" alt="banner">
                                            <div class="servise-page-text">
                                                <h3>IELTS</h3>
                                                <p class="paddding-bottom-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut turpis condimentum, ornare est vel, pharetra purus. Nullam gravida magna vel finibus 
                                                </p>
                                                <a href='#'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 item2">
                                        <div class="servise-page">
                                            <img src="images/tab-image8.jpg" alt="banner">
                                            <div class="servise-page-text">
                                                <h3>TOEFL</h3>
                                                <p class="paddding-bottom-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut turpis condimentum, ornare est vel, pharetra purus. Nullam gravida magna vel finibus 
                                                </p>
                                                <a href='#'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 item2">
                                        <div class="servise-page">
                                            <img src="images/tab-image9.jpg" alt="banner">
                                            <div class="servise-page-text">
                                                <h3>PTE</h3>
                                                <p class="paddding-bottom-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut turpis condimentum, ornare est vel, pharetra purus. Nullam gravida magna vel finibus 
                                                </p>
                                                <a href='#'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 item2">
                                        <div class="servise-page">
                                            <img src="images/tab-image7.jpg" alt="banner">
                                            <div class="servise-page-text">
                                                <h3>PTE</h3>
                                                <p class="paddding-bottom-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut turpis condimentum, ornare est vel, pharetra purus. Nullam gravida magna vel finibus 
                                                </p>
                                                <a href='#'><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Test Preparation -->

        <!-- How it work -->
        <div class="work-section"> 
            <div class="container">
                <!-- Row1 -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>How it work</h2>
                        <div class="header-image"><img src="images/heading-line.png" alt="banner"></div>
                    </div>
                </div>
                <!-- Row1 -->

                <!-- Row2 -->
                <div class="row">
<?php
$fetch_howitworks = executeQuery($conn, "select * from mng_extras");
while ($howitworks = getsingleRow($fetch_howitworks)) {
    ?>
                        <div class="col-md-4">
                            <div class="work-box">
                                <img src="<?php echo SITEURL ?>upload_images/<?php echo $howitworks['icon']; ?>" alt="icon">
                                <h5><?php echo stripslashes($howitworks['contents']); ?></h5>
                            </div>
                        </div> 
                    <?php }
                    ?>
                </div>     
                <!-- Row2 -->
            </div>  
        </div>
        <!-- How it work -->

        <!-- Footer Top -->
        <?php include("common/footer.php"); ?>
        <!-- Footer -->


        <!-- Tab Plug-in Initialisation -->
        <script type="text/javascript">
            $(document).ready(function () {
//Horizontal Tab
                $('#parentHorizontalTab').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion
                    width: 'auto', //auto or any width like 600px
                    fit: true, // 100% fit in a container
                    tabidentify: 'hor_1', // The tab groups identifier
                    activate: function (event) { // Callback function if tab is switched
                        var $tab = $(this);
                        var $info = $('#nested-tabInfo');
                        var $name = $('span', $info);
                        $name.text($tab.text());
                        $info.show();
                    }
                });

// Child Tab
                $('#ChildVerticalTab_1').easyResponsiveTabs({
                    type: 'vertical',
                    width: 'auto',
                    fit: true,
                    tabidentify: 'ver_1', // The tab groups identifier
                    activetab_bg: '#fff', // background color for active tabs in this group
                    inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
                    active_border_color: '#c1c1c1', // border color for active tabs heads in this group
                    active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
                });

//Vertical Tab
                $('#parentVerticalTab').easyResponsiveTabs({
                    type: 'vertical', //Types: default, vertical, accordion
                    width: 'auto', //auto or any width like 600px
                    fit: true, // 100% fit in a container
                    closed: 'accordion', // Start closed if in accordion view
                    tabidentify: 'hor_1', // The tab groups identifier
                    activate: function (event) { // Callback function if tab is switched
                        var $tab = $(this);
                        var $info = $('#nested-tabInfo2');
                        var $name = $('span', $info);
                        $name.text($tab.text());
                        $info.show();
                    }
                });
            });
        </script>

    </body>
</html>