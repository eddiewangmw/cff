<?php

/*

@name			    Search Form Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

?>

<form method="get" action="<?php echo home_url(); ?>/">
	<fieldset>
    	<input type="text" class="input-search no-radius transition" title="<?php _e('Search ...', 'gp'); ?>" value="<?php _e('Search ...', 'gp'); ?>" name="s" />
	</fieldset>
</form>
