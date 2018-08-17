<div class="banner-form2">
    <div class="banner-form2-header"><h2>Contact Us to Apply</h2></div>
    <div class="banner-form2-body">
        <form id="form1" name="form1" method="post" action="process.php">
          <?php if(!empty( $_GET['cid'])){ ?>
              <input type="hidden" name="countrypage" value="fromcountry" >
         <?php } ?> 
               <?php if(!empty( $_GET['pid'])){ ?>
             <input type="hidden" name="aboutuspage" value="fromaboutus">
         <?php } ?> 
          <?php  if(!empty( $_GET['newsid'])){ ?>
             <input type="hidden" name="aboutuspage" value="newsandevents">
         <?php }  ?> 
            <div class="row"> 
                <div class="col-md-12 padding-5a">
                    <input type="text" name="fname" id="fname" placeholder="Enter Name" />
                </div>    
                <label for="fname" generated="true" class="error1" style="display:none;">please enter your name</label>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="email" id="email" placeholder="Email" />
                </div>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="phone" id="phone"  placeholder="Phone" />
                </div>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="course" id="course"  placeholder="Courses" />
                </div>
                <div class="col-md-6 padding-5a">
                    <input type="text" name="date1" id="date1" placeholder="Date(dd/mm/yy)" />
                </div>                   
                <div class="col-md-12 padding-5a">
                    <textarea name="message" id="msgg" cols="45" class="banner2-textarea"  placeholder="Enter Message" rows="5"></textarea>
                             
                    
                </div>
            </div>
            <div class="row" style="margin-top: 5px;">
                <div class="col-md-12  padding-5">
                      <center><div class="padding-5 g-recaptcha" data-sitekey="6LcjhCoUAAAAADB5yZhIdWJnDsX8ngzc-DR3kNji" style="transform:scale(0.78);"></div></center>
                       <input type="submit" class="button-submit" value="Submit Request">
                    <!--<a href="" class="button-submit">Submit Request</a>-->
<!--                 <input type="submit" class="g-recaptcha button-submit"
                                  data-sitekey="6Ld91ycUAAAAAANd39QREcemifjTLMysGIur1W3a"
                                    data-callback="submitForm"
                                   value="Submit Request"/>-->
                </div>
            </div>
        </form>
    </div>
</div>

<!-- booking form -->
<!-- Accordion -->

<div class="sitebar">
    <div class="sitebar-header">
        <h2>Our Services</h2>
    </div>
    <div class="tab-image"><img src="images/serice-tab.png" class="img-responsive" alt="logo"></div>
    <div class="sitebar-body">        
        <!-- Navigation -->
        <nav class="mainNav">
            <ul>
                <li><a href="<?php echo SITEURL ?>">Home</a></li>
                <?php
                $cms_sql = executeQuery($conn, "select * from mng_cmspages limit 1 offset 2");
                while ($aboutus = getsingleRow($cms_sql)) {
                    ?>
                    <li><a href="<?php echo SITEURL ?>page.php?pid=<?php echo $aboutus['id']; ?>"><?php echo ucwords($aboutus['page_name']); ?></a></li>
                <?php }
                ?>
                <li><a href="services.php">Our Services</a>
                    <ul>
                        <?php
                        $cat_sql = executeQuery($conn, "select * from mng_services where subcategory_id=2");
                        while ($services = getsingleRow($cat_sql)) {
                            $has_submenu = getTotalrows(executeQuery($conn, "select * from mng_services where subcategory_id={$services['id']}"));
                            ?>
                            <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services['id']; ?>"><?php echo $services['category_name']; ?></a>

                                <?php
                                $cat_sql1 = executeQuery($conn, "select * from mng_services where subcategory_id={$services['id']}");
                                $has_submenu1 = getTotalrows($cat_sql1);
                                if ($has_submenu1 > 0) {
                                    print "<ul>";
                                    while ($services1 = getsingleRow($cat_sql1)) {
                                        ?>
                                    <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services1['id']; ?>"><?php echo $services1['category_name']; ?></a>

                                        <?php
                                        $cat_sql2 = executeQuery($conn, "select * from mng_services where subcategory_id={$services1['id']}");
                                        $has_submenu2 = getTotalrows($cat_sql2);
                                        if ($has_submenu2 > 0) {
                                            print "<ul>";
                                            while ($services2 = getsingleRow($cat_sql2)) {
                                                ?>
                                            <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services2['id']; ?>"><?php echo $services2['category_name']; ?></a>

                                                <?php
                                                $cat_sql3 = executeQuery($conn, "select * from mng_services where subcategory_id={$services2['id']}");
                                                $has_submenu3 = getTotalrows($cat_sql3);
                                                if ($has_submenu3 > 0) {
                                                    print "<ul>";
                                                    while ($services3 = getsingleRow($cat_sql3)) {
                                                        ?>
                                                    <li><a href="<?php echo SITEURL ?>services.php?subid=<?php echo $services3['id']; ?>"><?php echo $services3['category_name']; ?></a></li>

                                                <?php } ?> </ul>
                                        <?php } ?>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        <?php }
                        ?>
                        </li>

                    <?php } ?> 
                    </ul><?php } ?>     </li>  

            <?php } ?></ul> 

            </li>
            <li><a href="#">Universities</a>
                <ul>
                    <?php
                    $country_sql = executeQuery($conn, "select * from mng_country");
                    while ($country = getsingleRow($country_sql)) {
                        ?>
                        <li><a href="university.php?cid=<?php echo $country['id']; ?>"><?php echo $country['country_name']; ?></a>
                            <ul>
                                <?php
                                $country_sql_pointer = executeQuery($conn, "select * from mng_countrypagedetails where cid={$country['id']}");
                                while ($pointer = getsingleRow($country_sql_pointer)) {
                                    ?>
                                    <li><a href="#pointer<?= $pointer['id'] ?>" style="text-transform: capitalize"><?php echo strtolower($pointer['pointer']) ?></a></li>
                                    <?php } ?>
                            </ul>
                        </li>

                    <?php }
                    ?>

                </ul>
            </li>
            <li><a href="blog.php">Blogs</a></li>
            <li><a href="#">Career</a>
                <ul>
                    <li><a href="#">Internship</a></li>
                </ul>
            </li>
            <li><a href="#">Gallery</a>
                <ul>
                    <li><a href="<?php echo SITEURL?>gallery.php">Events & Upcoming University visits</a></li>
                </ul>
            </li>
            <li><a href="<?php echo SITEURL;?>register_page.php">Apply Online</a>
                <ul>
                    <?php
                    $form_name_r = executeQuery($conn, "select * from mng_cmspages where id in(9,10,11)");
                    while ($formname = getsingleRow($form_name_r)) { ?>
				<li><a href="<?php echo SITEURL?>register_page.php?rid=<?php echo $formname['id'];?>"><?php echo ucwords($formname['page_heading']);?></a></li> 
		
				<?php	} ?>
                </ul>
            </li>
            <li><a href="contactus.php">Contact us</a></li>
            </ul>
        </nav>
        <!-- Navigation -->
    </div>
</div>


