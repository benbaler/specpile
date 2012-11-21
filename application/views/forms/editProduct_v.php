<script>
	window.productData = {
		id: '<?= (string)$product['_id'] ?>',
		name: '<?= ucfirst($product['name']) ?>',
		category_id: '<?= (string)$product['category_id']['_id'] ?>',
		brand_id: '<?= (string)$product['brand_id']['_id'] ?>',
		specs: {Resolustion: "1920x1080", Memory: "16GB"}
	}
</script>

<script type="text/template" id="spec-template">
  <select id="" name="">
    <option value="" SELECTED>Select an Option</option>
  <% _.each(options, function(value,key) { %> 
    <option value=""></option>
  <% }); %>
  </select>
</script>

<script type="text/template" id="specs-template">

	<% _.each(specs, function(i,k) { %> 

		<div class="row">

			<div class="two mobile-one columns offset-by-one">
      		<label class="inline"><%= k %></label>
    	</div>

      <div class="four columns">
        <div class="row collapse">

          <div class="eight mobile-three columns">
            <select id="categoryDropdown" name="category">
            <option value="" SELECTED>Select Category</option>
            <?php foreach($categories as $category) : ?>
            <option value="<?= $category['_id'] ?>"><?= ucwords($category['name']) ?></option>
          <?php endforeach; ?>
        </select>
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

    <div class="six mobile-three columns offset-by-one">
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
    <h5><?= ucfirst($product['category_id']['name']) ?> &rsaquo; <?= ucfirst($product['brand_id']['name']) ?> &rsaquo; <?= ucfirst($product['name']) ?></h5>
  </div>
</div>

<div class="row">
  <div class="three columns">
    <h4>Specification</h4>
  </div>
</div>

<from class="custom collapse" id="editProduct-form">
</from>
