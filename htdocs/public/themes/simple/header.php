<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="apple-touch-icon" sizes="57x57" href="<?=$theme_url;?>favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?=$theme_url;?>favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=$theme_url;?>favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=$theme_url;?>favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=$theme_url;?>favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?=$theme_url;?>favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?=$theme_url;?>favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?=$theme_url;?>favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?=$theme_url;?>favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?=$theme_url;?>favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=$theme_url;?>favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=$theme_url;?>favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=$theme_url;?>favicon/favicon-16x16.png">
	<link rel="manifest" href="<?=$theme_url;?>favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?=$theme_url;?>favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=$theme_url;?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$theme_url;?>css/all.min.css?v=1">
    <link rel="stylesheet" href="<?=$theme_url;?>css/animate.min.css">

    <title>CAT AMA YOGYAKARTA - <?=$page_title;?></title>

	<?php \Arifrh\Themes\Themes::renderCSS(); ?>

    <link rel="stylesheet" href="<?=$theme_url;?>css/simple.css">

	<script>
		var site_url = '<?=site_url()?>';
		var base_url = '<?=base_url()?>';
		var plugin_url = '<?=plugin_url()?>';
		var theme_url = '<?=$theme_url?>';

		var WEBSOCKET_URL = '<?=getenv('WEBSOCKET_URL')?>';
		var WEBSOCKET_PORT = '<?=getenv('WEBSOCKET_PORT')?>';
	</script>
  </head>
  <body class="d-flex flex-column h-100">
    <header class="page-header">
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003366;">
        <div class="container d-flex justify-content-between">
          	<a class="navbar-brand" href="<?=site_url()?>">
		  	<?php if (in_array(current_url(), [site_url('test/tertulis'), site_url('test/selesai')])) : ?>
			  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAQAAAAnOwc2AAAAD0lEQVR42mNkwAIYh7IgAAVVAAuInjI5AAAAAElFTkSuQmCC" id="xyz">
			  <?php endif; ?>
			  <img src="<?=$theme_url?>images/amayo_top.png" alt="CAT" height="60px">
			</a>			
          </div>
        </div>
      </nav>
    </header>
	<div class="row justify-content-center">
		<?php
		$session = session();
		if ($session->getFlashdata('error'))
		{
			echo alert('danger', 'Error', $session->getFlashdata('message'));
		}
		elseif ($session->getFlashdata('message'))
		{
			echo alert('success', 'Success', $session->getFlashdata('message'));
		}
		?>
	</div>
