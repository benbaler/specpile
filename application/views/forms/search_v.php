<div class="row">
  <div class="two columns">
    <h4>Search</h4>
  </div>
</div>
<form class="custom collapse" id="search-form">

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

  <div class="ten columns">
    <div class="row collapse">

      <div class="ten mobile-three columns">
        <input type="text" name="query" placeholder="Search for products"/>
      </div>

      <div class="two mobile-one columns">
        <input class="postfix button expand" type="submit" value="Search"/>
      </div>

    </div>
  </div>

</div>

</form>