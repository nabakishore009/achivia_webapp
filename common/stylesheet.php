
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="<?php echo WEB_ADDRESS ?>css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- icon --> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- font --> 
<link href="<?php echo WEB_ADDRESS ?>css/style.css" rel="stylesheet">
<!-- menu -->
<link href="<?php echo WEB_ADDRESS ?>css/menu.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo WEB_ADDRESS ?>js/script.js?t=<?php echo time();?>"></script> 
<script type="text/javascript" src="<?php echo WEB_ADDRESS ?>js/jquery.cookie.js?t=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo WEB_ADDRESS ?>js/scripts.js?t=<?php echo time();?>"></script>


<!-- slider -->

<link rel="stylesheet" href="<?php echo WEB_ADDRESS ?>css/slider.css?t=<?php echo time();?>">
<link rel="stylesheet" href="<?php echo WEB_ADDRESS ?>css/responsiveslides.css?t=<?php echo time();?>">
<script src="<?php echo WEB_ADDRESS ?>js/responsiveslides.min.js?t=<?php echo time();?>"></script>
<link href="<?php echo WEB_ADDRESS ?>css/owl.carousel.css?t=<?php echo time();?>" rel="stylesheet">
<link href="<?php echo WEB_ADDRESS ?>css/owl.theme.css?t=<?php echo time();?>" rel="stylesheet">
<script src="<?php echo WEB_ADDRESS ?>js/owl.carousel.js?t=<?php echo time();?>"></script>
<script>
    $(document).ready(function () {
        // alert("running");
        $("#county_slide").owlCarousel({

            autoPlay: 3000,
            items: 5,
            itemsDesktop: [1199, 5],
            itemsTablet: [768, 3],
            itemsMobile: [479, 2],
            pagination: false
        });

    });
</script>
<script type="text/javascript">
    // You can also use "$(window).load(function() {"
    $(function () {


        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            speed: 800,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script> 