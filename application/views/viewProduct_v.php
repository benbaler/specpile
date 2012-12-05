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

<div class="two mobile-two columns offset-by-one">
<span class="inline"><b><%= name %></b></span>
</div>

<div class="four mobile-two columns pull-five">
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
  <div class="three mobile-two columns">
    <h4>Product</h4>
  </div>

  <div class="three mobile-two columns offset-by-six">
    <!-- <button class="button expend right">Edit Specs</button> -->
  </div>
</div>

<div class="row">
  <div class="twelve columns">
    <h5><?= $product['category_name'] ?> &rsaquo; <?= $product['brand_name'] ?> &rsaquo; <?= $product['name'] ?></h5>
  </div>
</div>

<div class="row">
  <div class="eleven mobile-four columns offset-by-one">
    <ul class="inline-list">
      <?php foreach($product['images'] as $url): ?>
        <li><img src="<?= $url ?>" /></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="row">
  <div class="three mobile-two columns">
    <h4>Specification</h4>
  </div>

  <div class="three mobile-two columns offset-by-six">
    <a href="/product/edit/<?= $product['_id'] ?>" class="button expend right">Edit Specs</a>
  </div>
</div>

<from class="custom collapse" id="editProduct-form">
</from>
