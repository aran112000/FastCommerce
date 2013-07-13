<h1><?= $this->current->title ?></h1>
<?= $this->current->body ?>
<?= $this->get_list($this->current->cid) ?>
<?php
$prods = $this->di->prod_list->get_list_from_cat($this->di->categories->current->cid);
if ($prods && !empty($prods)) {
	?>
	<ul id="prod" class="list">
		<? foreach ($prods as $prod) { ?>
			<li>
				<a href="<?= $prod->get_url() ?>" title="<?= $prod->price ?>">
					<span class="padded_img"><img src="http://placehold.it/230x290" alt="<?= $prod->title ?>" width="230" height="290"/></span>
					<strong class="title"><?= $prod->title ?></strong>
					<strong class="price">&#163;<?= number_format($prod->price, 2) ?></strong>
				</a>
			</li>
		<? } ?>
	</ul>
<? } ?>