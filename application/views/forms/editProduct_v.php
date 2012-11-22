
<script>
window.productData = {
  id: '<?= (string)$product['_id'] ?>',
  name: '<?= ucfirst($product['name']) ?>',
  category_id: '<?= (string)$product['category_id']['_id'] ?>',
  brand_id: '<?= (string)$product['brand_id']['_id'] ?>',
  specs: [
    {
      name: "Resolution", value: "1920x1080", options: ["1920x1080", "1024x768", "600x800"]
    },
    {
      name: "Memory", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "OS", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "CPU", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "Width", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "Height", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "Weight", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "Color", value: "16GB", options: ["16GB", "8GB", "32GB"]
    },
    {
      name: "Core", value: "16GB", options: ["16GB", "8GB", "32GB"]
    }
  ]
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
