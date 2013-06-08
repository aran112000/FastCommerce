<?=$this->get_html_header()?>
<header>
	<a href="/" title="<?=get::setting('site_name')?>">
		<img src="<?=$this->di->theme_class->get_path('/images/logo.png')?>" width="300" height="100" />
		<h1><?=get::setting('site_name')?></h1>
	</a>
</header>
<section id="main">
	<article id="content">
		<?=$this->get_html_content()?>
	</article>
	<aside id="left">
		<p>Leftcol</p>
		<p>
			<?
			$prod = new prod();
			echo '<p><pre>' . print_r($prod->do_retrieve_from_id(array(), 1), true) . '</pre></p>'."\n";
			?>
		</p>
	</aside>
	<aside id="right">
		<p>Rightcol</p>
	</aside>
</section>
<?=$this->get_html_footer()?>