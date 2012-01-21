<?php
/**
 * @package WordPress
 * @subpackage Wordousel Lite
 */
?>

<div id="footer">

<div class="ftr_inner">
 
<div class="copyright"> 
<p><a href="http://armeda.com/wordousel-lite-wordpress-theme/#comment-156" title="Wordousel">Wordousel</a> theme by <a href="http://armeda.com" title="Dre Armeda">Dre Armeda</a> -
Powered by <a href="http://wordpress.org" title="WordPress">WordPress</a>.
</p>
 
</div>

</div>

</div>

<script type="text/javascript">
$(document).ready(function(){

	$("#myController").jFlow({
		slides: "#mySlides",
		controller: ".jFlowControl", // must be class, use . sign
		slideWrapper : "#jFlowSlide", // must be id, use # sign
		selectedWrapper: "jFlowSelected",  // just pure text, no sign
		width: "910px",
		height: "320px",
		duration: 400,
		prev: ".jFlowPrev", // must be class, use . sign
		next: ".jFlowNext" // must be class, use . sign
	});
	
	$("#myController2").jFlow({
		slides: "#mySlides2",
		controller: ".jFlowControl2", // must be class, use . sign
		slideWrapper : "#jFlowSlide2", // must be id, use # sign
		selectedWrapper: "jFlowSelected2",  // just pure text, no sign
		width: "910px",
		height: "140px",
		duration: 400,
		prev: ".jFlowPrev2", // must be class, use . sign
		next: ".jFlowNext2" // must be class, use . sign
	});	

});
</script>

<?php wp_footer(); ?>
		
<!--[if IE]></div><![endif]--> 

</body>
</html>
