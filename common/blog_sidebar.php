<?php
if(!empty($_GET['id'])){
$db->runSql("select * from mng_blogs where status='1' and  id!={$_GET['id']} order by blog_dt desc limit 2");

}else{
$db->runSql("select * from mng_blogs where status='1' order by id desc limit 2");
}
$blogs = $db->Data;
  $db->runSql("select * from mng_blogcategory order by category_sorder asc ");
$blogs_category=$db->Data;
?>
<div class="col-md-3">
    <!-- serch-form -->
    <div class="serch-form padding-bottom-30">
        <form action="<?php WEB_ADDRESS ?>blog.php" name="searchform"  id="searchform" method="get">
            <!--<input type="hidden" name="stage" value="search">-->
            <div class="form-left">
                <input type="text" name="searchtext" id="searchtext" placeholder="Search">
            </div>
            <button type="submit" class="form-right">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
        <div class="clear"></div>
    </div><!-- serch-form -->
    <!-- Recent Post -->
    <!-- Header Recent Post -->
    <div class="recent-post padding-bottom-60">
        <h4>recent posts</h4>
        <div class="border-blue"></div>
        <!-- Header Recent Post -->
        <!-- Body Recent Post -->
        <?php foreach ($blogs as $blog) { ?>
            <div class="body-recent">
                <div class="left-body-recent">

                    <span> <a href='<?php echo WEB_ADDRESS ?>blog/<?php echo $blog['url']; ?>'><img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$blog['blogimage'];?>&w=70&h=58&zc=1"></a></span>
                </div>
                <div class="right-body-recent">
                    <span><a href='<?php echo WEB_ADDRESS ?>blog/<?php echo $blog['url']; ?>'><h5><?php
                    $pieces = explode(" ", $blog['blogname']);
$first_part = implode(" ", array_splice($pieces, 0, 5)); echo $first_part; ?></h5></a></span>
                    <p><?php echo date('M d Y', strtotime($blog['blog_dt'])); ?></p>
                </div>
            </div>
        <?php } ?>
        <!-- Body Recent Post -->

    </div>
    <!-- Categories -->

    <div class="categories">
        <div class="recent-post padding-bottom-60 categories-left">
            <h4>Categories</h4>
            <div class="border-blue"></div>
            <div class="categories">
                
                <ul>
                    <?php foreach ($blogs_category as $category) {
                        
                        ?>
                        <li><a href="<?php echo WEB_ADDRESS.$category['url']?>"><?php echo $category['category_name']; ?></a></li> 
                    <?php }
                    ?>    

                </ul>
            </div>
        </div>







        <div class="recent-post padding-bottom-60 categories-left">
            <h4>archieves</h4>
            <div class="border-blue"></div>
            <div class="categories">
                <ul>
                    <?php
                    $curyear = date('Y');
                    $db->runSql("select b.blog_year from (SELECT year(blog_dt) as blog_year FROM `mng_blogs` WHERE  status='1') as b where b.blog_year<={$curyear}  group by  b.blog_year order by b.blog_year desc ");
                    $yearsql = $db->Data;
                                                     
                    $no_rows=$db->DataCount;
                    if ($no_rows) {
                        for($i=0;$i<$no_rows;$i++) {
                            
                            $db->runSql("select b.id,b.month_no,b.blog_month,b.blog_year from (SELECT id,month(blog_dt)as month_no,year(blog_dt)as blog_year,monthname(blog_dt) as blog_month FROM `mng_blogs` WHERE status='1') as b where b.blog_year={$yearsql[$i]['blog_year']}  group by  b.month_no order by b.month_no desc");
                            $monthsql =  $db->Data;
                           
                            $no_rows_month=$db->DataCount;
                            if ($no_rows_month) {
                                for($j=0;$j<$no_rows_month;$j++) {
                                   
                                     $db->runSql("select b.id,b.month_no,b.blog_month,b.blog_year from (SELECT id,month(blog_dt)as month_no,year(blog_dt)as blog_year,monthname(blog_dt) as blog_month FROM `mng_blogs` WHERE status='1') as b where b.month_no={$monthsql[$j]['month_no']} and b.blog_year={$yearsql[$i]['blog_year']}");

                                     $totalpostcountsql = $db->Data;
                                      $totalpostcount = $db->DataCount;
                                    ?>

                                    <li><a href="<?PHP echo WEB_ADDRESS;?>blog?year=<?php echo $yearsql[$i]['blog_year'] ?>&month=<?php echo $monthsql[$j]['month_no'] ?>"> &nbsp;<?php echo $monthsql[$j]['blog_month'] . " " . $yearsql[$i]['blog_year'] ?>&nbsp;(<?php echo $totalpostcount ?>)</a></li> 

                                    <?php
                                }
                            }
                        }
                    }
                    ?>

            </div>
        </div>

    </div>
    <!-- Categories -->

</div>
