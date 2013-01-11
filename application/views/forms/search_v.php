<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Search specs <small>for smart phones, tablets or digital cameras</small></h4>
  </div>
</div>

<div class="row">
  <div class="twelve mobile-four columns" style="height: 40px;">
    <form class="custom collapse" id="search-form" onsubmit="return false;">
      <div class="row collapse">
        <div class="ten mobile-three columns">
          <input type="text" name="term" id="term" placeholder="Search Product e.g. iPhone 5"/>
        </div>
        <div class="two mobile-one columns">
          <input class="postfix button expand" type="submit" id="search" value="Search"/>
        </div>
      </div>
    </div>
  </form>
</div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Latest Searches</h4>
  </div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
    <ul id="latest-panel" class="block-grid eight-up mobile-four-up latest-panel">
      <?php foreach ($searches as $search) : ?>
      <li><a href="#" class="latest-search" data-term="<?= $search ?>"><?= $search ?></a>&nbsp;</li>
    <?php endforeach; ?>
  </ul>
</div>
</div>