<!doctype html>
<html>
<head>
  <?php
  $now = new DateTime();
  $date = $now->getTimestamp();
   ?>
    <title>uFly</title>
    <!-- META -->
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Favo Icon -->
    <link rel="icon" type="image/png" href="<?php echo Config::get('URL'); ?>favicon.png"/>

    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css?_=<?=md5($date)?>" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/material-dashboard.css?_=<?=md5($date)?>">

    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css?_=<?=md5($date)?>" />

    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/dropzone.css?_=<?=md5($date)?>" />

</head>
<body class="<?php echo View::getBodyClass($filename); ?>">
  <?php
    if (Session::userIsLoggedIn()) {
  ?>
  <div class="wrapper">
	    <div class="sidebar" data-color="red" data-image="../assets/img/sidebar-1.jpg">
  			<div class="logo">
  				<div class="simple-text"><span class="greeting"></span><a href="<?= Config::get('URL') . 'profile/showProfile/' . Session::get('user_id') ?>"><?= Session::get('user_name') ?></a></div>
  			</div>
      	<div class="sidebar-wrapper">
          <ul class="nav">
              <li class="<?php if (View::checkForActiveController($filename, "index")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>index/index"><i class="material-icons">home</i><p>Home</p></a></li>
              <?php
            if (Session::get("user_account_type") == 7 OR  $_SERVER['REQUEST_URI'] == '/uFlyProject/profile/showProfile/'.Session::get('user_id'))  { ?>
              <li class="<?php if (View::checkForActiveController($filename, "profile")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>profile/index"><i class="material-icons">person</i><p>Profile</p></a></li>
            <?php  } ?>
              <li class="<?php if (View::checkForActiveController($filename, "dashboard")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>dashboard/index"><i class="material-icons">dashboard</i><p>Dashboard</p></a></li>
              <li class="<?php if (View::checkForActiveController($filename, "folder")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>folder/index"><i class="material-icons">folder</i><p>Folder</p></a></li>
              <li style="position: absolute; bottom:0;"><a href="<?php echo Config::get('URL'); ?>login/logout"><i class="material-icons">highlight_off</i>Logout</a></li>
          </ul>

      	</div>
	    </div>
	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><?php echo View::getHeaderTitle(); ?></a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">notifications</i>
									<span class="notification">5</span>
									<p class="hidden-lg hidden-md">Notifications</p>
								</a>
								<ul class="dropdown-menu" data-color="red">
                  <li><a class="" href="<?= Config::get('URL') . 'profile/showProfile/' . Session::get('user_id') ?>">Change account settings</a></li>
                  <li><a class="" href="<?php echo Config::get('URL') ?>node/index">My notes</a></li>
								</ul>
							</li>
							<li>
								<a href="<?= Config::get('URL') . 'profile/showProfile/' . Session::get('user_id') ?>"><i class="material-icons">person</i></a>
							</li>
						</ul>

						<!-- <form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form> -->
					</div>
				</div>
			</nav>
			<div class="content">
				<div class="container-fluid">


  <?php } ?>
