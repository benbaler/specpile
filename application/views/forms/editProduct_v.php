
<script>
window.productData = '<?= json_encode($product) ?>';
</script>

<script type="text/template" id="specs-template">

<% _.each(specs, function(i,k) { %> 

  <div class="row">

  <div class="two mobile-one columns offset-by-one">
  <label class="inline"><%= i.name %></label>
  </div>

  <div class="four columns">
  <div class="row collapse">

  <div class="eight mobile-two columns">
  <input type="text" id="spec_<%= k %>" placeholder="Enter or Select <%= i.name %>" value="<%= i.value %>"/>
  </div>

  <div class="four mobile-one columns">
  <button class="postfix button expand">Save</button>
  </div>

  </div>
  </div>

  <div class="five columns">
  </div>

  </div> 

  <% }); %>

<div class="row">

<div class="six mobile-four columns offset-by-one">
<button class="button twelve">Add Field</button>
</div>

<div class="six columns">
</div>

</div>

</script>

<div class="row">
  <div class="three columns">
    <h4>Edit Product</h4>
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
