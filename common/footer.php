<?php
if (isset($_POST['textfield'])) {
    $ip=USER_IP;
$add_date=DATEE;
    
   if( $db->Insert("mng_registrationqueries",array('email'=>$_POST['textfield'],'ip'=>$ip,'add_date'=>$add_date))){
       $msg = "Thanks For Subscription!"; 
  
}
else{
     $msg = " ";
}
}
?>
<!-- footer carousel -->
<div class="footer-carousel"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center-carasouel">
                <h2>Top Global Universities</h2>
                <div class="header-image"><img src="<?php echo WEB_ADDRESS ?>images/heading-line.png" alt="banner"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="county_slide" class="footer-Carousel-text ">
                    <?php  $db->Fetch(TABLE_UNIVERSITY_LOGOS,NULL,NULL," order by sortorder ASC");
                         foreach($db->Data as $v){ ?>
                        <a href="javascript:">
                            <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['image'];?>">
                            <h5><?php echo $v['university_name'] ?></h5>
                        </a>  
                    <?php }
                    ?>

                </div>
            </div>
        </div>
    </div>  
</div>
<!-- footer carousel -->

<div class="footer-top"> 
    <div class="container">
        <!-- Row1 -->
        <div class="row">
            <div class="col-md-6">
                <h2>Looking to study abroad?</h2>
            </div>
            <div class="col-md-6">
                <div class="looking">
                    <a href="<?php echo WEB_ADDRESS ?>registration" class="btn-border">Register With Us!</a> 
                </div>
            </div>
        </div>
        <!-- Row1 -->
    </div>  
</div>
<!-- Footer Top -->

<!-- Footer -->
<div class="footer-section"> 
    <div class="container">
        <!-- Row1 -->
        <div class="row border-bottom">
            <div class="col-md-5">
                <div class="about-footer padding-bottom-60">
                    <h5>About Us</h5>
                    <p> Achivia opens the door to personal growth and career development by placing students in
                        <span><a href="<?php echo WEB_ADDRESS ?>about"><i>Read more..</i></a></span>
                    </p>
                    <div class="social-icon">
                        <ul>
                            <?php
                           $db->Fetch(TABLE_MNG_SOCIAL,NULL,NULL);
                            foreach($db->Data as $v){
                                ?>
                                <li><a href="<?php echo $v['url']; ?>" target="_blank"><div class="<?php echo $v['name']; ?>"></div></a></li>

                            <?php }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-footer padding-bottom-60">
                    <h5>information</h5>
                    <ul>
                        <li><a href="<?php echo WEB_ADDRESS ?>">Home</a></li>
                        <li><a href="<?php echo WEB_ADDRESS ?>about">About Us</a></li>
                        <li><a href="<?php echo WEB_ADDRESS ?>services">Services</li>
                        <li><a href="<?php echo WEB_ADDRESS ?>blog">Blog</li>
                        <li><a href="<?php echo WEB_ADDRESS ?>career">Career</a></li>
                    </ul>
                </div>
            </div>
          
            <div class="col-md-2">
                <div class="info-footer padding-bottom-60">
                    <h5>Quick Links</h5>
                    <ul>
                        <?php
                        $db->Fetch(TABLE_COUNTRY,NULL,NULL," order by id DESC");
foreach($db->Data as $v){
                            ?>

                            <li><a href="<?php echo WEB_ADDRESS ?>country/<?php echo $v['page_url']; ?>"><?php echo (strtoupper($v['country_name'])); ?> </a></li>

                        <?php }
                        ?>
                        <?php
                         $db->Fetch(TABLE_TEST_PREPARATION,NULL,NULL," where status=1 order by sortorder ASC");
                            foreach($db->Data as $v){ ?>
                            <li><a href="<?php echo WEB_ADDRESS ?>test-preparation/<?php echo $v['page_url']; ?>"><?php echo $v['test_name'] ?> </a></li>  
                        <?php }
                        ?> 
                    </ul>

                </div>
            </div>
            <div class="col-md-3">
                  <?php if (isset($msg)) { ?>  
<center style="color:red;"><?php echo $msg; ?> </center>
<?php } ?>
                <div class="subs-footer padding-bottom-60">
                    <h5>NEWSLETTER SUBSCRIPTION</h5>
                    <form id="form1" name="form1" method="post" action="">
                        <input name="textfield" id="textfield" placeholder="Type your email" class="border-field" type="email" required>
                        <input name="button" id="button" class="news-btn" value="Submit" type="submit">
                    </form>
                </div>
            </div>
        </div>
        <!-- Row1 -->

        <!-- Row2 -->
        <div class="row">
            <div class="col-md-6">
                <div class="copy-left">
                    <p>&copy; <?php echo date("Y"); ?> achivia.in,  All Rights Reserved.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="copy-right">
                    <p>Powered by <a href="https://inflexi.com/" tareget="_blank;">INFLEXI</a></p>
                </div>
            </div>
        </div>
        <!-- Row2 -->
    </div>  
</div>
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-599d7e0f0d0857e4"></script>



<script type="text/javascript">


    $(document).ready(function () {



        $('#app-worp').css({"top": ($(window).height() / 2) - ($("#app-worp").height() / 2) + "px", });


        $('.list4 ul li .default-pic').css({"left": ($(".list4 ul li").width() / 2) - ($(".default-pic").width() / 2) + "px", });

        $(window).resize(function () {

            $('#app-worp').css({"top": ($(window).height() / 2) - ($("#app-worp").height() / 2) + "px", });

        });



        $(".whatsapp, .viber, .hike").click(function () {



            // Set the effect type

            var effect = 'slide';



            // Set the options for the effect type chosen

            var options = {direction: 'right'};



            // Set the duration (default: 400 milliseconds)

            var duration = 300;



            //$('#body').toggle(effect, options, duration);

            $('.myDivapp', this).animate({width: 'toggle'});



        });


        $(".whatsapp, .viber, .hike").hover(
                function () {
                    var effect = 'slide';



                    // Set the options for the effect type chosen

                    var options = {direction: 'right'};



                    // Set the duration (default: 400 milliseconds)

                    var duration = 300;



                    //$('#body').toggle(effect, options, duration);

                    $('.myDivapp', this).animate({width: 'toggle'});

                },
                function () {
                    var effect = 'slide';



                    // Set the options for the effect type chosen

                    var options = {direction: 'right'};



                    // Set the duration (default: 400 milliseconds)

                    var duration = 300;



                    //$('#body').toggle(effect, options, duration);

                    $('.myDivapp', this).animate({width: 'toggle'});

                }
        );

    });



</script>
