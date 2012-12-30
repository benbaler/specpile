<div class="row">
	<div class="twelve mobile-four columns">
		<h4>Results</h4>
	</div>
</div>

<div class="row">
	<div class="twelve columns">
		<ul id="results-panel" class="block-grid four-up mobile-two-up">
			<li>Search to get results!</li>
		</ul>
	</div>
</div>

<script type="text/template" id="product-template">
<a href="/product/view/<%= _id %>">

	<div class="row search-result">
		<div class="twelve mobile-four columns product-result">

			<div class="row">
				<div class="twelve mobile-four columns result-img">
				<img src="<% if(image != '') { %> <%= image %> <% } else { %> assets/images/unknown.png  <% } %>" class="productImg"/>
				</div>
			</div>

			<div class="row">
				<div class="twelve mobile-four columns result-name">
				<%= category_name %> &rsaquo; <%= brand_name %><br/><b><%= name %></b>
				</div>
			</div>


		</div>
	</div>

</a>
</script>