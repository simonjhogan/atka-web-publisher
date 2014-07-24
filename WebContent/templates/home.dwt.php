<!DOCTYPE html>
<html>
 
<!-- #BeginTemplate "home.dwt" -->

<head> 
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<!-- #BeginEditable "doctitle" -->
<title><?= $this->data->title; ?></title>
	<!-- #EndEditable -->
	<link rel="stylesheet" type="text/css" href="/templates/styles/screen.css">
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-17815985-2']);
	  _gaq.push(['_setDomainName', 'h3consulting.net']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	<!-- #BeginEditable "cmsscript" --><?php $this->CmsScript(); ?><!-- #EndEditable -->
</head> 

<body>
	<!-- #BeginEditable "cmscontrols" --><?php $this->CmsControls(); ?><!-- #EndEditable -->
	<div id="header-wrap">
		<div id="header">
			<div id="logo">
				<h1><span class="highlight">Sith'ari</span> consulting</h1>
				<h5 class="tagline">Web Design &amp; Development &bull; Survey Solutions &bull; Events Management</h5>
			</div>
			<div id="social">
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	<div id="navigator">
		<ul>
			<li><a href="/index.php">Home</a></li>
			<li><a href="/index.php/services">Products &amp; Services</a></li>
			<li><a href="/index.php/news">News</a></li>
			<li><a href="/index.php/blog">Blog</a></li>
			<li><a href="/index.php/downloads">Downloads</a></li>
			<li><a class="last" href="/index.php/contact">Contact</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	
	<div id="features-wrap">
		<div id="features">
			<div class="feature-column">
				<h2>Welcome to h3<span class="white">consulting</span></h2>
				<!-- #BeginEditable "welcomeFeature" --><div id="_welcomeFeature" class="cms-editable"><?= $this->data->welcomeFeature; ?></div><!-- #EndEditable -->
			</div>
			<div class="feature-column">
				<h2>Recent News &amp; Announcements</h2>
				<!-- #BeginEditable "newsFeature" --><div id="_newsFeature" class="cms-editable"><?= $this->data->newsFeature; ?></div><!-- #EndEditable -->
			</div>
			<div class="feature-column last">
				<h2>Technology News</h2>
				<?php
					require(getcwd()."/rss/rss.php");
					echo rss(getcwd()."/rss/cache/google.xml", getcwd()."/rss/titles.xsl", 7); 
				?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="content-wrap">
		<div id="content">
			<div id="column-main">
			<!-- #BeginEditable "content" --><div id="_content" class="cms-editable"><?= $this->data->content; ?></div><!-- #EndEditable -->
			</div>
			<div id="column-side">
			<!-- #BeginEditable "contentFeature" --><div id="_contentFeature" class="cms-editable"><?= $this->data->contentFeature; ?></div><!-- #EndEditable -->	
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	<div id="footer-wrap">
		<div id="footer">
		<p id="footer-date">
			<?php 
				echo gmdate(DATE_RFC822, $_SERVER['REQUEST_TIME'])."<br>"; 
				echo $_SERVER['REMOTE_ADDR']."<br>";
				echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
			?>
		</p>
		<ul id="footer-links">
			<li class="last">&copy; 2012 <span class="highlight">Sith'ari</span> consulting</li>
			<li><a href="/index.php/disclaimer">Disclaimer</a></li>
			<li><a href="/index.php/privacy">Privacy</a></li>
			<li><a href="/index.php/contact">Contact</a></li>
		</ul>
		</div>
	</div>

</body>

<!-- #EndTemplate -->

</html>