<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Compare specs <small>of smart phones, tablets or digital cameras</small></h4>
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
   <ul id="latest-panel" class="block-grid two-up mobile-one-up">
     <?php foreach ($compares as $compare) : ?>
     <li style="border-top: 1px whitesmoke solid;">
      <a href="/product/compare/<?= $compare['category'] ?>/<?= urlencode($compare['product1']) ?>/<?= urlencode($compare['product2']) ?>">
        <div class="row">
          <div class="one columns hide-for-small">
            &nbsp;
          </div>
          <div class="two mobile-one columns" style="text-align:right;padding:0;margin:0;">
            <?= $compare['product1'] ?>
          </div>
          <div class="six mobile-two columns">
            <div class="row">
              <div class="five mobile-one columns" style="text-align:right;padding:0;margin:0;">
                <img src="<?= $compare['product1_image'] ?>"/>
              </div>
              <div class="two mobile-two columns" style="text-align:center;vertical-align:middle;">
                <h6 class="full-circle">vs</h6>
              </div>
              <div class="five mobile-one columns" style="text-align:left;padding:0;margin:0;">
                <img src="<?= $compare['product2_image'] ?>"/>
              </div>
            </div>
          </div>
          <div class="two mobile-one columns" style="text-align:left;padding:0;margin:0;">
            <?= $compare['product2'] ?>
          </div>
          <div class="one columns hide-for-small">
            &nbsp;
          </div>
        </div>
      </a>
    </li> 
  <?php endforeach; ?>
</ul>
</div>
</div>
