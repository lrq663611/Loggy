<?php include_once($_SERVER['DOCUMENT_ROOT']."/include/html.php");?>

<body>
    <div>
        <div class="home-left-half">
            <div class="home-left-half-container">
                <a href="/">
                    <img id="loggy-logo" src="/image/Loggy-Logo.png" alt="loggy logo">
                </a>
				<br /><br />
                <h1 style="color:#fff; font-size:19px;">Your online vehicle service logbook</h1>
				<div class="buttons">
					<a href="/auth/login" class="login-button">LOGIN</a>
					<br /><br />
					<a href="/whats-loggy.php" class="intro-button">WHAT IS LOGGY?</a>
				</div>
                <div class="home-left-footer">
                    <span class="line-1">
                        <a class="contact" href="/contact-us.php">Contact Us</a>
                        <a class="privacy" href="/privacy-policy.php" target="_blank">&nbsp;&nbsp;|&nbsp;&nbsp;Privacy Policy&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                        <a class="terms" href="/terms.php" target="_blank">Terms of Use</a>
                    </span>
					<br /><br />
                    <div id="loggy-copy-right">
						&copy; Loggy 2014
                    </div>
                </div>
            </div>
        </div>
        <div class="home-right-half">
			<div class=""></div>
        </div>
    </div>
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
</body>
</html>