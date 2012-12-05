<div class="row">
	<div class="four one-mobile columns">
		<h4>Results</h4>
	</div>
</div>

<div class="row">
	<div class="twelve columns">
		<div id="results-panel" class="panel radius">
			Search to get results
		</div>
	</div>
</div>

<script type="text/template" id="product-template">
<div class="row search-result">
<div class="twelve mobile-four columns">
<div class="row">
<div class="twelve mobile-four columns">
<%= category_name %> &rsaquo; <%= brand_name %> &rsaquo; <b><%= name %><b/>
</div>
</div>
<div class="row">
<div class="twelve mobile-four columns">
<a href="/product/view/<%= _id %>"><img src="<%= image %>"/></a>
</div>
</div>
</div>
</div>
</script>