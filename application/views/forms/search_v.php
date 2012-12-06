<script>
window.categories = <?= json_encode($categories); ?>;
</script>

<div class="row">
  <div class="two columns">
    <h4>Search</h4>
  </div>
</div>
<form class="custom collapse" id="search-form">

  <div class="row">

    <!-- <div class="two mobile-four columns">
      <div class="row">
        <div class="twelve mobile-four columns">

        <input type="text" name="category" id="categories" placeholder="Select Category"/>

      </div>
    </div>
  </div> -->

  <div class="twelve mobile-four columns">
    <div class="row collapse">

      <div class="twelve mobile-four columns">
        <input type="text" name="term" id="term" placeholder="Search Product e.g. iPhone 5"/>
      </div>

      <!-- <div class="two mobile-one columns">
        <input class="postfix button expand" type="submit" value="Search"/>
      </div> -->

    </div>
  </div>

</div>

</form>