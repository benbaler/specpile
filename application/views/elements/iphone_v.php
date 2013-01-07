    <style>
    img{
      border:0px;
    }
    .img{
      position: absolute;
      left: 1;
      top: 24;
      width:301px;
    }
    div img{
      height: 100%;
      width: 100%;
    }
    .mask {
      position: absolute;
      left: 31;
      top: 122;
      width: 239;
      height: 342;
      overflow: hidden;
    }
    .canvas {
      position: relative;
        /*left: 31;
        top: 122;*/
        width: 2195;
        height: 342;
      }
      .page {
        width: 239;
        height: 342;
        float:left;
      }
      </style>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript">
      var $canvas
      $(function(){
        $canvas=$("div.canvas")
        setInterval(scroll, 5000);
      });
      function scroll(){
        if ($canvas.position().left!=-956){
          $canvas.animate({left: "-=239"});
        }else{
          $canvas.animate({left: 0});
        }
      }
      </script>

      <a href="https://itunes.apple.com/il/app/specpile-search-compare-products/id590381093?mt=8" target="_blank">
        <img class="img" src="/assets/images/iphone.png">
        <div class="mask">
          <div class="canvas">
            <div class="page"><img src="/assets/images/1.jpg"/></div>
            <div class="page"><img src="/assets/images/2.jpg"/></div>
            <div class="page"><img src="/assets/images/6.png"/></div>
            <div class="page"><img src="/assets/images/3.jpg"/></div>
            <div class="page"><img src="/assets/images/4.jpg"/></div>
          </div>
        </div>
      </a>
