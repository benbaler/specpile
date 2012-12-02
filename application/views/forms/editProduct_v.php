
<script>
window.productData = <?= json_encode($product) ?>;
</script>


<script type="text/template" id="spec-template">
<div class="row">

<div class="two mobile-one columns offset-by-one">
<label class="inline"><%= name %></label>
</div>

<div class="four mobile-three columns pull-five">
<div class="row collapse">

<div class="eight mobile-two columns">
<input type="text" class="spec" data-id="<%= _id %>" placeholder="Select <%= name %>" value="<% _.each(options, function(option,i) { if(option.selected == true){ %><%= option.name %><% } }); %>"/>
</div>

<div class="four mobile-two columns">
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
    <button class="button expend right">Edit Template</button>
  </div>
</div>

<div class="row">
  <div class="twelve columns">
    <h5><?= ucfirst($product['category_name']) ?> &rsaquo; <?= ucfirst($product['brand_name']) ?> &rsaquo; <?= ucfirst($product['name']) ?></h5>
  </div>
</div>

<div class="row">
  <div class="three columns">
    <h4>Specification</h4>
  </div>
</div>

<from class="custom collapse" id="editProduct-form">
</from>
