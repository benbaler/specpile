<script>
window.categories = <?= json_encode($categories); ?>;
window.brands = <?= json_encode($brands); ?>;
</script>

<div class="row">
  <div class="three  mobile-four columns">
    <h4>Add Product</h4>
  </div>
</div>

<form class="custom collapse" id="addProduct-form">

  <div class="row">

    <div class="two mobile-one columns">
      <div class="row">
        <div class="twelve mobile-four columns">

        <input type="text" name="category" id="categories" placeholder="Select Category"/>

      </div>
    </div>
  </div>

  <div class="two mobile-one columns">
    <div class="row">
      <div class="twelve mobile-four columns">

    <input type="text" name="brand" id="brands" placeholder="Select Brand"/>

  </div>
</div>
</div>


<div class="eight mobile-two columns">

  <div class="row collapse">

    <div class="nine mobile-two columns">
      <input type="text" name="product" placeholder="Type Product Here"/>
    </div>

    <div class="three mobile-two columns">
      <input class="postfix button expand" type="submit" value="Add Product"/>
    </div>

  </div>

</div>

</div>
</form>