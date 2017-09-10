<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Creative - Bootstrap Admin Template</title>

    <!-- Bootstrap CSS -->    
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?= base_url('css/bootstrap-theme.css') ?>" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?= base_url('css/elegant-icons-style.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('css/font-awesome.min.css') ?>" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="<?= base_url('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/fullcalendar/fullcalendar/fullcalendar.css') ?>" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?= base_url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') ?>" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?= base_url('css/owl.carousel.css') ?>" type="text/css">
	<link href="<?= base_url('css/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="<?= base_url('css/fullcalendar.css') ?>">
	<link href="<?= base_url('css/widgets.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/style-responsive.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('css/xcharts.min.css') ?>" rel=" stylesheet">	
	<link href="<?= base_url('css/jquery-ui-1.10.4.min.css') ?>" rel="stylesheet">
	<!-- Timeline style -->
	<link href="<?= base_url('css/timeline.css') ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
    <script src="<?= base_url('js/jquery.js') ?>"></script>
	<script src="<?= base_url('js/jquery-ui-1.10.4.min.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?= base_url('js/jquery-ui-1.9.2.custom.min.js') ?>"></script>
  </head>
<body>
	<!-- container section start -->
  <section id="container" class="">
     
      
      <header id="site-header" class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <?php if ($_SESSION['is_admin']==1): ?>
            <a href="<?= base_url('adminhome') ?>" class="logo">Šiaulių centro <span class="lite">poliklinika</span></a>
            <?php elseif ($_SESSION['is_admin']==0): ?>
           <a href="<?= base_url('home') ?>" class="logo">Šiaulių centro <span class="lite">poliklinika</span></a>
      		<?php endif; ?>
            <!--logo end-->

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- inbox notificatoin start-->
                    <li id="mail_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        	 
                            <i class="icon-envelope-l"></i>
                            <span class="badge bg-important"><?php echo count($asmnew)?> </span>
                            
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <p class="blue">Asmenines naujienos </p>
                            </li>
                            <?php if (empty($naujienos['asmnew'])):?>
                            <?php foreach (array_reverse($asmnew) as $value): ?>
                            
                         
							<form class="form-group" action="<?= base_url('User/naujienav') ?>">
                            <li>
                                 <a>
                                    <span class="photo"><img alt="avatar" src="<?= base_url('img/defaultprofile.png') ?>"></span>
                                    <span class="subject">
                                    <span class="from"><?php echo $value['Pavadinimas']; ?></span>
                                    <br>
                                    <span class="time"><?php echo $value['Sukurimo_data']; ?></span>
                                    <br>
                                    </span>
                                    <span class="message">
										<input type="hidden" name="naujid" id="naujid" value="<?php echo $value['id']; ?>">
										<input type="submit" class="btn btn-success" value="Žiūrėti žinutę...">
                                    </span>
                                </a>
                            </li>
                            </form>
                         
                            <?php endforeach ?>
                            <?php endif?>
                            <li>
                                <a href="<?= base_url('visos_naujienos')?>">Žiūrėti visas žinutes</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox notificatoin end -->
                   
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="<?= base_url('img/defaultprofile.png') ?>">
                            </span>
                            <span class="username"><?php echo $_SESSION['username']?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="<?= base_url('adminprofile') ?>"><i class="icon_profile"></i> Mano profilis</a>
                            </li>
                            <li>
                                <a href="<?= base_url('logout') ?>"><i class="icon_key_alt"></i> Atsijungti</a>
                            </li>                   
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>  
       
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li class="active">
                  	<?php if ($_SESSION['is_admin']==1): ?>
            		<a class="" href="<?= base_url('adminhome') ?>"</a>
            		<?php elseif ($_SESSION['is_admin']==0): ?>
           			<a class="" href="<?= base_url('home') ?>"</a>
      				<?php endif; ?>
                          <i class="icon_house_alt"></i>
                          <span>Pradinis</span>
                      </a>
                  </li>
                  <?php if ($_SESSION['is_admin']==1): ?>
                  <li class="active">
                      <a class="" href="<?= base_url('naujiena')?>">
                          <i class="icon_documents_alt"></i>
                          <span>Rašyti naujieną</span>
                      </a>
                  </li>
                  <?php endif; ?>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      </body>
      