<div class="fixed contain-to-grid">
	<nav class="top-bar">
		<ul>
			<li class="name show-for-medium-down"><a href="/"><img src="/assets/images/apple.jpg" class="mobile-logo-png"/></a></li>
			<li class="name hide-for-medium-down"><a href="/"><img src="/assets/images/logo.png" class="logo-png"/></a></li>
			<li class="toggle-topbar"><a href="#"></a></li>
		</ul>
		<section>
			<!-- <ul class="left hide-for-small">
				<li><div class="fb-like" data-href="https://www.facebook.com/specpile" data-send="true" data-width="50" data-show-faces="false" layout="button_count"></div></li>
				<li><div class="twitter"><a href="https://twitter.com/specpile" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @specpile</a></div></li>
				<li><div class="g-plusone-div"><div class="g-plusone" data-size="medium"></div></div></li>
			</ul> -->

			<ul class="right">
				<?php if($logged_in == TRUE): ?>
				<li><a href="/">SEARCH</a></li>
				<li><a href="/product/compare">COMPARE</a></li>
				<li>
					<a href="/user/id/<?= $id ?>"><img src="<?= $picture_url ?>" class="profile-thumb"><span class="profile-name"><?= $first ?></span></a>
				</li>
				<li><a href="/user/logout">Logout</a></li>
			<?php else: ?>
			<li><a href="/">SEARCH</a></li>
			<li><a href="/product/compare">COMPARE</a></li>
		</ul>
	<?php endif; ?>
</section>
</nav>
</div>
