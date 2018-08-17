<h3 class="heading_txt5  border_all">  Recent Posts </h3>



<div class="blog_list">

    <ul class="list-group">

        <?php
        $recentblogsql = mysql_query("select * from mng_blogs where status=1 order by blog_dt desc limit 2");

        if (mysql_num_rows($recentblogsql)) {

            while ($recentblog = mysql_fetch_assoc($recentblogsql)) {
                $bloginnerpage_url = removeSpchar($recentblog['blogname']);
                ?>

                <li class="list-group-item">

                    <a href="<?PHP echo SITEURL.$blogpage_url."/".$bloginnerpage_url;?>">

                        <img src="<?php echo SITEURL?>timthumb.php?src=<?php echo SITEURL . "/blog_image/" . $recentblog['blogimage'] ?>&w=80&h=54&zc=0">

                        <p><?php echo $recentblog['blogname'] ?></p>

                    </a><small><?php echo date('F  d,Y', strtotime($recentblog['blog_dt'])) ?></small>

                </li>



                <?php
            }
        }
        ?>

    </ul>

</div>



<h3 class="heading_txt5  border_all"> Recent Blog Category </h3>



<div class="blog_list">

    <ul class="list-group">

        <?php
        $blogcatsql = mysql_query("select * from mng_blogcategory order by id asc");

        if (mysql_num_rows($blogcatsql) > 0) {

            while ($blogcat_r = mysql_fetch_assoc($blogcatsql)) {
                $blogcartpege_url = removeSpchar($blogcat_r['name']);
                ?>

                <li class="list-group-item"><a href="<?PHP echo SITEURL.$blogpage_url."/category/".$blogcartpege_url;?>"><?php echo $blogcat_r['name'] ?></a></li>

                <?php
            }
        }
        ?>

    </ul>

</div>





<h3 class="heading_txt5  border_all"> Archives</h3>



<div class="blog_list">

    <ul class="list-group">

        <?php
        $curyear = date('Y');
        $yearsql = mysql_query(" select b.blog_year from (SELECT year(blog_dt) as blog_year FROM `mng_blogs` WHERE  status=1) as b where b.blog_year<={$curyear}  group by  b.blog_year order by b.blog_year desc ");
        if (mysql_num_rows($yearsql)) {
            while ($blog_year = mysql_fetch_assoc($yearsql)) {
                $monthsql = mysql_query(" select b.id,b.month_no,b.blog_month,b.blog_year from (SELECT id,month(blog_dt)as month_no,year(blog_dt)as blog_year,monthname(blog_dt) as blog_month FROM `mng_blogs` WHERE status=1) as b where b.blog_year={$blog_year['blog_year']}  group by  b.month_no order by b.month_no desc");
                if (mysql_num_rows($monthsql)) {

                    while ($inner_row = mysql_fetch_assoc($monthsql)) {
                        ?>

        <li class="list-group-item"><a href="<?PHP echo SITEURL.$blogpage_url?>?year=<?php echo $inner_row['blog_year']?>&month=<?php echo $inner_row['month_no']?>"><i class="fa fa-calendar"></i> &nbsp;<?php echo $inner_row['blog_month']." ".$inner_row['blog_year']?></a></li> 

                        <?php
                    }
                }
            }
        }
        ?>





    </ul>

</div>