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
define('DB_NAME', 'credit_frontlinesms_frontblog');

/** MySQL database username */
define('DB_USER', 'blogger');

/** MySQL database password */
define('DB_PASSWORD', 'frontblog');

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
define('AUTH_KEY',         '=;/2 Hvmw~O},Rs 0YSxjLJO0_&HX%!,yb-f/QckG$1=,h)1U:CtXSg7qF(5+ bG');
define('SECURE_AUTH_KEY',  'Gus!Im*q7C~tT?v@q+~)AXr$q%?C$W4.@Qk!7`wK+F:55G_}z2)PBo^f^DWHZ4ao');
define('LOGGED_IN_KEY',    ' #q#3&$]6Ik:hovnp;_F*zPXc1r+X]}7DV53e%O((TOOv(^ <D|th`-M4@em{Rg,');
define('NONCE_KEY',        'Bk9;;&ahMh+ea-6+FYFu&b7i3{TYd}wf9|7+!h_*32V8brL_2mW&AAgs4&~nBIRU');
define('AUTH_SALT',        'dFaCj?bcpxK7so-ca1)4Q) ie`zc?9bvT&W8(^x2H#zAv$yn?{_@-0m^Xu8b:a0d');
define('SECURE_AUTH_SALT', '@biW/M>{bQ3u1WH1Bz9Yz4+`X~zE[UC=,>~D/:l%&CJY;-06zV4pQl 5FTkS&|1W');
define('LOGGED_IN_SALT',   '(*C5<ALe76o^V $fzbjDa]DkB2{)oaI75NY#kXQv-,;:N,1XHzzX|!NDE|DReNt(');
define('NONCE_SALT',       'e_U9A`1EtP23-G{Jox=dT0(?Gd3A^e*!Vw60)bUpYzu]h:3pA6^^QG-pQPI~Z8QA');

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
