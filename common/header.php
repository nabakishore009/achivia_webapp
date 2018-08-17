<?php
$db->Fetch(TABLE_CONTACT,NULL,NULL," where id=1");
$header_phone=$db->Data[0];
?>
<div class="hearder-fixed">
<!-- Mobile Hearder -->
<div id="app-worp">

    <div class="whatsapp"> <img src="<?php echo WEB_ADDRESS ?>images/whatsapp.png"  alt="whatup" id="whatsapp">

        <div class="myDivapp">

            <p><img src="<?php echo WEB_ADDRESS ?>images/s3.png"  alt="hone"><b style="font-size: 12px;">760-600-2979  </b></p>

            <small>Also call to this number</small>

        </div>

    </div>

    <div class="viber"> <img src="<?php echo WEB_ADDRESS ?>images/viber.png"  alt="whatup" id="viber">

        <div class="myDivapp">

            <p><img src="<?php echo WEB_ADDRESS ?>images/s3.png"  alt="hone"><b style="font-size: 12px;">0674-2972-615 </b></p>

            <small>Call Us</small>

        </div>

    </div>
</div>


<div class="top-section"> 
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="top-left">
                    <li>Have any question? <i class="fa fa-phone" aria-hidden="true"></i>
                        <a href="tel:+91<?php echo $header_phone['phn_no']; ?>"> <?php echo $header_phone['phn_no']; ?></a>
                    </li>
                    <li><a href="whatsapp://send?text=Hello World!&phone=<?php echo $header_phone['name']; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i><?php echo $header_phone['name']; ?></a></li>
                    <li><a href="mailto:education@achivia.in"><i class="fa fa-envelope-o" aria-hidden="true"></i>education@achivia.in</a></li>
              </div>
            </div>

            <div class="col-md-2">
                <div class="top-right">
                    <ul>
                        <?php $db->Fetch(TABLE_MNG_SOCIAL,NULL,NULL," order by id ASC");?>
                           <?php foreach($db->Data as $data) {
                  if($data['name']=="facebook") {?>
                    <li><a href="<?= $data['url'] ?>"><i class="fa fa-facebook-f"></i></a></li>
                  <?php }?>
                  <?php if($data['name']=="twitter") {?>
                    <li><a href="<?= $data['url'] ?>"><i class="fa fa-twitter"></i></a></li>
                  <?php } ?>
                  <?php if($data['name']=="google") {?>
                  <li><a href="<?= $data['url'] ?>"><i class="fa fa-google-plus"></i></a></li>
                  <?php } ?>
                  <?php if($data['name']=="instagram") {?>
                  <li><a href="<?= $data['url'] ?>"><i class="fa fa-instagram"></i></a></li>
                  <?php } ?>
                <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>	
</div>

<!-- Mobile Hearder -->

<div class="mobile-top-section"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-top">
                    <ul>
                        <li><a href="tel:<?php echo $header_phone['phn_no']; ?>"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $header_phone['phn_no']; ?></a></li>
                        <li><a href="whatsapp://send?text=Hello World!&phone=+917606002979"><i class="fa fa-whatsapp" aria-hidden="true"></i>+917606002979</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

