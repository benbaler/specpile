<div class="fixed contain-to-grid">
	<nav class="top-bar">
		<ul>
			<li class="name"><a href="/"><img src="/assets/images/logo.png" class="logo-png"/></a></li>
			<!-- <li class="name show-for-medium-down"><h1><a href="/">Specpile</a></h1></li> -->
			<li class="toggle-topbar"><a href="#"></a></li>
		</ul>
		<section>

			<ul class="left">
				<!-- <li class="divider"></li> -->
				<li><a href="/">Search</a></li>
				<li><a href="/product/compare">Compare</a></li>

			</ul>

			<ul class="right">

				<?php if($logged_in == TRUE): ?>

				<!-- <li><a href="/product/add" class="">Add Product</a></li> -->


				<li>
					<a href="/user/id/<?= $id ?>"><img src="<?= $picture_url ?>" class="profile-thumb"><span class="profile-name"><?= $first ?></span></a>
				</li>

				<li class="divider"></li>
				<li><a href="/user/logout">Logout</a></li>


			<?php else: ?>
						
			<li><a href="/user/signup">Signup</a></li>
			<!-- <li class="divider"></li> -->
			<li><a href="/user/login">Login</a></li>

		</ul>

		<?php endif; ?>

	</ul>
</section>
</nav>
</div>

<div class="row">
<div class="twelve columns">
&nbsp;
</div>
</div>

<div class="row">
<div class="twelve columns">
<!-- <br/><br/><br/><br/> -->
</div>
</div>






<!-- <div class="row" id="topbar">
	<div class="four mobile-four columns" id="logo">
		<h1><a href="/">Specpile <small>alpha</small></a></h1>
	</div>

	<?php if($logged_in == TRUE): ?>

	<div class="one mobile-one columns offset-by-three">
		<a href="/user/id/<?= $id ?>"><img src="<?= $picture_url ?>" id="thumb"/></a>
	</div>

	<div class="one mobile-one columns">
		<h5><a href="/user/id/<?= $id ?>"><?= ucfirst($first) ?></a></h5>
	</div>

	<div class="one mobile-one columns">
		<h5><a href="/user/logout">Logout</a></h5>
	</div>

	<div class="two mobile-one columns">
		<h4><a href="/product/add" class="">Add Product</a></h4>
	</div>

<?php else: ?>

	<div class="one mobile-one columns offset-by-six">
		<h5><a href="/user/signup">Signup</a></h5>
	</div>

	<div class="one mobile-one columns">
		<h5><a href="/user/login">Login</a></h5>
	</div>

	<div class="one mobile-two columns">
	</div>



<?php endif; ?>

</div> -->

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