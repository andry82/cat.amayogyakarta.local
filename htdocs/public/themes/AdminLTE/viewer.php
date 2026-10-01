<!doctype html>
	<html lang="en" dir="ltr">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

		<title>Sekolah Tinggi Ilmu Ekonomi Totalwin <?=$page_title;?></title>

		<link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">

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

		<!--
		<link rel="stylesheet" href="<?=$theme_url;?>fonts/icomoon/style.css">
		<link rel="stylesheet" href="<?=$theme_url;?>fonts/flaticon/font/flaticon.css">
		<link rel="stylesheet" href="<?=$theme_url;?>css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=$theme_url;?>css/style.css">
		<link rel="stylesheet" href="<?=$theme_url;?>css/totalwin.css">
		-->

		<style>
			.pdfobject-container { height: 90vh; border: 1rem solid rgba(0,0,0,.1); }
		</style>

		<?php \Arifrh\Themes\Themes::renderCSS(); ?>

		<link rel="stylesheet" href="<?=$theme_url?>css/custom.css">

		<script>
			var site_url = '<?=site_url()?>';
			var base_url = '<?=base_url()?>';
			var theme_url = '<?=$theme_url?>';
        </script>
	</head>
	
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">     
        <div class="site-wrap">
			<?=$content?>
        	<div class="footer small">
			    <div class="container">
			        <div class="row">
			            <div class="col-12">
			                <div class="copyright">
			                    <p>
			                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
			                        Copyright &copy;<?=date('Y');?> All rights reserved | Sekolah Tinggi Ilmu Ekonomi Totalwin</a>
			                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
			                    </p>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
        <!-- .site-wrap -->
		
		<?php 
		\Arifrh\Themes\Themes::renderJS();

		foreach ($js_files as $js)
		{
			echo '<script src="' . base_url($js) . '"></script>', "/r/n";
		}
		?>
		<script>
			PDFObject.embed("<?=$file?>", "#pdf-viewer");
		</script>		
    </body>
</html>