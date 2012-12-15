head.js(
    '/assets/javascripts/libs/jquery.js', 
    '/assets/javascripts/libs/jquery.ui.js', 
    '/assets/javascripts/libs/jquery.foundation.topbar.js',
    '/assets/javascripts/libs/modernizr.foundation.js',
    function() {
        $(document).ready(function(){
            $(document).foundationTopBar();
            $('#uvTab').addClass('hide-for-medium-down');
        });
   });