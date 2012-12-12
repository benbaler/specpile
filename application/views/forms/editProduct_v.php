
<script>
window.productData = <?= json_encode($product) ?>;
</script>


<script type="text/template" id="spec-template">
<div class="row">

<div class="four mobile-two columns offset-by-one">
<input type="text" class="field" data-id="<%= _id %>" placeholder="Add Field" value="<%= name %>"/>
<!--<label class="inline"><%= name %></label>-->
</div>

<div class="five mobile-two columns pull-two">
<div class="row collapse">

<div class="ten mobile-three columns">
<input type="text" class="spec" data-id="<%= _id %>" placeholder="<%= (name != '') ? 'Select ' + name : 'Add Option' %>" value="<% _.each(options, function(option,i) { if(option.selected == true){ %><%= option.name %><% } }); %>"/>
</div>

<div class="two mobile-one columns">
<button class="postfix button expand hide">Save</button>
</div>

</div>
</div>

</div> 
</script>


<div class="row">
  <div class="three mobile-two columns">
    <h4>Edit Product</h4>
  </div>

  <div class="three mobile-two columns offset-by-six">
    <!-- <button class="button expend right">Edit Template</button> -->
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
        <li><img src="<?= $url ?>" class="productImg"/></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="row">
  <div class="three mobile-two columns">
    <h4>Specification</h4>
  </div>

  <div class="three mobile-two columns offset-by-six">
    <a href="/product/view/<?= $product['_id'] ?>" class="button expend right">View Specs</a>
  </div>
</div>

<from class="custom collapse" id="editProduct-form">
</from>
