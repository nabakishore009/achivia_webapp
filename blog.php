<?php

include("library/adminconfig.php");
$db = new Db_Operation();
$page_name="";

$db->Fetch(TABLE_ALL_PAGES,NULL,NULL," where id=4");
$seo_r=$db->Data[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("common/seo.php");?>
<?php include("common/stylesheet.php");?>
<!-- slider -->

</head>
</head>
<body>
<!-- Hearder -->
<?php include("common/header.php");?>
<!-- Hearder -->

<!-- Top Menu -->
<?php include("common/menu.php");?>

<!-- Top Menu -->

<!-- banner -->

<div class="about-us-banner">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Blog</h2>
<ul>
<a href="<?php echo WEB_ADDRESS ?>"><li>Home / </li></a> 
<a href="<?php echo WEB_ADDRESS ?>blog"><li>Blog </li></a>
<ul>
</div>
</div>
</div>
</div>

<!-- banner -->

<!-- body -->


<div class="blog-body">
<div class="container">
<div class="row">
<div class="col-md-9">
<?php
/* Pagination Start Code */
$cond = " 1 ";
if (!empty($_REQUEST['id'])) {
$cond.=" and b.blog_id={$_GET['id']} ";
} if (!empty($_REQUEST['year'])) {
$cond.=" and b.blog_year={$_GET['year']}  ";
}
if (!empty($_REQUEST['month'])) {
$cond.=" and b.blog_month={$_GET['month']} ";
}
if (!empty($_REQUEST['searchtext'])) {
$cond.=" and blogname LIKE '%{$_GET['searchtext']}%' or description LIKE '%{$_GET['searchtext']}%' ";
}


$psql = "select b.* from (select id,url,blog_id,blogname,blog_dt,description,blogimage,year(blog_dt) as blog_year, month(blog_dt)as blog_month from mng_blogs where status='1'  order by blog_dt desc) as b where {$cond} order by b.id desc";
//  echo $psql;
// exit;
$limit_perpage = 5;
$db->runSql($psql);
$prs =$db->Data;
$num = $db->DataCount;
$total = $db->DataCount;

$adjacents = 3;

$targetpage = "blog"; //your file name  (the name of this file)
//$targetpage = $blogpage_url;
$limit = $limit_perpage;          //how many items to show per page


if (isset($_GET['page'])) {
// echo $_GET['page'];
// exit;
$page = $_GET['page'];
$start = ($page - 1) * $limit;    //first item to display on this page
} else {
$start = 0;
$page=0;
}

/* Setup page vars for display. */
if ($page == 0)
$page = 1;     //if no page var is given, default to 1.
$prev = $page - 1;       //previous page is page - 1
$next = $page + 1;       //next page is page + 1
$lastpage = ceil($total / $limit);   //lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;      //last page minus 1



$add = "";

if (!empty($_REQUEST['id'])) {
$add .= "&id={$_REQUEST['id']}";
}
if (!empty($_REQUEST['year'])) {
$add .= "&year={$_REQUEST['year']}";
}
if (!empty($_REQUEST['month'])) {
$add .= "&month={$_REQUEST['month']}";
}
//                                                if ($search) {
//                                                    $add .= "&search=$search";
//                                                }




$sql="select b.* from (select id,url,blog_id,blogname,blog_dt,sort_description,description,blogimage,year(blog_dt) as blog_year, month(blog_dt)as blog_month from mng_blogs where status='1'  order by blog_dt desc) as b where {$cond} order by b.id asc";

$sql .= "  limit $start ,$limit ";

//print $sql."<br/>";

$db->runSql($sql);
$main_data=$db->Data;
$curnm = $db->DataCount;
$counter=0;
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

if ( $total ) {

foreach ($main_data as $blog_r) {
?>


<div class="row">
<div class="col-md-12">
<div class="padding-bottom-60">
<div class="row">
<div class="col-md-2">
<div class="blog-date">
<h4><?php echo date('d', strtotime($blog_r['blog_dt'])); ?></h4>
<p><?php echo date('M', strtotime($blog_r['blog_dt'])); ?></p>
</div>
</div>
<div class="col-md-10">
<div class="padding-bottom-30 blog-image">
<span><a href="<?php echo WEB_ADDRESS ?>blog/<?php echo $blog_r['url']; ?>">  <img src="<?= WEB_ADDRESS;?>timthumb.php?src=<?=UPLOADS_PATH.$blog_r['blogimage']; ?>&w=702&h=365" class="img-responsive"></a></span>
</div>
<div class="blog-text">
<span><a href="<?= WEB_ADDRESS;?>blog/<?php echo $blog_r['url']; ?>">  <h2><?php echo $blog_r['blogname']; ?></h2></a></span>
<p><?php echo $blog_r['sort_description']; ?></p>
<span><a href="<?= WEB_ADDRESS;?>blog/<?php echo $blog_r['url']; ?>">READ MORE</a></span>
</div>
</div>
</div>
</div>
</div>
</div>   
<?php
}
} else {
?>



<div class="col-md-9 ">

<span style="font-color:red;">No post found!!! </span>    

</div> 

<?php }
?>
<?php print $pagination; ?>  
<!-- nested row 1 -->



</div>
<?php include("common/blog_sidebar.php"); ?>
</div><!-- firstrow -->
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