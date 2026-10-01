<!doctype html>
	<html lang="en" dir="ltr">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<title><?=$page_title;?></title>

		<link rel="icon" href="./favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
		<link rel="stylesheet" href="<?=$theme_url;?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=$theme_url;?>/css/signin.css">

		<?php \Arifrh\Themes\Themes::renderCSS(); ?>

		<script>
			var site_url = '<?=site_url()?>';
			var base_url = '<?=base_url()?>';
			var theme_url = '<?=$theme_url?>';
		</script>
	</head>

	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php $session = session();
					if ($session->getFlashdata('error'))
					{
						echo alert('danger', 'Error', $session->getFlashdata('message'));
					}
					elseif ($session->getFlashdata('message'))
					{
						echo alert('success', 'Success', $session->getFlashdata('message'));
					} 
				
					echo  $content; ?>
				</div>
    		</div>
  		</div>
	  
	    <script src="<?=$theme_url;?>/js/jquery-3.5.1.min.js"></script>
	    <script src="<?=$theme_url;?>/js/bootstrap.bundle.min.js"></script>
	    
	    <?php \Arifrh\Themes\Themes::renderJS(); ?>

    </body>
</html>
