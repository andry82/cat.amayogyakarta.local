<link rel="stylesheet" href="<?=theme_url('css/print.css')?>" type="text/css" media="all" />

<?php if ($print) : ?>
<body onload="window.print()"> 
<?php endif; ?>
<?=$header;?>
<?=$content;?>
<?=$footer;?>