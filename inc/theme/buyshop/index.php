<?=$this->get_html_header()?>
<header>
	<a href="/" title="<?=$this->di->get->setting('site_name')?>">
		<img src="<?=$this->di->theme->get_path('/images/logo.png')?>" width="250" height="85" />
	</a>
	<?=$this->di->pages->get_nav('main', array('where' => 'nav=:nav AND parent_pid = 0', 'params' => array('nav' => 1)))?>
</header>
<section id="main">
	<article id="content">
		<?=$this->get_html_content()?>
	</article>
	<footer>
		<small>&copy; <?=date('Y') . ' ' . $this->di->get->setting('site_name')?>. All rights reserved</small>
	</footer>
</section>
<?=$this->get_html_footer()?>