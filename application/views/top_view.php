<?php $site_title = getenv('SITE_TITLE') ?: 'SimpleIPAM'; ?>
<title><?php echo htmlspecialchars($site_title); ?></title>
<div class="container">
<?php 
include "local/index.html";
