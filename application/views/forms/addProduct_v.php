<div class="row">
  <div class="three columns">
    <h4>Add Product</h4>
  </div>
</div>

<form class="custom collapse" id="addProduct-form">

  <div class="row">

    <div class="two columns">
      <div class="row">
        <div class="twelve columns">

          <select id="categoryDropdown" name="category">
            <option value="" SELECTED>Select Category</option>
            <?php foreach($categories as $category) : ?>
            <option value="<?= $category['_id'] ?>"><?= ucwords($category['name']) ?></option>
          <?php endforeach; ?>
        </select>

      </div>
    </div>
  </div>

  <div class="two columns">
    <div class="row">
      <div class="twelve columns">

        <select id="brandDropdown" name="brand">
          <option value="" SELECTED>Brand</option>
          <?php foreach($brands as $brand) : ?>
          <option value="<?= $brand['_id'] ?>"><?= ucwords($brand['name']) ?></option>
        <?php endforeach; ?>
      </select>

    </div>
  </div>
</div>


<div class="eight columns">

  <div class="row collapse">

    <div class="eight mobile-three columns">
      <input type="text" name="model" placeholder="Example: iPhone 5"/>
    </div>

    <div class="four mobile-one columns">
      <input class="postfix button expand" type="submit" value="Add Product"/>
    </div>

  </div>

</div>

</div>
</form>