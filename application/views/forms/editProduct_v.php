<script>
	window.productData = {
		id: '<?= (string)$product['_id'] ?>',
		name: '<?= ucfirst($product['name']) ?>',
		category_id: '<?= $product['category_id'] ?>',
		brand_id: '<?= $product['brand_id'] ?>',
		specs: {Resolustion: "1920x1080", Memory: "16GB"}
	}
</script>

<script type="text/template" id="specs-template">
	<% _.each(specs, function(i,k) { %>  
		<div class="row">
			<div class="two mobile-one columns offset-by-one">
      			<label class="inline"><%= k %></label>
    		</div>
    		<div class="nine mobile-three columns">
      			<input type="text" class="three" value="<%= i %>"/>
    		</div>
		</div> 
	<% }); %>
</script>

<div class="row">
  <div class="three columns">
    <h4>Edit Product</h4>
  </div>
</div>

<div class="row">
  <div class="twelve columns">
    <h5><?= ucfirst($category['name']) ?> &rsaquo; <?= ucfirst($brand['name']) ?> &rsaquo; <?= ucfirst($product['name']) ?></h5>
  </div>
</div>

<div class="row">
  <div class="three columns">
    <h4>Specification</h4>
  </div>
</div>

<from class="custom collapse" id="editProduct-form">
</from>
