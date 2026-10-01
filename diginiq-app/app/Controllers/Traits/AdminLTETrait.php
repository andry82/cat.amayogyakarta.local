<?php namespace App\Controllers\Traits;

trait AdminLTETrait {

	protected $topNavMenus = [];
	protected $sidebarMenus = [];
	protected $activeMenu;

	protected function initializeTheme()
	{
		$config = config('AdminLTE');

		$this->themes = \Arifrh\Themes\Themes::init($config);

		$this->setMenus();
		//$this->setGlobalVariable();

		$this->themes
			->useFullTemplate()
			->setTemplate($this->mainTemplate)
			->loadPlugins('fa-free, swal')
			->addJS('adminlte.min.js')
			->setVar([
				'css_files'      => [],
				'js_files'       => [],
				'topNavMenus'    => $this->setTopNavMenus(),
				'controlSidebar' => $this->setControlSidebar(),
				'sidebarMenus'   => $this->setSidebarMenu(),
			]);
	}

	protected function setMenus()
	{

	}

	protected function setActiveMenu($url = null, $pos = 'sidebar')
	{
		$this->activeMenu = $url ?? current_url();
		$this->themes->setVar(['sidebarMenus' => $this->setSidebarMenu()]);
	}

	protected function setTopNavMenus($menus = null)
	{
		$menus = $menus ?? $this->topNavMenus;

		$menuHTML = '';

		foreach ($menus as $menu)
		{
			if ($menu['active'])
			{
				$currentUrl = $this->activeMenu ?? current_url();
				$selected   = $currentUrl === $menu['url'] || stripos($currentUrl, $menu['url']) > -1 || stripos($menu['url'], $currentUrl) > -1;
				$class      = $selected ? 'bg-warning' : '';

				$menuHTML .= '<li class="nav-item d-inline-block">
					<a href="' . $menu['url'] . '" class="nav-link ' . $class . '">' . $menu['text'] . '</a>
				</li>';
			}
		}

		return $menuHTML;
	}

	protected function setSidebarMenu($menus = null)
	{
		$menus = $menus ?? $this->sidebarMenus;

		$currentUrl = $this->activeMenu ?? current_url();
		$menuHTML   = '';

		foreach ($menus as $menu)
		{
			if ($menu['active'])
			{
				$menu['selected'] = $currentUrl === $menu['url']; // || stripos($menu['url'], $currentUrl) > -1 || stripos($currentUrl, $menu['url']) > -1;
				$menuHTML .= '<li class="nav-item' . ($menu['open'] ? ' menu-open' : '') . '">';

				if ($menu['has_sub'])
				{
					$menuHTML .= '<a href="#" class="nav-link' . ($menu['selected'] ? ' active' : '') . '">
						<i class="nav-icon ' . $menu['icon'] . '"></i>
						<p>' . $menu['text'] .
						  '<i class="right fas fa-angle-left"></i>
						</p>
					  </a>
					  <ul class="nav nav-treeview">';
					
					foreach ($menu['subs'] as $subMenu)
					{
						$subMenu['selected'] = $currentUrl === $subMenu['url'] || stripos($subMenu['url'], $currentUrl) > -1;

						$menuHTML .= '<li class="nav-item' . ($subMenu['open'] ? ' menu-open' : '') . '">
							<a href="' . $subMenu['url'] . '" class="nav-link' . ($subMenu['selected'] ? ' active' : '') . '">
				              <i class="nav-icon ' . $subMenu['icon'] . '"></i>
				              <p>' .
								$subMenu['text'] .
								($subMenu['has_badge'] ? '<span class="right badge badge-' . $subMenu['badge']['type'] . '">' . $subMenu['badge']['text'] . '</span>' : '') . 
				              '</p>
							</a>
						</li>';
					}
					  
            		$menuHTML .= '</ul>';
				}
				else
				{
					$menuHTML .= '<a href="' . $menu['url'] . '" class="nav-link' . ($menu['selected'] ? ' active' : '') . '">
		              <i class="nav-icon ' . $menu['icon'] . '"></i>
		              <p>' .
						$menu['text'] .
						($menu['has_badge'] ? '<span class="right badge badge-' . $menu['badge']['type'] . '">' . $menu['badge']['text'] . '</span>' : '') . 
		              '</p>
					</a>';
				}
				
				$menuHTML .= '</li>';
			}
		}

		return $menuHTML;
	}

	/**
	 * HTML template for search form
	 */
	protected function setSearchForm()
	{
		return '<!-- SEARCH FORM -->
		<form class="form-inline ml-3">
		  <div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
			  <button class="btn btn-navbar" type="submit">
				<i class="fas fa-search"></i>
			  </button>
			</div>
		  </div>
		</form>';
	}

	/**
	 * HTML template for Message Notif
	 */
	protected function setMessageNotif()
	{
		return '<!-- Messages Dropdown Menu -->
		<li class="nav-item dropdown">
		  <a class="nav-link" data-toggle="dropdown" href="#">
			<i class="far fa-comments"></i>
			<span class="badge badge-danger navbar-badge">3</span>
		  </a>
		  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<a href="#" class="dropdown-item">
			  <!-- Message Start -->
			  <div class="media">
				<img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
				<div class="media-body">
				  <h3 class="dropdown-item-title">
					Brad Diesel
					<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
				  </h3>
				  <p class="text-sm">Call me whenever you can...</p>
				  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
				</div>
			  </div>
			  <!-- Message End -->
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
			  <!-- Message Start -->
			  <div class="media">
				<img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
				<div class="media-body">
				  <h3 class="dropdown-item-title">
					John Pierce
					<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
				  </h3>
				  <p class="text-sm">I got your message bro</p>
				  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
				</div>
			  </div>
			  <!-- Message End -->
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
			  <!-- Message Start -->
			  <div class="media">
				<img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
				<div class="media-body">
				  <h3 class="dropdown-item-title">
					Nora Silvester
					<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
				  </h3>
				  <p class="text-sm">The subject goes here</p>
				  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
				</div>
			  </div>
			  <!-- Message End -->
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
		  </div>
		</li>';
	}

	/**
	 * HTML template for Push Notif
	 */
	protected function setPushNotif()
	{
		return '<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
		  <a class="nav-link" data-toggle="dropdown" href="#">
			<i class="far fa-bell"></i>
			<span class="badge badge-warning navbar-badge">15</span>
		  </a>
		  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<span class="dropdown-item dropdown-header">15 Notifications</span>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
			  <i class="fas fa-envelope mr-2"></i> 4 new messages
			  <span class="float-right text-muted text-sm">3 mins</span>
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
			  <i class="fas fa-users mr-2"></i> 8 friend requests
			  <span class="float-right text-muted text-sm">12 hours</span>
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
			  <i class="fas fa-file mr-2"></i> 3 new reports
			  <span class="float-right text-muted text-sm">2 days</span>
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
		  </div>
		</li>';
	}

	protected function setControlSidebar()
	{
		return '<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		  <!-- Control sidebar content goes here -->
		  <div class="p-3">
			<h5>' . $this->user['fullname'] . '</h5>
			<p>
				<ul class="list-unstyled">
					<li><a href="' . site_url('admin/dashboard/user') . '">Ubah Password</a></li>
					<li><a href="' . site_url('logout') . '">Logout</a></li>
				</ul>
			</p>
		  </div>
		</aside>
		<!-- /.control-sidebar -->';
	}

	/**
	 * HTML template for User Panel sidebar
	 */
	protected function setUserPanel()
	{
		return '<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		  <div class="image">
			<img src="user-pic.jpg" class="img-circle elevation-2" alt="User Image">
		  </div>
		  <div class="info">
			<a href="#" class="d-block">Alexander Pierce</a>
		  </div>
		</div>';
	}

	protected function setSearchMenu()
	{
		return '<!-- SidebarSearch Form -->
		<div class="form-inline mt-2">
		  <div class="input-group" data-widget="sidebar-search">
			<input class="form-control form-control-sidebar" name="searchMenu" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
			  <button class="btn btn-sidebar">
				<i class="fas fa-search fa-fw"></i>
			  </button>
			</div>
		  </div>
		</div>';
	}

	protected function setBreadcrumbs($links = [])
	{
		$breadcrumbs = '';
		foreach ($links as $i => $link)
		{
			if (count($links) == ($i+1))
			{	
				$breadcrumbs .= '<li class="breadcrumb-item active">' . $link['text'] . '</li>';
			}
			else
			{
				$breadcrumbs .= '<li class="breadcrumb-item active"><a href="' . site_url($link['url']) . '">' . $link['text'] . '</a></li>';
			}
		}

		return '<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="' . site_url('admin') . '">Home</a></li>' .
              $breadcrumbs . '
            </ol>
          </div><!-- /.col -->';
	}

	public function notFound()
	{
		$this->themes
			->setPageTitle('')
			::render($this->_404Page);
	}

	protected function _notFound()
	{
		return redirect()->to('/' . $this->_404Page)->send();
	}
}