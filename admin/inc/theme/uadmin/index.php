<?=$this->get_html_header()?>
	<!-- Page Container -->
	<div id="page-container">
	<header class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner remove-radius remove-box-shadow">
	<div class="container-fluid">
	<ul class="nav pull-right visible-phone visible-tablet">
		<li class="divider-vertical remove-margin"></li>
		<li>
			<a href="#" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-reorder"></i>
			</a>
		</li>
	</ul>
	<a href="/" class="brand"><img src="<?=$this->di->theme->get_path('/images/template/logo.png')?>" alt="FastCommerce Admin" /></a>

	<!-- Loading Indicator, Used for demostrating how loading of widgets could happen, check main.js - uiDemo() -->
	<div id="loading" class="hide pull-left"><i class="icon-certificate icon-spin"></i></div>

	<!-- Header Widgets -->
	<!-- You can create the widgets you want by replicating the following. Each one exists in a <li> element -->
	<ul id="widgets" class="nav pull-right">

	<!-- Just a divider -->
	<li class="divider-vertical remove-margin"></li>

	<!-- RSS Widget -->
	<!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
	<li id="rss-widget" class="dropdown dropdown-left-responsive">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-rss"></i>
			<span class="badge badge-warning display-none"></span>
		</a>
		<!-- By adding the class .widget-fluid, dropdown width will be set to auto with min value 180px and max value 250px -->
		<ul class="dropdown-menu widget widget-fluid">
			<li class="widget-heading text-center">Web Design</li>
			<li class="li-hover"><a href="#" class="widget-link"><i class="icon-umbrella"></i>This is a headline</a></li>
			<li class="divider"></li>
			<li class="li-hover"><a href="#" class="widget-link"><i class="icon-trophy"></i>Another headline</a></li>
			<li class="divider"></li>
			<li class="li-hover"><a href="#" class="widget-link"><i class="icon-suitcase"></i>Headlines keep coming!</a></li>
			<li class="widget-heading text-center">Web Developent</li>
			<li class="li-hover"><a href="#" class="widget-link"><i class="icon-phone"></i>New headline</a></li>
			<li class="divider"></li>
			<li class="li-hover"><a href="#" class="widget-link"><i class="icon-pencil"></i>Another one</a></li>
			<li class="divider"></li>
			<li><a href="#" class="text-center">All News</a></li>
		</ul>
	</li>
	<!-- END RSS Widget -->

	<li class="divider-vertical remove-margin"></li>

	<!-- Twitter Widget -->
	<!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
	<li id="twitter-widget" class="dropdown dropdown-left-responsive">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-twitter"></i>
			<span class="badge badge-info display-none"></span>
		</a>
		<ul class="dropdown-menu widget">
			<li class="widget-heading"><i class="icon-comments-alt pull-right"></i>Latest Tweets</li>
			<li class="li-hover">
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">Michael</a><span class="label label-info">just now</span></h6>
						<div class="media">Web design all the way!</div>
					</div>
				</div>
			</li>
			<li class="divider"></li>
			<li class="li-hover">
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">Monica</a><span class="label label-info">3 min ago</span></h6>
						<div class="media">Download free PSDs at <a href="http://bit.ly/YUs4SQ" target="_blank">http://bit.ly/YUs4SQ</a></div>
					</div>
				</div>
			</li>
			<li class="divider"></li>
			<li class="li-hover">
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">Steven</a><span class="label label-info">45 min ago</span></h6>
						<div class="media">Be sure to check out my portfolio!</div>
					</div>
				</div>
			</li>
			<li class="divider"></li>
			<li class="li-hover">
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">Tim</a><span class="label label-info">1 hour ago</span></h6>
						<div class="media">Get all our themes for free for the next 2 hours! <a href="#">#freebies</a></div>
					</div>
				</div>
			</li>
		</ul>
	</li>
	<!-- END Twitter Widget -->

	<li class="divider-vertical remove-margin"></li>

	<!-- Messages Widget -->
	<!-- Add .dropdown-left-responsive class to align the dropdown menu left (so its visible on mobile) -->
	<li id="messages-widget" class="dropdown dropdown-left-responsive">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-envelope"></i>
			<!-- If the <span> element with .badge class has no content it will disappear (not in IE8 and below because of using :empty in CSS) -->
			<span class="badge badge-success">1</span>
		</a>
		<ul class="dropdown-menu widget pull-right">
			<li class="widget-heading"><i class="icon-comment pull-right"></i>Latest Messages</li>
			<li class="new-on">
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">George</a><span class="label label-success">2 min ago</span></h6>
						<div class="media">Thanks for your help! The tutorial really helped me a lot!</div>
					</div>
				</div>
			</li>
			<li class="divider"></li>
			<li>
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">Mike</a><span class="label">6 hours ago</span></h6>
						<div class="media">The logo is ready, have a look and let me know what you think!</div>
					</div>
				</div>
			</li>
			<li class="divider"></li>
			<li>
				<div class="media">
					<a class="pull-left" href="#">
						<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="#">Julia</a><span class="label">1 day ago</span></h6>
						<div class="media">We should better consider our social media marketing strategy!</div>
					</div>
				</div>
			</li>
			<li class="divider"></li>
			<li class="text-center"><a href="page_inbox.html">View All Messages</a></li>
		</ul>
	</li>
	<!-- END Messages Widget -->

	<li class="divider-vertical remove-margin"></li>

	<!-- Notifications Widget -->
	<!-- Add .dropdown-center-responsive class to align the dropdown menu center (so its visible on mobile) -->
	<li id="notifications-widget" class="dropdown dropdown-center-responsive">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-flag"></i>
			<span class="badge badge-important">1</span>
			<span class="badge badge-warning">2</span>
		</a>
		<ul class="dropdown-menu widget">
			<li class="widget-heading"><a href="#" class="pull-right widget-link"><i class="icon-cog"></i></a><a href="#" class="widget-link">System</a></li>
			<li>
				<ul>
					<li class="label label-important">20 min ago</li>
					<li class="text-error">Support system is down for maintenance!</li>
				</ul>
			</li>
			<li>
				<ul>
					<li class="label label-warning">3 hours ago</li>
					<li class="text-warning">PHP upgrade started!</li>
				</ul>
			</li>
			<li>
				<ul>
					<li class="label label-warning">5 hours ago</li>
					<li class="text-warning"><a href="#" class="widget-link">1 support ticket</a> just opened!</li>
				</ul>
			</li>
			<li class="widget-heading"><a href="#" class="pull-right widget-link"><i class="icon-bookmark"></i></a><a href="#" class="widget-link">Project #3</a></li>
			<li>
				<ul>
					<li class="label label-success">3 weeks ago</li>
					<li class="text-success">Project #3 <a href="#" class="widget-link">published</a> successfully!</li>
				</ul>
			</li>
			<li>
				<ul>
					<li class="label label-info">1 month ago</li>
					<li class="text-info">Milestone #3 achieved!</li>
					<li class="text-info"><a href="#" class="widget-link">John Doe</a> joined the project!</li>
				</ul>
			</li>
			<li>
				<ul>
					<li class="label">1 year ago</li>
					<li class="text-muted">This is an old notification</li>
				</ul>
			</li>
			<li class="divider"></li>
			<li class="text-center"><a href="#">View All Notifications</a></li>
		</ul>
	</li>
	<!-- END Notifications Widget -->

	<li class="divider-vertical remove-margin"></li>

	<!-- User Menu -->
	<li class="dropdown dropdown-user">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=$this->di->theme->get_path('/images/template/avatar.png')?>" alt="avatar"> <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<!-- Just a button demostrating how loading of widgets could happen, check main.js- - uiDemo() -->
			<li>
				<a href="#" class="loading-on"><i class="icon-refresh"></i> Refresh</a>
			</li>
			<li class="divider"></li>
			<li>
				<!-- Modal div is at the bottom of the page before including javascript code -->
				<a href="#modal-user-settings" role="button" data-toggle="modal"><i class="icon-user"></i> User Profile</a>
			</li>
			<li>
				<a href="#"><i class="icon-wrench"></i> App Settings</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="page_login.html"><i class="icon-lock"></i> Log out</a>
			</li>
		</ul>
	</li>
	<!-- END User Menu -->
	</ul>
	<!-- END Header Widgets -->
	</div>
	<!-- END div#container-fluid -->
	</div>
	<!-- END Navbar Inner -->
	</header>
	<!-- END Header -->

	<!-- Inner Container -->
	<div id="inner-container"><!-- Sidebar -->
	<aside id="page-sidebar" class="nav-collapse collapse">
		<!-- Sidebar search -->
		<form id="sidebar-search" action="page_search_results.html" method="post">
			<div class="input-append">
				<input type="text" placeholder="Search.." class="remove-box-shadow remove-transition remove-radius">
				<button><i class="icon-search"></i></button>
			</div>
		</form>
		<!-- END Sidebar search -->

		<!-- Primary Navigation -->
		<nav id="primary-nav">
			<ul>
				<li>
					<a href="index.html" class="active"><i class="icon-fire"></i>Dashboard</a>
				</li>
				<li>
					<a href="#"><i class="icon-magic"></i>UI Elements</a>
					<ul>
						<li>
							<a href="page_ui_general.html"><i class="icon-star"></i>General</a>
						</li>
						<li>
							<a href="page_forms.html"><i class="icon-th-list"></i>Forms</a>
						</li>
						<li>
							<a href="page_tables.html"><i class="icon-table"></i>Tables</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="icon-leaf"></i>Components</a>
					<ul>
						<li>
							<a href="page_charts.html"><i class="icon-bar-chart"></i>Charts</a>
						</li>
						<li>
							<a href="page_calendar.html"><i class="icon-calendar"></i>Calendar</a>
						</li>
						<li>
							<a href="page_datatables.html"><i class="icon-th"></i>DataTables</a>
						</li>
						<li>
							<a href="page_datatables_editable.html"><i class="icon-pencil"></i>Editable DataTables</a>
						</li>
						<li>
							<a href="page_maps.html"><i class="icon-map-marker"></i>Maps</a>
						</li>
						<li>
							<a href="page_form_validation.html"><i class="icon-warning-sign"></i>Form Validation</a>
						</li>
						<li>
							<a href="page_form_wizard.html"><i class="icon-magic"></i>Form Wizard</a>
						</li>
						<li>
							<a href="page_syntax_highlighting.html"><i class="icon-beaker"></i>Syntax Highlighting</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="page_typography.html"><i class="icon-font"></i>Typography</a>
				</li>
				<li>
					<a href="page_gallery.html"><i class="icon-picture"></i>Gallery</a>
				</li>
				<li>
					<a href="#"><i class="icon-tint"></i>Icons</a>
					<ul>
						<li>
							<a href="page_glyphicons_pro.html">Glyphicons PRO</a>
						</li>
						<li>
							<a href="page_glyphicons_halflings_pro.html">Glyphicons Halflings PRO</a>
						</li>
						<li>
							<a href="page_fontawesome.html">FontAwesome</a>
						</li>
						<li>
							<a href="page_gemicon.html">Gemicon</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="icon-file-alt"></i>Pages</a>
					<ul>
						<li>
							<a href="page_inbox.html"><i class="icon-envelope"></i>Inbox</a>
						</li>
						<li>
							<a href="page_chatui.html"><i class="icon-comments"></i>ChatUI</a>
						</li>
						<li>
							<a href="page_search_results.html"><i class="icon-search"></i>Search Results</a>
						</li>
						<li>
							<a href="page_price_tables.html"><i class="icon-ticket"></i>Price Tables</a>
						</li>
						<li>
							<a href="page_article.html"><i class="icon-pencil"></i>Article</a>
						</li>
						<li>
							<a href="page_invoice.html"><i class="icon-book"></i>Invoice</a>
						</li>
						<li>
							<a href="page_profile.html"><i class="icon-user"></i>Profile</a>
						</li>
						<li>
							<a href="page_faq.html"><i class="icon-flag"></i>FAQ</a>
						</li>
						<li>
							<a href="page_errors.html"><i class="icon-warning-sign"></i>Errors</a>
						</li>
						<li>
							<a href="page_blank.html"><i class="icon-circle-blank"></i>Blank</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="page_login.html"><i class="icon-off"></i>Login Page</a>
				</li>
				<li>
					<a href="page_landing.html"><i class="icon-rocket"></i>Landing Page</a>
				</li>
			</ul>
		</nav>
		<!-- END Primary Navigation -->

		<!-- Demo Theme Options -->
		<div id="theme-options" class="text-left hidden-phone hidden-tablet">
			<a href="#" class="btn btn-theme-options"><i class="icon-cog"></i> Theme Options</a>
			<div id="theme-options-content">
				<h5>Color Themes</h5>
				<ul class="theme-colors clearfix">
					<li class="active">
						<a href="#" class="themed-background-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default"></a>
					</li>
					<li>
						<a href="#" class="themed-background-deepblue themed-border-deepblue" data-theme="css/themes/deepblue.css" data-toggle="tooltip" title="DeepBlue"></a>
					</li>
					<li>
						<a href="#" class="themed-background-deepwood themed-border-deepwood" data-theme="css/themes/deepwood.css" data-toggle="tooltip" title="DeepWood"></a>
					</li>
					<li>
						<a href="#" class="themed-background-deeppurple themed-border-deeppurple" data-theme="css/themes/deeppurple.css" data-toggle="tooltip" title="DeepPurple"></a>
					</li>
					<li>
						<a href="#" class="themed-background-deepgreen themed-border-deepgreen" data-theme="css/themes/deepgreen.css" data-toggle="tooltip" title="DeepGreen"></a>
					</li>
				</ul>
				<h5>Header</h5>
				<div id="topt-fixed-header-top" class="input-switch switch-mini" data-toggle="tooltip" title="Top fixed header" data-on="success" data-off="danger" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
					<input type="checkbox">
				</div>
				<div id="topt-fixed-header-bottom" class="input-switch switch-mini" data-toggle="tooltip" title="Bottom fixed header" data-on="success" data-off="danger" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
					<input type="checkbox">
				</div>
				<div id="topt-fixed-layout" class="input-switch switch-mini" data-toggle="tooltip" title="Fixed layout (for large resolutions)" data-on="success" data-off="danger" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
					<input type="checkbox">
				</div>
			</div>
		</div>
		<!-- END Demo Theme Options -->
	</aside>
	<!-- END Sidebar -->
	<!-- Page Content -->
	<div id="page-content">
	<!-- Navigation info -->
	<ul id="nav-info" class="clearfix">
		<li><a href="index.html"><i class="icon-home"></i></a></li>
		<li class="active"><a href="">Dashboard</a></li>
	</ul>
	<!-- END Navigation info -->

	<!-- Nav Dash -->
	<ul class="nav-dash">
		<li>
			<a href="#" data-toggle="tooltip" title="Users">
				<i class="icon-user"></i>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Comments">
				<i class="icon-comments"></i> <span class="badge badge-success">3</span>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Calendar">
				<i class="icon-calendar"></i> <span class="badge badge-inverse">5</span>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Photos">
				<i class="icon-camera-retro"></i>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Projects">
				<i class="icon-paper-clip"></i>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Tasks">
				<i class="icon-tasks"></i> <span class="badge badge-warning">1</span>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Reader">
				<i class="icon-book"></i>
			</a>
		</li>
		<li>
			<a href="#" data-toggle="tooltip" title="Settings">
				<i class="icon-cogs"></i>
			</a>
		</li>
	</ul>
	<!-- END Nav Dash -->

	<!-- Tiles -->
	<!-- Row 1 -->
	<div class="dash-tiles row-fluid">
		<!-- Column 1 of Row 1 -->
		<div class="span3">
			<!-- Total Users Tile -->
			<div class="dash-tile dash-tile-ocean clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<div class="btn-group">
							<a href="#" class="btn" data-toggle="tooltip" title="Manage Users"><i class="icon-cog"></i></a>
							<a href="#" class="btn" data-toggle="tooltip" title="Statistics"><i class="icon-bar-chart"></i></a>
						</div>
					</div>
					Total Users
				</div>
				<div class="dash-tile-icon"><i class="icon-group"></i></div>
				<div class="dash-tile-text">265k</div>
			</div>
			<!-- END Total Users Tile -->

			<!-- Total Profit Tile -->
			<div class="dash-tile dash-tile-leaf clearfix">
				<div class="dash-tile-header">
                                    <span class="dash-tile-options">
                                        <a href="#" class="btn" data-toggle="popover" data-placement="top" data-content="$500 (230 Sales)" title="Today's profit"><i class="icon-credit-card"></i></a>
                                    </span>
					Total Profit
				</div>
				<div class="dash-tile-icon"><i class="icon-money"></i></div>
				<div class="dash-tile-text">$5M</div>
			</div>
			<!-- END Total Profit Tile -->
		</div>
		<!-- END Column 1 of Row 1 -->

		<!-- Column 2 of Row 1 -->
		<div class="span3">
			<!-- Total Sales Tile -->
			<div class="dash-tile dash-tile-flower clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<div class="btn-group">
							<a href="#" class="btn" data-toggle="tooltip" title="View new orders"><i class="icon-shopping-cart"></i></a>
							<a href="#" class="btn" data-toggle="tooltip" title="Statistics"><i class="icon-bar-chart"></i></a>
						</div>
					</div>
					Total Sales
				</div>
				<div class="dash-tile-icon"><i class="icon-tags"></i></div>
				<div class="dash-tile-text">300k</div>
			</div>
			<!-- END Total Sales Tile -->

			<!-- Total Downloads Tile -->
			<div class="dash-tile dash-tile-fruit clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<a href="#" class="btn" data-toggle="tooltip" title="View popular downloads"><i class="icon-asterisk"></i></a>
					</div>
					Total Downloads
				</div>
				<div class="dash-tile-icon"><i class="icon-cloud-download"></i></div>
				<div class="dash-tile-text">360k</div>
			</div>
			<!-- END Total Downloads Tile -->
		</div>
		<!-- END Column 2 of Row 1 -->

		<!-- Column 3 of Row 1 -->
		<div class="span3">
			<!-- Popularity Tile -->
			<div class="dash-tile dash-tile-oil clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<div class="btn-group">
							<a href="#" class="btn" data-toggle="tooltip" title="What's changed?"><i class="icon-fire"></i></a>
							<a href="#" class="btn" data-toggle="tooltip" title="Share"><i class="icon-share"></i></a>
						</div>
					</div>
					Popularity
				</div>
				<div class="dash-tile-icon"><i class="icon-globe"></i></div>
				<div class="dash-tile-text">+90%</div>
			</div>
			<!-- END Popularity Tile -->

			<!-- Server Downtime Tile -->
			<div class="dash-tile dash-tile-dark clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<a href="#" class="btn" data-toggle="tooltip" title="Monthly report"><i class="icon-bar-chart"></i></a>
					</div>
					Server Downtime
				</div>
				<div class="dash-tile-icon"><i class="icon-hdd"></i></div>
				<div class="dash-tile-text">0.1%</div>
			</div>
			<!-- END Server Downtime Tile -->
		</div>
		<!-- END Column 3 of Row 1 -->

		<!-- Column 4 of Row 1 -->
		<div class="span3">
			<!-- RSS Subscribers Tile -->
			<div class="dash-tile dash-tile-balloon clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<a href="#" class="btn" data-toggle="tooltip" title="Manage subscribers"><i class="icon-cog"></i></a>
					</div>
					RSS Subscribers
				</div>
				<div class="dash-tile-icon"><i class="icon-rss"></i></div>
				<div class="dash-tile-text">160k</div>
			</div>
			<!-- END RSS Subscribers Tile -->

			<!-- Total Tickets Tile -->
			<div class="dash-tile dash-tile-doll clearfix">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<a href="#" class="btn" data-toggle="tooltip" title="Open tickets"><i class="icon-file-alt"></i></a>
					</div>
					Total Tickets
				</div>
				<div class="dash-tile-icon"><i class="icon-wrench"></i></div>
				<div class="dash-tile-text">1.5k</div>
			</div>
			<!-- END Total Tickets Tile -->
		</div>
		<!-- END Column 4 of Row 1 -->
	</div>
	<!-- END Row 1 -->

	<!-- Row 2 -->
	<div class="row-fluid">
		<!-- Column 1 of Row 2 -->
		<div class="span6">
			<!-- Statistics Tile -->
			<div class="dash-tile dash-tile-2x">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<div id="example-advanced-daterangepicker" class="btn">
							<i class="icon-calendar"></i>
							<span></span>
							<b class="caret"></b>
						</div>
					</div>
					<i class="icon-bar-chart"></i>
				</div>
				<div class="dash-tile-content">
					<div id="dash-example-stats" class="dash-tile-content-inner"></div>
				</div>
			</div>
			<!-- END Statistics Tile -->
		</div>
		<!-- END Column 1 of Row 2 -->

		<!-- Column 2 of Row 2 -->
		<div class="span3">
			<!-- Projects Tile -->
			<div class="dash-tile dash-tile-2x">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<a href="#" class="btn" data-toggle="tooltip" title="Manage projects"><i class="icon-cog"></i></a>
					</div>
					Projects
				</div>
				<div class="dash-tile-content">
					<div class="dash-tile-content-inner scrollable-tile-2x">
						<h5 class="page-header-sub"><a href="#">#1 - Project</a></h5>
						<div class="progress progress-success">
							<div class="bar" style="width: 100%"><i class="icon-ok"></i> Done!</div>
						</div>
						<h5 class="page-header-sub"><a href="#">#2 - Project</a></h5>
						<div class="progress progress-success">
							<div class="bar" style="width: 75%">75%</div>
						</div>
						<h5 class="page-header-sub"><a href="#">#3 - Project</a></h5>
						<div class="progress progress-warning">
							<div class="bar" style="width: 50%">50%</div>
						</div>
						<h5 class="page-header-sub"><a href="#">#4 - Project</a></h5>
						<div class="progress progress-danger">
							<div class="bar" style="width: 20%">20%</div>
						</div>
						<h5 class="page-header-sub"><a href="#">#5 - Project</a></h5>
						<div class="progress progress-success">
							<div class="bar" style="width: 85%">85%</div>
						</div>
						<h5 class="page-header-sub"><a href="#">#6 - Project</a></h5>
						<div class="progress progress-success">
							<div class="bar" style="width: 95%">95%</div>
						</div>
						<h5 class="page-header-sub"><a href="#">#7 - Project</a></h5>
						<div class="progress progress-warning">
							<div class="bar" style="width: 60%">60%</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Projects Tile -->
		</div>
		<!-- END Column 2 of Row 2 -->

		<!-- Column 3 of Row 2 -->
		<div class="span3">
			<!-- Alerts Tile -->
			<div class="dash-tile dash-tile-2x">
				<div class="dash-tile-header">
					<div class="dash-tile-options">
						<div class="btn-group">
							<a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
							<a href="#" class="btn btn-info"><i class="icon-twitter"></i></a>
							<a href="#" class="btn btn-success"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">System</a></li>
								<li><a href="#">Projects</a></li>
								<li><a href="#">Users</a></li>
							</ul>
						</div>
					</div>
					Alerts
				</div>
				<div class="dash-tile-content">
					<div class="dash-tile-content-inner scrollable-tile-2x">
						<h5 class="page-header-sub">Today</h5>
						<div class="alert">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="icon-barcode"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<div class="alert alert-success">
							<i class="icon-unlock"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="icon-bell"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<div class="alert alert-info">
							<i class="icon-signal"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<h5 class="page-header-sub">Yesterday</h5>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="icon-barcode"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<div class="alert">
							<i class="icon-barcode"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="icon-facebook"></i> <strong>Check out!</strong> This is a notification!
						</div>
						<div class="alert alert-danger">
							<i class="icon-align-justify"></i> <strong>Check out!</strong> This is a notification!
						</div>
					</div>
				</div>
			</div>
			<!-- END Alerts Tile -->
		</div>
		<!-- END Column 3 of Row 2 -->
	</div>
	<!-- END Row 2 -->

	<!-- Row 3 -->
	<div class="row-fluid">
	<!-- Column 1 of Row 3 -->
	<div class="span6">
		<!-- Datatables Tile -->
		<div class="dash-tile dash-tile-2x remove-margin">
			<div class="dash-tile-header">
				<div class="dash-tile-options">
					<a href="#" class="btn" data-toggle="tooltip" title="Manage Orders"><i class="icon-cogs"></i></a>
				</div>
				<i class="icon-shopping-cart"></i> New Orders
			</div>
			<div class="dash-tile-content">
				<div class="dash-tile-content-inner-fluid">
					<table id="dash-example-orders" class="table table-striped table-bordered table-condensed">
						<thead>
						<tr>
							<th class="span1"></th>
							<th class="span1 hidden-phone hidden-tablet">#</th>
							<th><i class="icon-shopping-cart"></i> Order</th>
							<th class="hidden-phone hidden-tablet"><i class="icon-user"></i> User</th>
							<th><i class="icon-bolt"></i> Status</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">1</td>
							<td><a href="#">Order#1</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User1</a></td>
							<td><span class="label">Inactive</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">2</td>
							<td><a href="#">Order#2</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User2</a></td>
							<td><span class="label label-info">Manual process..</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">3</td>
							<td><a href="#">Order#3</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User3</a></td>
							<td><span class="label label-inverse">On hold..</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">4</td>
							<td><a href="#">Order#4</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User4</a></td>
							<td><span class="label label-success">Sent!</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">5</td>
							<td><a href="#">Order#5</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User5</a></td>
							<td><span class="label label-success">Sent!</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">6</td>
							<td><a href="#">Order#6</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User6</a></td>
							<td><span class="label label-warning">Pending..</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">7</td>
							<td><a href="#">Order#7</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User7</a></td>
							<td><span class="label">Inactive</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">8</td>
							<td><a href="#">Order#8</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User8</a></td>
							<td><span class="label label-success">Sent!</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">9</td>
							<td><a href="#">Order#9</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User9</a></td>
							<td><span class="label label-info">Manual process..</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">10</td>
							<td><a href="#">Order#10</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User10</a></td>
							<td><span class="label label-inverse">On hold..</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">11</td>
							<td><a href="#">Order#11</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User11</a></td>
							<td><span class="label label-inverse">On hold..</span></td>
						</tr>
						<tr>
							<td class="span1">
								<div class="btn-group">
									<a href="#" data-toggle="tooltip" title="Process" class="btn btn-mini btn-primary"><i class="icon-book"></i></a>
									<a href="#" data-toggle="tooltip" title="Cancel" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
								</div>
							</td>
							<td class="span1 hidden-phone hidden-tablet">12</td>
							<td><a href="#">Order#12</a></td>
							<td class="hidden-phone hidden-tablet"><a href="#">User12</a></td>
							<td><span class="label">Inactive</span></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- END Datatables Tile -->
	</div>
	<!-- END Column 1 of Row 3 -->

	<!-- Column 2 of Row 3 -->
	<div class="span6">
	<!-- Users Tile -->
	<div class="dash-tile dash-tile-2x remove-margin">
	<div class="dash-tile-header">
		<i class="icon-user"></i> Users
	</div>
	<div class="dash-tile-content">
	<div class="dash-tile-content-inner-fluid">
	<!-- Users tabs links -->
	<ul id="dash-example-tabs" class="nav nav-tabs" data-toggle="tabs">
		<li class="active"><a href="#dash-example-tabs-admin">Admins</a></li>
		<li><a href="#dash-example-tabs-mods">Mods</a></li>
		<li><a href="#dash-example-tabs-newusers">New Users</a></li>
	</ul>
	<!-- END Users tabs links -->

	<!-- User tabs content -->
	<div class="tab-content">
	<!-- Admins Tab -->
	<div class="tab-pane active" id="dash-example-tabs-admin">
		<ul class="thumbnails remove-margin" data-toggle="gallery-options">
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin1</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin2</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin3</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin4</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin5</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin6</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin7</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Admin8</a>
			</li>
		</ul>
	</div>
	<!-- END Admins Tab -->

	<!-- Mods Tab -->
	<div class="tab-pane" id="dash-example-tabs-mods">
		<ul class="thumbnails remove-margin" data-toggle="gallery-options">
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod1</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod2</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod3</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod4</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod5</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod6</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod7</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-rounded')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">Mod8</a>
			</li>
		</ul>
	</div>
	<!-- END Mods Tab -->

	<!-- New Users Tab -->
	<div class="tab-pane" id="dash-example-tabs-newusers">
		<ul class="thumbnails remove-margin" data-toggle="gallery-options">
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User1</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User2</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User3</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User4</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User5</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User6</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User7</a>
			</li>
			<li>
				<div class="thumbnails-options">
					<div class="btn-group">
						<button class="btn btn-mini btn-success"><i class="icon-pencil"></i></button>
						<button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
					</div>
				</div>
				<a href="#" class="thumbnail">
					<img src="<?=$this->di->theme->get_path('/images/placeholders/image_light_64x64.png" class="img-circle')?>" alt="fakeimg">
				</a>
				<a href="#" class="thumbnail thumbnail-borderless text-center">User8</a>
			</li>
		</ul>
	</div>
	<!-- END New Users Tab -->
	</div>
	<!-- END User tabs content -->
	</div>
	</div>
	</div>
	<!-- END Users Tile -->
	</div>
	<!-- END Column 2 of Row 3 -->
	</div>
	<!-- END Row 3 -->
	<!-- END Tiles -->
	</div>
	<!-- END Page Content -->

	<!-- Footer -->
	<footer>
		<span id="year-copy"></span> &copy; <strong>uAdmin 1.3</strong> - Crafted with <i class="icon-heart"></i> by <strong><a href="http://goo.gl/vNS3I" target="_blank">pixelcave</a></strong>
	</footer>
	<!-- END Footer -->
	</div>
	<!-- END Inner Container -->
	</div>
	<!-- END Page Container -->

	<!-- Scroll to top link, check main.js - scrollToTop() -->
	<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>

	<!-- User Modal Settings, appears when clicking on 'User Settings' link found on user dropdown menu (header, top right) -->
	<div id="modal-user-settings" class="modal hide">
		<!-- Modal Header -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4>Profile Settings</h4>
		</div>
		<!-- END Modal Header -->

		<!-- Modal Content -->
		<div class="modal-body">
			<!-- Example Tabs, initialized at main.js - uiDemo() -->
			<!-- Tab links -->
			<ul id="example-user-tabs" class="nav nav-tabs">
				<li class="active"><a href="#example-user-tabs-account"><i class="icon-cogs"></i> Account</a></li>
				<li><a href="#example-user-tabs-profile"><i class="icon-user"></i> Profile</a></li>
			</ul>
			<!-- END Tab links -->

			<!-- END Tab Content -->
			<div class="tab-content">
				<!-- First Tab -->
				<div class="tab-pane active" id="example-user-tabs-account">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Success!</strong> Password changed!
					</div>
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="example-user-username">Username</label>
							<div class="controls">
								<input type="text" id="example-user-username" class="disabled" value="administrator" disabled="">
								<span class="help-block">You can't change your username!</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-pass">Password</label>
							<div class="controls">
								<input type="password" id="example-user-pass">
								<span class="help-block">if you want to change your password enter your current for confirmation!</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-newpass">New Password</label>
							<div class="controls">
								<input type="password" id="example-user-newpass">
							</div>
						</div>
					</form>
				</div>
				<!-- END First Tab -->

				<!-- Second Tab -->
				<div class="tab-pane" id="example-user-tabs-profile">
					<h5 class="page-header-sub hidden-phone">Image</h5>
					<div class="form-horizontal hidden-phone">
						<div class="control-group">
							<img src="<?=$this->di->theme->get_path('/images/placeholders/image_dark_120x120.png')?>" alt="image">
						</div>
						<div class="control-group">
							<form action="index.html" class="dropzone">
								<div class="fallback">
									<input name="file" type="file">
								</div>
							</form>
						</div>
					</div>
					<form class="form-horizontal">
						<h5 class="page-header-sub">Details</h5>
						<div class="control-group">
							<label class="control-label" for="example-user-firstname">Firstname</label>
							<div class="controls">
								<input type="text" id="example-user-firstname" value="John">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-lastname">Lastname</label>
							<div class="controls">
								<input type="text" id="example-user-lastname" value="Doe">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-gender">Gender</label>
							<div class="controls">
								<select id="example-user-gender">
									<option>Male</option>
									<option>Female</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-birthdate">Birthdate</label>
							<div class="controls">
								<div class="input-append">
									<input type="text" id="example-user-birthdate" class="input-small input-datepicker">
									<span class="add-on"><i class="icon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-skills">Skills</label>
							<div class="controls">
								<select id="example-user-skills" multiple="multiple" class="select-chosen">
									<option selected>html</option>
									<option selected>css</option>
									<option>javascript</option>
									<option>php</option>
									<option>mysql</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-bio">Bio</label>
							<div class="controls">
								<textarea id="example-user-bio" class="textarea-elastic" rows="3">Bio Information..</textarea>
							</div>
						</div>
						<h5 class="page-header-sub">Social</h5>
						<div class="control-group">
							<label class="control-label" for="example-user-fb">Facebook</label>
							<div class="controls">
								<div class="input-append">
									<input type="text" id="example-user-fb">
									<span class="add-on"><i class="icon-facebook"></i></span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-twitter">Twitter</label>
							<div class="controls">
								<div class="input-append">
									<input type="text" id="example-user-twitter">
									<span class="add-on"><i class="icon-twitter"></i></span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-pinterest">Pinterest</label>
							<div class="controls">
								<div class="input-append">
									<input type="text" id="example-user-pinterest">
									<span class="add-on"><i class="icon-pinterest"></i></span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="example-user-github">Github</label>
							<div class="controls">
								<div class="input-append">
									<input type="text" id="example-user-github">
									<span class="add-on"><i class="icon-github"></i></span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- END Second Tab -->
			</div>
			<!-- END Tab Content -->
		</div>
		<!-- END Modal Content -->

		<!-- Modal footer -->
		<div class="modal-footer">
			<button class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i> Close</button>
			<button class="btn btn-success"><i class="icon-spinner icon-spin"></i> Save changes</button>
		</div>
		<!-- END Modal footer -->
	</div>
	<!-- END User Modal Settings -->
<?
$this->di->core->inline_js[] = '$(\'#dash-example-orders\').dataTable({
		"aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
		"iDisplayLength": 6,
		"aLengthMenu": [[6, 10, 30, -1], [6, 10, 30, "All"]]
	});

	// Dash example stats
	var dashChart = $(\'#dash-example-stats\');

	var dashChartData1 = [
[0, 200],
[1, 250],
[2, 360],
[3, 584],
[4, 1250],
[5, 1100],
[6, 1500],
[7, 1521],
[8, 1600],
[9, 1658],
[10, 1623],
[11, 1900],
[12, 2100],
[13, 1700],
[14, 1620],
[15, 1820],
[16, 1950],
[17, 2220],
[18, 1951],
[19, 2152],
[20, 2300],
[21, 2325],
[22, 2200],
[23, 2156],
[24, 2350],
[25, 2420],
[26, 2480],
[27, 2320],
[28, 2380],
[29, 2520],
[30, 2590]
];
	var dashChartData2 = [
[0, 50],
[1, 180],
[2, 200],
[3, 350],
[4, 700],
[5, 650],
[6, 700],
[7, 780],
[8, 820],
[9, 880],
[10, 1200],
[11, 1250],
[12, 1500],
[13, 1195],
[14, 1300],
[15, 1350],
[16, 1460],
[17, 1680],
[18, 1368],
[19, 1589],
[20, 1780],
[21, 2100],
[22, 1962],
[23, 1952],
[24, 2110],
[25, 2260],
[26, 2298],
[27, 1985],
[28, 2252],
[29, 2300],
[30, 2450]
];

	// Initialize Chart
	$.plot(dashChart, [
		{data: dashChartData1, lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.05}, {opacity: 0.05}]}}, points: {show: true}, label: \'All Visits\'},
		{data: dashChartData2, lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.05}, {opacity: 0.05}]}}, points: {show: true}, label: \'Unique Visits\'}],
		{
			legend: {
			position: \'nw\',
				backgroundColor: \'#f6f6f6\',
				backgroundOpacity: 0.8
			},
			colors: [\'#555555\', \'#db4a39\'],
			grid: {
			borderColor: \'#cccccc\',
				color: \'#999999\',
				labelMargin: 5,
				hoverable: true,
				clickable: true
			},
			yaxis: {
			ticks: 5
			},
			xaxis: {
			tickSize: 2
			}
		}
	);

	// Create and bind tooltip
	var previousPoint = null;
	dashChart.bind("plothover", function(event, pos, item) {

		$("#x").text(pos.x.toFixed(2));
		$("#y").text(pos.y.toFixed(2));

		if (item) {
			if (previousPoint !== item.dataIndex) {
				previousPoint = item.dataIndex;

				$("#tooltip").remove();
				var x = item.datapoint[0],
					y = item.datapoint[1];

				$(\'<div id="tooltip" class="chart-tooltip"><strong>\' + y + \'</strong> visits</div>\')
				.css({top: item.pageY - 30, left: item.pageX + 5})
					.appendTo("body")
				.show();
			}
		} else {
			$("#tooltip").remove();
			previousPoint = null;
		}
	});';
echo $this->get_html_footer();
?>