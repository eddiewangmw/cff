<?php

/*

@name			    Header Toolbar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

?>

<?php gp_start('div', 'toolbar-right', false); ?>

    <?php gp_start('div', 'row', false); ?>

        
        <?php if (gp_option('gp_toolbar_header_search') != 'false') { ?>

            <ul class="modal-search-button">

                <li>
                    <a href="javascript:;" title="<?php _e('Search ...', 'gp'); ?>">
                        <?php _e('Search ...', 'gp'); ?>
                    </a>
                </li>

            </ul>

        <?php } ?>


    <?php gp_end('div', 'row', false); ?>

<?php gp_end('div', 'toolbar-right', false); ?>