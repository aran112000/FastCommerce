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
	<a href="/" class="brand"><img src="<?=$this->di->theme->get_path('images/template/logo.png')?>" alt="FastCommerce Admin" /></a>

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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_dark_64x64.png')?>" alt="fakeimg">
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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
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
						<img src="<?=$this->di->theme->get_path('images/placeholders/image_light_64x64.png')?>" alt="fakeimg">
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
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=$this->di->theme->get_path('images/template/avatar.png')?>" alt="avatar"> <b class="caret"></b></a>
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
		<?=$this->di->pages->get_nav('primary-nav', array('where' => 'nav=1', 'span' => false))?>
		<!-- END Primary Navigation -->
	</aside>
	<!-- END Sidebar -->
	<!-- Page Content -->
	<div id="page-content">
	<!-- Navigation info -->
	<ul id="nav-info" class="clearfix">
		<li><a href="/"><i class="icon-home"></i></a></li>
		<li class="active"><a href="">Dashboard</a></li>
	</ul>
	<!-- END Navigation info -->

		<?=$this->get_html_content()?>

	</div>
	<!-- END Page Content -->

	<!-- Footer -->
	<footer>
		<span id="year-copy"><?=date('Y')?></span> &copy; FastCommerce | All rights reserved
	</footer>
	<!-- END Footer -->
	</div>
	<!-- END Inner Container -->
	</div>
	<!-- END Page Container -->

	<!-- Scroll to top link, check main.js - scrollToTop() -->
	<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>
<?=$this->get_html_footer()?>