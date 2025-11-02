<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap/css/mystyle.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url('/') ?>"><b>SimpleIPAM</b></a>
        </div>
        <div id="navbar">
          <ul class="nav navbar-nav">
             <li><a href="<?php echo base_url('/') ?>Networks">networks</a></li>
             <li><a href="<?php echo base_url('/') ?>Hosts">hosts</a></li>
             <li><a href="<?php echo base_url('/') ?>Docs">docs</a></li>
	  </ul>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
