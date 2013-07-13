<article id="prod_detail">
	<div id="left">
		<span class="padded_img"><img src="http://placehold.it/400x550" alt="<?=$this->current->title ?>" width="400" height="550" /></span>
	</div>
	<div id="right">
		<h1><?=$this->current->title?></h1>
		<p><strong class="price"><span class="label">Price:</span> &#163;<?=number_format($this->current->price, 2)?></strong><br />
		<strong class="stock"><span class="label">Stock:</span> <?=($this->current->stock > 0 ? 'In stock <small>(' . $this->current->stock . ' remaining)</small>' : 'Out of stock')?></strong></p>
		<p><a href="#" data-rel="lightbox" title="Add to cart" data-ajaxify-handler="prod:do_add_to_cart" data-ajaxify-data='<?=json_encode(array('pid' => 1, 'qty' => 2))?>'>Add to cart (test)</a></p>
		<section id="body">
			<p><?=$this->current->body?></p>
		</section>
		<?if (!empty($this->current->vimeo_url)) {?>
		<section id="video">
			<iframe src="<?=$this->current->vimeo_url?>" width="700" height="405"></iframe>
		</section>
		<?}?>
	</div>
</article>