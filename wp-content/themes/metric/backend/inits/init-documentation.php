<?php

/*

@name			    GPanel Documentation Init
@package		    GPanel WordPress Framework
@since			    3.0.0
@author			    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Link to Documentation
====================================================================================================
*/

if (!function_exists('gp_init_documentation')) {

	function gp_init_documentation() {
	?>
	
		<script type="text/javascript">
	
			//<![CDATA[
	
				window.location.replace("http://docs.grandpixels.com/metric/");
	
			//]]>
	
		</script>
	
	<?php
	}

}