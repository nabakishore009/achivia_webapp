<?php
include("library/adminconfig.php");
$db = new Db_Operation();
if (!empty($_GET['id'])) {
    // $seoservices_sql = executeQuery($conn, "select * from mng_services where subcategory_id='{$_GET['subid']}'");
   $db->Fetch(TABLE_SERVICES,NULL,NULL," where id=".$_GET['id']);
$seo_r=$db->Data[0];
$seo_r['meta_title']=$seo_r['meta_name'];
    //echo pre($seo_rr);
    // $main_service=getsingleRow($seo_rr);
    // $seo_r['og_url']="https://www.achivia.in/upload_images/".$main_service['image'];
// } else {
//     $seoservices_sql = executeQuery($conn, "select * from mng_cmspages where id=2");
//     $main_service=getsingleRow(executeQuery($conn,"select category_name,image from  mng_services where id not in(4,6) order by sortorder asc limit 1 "));
//     $seo_r['og_url']="https://www.achivia.in/upload_images/".$main_service['image'];
 }
else
{
      $db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=3");
$seo_r=$db->Data[0];
}
// while ($sevice_seo = getsingleRow($seoservices_sql)) {
//     $seo_r['meta_description'] = $sevice_seo['meta_description'];
//     $seo_r['page_name'] = $sevice_seo['page_name'];
//     $seo_r['meta_title'] = $sevice_seo['meta_title'];
//     $seo_r['seo_nofollow'] = $sevice_seo['seo_nofollow'];
//     $seo_r['meta_keyword'] = $sevice_seo['meta_keyword'];
// }
// while ($seo = getsingleRow($seo_rr)) {
//     $seo_r['meta_description'] = $seo['meta_description'];
//     $seo_r['page_name'] = $seo['page_name'];
//     $seo_r['meta_title'] = $seo['meta_title'];
//     $seo_r['seo_nofollow'] = $seo['seo_nofollow'];
//     $seo_r['meta_keyword'] = $seo['meta_keyword'];
// }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("common/seo.php"); ?>
        <?php include("common/stylesheet.php"); ?>
        <!-- slider -->
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
                       <?php if (!empty($_GET['id'])){?>
                        <h2><?php echo $seo_r['services_name']; ?></h2> 
                       <?php } else { $db->FetchSingle(TABLE_ALL_PAGES,"page_name",NULL," where id=3");  ?>
                       <h2><?php echo $db->DataStr; ?></h2>  
                       <?php } ?>
                        <ul>
                             <a href="<?php echo WEB_ADDRESS ?>"><li>Home / </li></a>
                            <a href="<?php echo WEB_ADDRESS ?>services"><li>Services <?php
                                    if (!empty($_GET['id'])) {
                                        print "/";
                                    }
                                    ?></li></a>
                            <?php
                          

                            if (!empty($_GET['id'])) {
                                ?>
                                <a href="<?= WEB_ADDRESS;?>services/<?php echo $seo_r['url']; ?>"><li><?php echo $seo_r['services_name']?></li></a>
                                <?php
                            }
                            ?>
                            <ul>
                                </div>
                                </div>
                                </div>
                                </div>

                                <!-- banner -->

                                <!-- body -->

                                <div class="bout-text1">
                                    <div class="container">
                                        <div class="col-md-12 text-center">
                                             <?php if (!empty($_GET['id'])){?>
                        <h2><?php echo $seo_r['services_name']; ?></h2> 
                       <?php } else { $db->FetchSingle(TABLE_ALL_PAGES,"page_name",NULL," where id=3");  ?>
                       <h2><?php echo $db->DataStr; ?></h2>  
                       <?php } ?>

                                            <div class="header-image"><img src="<?php echo WEB_ADDRESS ?>images/heading-line.png" alt="banner"></div>
                                        </div>
                                        
                                        <div class="inner-page">
                                            <?php
                                            if (!empty($_GET['id'])) {
                                                echo html_entity_decode(strip_tags(html_entity_decode(@$seo_r['description'])));
                                            } else {
                                               $db->FetchSingle(TABLE_ALL_PAGES,"description",NULL," where id=3");
                                               echo html_entity_decode(strip_tags(html_entity_decode(@$db->DataStr)));
                                            }
                                            
                                            ?>
                                        </div>
                                        <?php if (empty($_GET['id'])) { ?>
                                        <div class="row"><!-- main-row-->
                                            <div class="col-md-12">

                                                <!-- Row2-->

                                                <div class="row">
                                                    <?php
                                                    $i = 1;
                                                    if (empty($_GET['id'])) {
                                                  $db->Fetch(TABLE_SERVICES,NULL,NULL," where show_service=1 AND status=1 order by id ASC");
                         foreach($db->Data as $v){
                                                        // print pre($subservices);
                                                        ?>
                                                        <div class="col-md-4">
                                                            <div class="servise-page">
                                                                <a href="<?= WEB_ADDRESS;?>services/<?php echo $v['url']; ?>">
                                                                    <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$v['images'];?>&h=258&w=371&zc=1" alt="<?= $v['img_tags'] ?>">
                                                                </a>
                                                                <div class="servise-page-text">
                                                                    <a href="<?= WEB_ADDRESS;?>services/<?php echo $v['url']; ?>"> <h3><?php echo $v['services_name']; ?></h3></a>
                                                                   <?php $data=html_entity_decode(@$v['description']);?>
                                <p><?php echo substr(strip_tags(html_entity_decode($data, ENT_QUOTES, 'UTF-8')), 0, 180); ?>..</p>
                               
                                                                    <a href="<?= WEB_ADDRESS;?>services/<?php echo $v['url']; ?>"><h4>Read More <img src="images/news-butt.png" alt="banner"></h4></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        if ($i % 3 == 0) {
                                                            echo ' </div></div><div class="row"><!-- main-row-->
                                                                 <div class="col-md-12">';
                                                        }
                                                        $i++;
                                                    }
                                                }
                                                    ?>

                                                </div>     
                                                <!-- sub-Row2 -->
                                            </div>
                                        </div><!-- main-row-->

<?php } ?>

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