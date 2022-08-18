<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background: #3da6ea; border: 0;">
    <div class="navbar-header">
        <div class="logo">
        <a class="navbar-brand" href="index.php" title="CMS Admin - Delectech">
            <img src="templates/default/images/logo_delectech.png" />
        </a>
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="border: 0;">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar" style="background: #fff;"></span>
            <span class="icon-bar" style="background: #fff;"></span>
            <span class="icon-bar" style="background: #fff;"></span>
        </button>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">

            <?php 
                $db->query('SELECT count(id) as total
                FROM fs_order
                WHERE status = 0');
                $order_ss0 = $db->getObject();

             ?>
          
            <a class="vd_hd_nav" href="<?php echo $_SERVER['SCRIPT_NAME'].'?module=order&view=order'?>"><i class="fa fa-shopping-cart"></i> Có <strong style="color: red"><?php echo $order_ss0->total ?></strong> đơn hàng mới tiếp nhận</a>
            <a class="vd_hd_nav" href="<?php echo $_SERVER['SCRIPT_NAME'].'?module=iframe_huong_dan&view=iframe_huong_dan'?>"><i class="fa fa-video-camera"></i> Video hướng dẫn</a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['ad_username']; ?>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">

                <li><a href="index.php?module=users&view=log&task=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <!-- <div class="full_screen"></div> -->
  
    <!-- /.navbar-static-side -->
</nav>
<div class="clear"></div>
  <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse" >
            <?php require('modules/menus/admin.php');?>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>