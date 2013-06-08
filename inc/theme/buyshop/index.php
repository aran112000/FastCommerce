<?=$this->get_html_header()?>
<header>
	<a href="/" title="<?=get::setting('site_name')?>">
		<img src="<?=$this->di->theme_class->get_path('/images/logo.png')?>" width="300" height="100" />
		<h1><?=get::setting('site_name')?></h1>
	</a>
</header>
<section id="main">
	<article id="content">
		<h2>Page title</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros orci, mollis vel massa vel, ultrices interdum urna. Sed laoreet accumsan ullamcorper. Maecenas dignissim, mauris ac vehicula bibendum, velit ipsum eleifend odio, ac lacinia massa turpis nec diam. Proin a nisl et metus porta sagittis. Vivamus id leo ac tortor pretium facilisis pharetra a magna. Pellentesque lobortis euismod bibendum. Mauris vitae ornare enim. Nam placerat ante porta dolor dignissim, a fermentum sapien sagittis. Integer scelerisque nec enim congue bibendum. Etiam porta fringilla tortor, ut cursus nibh adipiscing nec. Praesent hendrerit sapien sapien, et consectetur neque semper fringilla. Fusce rutrum nunc ac turpis tempus, non tristique augue accumsan. Aliquam mollis pharetra auctor. Mauris id dui in lacus tincidunt laoreet in vitae eros.</p>

		<p>Curabitur quis malesuada urna, ut sodales metus. Nulla accumsan tortor in urna luctus, sit amet scelerisque ante ultrices. Donec vel suscipit tellus. Vestibulum nunc magna, mattis a elit ac, adipiscing laoreet est. Morbi eu mauris a nibh ultricies suscipit. Aenean hendrerit nisl at consectetur interdum. Suspendisse nec elementum dolor. Cras lacinia nisl urna, sed pretium risus sollicitudin quis. Proin nulla mauris, rutrum a hendrerit non, rhoncus ut dui. Nam ut nulla eget tortor consequat feugiat. Nullam vel libero lacus. Pellentesque nibh purus, adipiscing porta massa eget, fringilla varius lectus. Ut porta sollicitudin luctus. Aliquam ac lacinia erat. Morbi nisl dui, cursus non imperdiet nec, mattis nec justo.</p>

		<p>Sed vulputate commodo urna in viverra. Pellentesque convallis posuere nibh et faucibus. Quisque pharetra ut tortor a suscipit. Vivamus in tempus ipsum. Aliquam erat volutpat. Nam malesuada sit amet lorem eget tempor. In cursus orci dui, eu dictum quam hendrerit ut. Nulla erat lorem, porta ultricies lectus ut, malesuada ultricies urna. Integer nunc elit, luctus et tortor quis, facilisis auctor justo. Nam ut pharetra dolor. Integer vehicula egestas diam et dapibus. Donec eu cursus risus, pellentesque congue nibh. Maecenas sit amet ultrices justo, in ultricies odio.</p>

		<p>Duis aliquet leo sapien, at convallis lectus malesuada sit amet. Aliquam dictum vel urna sit amet gravida. Vivamus auctor, nisl id sagittis tristique, sem tortor consequat elit, ac blandit eros est quis eros. Donec euismod est vitae dolor ultrices ultrices. Aenean eu elementum mi. Praesent blandit pulvinar elit, nec interdum elit porta id. Aliquam auctor, purus vitae mollis volutpat, est augue hendrerit orci, ac fermentum erat velit vitae leo.</p>

		<p>Morbi ac porttitor eros. In a arcu libero. Aenean ullamcorper placerat viverra. Sed semper ullamcorper quam a fermentum. Pellentesque posuere ipsum eget lectus condimentum rhoncus. Donec nec hendrerit purus, vitae bibendum urna. Aenean dui eros, lobortis et dolor at, laoreet sagittis massa. Aliquam at condimentum tellus. Vestibulum nunc magna, facilisis eget gravida eget, feugiat et erat.</p>
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
<?=$this->get_html_content()?>
<?=$this->get_html_footer()?>