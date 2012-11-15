<div class="row">
	<div class="four one-mobile columns">
		<h4>Results</h4>
	</div>
</div>

<div class="row">
	<div class="twelve columns">
		<div id="results-panel" class="panel radius">
		</div>
	</div>
</div>

<script type="text/template" id="results-template">
<div class="row search-result">
<div class="three columns">
<%= id %>
</div>
<div class="three columns">
<%= product %>
</div>
<div class="three columns">
<%= model %>
</div>
<div class="three columns">
<img src="<%= picture %>"/>
</div>
</div>
</script>