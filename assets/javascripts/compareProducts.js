head.js('/assets/javascripts/libs/jquery.js',
    '/assets/javascripts/libs/jquery.ui.js',
    '/assets/javascripts/libs/jquery.foundation.topbar.js',
    '/assets/javascripts/libs/modernizr.foundation.js',
    function() {
        $(document).ready(function(){
            $(document).foundationTopBar();
            $('#uvTab').addClass('hide-for-medium-down');

            $('#product1').autocomplete({
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

                $('#product2').autocomplete({
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

            $("#product1, #product2").on('keyup', function(){
                var term = $(this).val();
                var category = $('#category option:selected').val();

                $.get('/api/products/category/'+category+'/term/'+encodeURIComponent(term), function(data) {
                    results = [];
                    $.each(data, function(i,val){
                        results.push(val);
                    });

                    $("#product1, #product2").autocomplete("option", "source", results);
                });
            });

            $('#category').change(function(){
                var category = $(this).val();
                $("#product1, #product2").autocomplete("option", "source", []);
                $("#product1, #product2").each(function(){
                    console.log($(this).val());
                    $(this).val('');
                });
            });


            $('#compareProducts-form').submit(function(){
                var p1 = $('#product1').val();
                var p2 = $('#product2').val();
                var c = $('#category option:selected').val();

                if(p1 && p2){
                    location.href = '/product/compare/'+c+'/'+p1+'/'+p2;
                }
                return false;
            });

        });
    });