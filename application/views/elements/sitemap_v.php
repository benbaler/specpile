<div class="row">
	<div class="twelve columns">
		<h4><?= $title ?></h4>
	</div>
</div>
<div class="row">
	<div class="twelve columns">
		<ul class="block-grid one-up mobile-one-up">
			<?php foreach($products as $product) : ?>
			<li><a href="/product/view/<?= $product['id'] ?>"><img style="vertical-align: middle; width:30px" src="<?= $product['image'] ?>"/><?= ' '.ucwords($product['company']).' &rsaquo; '.ucwords(character_limiter($product['name'], 80)) ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>
</div>

<div class="row">
	<div class="twelve columns">
		<?= $pagination ?>
	</div>
</div>