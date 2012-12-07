<div class="row">
	<div class="four one-mobile columns">
		<h4>Results</h4>
	</div>
</div>

<div class="row">
	<div class="twelve columns">
		<div class="panel radius">
			<ul id="results-panel" class="block-grid four-up mobile">
				Search to get results
			</ul>
		</div>
	</div>
</div>

<script type="text/template" id="product-template">
<a href="/product/view/<%= _id %>">
<div class="row search-result">
<div class="twelve mobile-four columns">
<div class="row">
<div class="twelve mobile-four columns">
<%= category_name %> &rsaquo; <%= brand_name %> &rsaquo; <b><%= name %><b/>
</div>
</div>
<div class="row">
<div class="twelve mobile-four columns">
<img src="<%= image %>" class="productImg"/>
</div>
</div>
</div>
</div>
</a>
</script>