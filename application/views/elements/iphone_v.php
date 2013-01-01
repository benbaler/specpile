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

      <a href="https://play.google.com/store/apps/details?id=com.ben.com" target="_blank">
        <img class="img" src="/assets/images/iphone.png">
        <div class="mask">
          <div class="canvas">
            <div class="page"><img src="/assets/images/2012-12-18 17.23.14.png"/></div>
            <div class="page"><img src="/assets/images/2012-12-18 16.56.36.png"/></div>
            <div class="page"><img src="/assets/images/2012-12-18 16.56.45.png"/></div>
            <div class="page"><img src="/assets/images/2012-12-18 16.57.13.png"/></div>
            <div class="page"><img src="/assets/images/2012-12-18 16.57.26.png"/></div>
          </div>
        </div>
      </a>
