<?php
include("includes/Db_Config.php");
if (!empty($_GET['cid'])) {
    $_SESSION['cid'] = $_GET['cid'];    //to redirect signup form
    $countryseo_sql = executeQuery($conn, "select * from mng_country where id={$_GET['cid']}");
    while ($country_seo = getsingleRow($countryseo_sql)) {
     $_SESSION['country_name']=$country_seo['country_name'];
        $seo_r['meta_description'] = $country_seo['meta_description'];
        $seo_r['page_name'] = $country_seo['page_name'];
        $seo_r['meta_title'] = $country_seo['meta_title'];
        $seo_r['seo_nofollow'] = $country_seo['seo_nofollow'];
        $seo_r['meta_keyword'] = $country_seo['meta_keyword'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script src='https://www.google.com/recaptcha/api.js'></script>
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


        <!-- Top Menu -->

        <!-- banner -->

        <div class="about-us-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <?php $Country_name_heading= getsingleRow(executeQuery($conn, "select id,country_name from mng_country where id={$_GET['cid']}"));?>
                        <h2><?php echo $Country_name_heading['country_name']; ?></h2>
                        <ul>
                            <li>Home / </li> 
                            <li><?php
                                $countryname_sql = executeQuery($conn, "select id,country_name from mng_country where id={$_GET['cid']}");
                                while ($country_name = getsingleRow($countryname_sql)) {
                                    ?>
                                    <?php echo $country_name['country_name']; ?>
                                <?php }
                                ?></li>

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
                                                $countrypage_sql = executeQuery($conn, "select * from mng_country where id={$_GET['cid']}");
                                                while ($country = getsingleRow($countrypage_sql)) {
                                                    ?>
                                                    <div class="padding-bottom-30"><img src="<?php echo SITEURL ?>timthumb.php?src=upload_images/<?php echo $country['image']; ?>&h=290&w=780&zc=1" class="img-responsive"></div>
                                                    <div class="country">
                                                        <?php if (!empty($country['contents'])) echo $country['contents']; ?>
                                                    </div>

                                                <?php }
                                                ?>
                                                <div class="list" style="text-transform: capitalise">
                                                    <ul>
                                                        <?php
                                                        $href1 = '';
                                                        $country_pointersql = executeQuery($conn, "select * from mng_countrypagedetails where cid={$_GET['cid']}");
                                                        while ($countrt_pointers = getsingleRow($country_pointersql)) {
                                                            $href1 = pointer . $countrt_pointers['id'];
                                                            ?>

                                                            <li><a href="#<?php print $href1; ?>" ><?php echo ucwords(strtolower($countrt_pointers['pointer'])); ?> </a></li>  

                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>   
                                                <div class="country">
                                                    <?php
                                                    $href2 = '';
                                                    $country_detailssql = executeQuery($conn, "select * from mng_countrypagedetails where cid={$_GET['cid']}");
                                                    while ($country_details = getsingleRow($country_detailssql)) {
                                                        $href2 = pointer . $country_details['id'];
                                                        ?>
                                                        <div id="<?php print $href2; ?>" class="lock-heading"><h3><div style="color: #0070c0;font-family: Verdana, serif;font-size: small;"><strong><?php echo $country_details['pointer']; ?> <?php
                                                                        if (!empty($_SESSION['uid']) && isset($_SESSION['uid'])) {
                                                                            
                                                                        } else if ($country_details['lock_status'] == 1) {
                                                                            ?><span class="lock" data-toggle="modal" data-target="#myModal" ><i class="fa fa-lock" aria-hidden="true"></i></span><?php } ?></strong></div></h3></div>
                                                                        <?php
                                                                        if (!empty($_SESSION['uid']) && isset($_SESSION['uid'])) {
                                                                            echo $country_details['details'];
                                                                        } else if ($country_details['lock_status'] == 0) {
                                                                            ?>
                                                            <div>
                                                                <?php echo $country_details['details']; ?>
                                                            </div>
                                                        <?php } ?>
                                                    <?php }
                                                    ?>

                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->

                                                        <div class="modal-body">
                                                            <form id='signupform' name='signupform' role="form" method="post" action="process.php">
                                                                <input type='hidden' name='userdetails' value='signup'>
                                                                <div class="col-lg-12">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            Please Fill Details To Unlock
                                                                        </div>
                                                                        <div class="panel-body"> 
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Name</label>
                                                                                    <input type='text' name='page[name]' id='name' class="form-control">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Email</label>
                                                                                    <input type='email' name='page[email]' id='email' class="form-control">
                                                                                </div>
                                                                                <!--                                                                                <div class="form-group">
                                                                                                                                                                    <label>Password</label>
                                                                                                                                                                    <input type='password' name='page[password]' class="form-control">
                                                                                                                                                                </div>-->
                                                                                <div class="form-group">
                                                                                    <label>Phone</label>
                                                                                    <input type='text' name='page[phone]' class="form-control">
                                                                                </div>
                                                                            </div>


                                                                            <input type="submit" class="btn btn-outline btn-primary btn-lg btn-block" value="Unlock">
                                                                            <br><br>
                                                                        </div>
                                                                        <!-- /.panel-body -->
                                                                    </div> 
                                                                    <!-- /.panel -->
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!--</div>-->

                                                    </div>
                                                </div>
                                                <!-- Modal End-->                         
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

                                </body>
                                </html>