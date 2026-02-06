<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap/css/mystyle.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container">

	<div id="navbar-header">
<?php $site_title = getenv('SITE_TITLE') ?: 'SimpleIPAM'; ?>
  <a class="navbar-brand" href="<?php echo base_url('/') ?>"><b><?php echo htmlspecialchars($site_title); ?></b></a>
</div>
	  <ul class="nav navbar-nav">
             <li><a href="<?php echo base_url('/') ?>Hosts">hosts</a></li>
             <li><a href="<?php echo base_url('/') ?>Networks">networks</a></li>
	  </ul>
        </div>
      </div>
    </nav>
