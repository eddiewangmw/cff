<?php

/*

@name			    Footer Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

?>

	<?php gp_start('footer', 'footer', false); ?>
    

        <?php gp_start('div', 'copyright'); ?>
            
            <?php
                if (gp_option('gp_footer_copyright')) {
                    
                    echo stripslashes(gp_option('gp_footer_copyright'));
                
                } else {
                ?>
            
                    <?php _e('Copyright &copy;', 'gp'); ?> <?php echo date('Y'); ?> <a class="underline" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a>
            
                <?php
                }
            ?>
            
        <?php gp_end('div', 'copyright'); ?>
    
    <?php gp_end('footer', 'footer', false); ?>
 </div>   
    <div class="back-to-top" title="Back to Top"></div><!-- END // back-to-top -->

	<?php gp_footer(); ?>
    <?php wp_footer(); ?>

</body>
</html>