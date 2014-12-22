<?php

/*

@name			    GPanel Options Init
@package		    GPanel WordPress Framework
@since			    3.0.1
@author			    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Theme Options Sections
====================================================================================================
*/

if (!function_exists('gp_theme_options_sections')) {

	function gp_theme_options_sections() {
	
		$sections = array();
	
		$sections['general'] 				= __('General Settings', 'gp');
		$sections['styling'] 				= __('Styling', 'gp');
		$sections['reading'] 				= __('Reading', 'gp');
		$sections['socials'] 				= __('Socials', 'gp');
		$sections['forms'] 					= __('Forms', 'gp');
		$sections['tracking'] 				= __('Tracking', 'gp');
	
		return $sections;
	
	}

}

/*
====================================================================================================
Theme Options
====================================================================================================
*/

if (!function_exists('gp_theme_options_fields')) {

	function gp_theme_options_fields() {
		global $wp_version;
		
		/*
		----------------------------------------------------------------------------------------------------
		General Tab
		----------------------------------------------------------------------------------------------------
		*/
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_logo',
			'title'		=> __('Logos', 'gp'),
			'type'		=> 'heading',
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_logo',
			'title'		=> __('Logo Image', 'gp'),
			'desc'		=> __('Upload a logo image. Upload an image and then click "Select".<br /> <strong>Best size: Anything x 80 px.</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_logo_2x',
			'title'		=> __('@2x Logo Image', 'gp'),
			'desc'		=> __('Upload a @2x logo image for retina displays. Upload an image and then click "Select".<br /> <strong>Best size: Anything x 160 px.</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_login_logo',
			'title'		=> __('WordPress Login Logo Image', 'gp'),
			'desc'		=> __('Upload a WordPress login logo image. Upload an image and then click "Select".<br /> <strong>Required size: 80 x 80 px.</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);

        $options[] = array(
            'section'	=> 'general',
            'id'		=> GP_SHORTNAME . '_image_login_logo_2x',
            'title'		=> __('@2x WordPress Login Logo Image', 'gp'),
            'desc'		=> __('Upload a @2x WordPress login logo image for retina displays. Upload an image and then click "Select".<br /> <strong>Required size: 160 x 160 px.</strong>', 'gp'),
            'type'		=> 'input-upload',
            'std'		=> ''
        );
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_icons',
			'title'		=> __('Icons', 'gp'),
			'type'		=> 'heading',
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_favicon',
			'title'		=> __('Browser Favicon 32x32', 'gp'),
			'desc'		=> __('Upload a favicon in *.ico format. Upload an image and then click "Select".<br /> <strong>Required size: 32 x 32 px. Required name: favicon.ico</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon',
			'title'		=> __('Apple Touch Icon Precomposed 57x57', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select".<br /> <strong>Required size: 57 x 57 px. Required name: apple-touch-icon-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon_72',
			'title'		=> __('Apple Touch Icon Precomposed 72x72', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select".<br /> <strong>Required size: 72 x 72 px. Required name: apple-touch-icon-72x72-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon_114',
			'title'		=> __('Apple Touch Icon Precomposed 114x114', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select".<br /> <strong>Required size: 114 x 114 px. Required name: apple-touch-icon-114x114-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon_144',
			'title'		=> __('Apple Touch Icon Precomposed 144x144', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select".<br /> <strong>Required size: 144 x 144 px. Required name: apple-touch-icon-144x144-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_toolbar_header',
			'title'		=> __('Header Toolbar', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header',
			'title'		=> __('Header Toolbar', 'gp'),
			'desc'		=> __('Enable / disable displaying of the whole toolbar in the header.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header_left',
			'title'		=> __('Header Left Toolbar Content', 'gp'),
			'desc'		=> __('Fill the content of the left toolbar displayed in header. Ideal for the contact information.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header_socials',
			'title'		=> __('Socials', 'gp'),
			'desc'		=> __('Enable / disable displaying of the socials in the header toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header_search',
			'title'		=> __('Search Button', 'gp'),
			'desc'		=> __('Enable / disable displaying of the search button in the header toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header_qtranslate',
			'title'		=> __('qTranslate Flags', 'gp'),
			'desc'		=> __('Enable / disable displaying of the qTranslate flags in the header toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header_cart',
			'title'		=> __('WooCommerce Cart', 'gp'),
			'desc'		=> __('Enable / disable displaying of the WooCommerce cart in the header toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_toolbar_footer',
			'title'		=> __('Footer Toolbar', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer',
			'title'		=> __('Footer Toolbar', 'gp'),
			'desc'		=> __('Enable / disable displaying of the whole toolbar in the footer.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer_left',
			'title'		=> __('Footer Left Toolbar Content', 'gp'),
			'desc'		=> __('Fill the content of the left toolbar displayed in footer. Ideal for the contact information.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer_socials',
			'title'		=> __('Socials', 'gp'),
			'desc'		=> __('Enable / disable displaying of the socials in the footer toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer_search',
			'title'		=> __('Search Button', 'gp'),
			'desc'		=> __('Enable / disable displaying of the search button in the footer toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer_qtranslate',
			'title'		=> __('qTranslate Flags', 'gp'),
			'desc'		=> __('Enable / disable displaying of the qTranslate flags in the footer toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer_cart',
			'title'		=> __('WooCommerce Cart', 'gp'),
			'desc'		=> __('Enable / disable displaying of the WooCommerce cart in the footer toolbar.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_slideshow',
			'title'		=> __('Slideshow', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_type',
			'title'		=> __('Type', 'gp'),
			'desc'		=> __('Select type of slideshow.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'normal',
			'choices'	=> array(
				__('Normal', 'gp') . '|normal',
				__('Full Width', 'gp') . '|fullwidth'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_delay',
			'title'		=> __('Delay', 'gp'),
			'desc'		=> __('Fill the delay between slides in miliseconds. Default: 5000 (5s)', 'gp'),
			'type'		=> 'input',
			'std'		=> '5000'
		);
			
        $options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_navigation',
			'title'		=> __('Navigation', 'gp'),
			'desc'		=> __('Select type of slideshow navigation.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'bullet',
			'choices'	=> array(
				__('Bullets', 'gp') . '|bullet',
				__('Thumbnails', 'gp') . '|thumb',
				__('None', 'gp') . '|none'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_navigation_style',
			'title'		=> __('Bullet Navigation Style', 'gp'),
			'desc'		=> __('Select style of the bullet navigation. "Bullets" must be selected before.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'square',
			'choices'	=> array(
				__('Squares', 'gp') . '|square',
				__('Rounds', 'gp') . '|round'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_navigation_hide',
			'title'		=> __('Navigation Hide', 'gp'),
			'desc'		=> __('Show / hide navigation on hover (arrows and bullets or thumbnails).', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Hide', 'gp') . '|true',
				__('Never Hide', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_on_hover_stop',
			'title'		=> __('Stop Slideshow on Hover', 'gp'),
			'desc'		=> __('Select if slideshow will be stopped on hover.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Stop', 'gp') . '|true',
				__('Don\'t Stop', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_touch_enabled',
			'title'		=> __('Touch', 'gp'),
			'desc'		=> __('Enable / disable touch navigation of the slideshow on mobile devices.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_transition_default',
			'title'		=> __('Default Transition', 'gp'),
			'desc'		=> __('Select default slide transition. Individual transition of the slide can be changed on Add/Edit Slide page.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'boxslide',
			'choices'	=> array(
				__('Boxslide', 'gp') . '|boxslide',
				__('Boxfade', 'gp') . '|boxfade',
				__('Slotzoom Horizontal', 'gp') . '|slotzoom-horizontal',
				__('Slotzoom Vertical', 'gp') . '|slotzoom-vertical',
				__('Slotslide Horizontal', 'gp') . '|slotslide-horizontal',
				__('Slotslide Vertical', 'gp') . '|slotslide-vertical',
				__('Slotfade Vertical', 'gp') . '|slotfade-horizontal',
				__('Curtain 1', 'gp') . '|curtain-1',
				__('Curtain 2', 'gp') . '|curtain-2',
				__('Curtain 3', 'gp') . '|curtain-3',
				__('Slideleft', 'gp') . '|slideleft',
				__('Slideright', 'gp') . '|slideright',
				__('Slideup', 'gp') . '|slideup',
				__('Slidedown', 'gp') . '|slidedown',
				__('Slidehorizontal', 'gp') . '|slidehorizontal',
				__('Slidevertical', 'gp') . '|slidevertical',
				__('Fade', 'gp') . '|fade',
				__('Papercut', 'gp') . '|papercut',
				__('Flyin', 'gp') . '|flyin',
				__('Turnoff', 'gp') . '|turnoff',
				__('Cube', 'gp') . '|cube',
				__('3dcurtain Vertical', 'gp') . '|3dcurtain-vertical',
				__('3dcurtain Horizontal', 'gp') . '|3dcurtain-horizontal',
				__('Random', 'gp') . '|random',
				__('Premium Random', 'gp') . '|premium-random'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_rss',
			'title'		=> __('RSS', 'gp'),
			'desc'		=> __('For this setting you will need to create an account on <a href="http://www.feedburner.com/" target="_blank">Feedburner</a>.', 'gp'),
			'type'		=> 'heading',
		);
	
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_feedburner',
			'title'		=> __('FeedBurner URL', 'gp'),
			'desc'		=> __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed. <a href="http://www.wpbeginner.com/beginners-guide/step-by-step-guide-to-setup-feedburner-for-wordpress/" target="_blank">Step by Step Guide to Setup FeedBurner for WordPress</a>', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	
		if (!gp_seo_third_party()) {
			
			$options[] = array(
				'section'	=> 'general',
				'id'		=> GP_SHORTNAME . '_heading_meta',
				'title'		=> __('Meta', 'gp'),
				'type'		=> 'heading',
			);
			
			$options[] = array(
				'section'	=> 'general',
				'id'		=> GP_SHORTNAME . '_meta_keywords_default',
				'title'		=> __('Default Meta Keywords', 'gp'),
				'desc'		=> __('Add default meta keywords. Separate keywords with commas.', 'gp'),
				'type'		=> 'textarea',
				'std'		=> ''
			);
			
			$options[] = array(
				'section'	=> 'general',
				'id'		=> GP_SHORTNAME . '_meta_description_default',
				'title'		=> __('Default Meta Description', 'gp'),
				'desc'		=> __('Add default meta description.', 'gp'),
				'type'		=> 'textarea',
				'std'		=> ''
			);
			
		}
		
		/*
		----------------------------------------------------------------------------------------------------
		Styling Tab
		----------------------------------------------------------------------------------------------------
		*/

        $options[] = array(
            'section'	=> 'styling',
            'id'		=> GP_SHORTNAME . '_heading_fonts',
            'title'		=> __('Fonts', 'gp'),
            'type'		=> 'heading',
        );
	
		$options[] = array(
			'section'	=> 'styling',
			'id'		=> GP_SHORTNAME . '_font_face',
			'title'		=> __('Google Font Name', 'gp'),
			'desc'		=> __('Fill the <strong>FULL NAME</strong> of the font that you\'d like using from Google Font API: <a href="http://www.google.com/fonts" target="_blank">
	http://www.google.com/fonts</a>.<br /> <strong>For example:</strong> <code>Roboto</code><br /> Empty field = Default font', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);

        $options[] = array(
            'section'	=> 'styling',
            'id'		=> GP_SHORTNAME . '_font_face_styles',
            'title'		=> __('Google Font Styles', 'gp'),
            'desc'		=> __('Fill the styles you want to use with the font specified in <strong>Google Font Name</strong>.<br /> Separated by comma.<br /> <strong>For example:</strong> <code>400,300,500,700,900,100italic,100,300italic,400italic</code><br /><br /> List of the available styles you can get the on Quick Use page like  <a href="http://www.google.com/fonts/#QuickUsePlace:quickUse/Family:Roboto" target="_blank">http://www.google.com/fonts/#QuickUsePlace:quickUse/Family:Roboto</a>', 'gp'),
            'type'		=> 'input',
            'std'		=> ''
        );

        $options[] = array(
            'section'	=> 'styling',
            'id'		=> GP_SHORTNAME . '_font_face_subsets',
            'title'		=> __('Google Font Character Sets', 'gp'),
            'desc'		=> __('Fill the character sets you want to use with the font specified in <strong>Google Font Name</strong>.<br /> Separated by comma.<br /> <strong>For example:</strong> <code>latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic</code><br /><br /> List of the available sets you can get the on Quick Use page like  <a href="http://www.google.com/fonts/#QuickUsePlace:quickUse/Family:Roboto" target="_blank">http://www.google.com/fonts/#QuickUsePlace:quickUse/Family:Roboto</a>', 'gp'),
            'type'		=> 'input',
            'std'		=> ''
        );

		$options[] = array(
			'section'	=> 'styling',
			'id'		=> GP_SHORTNAME . '_text_transform',
			'title'		=> __('Text Transform', 'gp'),
			'desc'		=> __('Select text transform for some texts as headings, navigations, etc.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'uppercase',
			'choices'	=> array(
				__('Uppercase', 'gp') . '|uppercase',
				__('None', 'gp') . '|none'
			)
		);

        $options[] = array(
            'section'	=> 'styling',
            'id'		=> GP_SHORTNAME . '_heading_styles',
            'title'		=> __('Styles', 'gp'),
            'type'		=> 'heading',
        );
		
		$options[] = array(
			'section'	=> 'styling',
			'id'		=> GP_SHORTNAME . '_custom_css',
			'title'		=> __('Custom CSS', 'gp'),
			'desc'		=> __('Here you can specify a custom CSS section of code. This code will be given priority over other CSS styles.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		/*
		----------------------------------------------------------------------------------------------------
		Reading Tab
		----------------------------------------------------------------------------------------------------
		*/
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_date_format',
			'title'		=> __('Date', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_date_format',
			'title'		=> __('Select Date Format', 'gp'),
			'desc'		=> __('Please select a date format for the events and albums.<br /> d m Y = 01 02 2000<br /> m d Y = 02 01 2000<br /> Y m d = 2000 02 01<br /> Y d m = 2000 01 02<br /> l, j m Y = Monday, 01 02 2000<br /> F j, Y = January 1, 2000<br /> j M, Y = 1 Jan, 2000', 'gp'),
			'type'		=> 'select-text',
			'std'		=> '',
			'choices'	=> array(
				__('d m Y', 'gp') . '|d m Y',
				__('m d Y', 'gp') . '|m d Y',
				__('Y m d', 'gp') . '|Y m d',
				__('Y d m', 'gp') . '|Y d m',
                __('l, j m Y', 'gp') . '|l, j m Y',
				__('F j, Y (Delimiter ignored)', 'gp') . '|F j, Y',
				__('j M, Y (Delimiter ignored)', 'gp') . '|j M, Y'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_date_delimiter',
			'title'		=> __('Select Date Delimiter', 'gp'),
			'desc'		=> __('Please elect delimiter what want to use between the characters of date.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> '/',
			'choices'	=> array(
				__('Space [ ]', 'gp') . '| ',
				__('Slash [/]', 'gp') . '|/',
				__('Dash [-]', 'gp') . '|-',
				__('Dot [.]', 'gp') . '|.'
			)
		);
				
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_posts_homepage',
			'title'		=> __('Posts on Homepage', 'gp'),
			'type'		=> 'heading'
		);

        $options[] = array(
            'section'	=> 'reading',
            'id'		=> GP_SHORTNAME . '_heading_posts_homepage_callout',
            'title'		=> __('Callouts', 'gp'),
            'type'		=> 'subheading'
        );
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_callout_homepage',
			'title'		=> __('Callouts', 'gp'),
			'desc'		=> __('Enable / disable callout blocks on homepage.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);

       

     
		
		// $options[] = array(
		// 	'section'	=> 'reading',
		// 	'id'		=> GP_SHORTNAME . '_heading_event',
		// 	'title'		=> __('Events', 'gp'),
		// 	'type'		=> 'heading'
		// );
		//
		//         $options[] = array(
		// 	'section'	=> 'reading',
		// 	'id'		=> GP_SHORTNAME . '_event_view',
		// 	'title'		=> __('Events View Type', 'gp'),
		// 	'desc'		=> __('Select <strong>Events</strong> view type.', 'gp'),
		// 	'type'		=> 'select-text',
		// 	'std'		=> 'grid',
		// 	'choices'	=> array(
		// 		__('Grid', 'gp') . '|grid',
		// 		__('List', 'gp') . '|list'
		// 	)
		// );
       		//
		//
		// $options[] = array(
		// 	'section'	=> 'reading',
		// 	'id'		=> GP_SHORTNAME . '_event_per_page',
		// 	'title'		=> __('Upcoming Events per Page', 'gp'),
		// 	'desc'		=> __('Fill the number of upcoming events displayed per page. Default: -1 (all).', 'gp'),
		// 	'type'		=> 'input',
		// 	'std'		=> '-1'
		// );
				
        // $options[] = array(
  // 			'section'	=> 'reading',
  // 			'id'		=> GP_SHORTNAME . '_event_past_per_page',
  // 			'title'		=> __('Past Events per Page', 'gp'),
  // 			'desc'		=> __('Fill the number of upcoming events displayed per page. Default: -1 (all).', 'gp'),
  // 			'type'		=> 'input',
  // 			'std'		=> '-1'
  // 		);
  //
        // $options[] = array(
  // 			'section'	=> 'reading',
  // 			'id'		=> GP_SHORTNAME . '_event_sidebar',
  // 			'title'		=> __('Events Sidebar', 'gp'),
  // 			'desc'		=> __('Select the sidebar location of the events templates.', 'gp'),
  // 			'type'		=> 'select-text',
  // 			'std'		=> 'left',
  // 			'choices'	=> array(
  // 				__('Left', 'gp') . '|left',
  // 				__('Right', 'gp') . '|right'
  // 			)
  // 		);
		
	
		
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_video_sidebar',
			'title'		=> __('Videos Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the video templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'left',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_gallery',
			'title'		=> __('Galleries', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_gallery_number',
			'title'		=> __('Galleries per Page', 'gp'),
			'desc'		=> __('Fill the number of galleries displayed per page. Default: -1 (all).', 'gp'),
			'type'		=> 'input',
			'std'		=> '-1'
		);
		
		

        $options[] = array(
            'section'	=> 'reading',
            'id'		=> GP_SHORTNAME . '_heading_contact',
            'title'		=> __('Contact', 'gp'),
            'type'		=> 'heading'
        );

        $options[] = array(
            'section'	=> 'reading',
            'id'		=> GP_SHORTNAME . '_contact_sidebar',
            'title'		=> __('Contact Sidebar', 'gp'),
            'desc'		=> __('Select the sidebar location of the contact template.', 'gp'),
            'type'		=> 'select-text',
            'std'		=> 'right',
            'choices'	=> array(
                __('Left', 'gp') . '|left',
                __('Right', 'gp') . '|right'
            )
        );
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_contact_address',
			'title'		=> __('Contact address', 'gp'),
			'type'		=> 'input',
			'std'		=> 'PO Box 555 Westmead, NSW, 2145 Australia'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_footer',
			'title'		=> __('Footer', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_footer_copyright',
			'title'		=> __('Footer Copyright', 'gp'),
			'desc'		=> __('Fill the text appeared instead copyright in footer.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		/*
		----------------------------------------------------------------------------------------------------
		Socials Tab
		----------------------------------------------------------------------------------------------------
		*/
	
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_target',
			'title'		=> __('Open Links in New Window', 'gp'),
			'desc'		=> __('Enable / disable opening of the link in new window. Enabled = Open in new window/tab, Disabled = Open in actual window/tab', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_heading_social_profiles',
			'title'		=> __('Social Profiles', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_twitter',
			'title'		=> __('Twitter', 'gp'),
			'desc'		=> __('Fill the absolute path to your Twitter account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_facebook',
			'title'		=> __('Facebook', 'gp'),
			'desc'		=> __('Fill the absolute path to your Facebook account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_googleplus',
			'title'		=> __('Google+', 'gp'),
			'desc'		=> __('Fill the absolute path to your Google+ account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_amazon',
			'title'		=> __('Amazon', 'gp'),
			'desc'		=> __('Fill the absolute path to your Amazon account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_youtube',
			'title'		=> __('YouTube', 'gp'),
			'desc'		=> __('Fill the absolute path to your YouTube account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_vimeo',
			'title'		=> __('Vimeo', 'gp'),
			'desc'		=> __('Fill the absolute path to your Vimeo account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_itunes',
			'title'		=> __('iTunes', 'gp'),
			'desc'		=> __('Fill the absolute path to your iTunes account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_soundcloud',
			'title'		=> __('SoundCloud', 'gp'),
			'desc'		=> __('Fill the absolute path to your SoundCloud account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_beatport',
			'title'		=> __('Beatport', 'gp'),
			'desc'		=> __('Fill the absolute path to your Beatport account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_mixcloud',
			'title'		=> __('Mixcloud', 'gp'),
			'desc'		=> __('Fill the absolute path to your Mixcloud account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_purevolume',
			'title'		=> __('PureVolume', 'gp'),
			'desc'		=> __('Fill the absolute path to your PureVolume account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_spotify',
			'title'		=> __('Spotify', 'gp'),
			'desc'		=> __('Fill the absolute path to your Spotify account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_lastfm',
			'title'		=> __('Last.fm', 'gp'),
			'desc'		=> __('Fill the absolute path to your Last.fm account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_myspace',
			'title'		=> __('Myspace', 'gp'),
			'desc'		=> __('Fill the absolute path to your Myspace account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_grooveshark',
			'title'		=> __('Grooveshark', 'gp'),
			'desc'		=> __('Fill the absolute path to your Grooveshark account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_bandcamp',
			'title'		=> __('Bandcamp', 'gp'),
			'desc'		=> __('Fill the absolute path to your Bandcamp account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_jamendo',
			'title'		=> __('Jamendo', 'gp'),
			'desc'		=> __('Fill the absolute path to your Jamendo account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_reverbnation',
			'title'		=> __('ReverbNation', 'gp'),
			'desc'		=> __('Fill the absolute path to your ReverbNation account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_flickr',
			'title'		=> __('Flickr', 'gp'),
			'desc'		=> __('Fill the absolute path to your Flickr account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_tumblr',
			'title'		=> __('Tumblr', 'gp'),
			'desc'		=> __('Fill the absolute path to your Tumblr account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_pinterest',
			'title'		=> __('Pinterest', 'gp'),
			'desc'		=> __('Fill the absolute path to your Pinterest account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_instagram',
			'title'		=> __('Instagram', 'gp'),
			'desc'		=> __('Fill the absolute path to your Instagram account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_vk',
			'title'		=> __('VK', 'gp'),
			'desc'		=> __('Fill the absolute path to your VK account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);

        $options[] = array(
            'section'	=> 'socials',
            'id'		=> GP_SHORTNAME . '_socials_linkedin',
            'title'		=> __('LinkedIn', 'gp'),
            'desc'		=> __('Fill the absolute path to your LinkedIn account.', 'gp'),
            'type'		=> 'input',
            'std'		=> ''
        );

        $options[] = array(
            'section'	=> 'socials',
            'id'		=> GP_SHORTNAME . '_socials_reddit',
            'title'		=> __('Reddit', 'gp'),
            'desc'		=> __('Fill the absolute path to your Reddit account.', 'gp'),
            'type'		=> 'input',
            'std'		=> ''
        );
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_heading_sharing_box',
			'title'		=> __('Sharing Box', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_twitter',
			'title'		=> __('Twitter Button', 'gp'),
			'desc'		=> __('Enable / disable Twitter button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_facebook',
			'title'		=> __('Facebook Button', 'gp'),
			'desc'		=> __('Enable / disable Facebook button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_googleplus',
			'title'		=> __('Google+ Button', 'gp'),
			'desc'		=> __('Enable / disable Google+ button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_pinterest',
			'title'		=> __('Pinterest Button', 'gp'),
			'desc'		=> __('Enable / disable Pinterest button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_vk',
			'title'		=> __('VK Button', 'gp'),
			'desc'		=> __('Enable / disable VK button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
        
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_heading_twitter_api',
			'title'		=> __('Twitter API', 'gp'),
			'type'		=> 'heading'
		);
        
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_consumer_key',
			'title'		=> __('Consumer Key', 'gp'),
			'desc'		=> __('Fill the consumer key of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_consumer_secret',
			'title'		=> __('Consumer Secret', 'gp'),
			'desc'		=> __('Fill the consumer secret of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_access_token',
			'title'		=> __('Access Token', 'gp'),
			'desc'		=> __('Fill the access token of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_access_token_secret',
			'title'		=> __('Access Secret', 'gp'),
			'desc'		=> __('Fill the access secret of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
		/*
		----------------------------------------------------------------------------------------------------
		Forms Tab
		----------------------------------------------------------------------------------------------------
		*/
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_heading_contact_form',
			'title'		=> __('Contact Form', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_contact_email',
			'title'		=> __('Email Address for Receiving Emails', 'gp'),
			'desc'		=> __('Fill your email address in this format: john@doe.com', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_contact_subject',
			'title'		=> __('Subject of Received Emails', 'gp'),
			'desc'		=> __('Fill the subject of the email. Something as: Name of the site - Contact form.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_heading_recaptcha',
			'title'		=> __('reCaptcha', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha',
			'title'		=> __('reCaptcha', 'gp'),
			'desc'		=> __('Enable / disable reCaptcha for contact form.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'false',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha_public_key',
			'title'		=> __('Public Key [REQUIRED]', 'gp'),
			'desc'		=> __('Fill the public key. Keys you can get on: <a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha_private_key',
			'title'		=> __('Private Key [REQUIRED]', 'gp'),
			'desc'		=> __('Fill the private key. Keys you can get on: <a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		/*
		----------------------------------------------------------------------------------------------------
		Tracking Tab
		----------------------------------------------------------------------------------------------------
		*/
	
		$options[] = array(
			'section'	=> 'tracking',
			'id'		=> GP_SHORTNAME . '_tracking_code',
			'title'		=> __('Tracking Code', 'gp'),
			'desc'		=> __('Paste your Google Analytics (or other) tracking code. It will be inserted before the closing body tag of your theme.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		return $options;
			
	}

}