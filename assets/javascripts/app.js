head.js('/assets/javascripts/libs/jquery.js',
    '/assets/javascripts/libs/jquery.ui.js',
    '/assets/javascripts/libs/jquery.foundation.topbar.js',
    '/assets/javascripts/libs/jquery.foundation.placeholder.js',
    '/assets/javascripts/libs/modernizr.foundation.js',
    '/assets/javascripts/libs/underscore.js',
    function() {
        $(document).ready(function(){
            $(document).foundationTopBar();
            $('#uvTab').addClass('hide-for-medium-down');
            $('input, textarea').placeholder();
            
            var delay = (function(){
              var timer = 0;
              return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
              };
            })();

            $('#term').autocomplete({
                source: [],
                delay: 0
                }).data( "autocomplete" )._renderItem = function( ul, item ) {
                    var term = this.term.split(' ').join('|');
                    var re = new RegExp("(" + term + ")", "gi") ;
                    var t = item.label.replace(re,"<span style='font-weight:bold;'>$1</span>");
                    var inner_html = '<a><img style="vertical-align:middle;" width="30" src="' + item.image + '"/> ' + t +'</a>';
                    return $( "<li></li>" )
                        .data( "item.autocomplete", item )
                        .append(inner_html)
                        .appendTo( ul );
                }

            $("#term").on('keydown', function(event){
                if(event.keyCode == '13' || event.keyCode == '38' || event.keyCode == '40' || event.keyCode == '9' || event.keyCode == '27')
                    return;

                var self = this;

                delay(function(){
                    var term = $(self).val();

                    $.get('/api/products/term/'+encodeURIComponent(term), function(data) {
                        results = [];
                        $.each(data, function(i,val){
                            results.push(val);
                        });

                        $(self).autocomplete("option", "source", results);
                        $(self).autocomplete("search");
                    });
                }, 300 );

            });

            $('#search-form').submit(function(){
                var term = $('#term').val().trim();
                var panel = $('#results-panel');

                if(term){
                    panel.html('<li>Searching...</li>');
                    $.get('/api/search/query/'+encodeURIComponent(term), function(data){
                        var str = '';
                        $.each(data, function(index, value){
                            var template = _.template($('#product-template').html());
                            str = str+'<li class="product-div">'+template(value)+'</li>';
                        });

                        panel.html(str);
                        $("#term").autocomplete("close");
                        $("html, body").animate({ scrollTop: $('#results-header').offset().top }, 1000);
                    }).error(function() {
                        panel.html("<li>No results for '"+term+"'<br/>you can only search for <b>smart phones</b>, <b>tablets</b> or <b>digital cameras</b></li>");
                    });
                }
                return false;
            });

            $('.latest-search').click(function(){
                var term = $(this).attr('data-term');
                $('#term').val(term);
                $('#search').trigger('click');
            });

        });
    });