<p class="footer">
	<?php 
	$generation_end = microtime(TRUE);
	$generation_time = $generation_end - $generation_start;
	$generation_time = round($generation_time*1000);
	
	echo L::footer_page_build . ' ' . $generation_time . ' ms - ' . L::footer_powered_by . ' <a href="https://github.com/olaulau/DownloadDir">DownloadDir</a>';
	?>
</p>

<script src="index.js"></script>
<script src="js/design.js"></script>