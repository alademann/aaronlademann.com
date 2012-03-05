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

 define('COOKIE_DOMAIN', 'portfolio.aaronlademann.com');

// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'db66485_wp');



/** MySQL database username */

define('DB_USER', '1clk_wp_BsqbIww');



/** MySQL database password */

define('DB_PASSWORD', 'tflbAnEp');



/** MySQL hostname */

define('DB_HOST', $_ENV{DATABASE_SERVER});



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

define('AUTH_KEY', '|sa/9w,UPTf.unlbS!hsMQFvv&iWr}B+1`*u2]|H-t;+PV{I3:rApR`*3 )-t=f`');


define('SECURE_AUTH_KEY', 'W~YyUr=heG|TB.*92BHka[;k-]d=@!d|k?Hbc$}7t-9gK,t(<>`_E;OHD7/7P#X^');


define('LOGGED_IN_KEY', 'STfNomvg>A}6*ju7bt0ahBL|Dbe-MyHkQEih91)pq=jL{K`3PJ6?E0m?0XkQTu2(');


define('NONCE_KEY', 'M{FY0KrmS}c$kY:|3|oZ@wF$D,k+HQ5].KT3xF2@ls7Pz3x1mt=*$.]prde.-lGL');


define('AUTH_SALT', '|9pc./l-NUS5Lvo. 2 }h4+E`g{B;y-Z|gUo6J(+y.5H+E-H;~ s-M(-$aFV0ihX');


define('SECURE_AUTH_SALT', 'Dv4mp])SvsmH ^G;;oXf|2T_l&CjHhb+`{T,]Ml(<J<=0caN9r-th>T7^:wi=zB.');


define('LOGGED_IN_SALT', ' kmBRNK!kk#4%PN.z{8,y-@%HnG|^!i|vY-7469CF+s}Q~aHf^dQK?!IdWIc>A:T');


define('NONCE_SALT', '|=.fV|vuuM-/p{7+DJ-FPc%|p~f|)myk^T,5J=f$[~|}>Huf57RiGWJ=bim(D +$');


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