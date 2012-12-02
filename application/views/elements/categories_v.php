<div class="row">
	<div class="two columns">
		<h4>Categories</h4>
	</div>
</div>
<div class="row">
	<div class="twelve columns">
<ul class="block-grid five-up">
	<?php foreach($categories as $category) : ?>
	<li><h5><a href=""><?= ucfirst($category) ?></a></h5></li>
<?php endforeach; ?>
</ul>
</div></div>
	