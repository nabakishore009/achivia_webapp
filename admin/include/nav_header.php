<?php
$db = new Db_Operation();
date_default_timezone_set('Asia/Calcutta');
$db->Fetch(TABLE_USER_TRACK,NULL,array(array('where','datee',date("Y-m-d"))));
$visitors=$db->DataCount;
$db->Fetch(TABLE_USER_CONTACT,NULL,NULL);
?>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php foreach ($db->Data as $data) {?>
                         
                     
                        <li>
                            <a href="#">
                                <div>
                                    <strong><?= $data['name']; ?></strong>
                                    <span class="pull-right text-muted">
                                        <em><?= $data['datee']; ?></em>
                                    </span>
                                </div>
                                <div><?= substr($data['message'],0,20);?></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                           <?php } ?>
                        <li>
                            <a class="text-center" href="../pages/mng_contactquote.php">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                 
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> Today's Visitors
                                    <span class="pull-right text-muted small"><?=$visitors ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="../pages/mng_visitquote.php">
                                <strong>See All Visitors</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="../pages/changepwd.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../pages/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->