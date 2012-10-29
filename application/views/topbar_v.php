<div class="row"ד>
  <div class="two mobile-two columns">
    <h1><a href="/">Specpile</a></h1>
  </div>
  <?php if($logged_in == TRUE): ?>
	<div class="register-button one mobile-one columns offset-by-eight">
   	<img src="<?= $picture_url ?>"/>
  </div>
  <div class="login-button one mobile-one columns">
   	<h5><a href="/index.php/user/profile/<?= $id ?>"><?= $first ?></a></h5>
  </div>	
  <?php else: ?>
  <div class="register-button one mobile-one columns offset-by-eight" style="vertical-align:middle;">
   	<h5 style="vertical-align:middle;"><a href="/index.php/page/register" style="vertical-align:middle;">Register</a></h5>
  </div>
  <div class="login-button one mobile-one columns">
   	<h5><a href="/index.php/page/login">Login</a></h5>
  </div>
<?php endif; ?>
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