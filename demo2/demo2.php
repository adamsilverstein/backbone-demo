<?php
namespace backbonedemo\demo2
?>

<!-- Main placeholder div to inject into -->
<div class="backbonedemo"></div>

<!-- Detail placeholder div to inject into -->
<div class="backbonedemodetail"></div>


<!-- Demo post template -->
<script id="tmpl-backbonedemo-post" type="text/html">
	<!-- Post -->
	<div class="backbonedemo-post-container" >
		<div class="backbonedemo-post-title">
			<h2>{{ data.title.rendered }}</h2>
		</div>
		<div class="backbonedemo-post-content">
			{{{ data.content.rendered }}}
		</div>
	</div>
</script>


<!-- Demo postlist template -->
<script id="tmpl-backbonedemo-postlist" type="text/html">
	<!-- Postlist -->
	<div class="backbonedemo-postlist-container">
		<h2>
			<?php esc_html_e( 'Backbone demo post list' ); ?>
		</h2>
		<!-- Placeholder div to inject post list into -->
		<div class="backbonedemo"></div>
	</div>
</script>

<!-- Demo postlistitem template -->
<script id="tmpl-backbonedemo-postlistitem" type="text/html">
	<div class="backbonedemo-postlistitem-container">
		<div class="backbonedemo-postlistitem-title">
			<h3>
				<a href="#post{{ data.ID }}">
					{{ data.post_title }}
				</a>
			</h3>
		</div>
	</div>
</script>
