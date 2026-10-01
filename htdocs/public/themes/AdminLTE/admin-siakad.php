<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Sekolah Tinggi Ilmu Ekonomi Totalwin | <?=$page_title;?></title>

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
			var theme_url = '<?=$theme_url?>';
        </script> 
	</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light bg-light elevation-3">
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
  <aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="<?=site_url('admin/dashboard')?>" class="brand-link navbar-primary">
	  <div class="d-flex justify-content-center">
		  <img src="<?=$theme_url . 'img/logo-totalwin.png'?>" class="user-image img-circle elevation-4">
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
	<img src="<?=$theme_url?>img/logo-top.png" alt="STIE Totalwin" class="logo-container">
	<div class="float-right">
    <strong>Copyright &copy; 2021 </strong>
    <span class="d-block">All rights reserved.</span>
	</div>
  </footer>

  <?=$controlSidebar??''?>
</div>
<!-- ./wrapper -->

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
