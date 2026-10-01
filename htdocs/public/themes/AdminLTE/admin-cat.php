<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>CAT AMA YOGYAKARTA | <?=$page_title;?></title>

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

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

		<!-- Theme style -->
		<link rel="stylesheet" href="<?=$theme_url?>css/adminlte.min.css">

		<?php 
			\Arifrh\Themes\Themes::renderCSS();
			
			foreach ($css_files as $css)
			{
				echo '<link rel="stylesheet" href="' . base_url($css) . '">';
			}
		?>

		<link rel="stylesheet" href="<?=$theme_url?>css/custom.css">

		<script>
			var site_url = '<?=site_url()?>';
			var base_url = '<?=base_url()?>';
			var plugin_url = '<?=plugin_url()?>';
			var theme_url = '<?=$theme_url?>';

			var WEBSOCKET_URL = '<?=getenv('WEBSOCKET_URL')?>';
			var WEBSOCKET_PORT = '<?=getenv('WEBSOCKET_PORT')?>';
        </script> 
	</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light bg-light elevation-2">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <?=$topNavMenus?>
      </li>
    </ul>

    <?=$searchForm??''?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?=$messageNotif??''?>
      <?=$pushNotif??''?>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-purple elevation-2">
    <!-- Brand Logo -->
    <a href="<?=site_url('admin/dashboard')?>" class="brand-link navbar-purple">
	  <div class="d-flex justify-content-center">
		  <img src="<?=$theme_url . 'img/logo-amayo.png'?>" class="user-image img-circle elevation-4">
	  </div>
	  <span class="brand-text d-flex justify-content-center" id="user-name"><?=$user['username']?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
	 
		<?=$userPanel??''?>
		<?=$searchMenu??''?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-flat nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
		  <?=$sidebarMenus??''?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$page_title?></h1>
          </div><!-- /.col -->
          <?=$breadcrumbs??''?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pb-5">
		  <?=$content?>
	  </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer elevation-4">
	<img src="<?=$theme_url?>img/amayo_fotter.png" alt="AMA Yogyakarta" height="30">
	<div class="float-right">
    <span ondblclick="downloadJawaban();">Copyright&copy; 2025</span>
	<span id="socketStatus-X" class="fa-stack fa-lg text-danger d-none">
		<i class="fa fa-exclamation-triangle"></i>
	</span>
	</div>
  </footer>

  <?=$controlSidebar??''?>
</div>
<!-- ./wrapper -->

	<script src="<?=$plugin_url?>jquery/jquery.min.js"></script>
	<script src="<?=$plugin_url?>bootstrap/js/bootstrap.bundle.min.js"></script>

	<script>
		let isOnline, wsConnected = false;

		var myHeaders = new Headers();

		myHeaders.append('pragma', 'no-cache');
		myHeaders.append('cache-control', 'no-cache');

		var myInit = {
		  method: 'GET',
		  headers: myHeaders,
		};

		const checkOnlineStatus = async () => {
		  try {
		    const online = await fetch("http://temsipa.stietotalwin.ac.id/themes/simple/images/1x1-00000000.png", myInit);
		    return online.status >= 200 && online.status < 300; // either true or false
		  } catch (err) {
		    return false; // definitely offline
		  }
		};

		window.addEventListener("load", async (event) => {
		    isOnline = await checkOnlineStatus();
			toggleStatus();
		});

		window.addEventListener('offline', function(e) {
			isOnline = false;
		});

		window.addEventListener('online', function(e) {
			isOnline = true;
		});

		function toggleStatus(){
			if (isOnline) {
				$('#online').removeClass('d-none');
				$('#offline').addClass('d-none');
			} else {
				$('#online').addClass('d-none');
				$('#offline').removeClass('d-none');
			}

			if (wsConnected) {
				$('#socketStatus').addClass('d-none');
			} else {
				$('#socketStatus').removeClass('d-none');
			}
		}
	</script>

	<?php 
		\Arifrh\Themes\Themes::renderJS();

		foreach ($js_files as $js)
		{
			echo '<script src="' . base_url($js) . '"></script>', "/r/n";
		}
	?>
	<?php 
	if ($message = session()->getFlashdata('message')) : 
		$type  = session()->getFlashdata('error') ? 'error' : (session()->getFlashdata('alert') ?? 'success');
		$title = session()->getFlashdata('title') ?? '';
	?>
	<script>
		<?php if (session()->getFlashdata('error')) :
			echo session()->getFlashdata('title') ? "swalError('" . $message . "', '" . session()->getFlashdata('title') . "');" : "swalError('" . $message . "');";
		elseif (! session()->getFlashdata('alert') || session()->getFlashdata('alert') === 'success') :
			echo session()->getFlashdata('title') ? "swalSuccess('" . $message . "', '" . session()->getFlashdata('title') . "');" : "swalSuccess('" . $message . "');";
		 else :
			echo session()->getFlashdata('title') ? "swAlert('" . $message . "', '" . session()->getFlashdata('title') . "','" . $type . "');" : "swAlert('" . $message . "',false,'" . $type . "');";
		endif; ?>
	</script>
	<?php endif; ?>
</body>
</html>
