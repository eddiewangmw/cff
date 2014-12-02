<?php

/*

@name			    Title Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

?>

<?php gp_start('header', 'title'); ?>
    
    <h1>
		<?php
            if (is_home()) {
                bloginfo('name');
            } else if (is_category()) {
                single_cat_title();
            } else if (is_single()) {
                single_post_title();
            } else if (is_page()) {
                single_post_title();
            } else if (is_tax()) {
                single_term_title();
            } else {
                wp_title('', true);
            }
        ?>
    	
        <?php
            if (current_user_can('edit_posts') && !is_tax()) {
                edit_post_link(__('[edit]', 'gp'), '<span class="edit-post-link">', '</span>');
            }
		?>    
    </h1>

<?php gp_end('header', 'title'); ?>