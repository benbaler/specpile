<div class="row">
	<div class="four mobile-two columns" id="logo">
		<h1><a href="/">Specpile</a></h1>
	</div>
	<?php if($logged_in == TRUE): ?>
	<div class="one mobile-one columns offset-by-three">
		<a href="/user/profile/<?= $id ?>"><img src="<?= $picture_url ?>" id="thumb"/></a>
	</div>
	<div class="one mobile-one columns">
		<h5><a href="/page/profile/<?= $id ?>"><?= ucfirst($first) ?></a></h5>
	</div>
	<div class="one mobile-one columns">
		<h5><a href="/page/logout">Logout</a></h5>
	</div>

<?php else: ?>
	<div class="one mobile-one columns offset-by-four">
		<h5><a href="/user/signup">Signup</a></h5>
	</div>
	<div class="one mobile-one columns">
		<h5><a href="/user/login">Login</a></h5>
	</div>
<?php endif; ?>
<div class="two mobile-one columns">
		<h5><a href="/product/add">Add Product</a></h5>
	</div>
</div>

<!--
<div class="row">
	<ul class="left">
		<li><a href="/">Specpile</a></li>
		<li class="toggle-topbar"><a href="#"></a></li>
	</ul>
	<section>
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Login</a>
				
				<ul class="dropdown">
					<li class="search"><?php $this->load->view('forms/login_v'); ?></li>
				</ul>
			</li>
		</ul>
		<ul class="right">
			<li><a href="#">Register</a></li>
		</ul>
	</section>
</div>
-->