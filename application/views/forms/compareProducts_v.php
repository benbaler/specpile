<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Compare</h4>
  </div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">

    <form class="custom collapse" id="compareProducts-form" onsubmit="return false;">

      <div class="row">

        <div class="two mobile-four columns">
          <select name="company" id="category">
            <option value="smartphones" SELECTED>Smartphones</option>
            <option value="tablets">Tablets</option>
            <option value="cameras">Cameras</option>
          </select>
        </div>

        <div class="two mobile-four columns show-for-small">
          &nbsp;
        </div>

        <div class="four mobile-four columns">
          <input type="text" name="product1" id="product1" placeholder="Type First Product"/>
        </div>

        <div class="four mobile-four columns">
          <input type="text" name="product2" id="product2" placeholder="Type Second Product"/>
        </div>

        <div class="two mobile-four columns">
          <input class="postfix button expand" type="submit" value="Compare"/>
        </div>

      </div>

    </div>
  </form>

</div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Latest Compares</h4>
  </div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">
   <ul id="latest-panel" class="block-grid two-up mobile-one-up" style="text-align: center">
   <?php foreach ($compares as $compare) : ?>
    <li><a href="/product/compare/<?= $compare['category'] ?>/<?= urlencode($compare['product1']) ?>/<?= urlencode($compare['product2']) ?>"><?= $compare['product1'].'<img src="'.$compare['product1_image'].'" style="vertical-align:middle;"/>vs<img src="'.$compare['product2_image'].'" style="vertical-align:middle;"/>'.$compare['product2'] ?></a>&nbsp;&nbsp;&nbsp;&nbsp;</li> 
  <?php endforeach; ?>
  </ul>
</div>
</div>   

<!-- <div class="row">
  <div class="twelve mobile-four columns">
    <div  style="text-align: center;"><a href="/product/compare/smartphones/iphone%205/galaxy%20s%20iii"><img src="/assets/images/iphone5-galaxy-s3.jpg"/></a><div>
    </div>
  </div> -->
