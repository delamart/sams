<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAMS</title>

    <!-- Bootstrap -->
    <link href="<?php eUfix('css/bootstrap.min.css'); ?>" rel="stylesheet">

    <link href="<?php eUfix('css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php eUfix('css/jquery.datetimepicker.css'); ?>" rel="stylesheet">
    <link href="<?php eUfix('css/vis.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php eUfix('css/sams.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php eUfix('js/html5shiv.min.js'); ?>"></script>
    <script src="<?php eUfix('js/respond.min.js'); ?>"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php eUfix('js/jquery-1.11.2.min.js'); ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php eUfix('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php eUfix('js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php eUfix('js/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?php eUfix('js/jquery.datetimepicker.js'); ?>"></script>
    <script src="<?php eUfix('js/vis.min.js'); ?>"></script>


    <script> window.absolute_url = '<?php echo eUfix('/'); ?>'; </script>

    <script src="<?php eUfix('js/sams.js'); ?>"></script>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<? eUrl('/'); ?>">SAMS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li class="visible-xs-block"><a href="<?php eUrl('default','index'); ?>"><?php _('Overview'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('mission','index'); ?>"><?php _('Missions'); ?> <span class="badge"><?php $c = new MissionsModel(); echo $c->countActive(); ?></span></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('vehicle','index'); ?>"><?php _('Vehicles'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('personel','index'); ?>"><?php _('Personel'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('check','index'); ?>"><?php _('Personel Checks'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('group','index'); ?>"><?php _('Personel Groups'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('vtype','index'); ?>"><?php _('Vehicle Types'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('rank','index'); ?>"><?php _('Ranks'); ?></a></li>
                <li class="visible-xs-block"><a href="<?php eUrl('license','index'); ?>"><?php _('Licenses'); ?></a></li>
                <li class="visible-xs-block"><hr /></li>

                <li><a href="<?php eUrl('settings','index'); ?>"><?php _('Settings'); ?></a></li>
                <li><a href="<?php eUrl('user','index'); ?>"><?php _('Account'); ?></a></li>

            </ul>
            <!--
  <form class="navbar-form navbar-right">
    <input type="text" class="form-control" placeholder="Search...">
  </form>
            -->
        </div>
    </div>
</nav>

<div class="container-fluid"><!-- container -->
    <div class="row"><!-- row -->
        <div class="col-sm-2 col-md-2 sidebar"><!-- col1 - sidebar -->
            <ul class="nav nav-sidebar">
                <li><a href="<?php eUrl('default','index'); ?>"><?php _('Overview'); ?></a></li>
                <li><a href="<?php eUrl('mission','index'); ?>"><?php _('Missions'); ?> <span class="badge"><?php $c = new MissionsModel(); echo $c->countActive(); ?></span></a></li>
                <li><a href="<?php eUrl('vehicle','index'); ?>"><?php _('Vehicles'); ?></a></li>
                <li><a href="<?php eUrl('personel','index'); ?>"><?php _('Personel'); ?></a></li>
                <li><a href="<?php eUrl('check','index'); ?>"><?php _('Personel Checks'); ?></a></li>
                <li><a href="<?php eUrl('group','index'); ?>"><?php _('Personel Groups'); ?></a></li>
                <li><a href="<?php eUrl('vtype','index'); ?>"><?php _('Vehicle Types'); ?></a></li>
                <li><a href="<?php eUrl('rank','index'); ?>"><?php _('Ranks'); ?></a></li>
                <li><a href="<?php eUrl('license','index'); ?>"><?php _('Licenses'); ?></a></li>
            </ul>
        </div><!-- END - col1 - sidebar -->
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main"><!-- col2 - content -->