<?php

/*

@name			    GPanel Init
@package		    GPanel WordPress Framework
@since			    3.0.2
@author			    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

====================================================================================================
Define Constants
====================================================================================================
*/

define('GP_VERSION', '3.1.0');
define('GP_SHORTNAME', 'gp');
define('GP_BASENAME', 'gp-theme-options');

/*
====================================================================================================
Load GPanel Components
====================================================================================================
----------------------------------------------------------------------------------------------------
Load Classes
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/classes/class', 'metabox');
get_template_part('backend/classes/class', 'fields');
//get_template_part('backend/classes/class', 'taxonomy');
get_template_part('backend/classes/class', 'twitter');          // Twitter
get_template_part('backend/classes/class', 'twitteroauth');     // Twitter Oauth
get_template_part('backend/classes/class', 'plugins');
get_template_part('backend/classes/class', 'shortcodes');

/*
----------------------------------------------------------------------------------------------------
Load Helpers
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/helpers/gp', 'option');
get_template_part('backend/helpers/gp', 'meta');

/*
----------------------------------------------------------------------------------------------------
Load Inits
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/inits/init', 'backend');
// Theme Options
get_template_part('backend/inits/init', 'options');
// Backend Functions
get_template_part('backend/inits/init', 'functions');
get_template_part('backend/inits/init', 'navigation');
get_template_part('backend/inits/init', 'plugins');
get_template_part('backend/inits/init', 'postformats');
get_template_part('backend/inits/init', 'shortcodes');
get_template_part('backend/inits/init', 'support');
get_template_part('backend/inits/init', 'documentation');
//get_template_part('backend/inits/init', 'taxonomy');
get_template_part('backend/inits/init', 'tweets');
get_template_part('backend/inits/init', 'widgets');

/*
----------------------------------------------------------------------------------------------------
Load Custom Post Types
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/posttypes/posttype', 'slide');
get_template_part('backend/posttypes/posttype', 'callout');
get_template_part('backend/posttypes/posttype', 'award');
get_template_part('backend/posttypes/posttype', 'judge');
get_template_part('backend/posttypes/posttype', 'album');
get_template_part('backend/posttypes/posttype', 'event');
get_template_part('backend/posttypes/posttype', 'gallery');
get_template_part('backend/posttypes/posttype', 'video');

/*
----------------------------------------------------------------------------------------------------
Load Custom Taxonomies
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/taxonomies/taxonomy', 'album');
get_template_part('backend/taxonomies/taxonomy', 'event');
get_template_part('backend/taxonomies/taxonomy', 'award');
get_template_part('backend/taxonomies/taxonomy', 'gallery');
get_template_part('backend/taxonomies/taxonomy', 'video');

/*
----------------------------------------------------------------------------------------------------
Load Widgets
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/widgets/widget', 'about');
get_template_part('backend/widgets/widget', 'categories-album');
get_template_part('backend/widgets/widget', 'categories-event');
get_template_part('backend/widgets/widget', 'categories-gallery');
get_template_part('backend/widgets/widget', 'categories-video');
get_template_part('backend/widgets/widget', 'recent-albums');
get_template_part('backend/widgets/widget', 'recent-events');
get_template_part('backend/widgets/widget', 'recent-posts');
get_template_part('backend/widgets/widget', 'recent-tweet');
get_template_part('backend/widgets/widget', 'recent-videos');
get_template_part('backend/widgets/widget', 'subpages');
get_template_part('backend/widgets/widget', 'tweets');

/*
----------------------------------------------------------------------------------------------------
Load Shortcodes
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/shortcodes/short', 'codes');

/*
----------------------------------------------------------------------------------------------------
Load Metaboxes
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/metaboxes/metabox', 'attachment');

if (!gp_seo_third_party()) {
	get_template_part('backend/metaboxes/metabox', 'global');
}