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
define('DB_NAME', 'wp_woo_sneaker');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '=NmHcOh)e2|*v0G/m .6i[hW~-6%MG%4(3%H%aW=$Sw.{?K@l{yD*dV-MPc~?u(h');
define('SECURE_AUTH_KEY',  'sVa,RO|:^tu*2t^<=|Q5yv2F?%`+<ppOamFSR_<H5,gF%J>:]^_H-r ()zy:7| F');
define('LOGGED_IN_KEY',    '?]l9l!cWJ6:i8LF}vPO.,,!?2#,TILlRg==Uel^ooyZfbWB$39RMUS9ydE-}*4||');
define('NONCE_KEY',        '|ITFSKPqBv-20Kj=+J$QO,+WM@Id%?pL,#1_K|(X.qG!hE(FZTBM6l-[|fg+G4:=');
define('AUTH_SALT',        'd>f<3 |PWR7]Gu$VZS|+M_8::(WmLd{5#g=C,Y(Vb>a!mmr-?QM;Sge_H6c2ASSJ');
define('SECURE_AUTH_SALT', '0v+!Y<vzHT58 OULXqgw8TRam 8DG|Z:/-xk]=#kqr6W-tfbO#H@h-b0F|1NaKj>');
define('LOGGED_IN_SALT',   'C|w#]1*AR|N/)bHm5s(*A1+<oi&np*6(O$&nn4P`)F-d/`b0qps!MhH0Y1ZTA~|x');
define('NONCE_SALT',       'a<o+]y>DBZk#h(4}JFoE~/,jS*x<;sCq6j[$)Mz~^cIo%96<]DL0oy)v$MB$|+/X');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
