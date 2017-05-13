<div id="footer">
	<div class="full-width-container add-padding-width">
		<a href="/contact-us.php">Contact Us&nbsp;&nbsp;|</a>
		<a href="/privacy-policy.php" target="_blank">&nbsp;&nbsp;Privacy Policy&nbsp;&nbsp;|</a>
		<a href="/terms.php" target="_blank">&nbsp;&nbsp;Terms of Use</a>
		<!--<a class="SiteMap" href="#">&nbsp;&nbsp;Site Map</a>-->
		<span id="loggy-copy-right">
			1300 462 248&nbsp;&nbsp;|&nbsp;&nbsp;ABN 64 167 955 178&nbsp;&nbsp;|&nbsp;&nbsp;&copy; Loggy <?=date("Y")?>&nbsp;&nbsp;|&nbsp;&nbsp;Developed By <a href="http://www.emoceanstudios.com.au/" target="_blank" style="text-decoration: underline;">Emocean Studios</a>
		</span>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$('.menu-item-sticky a').each(function(){
	if (document.URL.indexOf($(this).attr("href")) > -1){
		$(this).parent().css("background", "#ed5622");
	}
})
</script>
<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-46783652-2']);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>