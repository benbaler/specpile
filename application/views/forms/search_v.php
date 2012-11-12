<form class="custom collapse" id="search-form">

  <div class="row">

    <div class="two columns">
      <div class="row">
        <div class="twelve columns">

        <select style="display:none;" id="customDropdown">
          <option SELECTED>Category</option>
          <?php foreach($categories as $category) : ?>
          <option><?= ucwords($category['name']) ?></option>
        <?php endforeach; ?>
      </select>

      <div class="custom dropdown">
        <a href="#" class="current">
          Category
        </a>
        <a href="#" class="selector"></a>
        <ul>
          <?php foreach($categories as $category) : ?>
          <li><?= ucwords($category['name']) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    </div>

  </div>

</div>

<div class="ten columns">

  <div class="row collapse">

    <div class="ten mobile-three columns">
      <input type="text" name="term" placeholder="Search for products"/>
    </div>

    <div class="two mobile-one columns">
      <input class="postfix button expand" type="submit" value="Search"/>
    </div>

  </div>

</div>

</div>

</form>