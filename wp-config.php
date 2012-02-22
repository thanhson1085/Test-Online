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
define('DB_NAME', 'to_db');

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
define('AUTH_KEY',         'd{7gF-Dv;_iKQq!J)DGH4hmy3LWsND:E}|8e<d^.#F:IHzH^[XwdGKP5x>6V)7I)');
define('SECURE_AUTH_KEY',  'CG$dQt_2etfy<5~^k$UA)49oOZM|:(+$=F_+O{>~3}RlS`v_|s=VTt|cx(o[jiEb');
define('LOGGED_IN_KEY',    't4*?e5r6V/<:/h`/K.kse>uLB[c3[{[<|wa!3zbmM+B+REh~yP2wkflakoR%O@J$');
define('NONCE_KEY',        'iI_|&aogZ~bXDcsX7/Odml)IoF7n+LLCHsqsZH{<f<Y^8fk)V{k4#-N6[Ok4Reae');
define('AUTH_SALT',        '3^u1lu&U/J}7Zk:x4VuGd*2hNW3OFW5],IS86foLkfkXf4LhiMH^| #&Q;Sj AL?');
define('SECURE_AUTH_SALT', '/Lu$^ zbMX_^!u+E)wV$I^j9&GY%9q7HmEQr!P1|25W E.z(WaMWZR5-z*OotZ.;');
define('LOGGED_IN_SALT',   '~CSs?>.g9BR{.^1eq>S1W91dxiRZTRb )97d/lv=/wfjvWfQh`OyONVUYQy3jK59');
define('NONCE_SALT',       'u{z;M7-[[5J^|q^kgV0=!ILfE`R>?_V;gB*`i`9~+&$}lOM+;QajdOn:sH6O+j||');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'to_';

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
