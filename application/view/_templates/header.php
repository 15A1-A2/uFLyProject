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
	    <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
			<div class="logo">
				<span class="greeting"></span><a href="<?= Config::get('URL') . 'profile/showProfile/' . Session::get('user_id') ?>"><?= Session::get('user_name') ?></a>
			</div>
    	<div class="sidebar-wrapper">
            <ul class="nav">
                <li class="<?php if (View::checkForActiveController($filename, "index")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>index/index"><i class="material-icons">home</i><p>Home</p></a></li>
                <li class="<?php if (View::checkForActiveController($filename, "profile")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>profile/index"><i class="material-icons">person</i><p>Profile</p></a></li>
                <li class="<?php if (View::checkForActiveController($filename, "dashboard")) { echo ' active" '; } ?>"><a href="<?= Config::get('URL') ?>dashboard/index"><i class="material-icons">dashboard</i><p>Dashboard</p></a></li>
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
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">dashboard</i>
									<p class="hidden-lg hidden-md">Dashboard</p>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">notifications</i>
									<span class="notification">5</span>
									<p class="hidden-lg hidden-md">Notifications</p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Mike John responded to your email</a></li>
									<li><a href="#">You have 5 new tasks</a></li>
									<li><a href="#">You're now friend with Andrew</a></li>
									<li><a href="#">Another Notification</a></li>
									<li><a href="#">Another One</a></li>
								</ul>
							</li>
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
	 							   <i class="material-icons">person</i>
	 							   <p class="hidden-lg hidden-md">Profile</p>
		 						</a>
							</li>
						</ul>

						<form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form>
					</div>
				</div>
			</nav>
			<div class="content">
				<div class="container-fluid">


  <?php } ?>
