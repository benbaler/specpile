<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Product</h4>
  </div>

</div>

<div class="row">
  <div class="twelve columns">
    <h5><?= ucwords($product['category']) ?> &rsaquo; <?= ucwords($product['company']) ?> &rsaquo; <?= ucwords(character_limiter($product['name'],50)) ?></h5>
  </div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
    <ul class="inline-list">
      <?php foreach(array($product['image']) as $url): ?>
      <li><img src="<?= $url ?>" class="product-large-image"/></li>
    <?php endforeach; ?>
  </ul>
</div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Specification <div class="fb-like" data-href="<?= 'http://specpile.com'.$_SERVER['REQUEST_URI'] ?>" data-send="true" data-width="50" data-show-faces="false" layout="button_count"></div><a href="https://twitter.com/share" class="twitter-share-button" data-via="specpile">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<div style="display:inline; float:right;" id="google_translate_element"></div></h4>
  </div>
</div>

<div class="row specs-view">
  <div class="twelve columns">
    <?php foreach (isset($product['features']) ? $product['features'] : array() as $feature => $specs) : ?>
    <div class="row specs-feature">
      <div class="twelve mobile-four columns">
        <h5><?= ucwords($feature); ?></h5>
      </div>
    </div>
    <?php foreach ($specs as $spec => $option) : ?>

    <div class="row specs-option">
      <div class="five mobile-two columns offset-by-two">
        <b><?= ucwords($spec) ?></b> 
      </div>
      <div class="four mobile-two columns pull-two">
        <?= $option === TRUE ? 'Yes' : ($option === FALSE ? 'No' : ucwords(str_replace(', ','<br/>',$option))) ?>
      </div>
    </div>
  <?php endforeach; ?>
  <br/>
  <br/>
<?php endforeach; ?>
</div>
</div>

  <div class="row">
    <div class="twelve columns" style="text-align:center;">
      <div class="fb-comments" data-href="<?= 'http://specpile.com'.$_SERVER['REQUEST_URI'] ?>" data-width="430" data-num-posts="5"></div>
    </div>
  </div>
