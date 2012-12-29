head.js('/assets/javascripts/libs/jquery.js',
    '/assets/javascripts/libs/jquery.ui.js',
    '/assets/javascripts/libs/jquery.foundation.topbar.js',
    '/assets/javascripts/libs/modernizr.foundation.js',
    '/assets/javascripts/libs/underscore.js',
    function() {
        $(document).ready(function(){
            $(document).foundationTopBar();
            $('#uvTab').addClass('hide-for-medium-down');

            $('#term').autocomplete({
                source: [],
                minLength: 1
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

            $("#term").on('keyup', function(){
                var term = $(this).val();

                $.get('/api/products/term/'+encodeURIComponent(term), function(data) {
                    results = [];
                    $.each(data, function(i,val){
                        results.push(val);
                    });

                    $("#term").autocomplete("option", "source", results);
                });
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
                    }).error(function() {
                        panel.html("<li>No results for '"+term+"'</li>");
                    });
                }
                return false;
            });

        });
    });