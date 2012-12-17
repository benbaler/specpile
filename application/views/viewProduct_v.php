<style>
#addNewSpecField{
	display: none;
}
</style>


<script>
window.productData = <?= json_encode($product) ?>;
</script>


<script type="text/template" id="spec-template">
<div class="row viewSpec">

<div class="six mobile-two columns offset-by-one">
<span class="inline"><b><%= name %></b></span>
</div>

<div class="five mobile-two columns pull-five">
<div class="row collapse">

<div class="eight mobile-three columns">
<span>
<% _.each(options, function(option,i) { if(option.selected == true){ %><%= option.name %><% } }); %>
</span>
</div>

<div class="four mobile-one columns">
<button class="postfix button expand hide">Save</button>
</div>

</div>
</div>

</div> 
</script>


<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Product</h4>
  </div>

  <!-- <div class="three mobile-two columns offset-by-six">
    <button class="button expend right">Edit Specs</button>
  </div> -->
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
      <li><img src="<?= $url ?>" class="productImg"/></li>
    <?php endforeach; ?>
  </ul>
</div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Specification</h4>
  </div>

  <!-- <div class="two mobile-one columns offset-by-six">
    <a href="/product/edit/<?= $product['_id'] ?>" class="button expend right">Edit Specs</a>
  </div> -->
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

