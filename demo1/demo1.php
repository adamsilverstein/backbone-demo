<?php
namespace backbonedemo\demo1
?>

<!-- Main placeholder div to inject into -->
<div class="backbonedemo"></div>

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
