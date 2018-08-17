<?php
include("includes/connection.php");
$page_r =mysql_fetch_assoc(mysql_query("select * from mng_blogbanner"));

//$pagedetails = str_replace("../upload_image/", "upload_image/", $page_r['contents']);

$page_record['page_title'] = $page_r['page_title'];

$page_record['meta_keyword'] =  $page_r['meta_keyword'];

$page_record['meta_description'] = $page_r['meta_description'];
//$banner_r = mysql_fetch_assoc(mysql_query("select * from mng_blogbanner"));

$banner_image = $page_r['banner_image'];
?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <?php include('seo.php'); ?>

        <?php include('style_sheet.php'); ?>



    </head>

    <body>

        <header>

            <?php include('header.php'); ?>
            <style type="text/css">
                
                .page_active{
                    color:#fff;
                    text-decoration: none;
                    background:#0099FF !important;
                    display:block;
                    padding:4px 6px; 
                }
                  
            </style>  
        </header>

        <div class="container-fluid">

            <div class="row">

<!--                <img src="images/big_banner.jpg" class="img-responsive" >-->

                <img style="width:100%" src="<?php echo SITEURL;?>timthumb.php?src=<?php echo SITEURL ?>/banner/<?php echo $banner_image ?>&w=1349&h=379&zc=0" class="img-responsive" >

            </div></div>

        <section>

            <div class="clearfix"></div>

            <div class="container margin_top1">

                <div class="row"></div>

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 ">



                        <div class="col-md-9 margin_top1">

                            <?php
                            /* Pagination Start Code */
                            $cond = " 1 ";
                            if (!empty($_REQUEST['catid'])) {
                                $cond.=" and b.catid={$_GET['catid']} ";
                            } if (!empty($_REQUEST['year'])) {
                                $cond.=" and b.blog_year={$_GET['year']}  ";
                            }
                            if (!empty($_REQUEST['month'])) {
                                $cond.=" and b.blog_month={$_GET['month']} ";
                            }


                            $psql = "select b.* from (select id,catid,blogname,blog_dt,details,blogimage,year(blog_dt) as blog_year, month(blog_dt)as blog_month from mng_blogs where status=1  order by blog_dt desc) as b where {$cond} order by b.blog_year desc,b.blog_month desc";


                            $limit_perpage = 5;
                            $prs = mysql_query($psql);
                            $num = mysql_num_rows($prs);
                            $total = mysql_num_rows($prs);

                            $adjacents = 3;

                            //$targetpage = "blog.php"; //your file name  (the name of this file)
                            $targetpage=$blogpage_url;
                            $limit = $limit_perpage;          //how many items to show per page
                            $page = $_GET['page'];

                            if ($page) {
                                $start = ($page - 1) * $limit;    //first item to display on this page
                            } else {
                                $start = 0;
                            }

                            /* Setup page vars for display. */
                            if ($page == 0)
                                $page = 1;     //if no page var is given, default to 1.
                            $prev = $page - 1;       //previous page is page - 1
                            $next = $page + 1;       //next page is page + 1
                            $lastpage = ceil($total / $limit);   //lastpage is = total pages / items per page, rounded up.
                            $lpm1 = $lastpage - 1;      //last page minus 1



                            $add = "";

                            if (!empty($_REQUEST['catid'])) {
                                $add .= "&catid={$_REQUEST['catid']}";
                            }
                            if (!empty($_REQUEST['year'])) {
                                $add .= "&year={$_REQUEST['year']}";
                            }
                            if (!empty($_REQUEST['month'])) {
                                $add .= "&month={$_REQUEST['month']}";
                            }
                            if ($search) {
                                $add .= "&search=$search";
                            }




                            $sql.="select b.* from (select id,catid,blogname,blog_dt,details,blogimage,year(blog_dt) as blog_year, month(blog_dt)as blog_month from mng_blogs where status=1  order by blog_dt desc) as b where {$cond} order by b.blog_year desc,b.blog_month desc";

                            $sql .= "  limit $start ,$limit ";

                            //print $sql."<br/>";

                            $query = mysql_query($sql);
                            $curnm = mysql_num_rows($query);

                            $pagination = "";
                            if ($lastpage > 1) {
                                $pagination .= "<div class='pagination1' style='margin-left:35%'><nav> <ul class='pagination'>";
                                if ($page > $counter + 1) {
                                    $pagination.= "<li class='prev'><a href=\"$targetpage?page=$prev$add\">Previous</a></li>";
                                }

                                if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                                        if ($counter == $page)
                                            $pagination.= "<li><a href='#' class='page_active'>$counter</a></li>";
                                        else
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter$add\">$counter</a></li>";
                                    }
                                }
                                elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                                    //close to beginning; only hide later pages
                                    if ($page < 1 + ($adjacents * 2)) {
                                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                            if ($counter == $page)
                                                $pagination.= "<li><a href='#' class='page_active'>$counter</a></li>";
                                            else
                                                $pagination.= "<li><a href=\"$targetpage?page=$counter$add\">$counter</a></li>";
                                        }
                                        $pagination.= "<li>...</li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lpm1$add\">$lpm1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lastpage$add\">$lastpage</a></li>";
                                    }
                                    //in middle; hide some front and some back
                                    elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                        $pagination.= "<li><a href=\"$targetpage?page=1$add\">1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=2$add\">2</a></li>";
                                        $pagination.= "<li>...</li>";
                                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                            if ($counter == $page)
                                                $pagination.= "<li><a href='#' class='page_active'>$counter</a></li>";
                                            else
                                                $pagination.= "<li><a href=\"$targetpage?page=$counter$add\">$counter</a></li>";
                                        }
                                        $pagination.= "<li>...</li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lpm1$add\">$lpm1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lastpage$add\">$lastpage</a></li>";
                                    }
                                    //close to end; only hide early pages
                                    else {
                                        $pagination.= "<li><a href=\"$targetpage?page=1$add\">1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=2$add\">2</a></li>";
                                        $pagination.= "<li><b>....</b></li>";
                                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                            if ($counter == $page)
                                                $pagination.= "<li><a href='#' class='page_active'>$counter</a></li>";
                                            else
                                                $pagination.= "<li><a href=\"$targetpage?page=$counter$add\">$counter</a></li>";
                                        }
                                    }
                                }

                                //next button
                                if ($page < $counter - 1) {
                                    $pagination.= "<li class='next'><a href=\"$targetpage?page=$next$add\">Next</a></li>";
                                } else
                                    $pagination.= "";
                                $pagination.= "</ul></nav></div>\n";
                            }
                            /* Pagination code end here */
                            /* Pagination Code end */


                            $cond = "1";

                            if (!empty($_GET['catid'])) {

                                $cond.=" and b.catid={$_GET['catid']}";
                            }
                            if (!empty($_GET['year']) && !empty($_GET['month'])) {
                                $cond.=" and b.blog_year={$_GET['year']} and blog_month={$_GET['month']} ";
                            }

                            //$allblogsql = "select b.* from (select id,blogname,blog_dt,details,blogimage,year(blog_dt) as blog_year, month(blog_dt)as blog_month from mng_blogs where status=1  order by blog_dt desc) as b where {$cond} order by blog_month desc";
                            //print $allblogsql;
                            //$query = mysql_query($allblogsql);

                            if (mysql_num_rows($query)) {

                                while ($blog_r = mysql_fetch_assoc($query)) {
                                     $bloginnerpage_url = removeSpchar($blog_r['blogname']);
                                    ?>

                                    <div class="col-md-12 border_btm margin_top2">

                                        <div class="blog_m"><img src="<?php echo SITEURL ?>timthumb.php?src=<?php echo SITEURL ?>/blog_image/<?php echo $blog_r['blogimage'] ?>&w=791&h=316&zc=0" class="img-responsive" ></div>

                                        <div class="col-md-4  padding_2"><a href="<?PHP echo SITEURL.$blogpage_url."/".$bloginnerpage_url;?>"><h3 class="heading_txt6"><?php echo $blog_r['blogname'] ?></h3></a>

                                            <small> <strong><a href="<?PHP echo SITEURL.$blogpage_url."/".$bloginnerpage_url;?>"><?php echo date('F  d,Y', strtotime($blog_r['blog_dt'])) ?></a></strong> | Posted By Admin</small></div>

                                        <div class="col-md-8">

                                            <p class="margin_top2"> 

                                                <?php
                                                echo word_limiter(strip_tags($blog_r['details']), 30);
                                                ?>

                                                <br>



                                                <!--<a href="blogdetails.php?id=<?php echo $blog_r['id'] ?>"><i class="fa fa-arrow-circle-o-right"></i>&nbsp; more</a>-->
                                                <a href="<?PHP echo SITEURL.$blogpage_url."/".$bloginnerpage_url;?>"><i class="fa fa-arrow-circle-o-right"></i>&nbsp; more</a>

                                            </p>

                                        </div>





                                    </div> 

                                    <?php
                                }
                            } else {
                                ?>



                                <div class="col-md-12 border_btm margin_top2">

                                    <span style="font-color:red;">No post found!!! </span>    

                                </div> 

                            <?php }
                            ?>














                            <?php print $pagination; ?>


                        </div>

                        <div class="col-md-3 margin_top3">

                            <?php include("blog_sidebar.php") ?>      





                        </div>

                    </div>

                </div>

            </div>

        </section>

        <footer>

            <?php include('footer.php'); ?>

        </footer>

        <?php include('login_forms.php'); ?>



        <script>





        </script>







    </body>

</html>

