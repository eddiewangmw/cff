<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cff');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^=g.Rq[C0{S{nD$z9|lFVh$5$)cR<j=Uan|z5/AT!zdX(JNM]N|q|JO&WW6*I}Az');
define('SECURE_AUTH_KEY',  'Ad3?aYr;0DbkVF}N45&Uv5,a/828$~p&c/vz>9OA6t7M)ll-J|]gYe|bz)TqZbF,');
define('LOGGED_IN_KEY',    'xnF/G1A>5])4-| D<QOq;P[N&~K7zhY|OO^r.?j`%Q$lh_#}_uR/ObCVVN.Ph460');
define('NONCE_KEY',        'oeW5P9n{b+5Kjf{Oxd3s|?W>-wW_+]G} N/X-0t]k1H_<}_%-=^6>hXlqH__wn0t');
define('AUTH_SALT',        '^9 n0PmJwa=(1;4B2n*-KO+C>$|p9@+nB5j=q#5pISr.B0oq7f!4Z+|Dg* w/8|Y');
define('SECURE_AUTH_SALT', '< Md-lhAA;}VV)u?WZNKgIx$+A9[-b(jRHdt2RHg|8y-tMB,@UIQ#U$ v|K$|#dW');
define('LOGGED_IN_SALT',   '5LGDu3jXw$;ha9|gE;{%93.]r}5r40:MLzE3-jzfVpM||c:.Zop^m|G0I-K-,:n ');
define('NONCE_SALT',       'eGu.^pR&%y=(W|,A`I5SH45ix5nK<39C(pfVbx.MU:Fz;kRgUpAP3*w-03hzKf`@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
