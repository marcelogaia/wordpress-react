<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'marcelogaia_wordpress');

/** MySQL database username */
define('DB_USER', 'marcelogaia');

/** MySQL database password */
define('DB_PASSWORD', '19aiaG89');

/** MySQL hostname */
define('DB_HOST', 'mysql.marcelogaia.com.br');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'M/U;Q%%oh`eR6E|-n)]_dPB*0y/#:D*$4|i.!l-NYy.95+G)gh@wp~Qw~J&7KZEZ');
define('SECURE_AUTH_KEY',  'UO_vB%ar3SA0S3^Y[EY+ cUSz>=Wt)go~r8>L!oT@Mh<P_gOghE>Y[]mOlWo.qOx');
define('LOGGED_IN_KEY',    'xOh*VLRIlf_P8vN:/AZZ%O^lt/Etjf9qS)sg~%^WYu@P`$1$:Z1MUSHG[b GxGB[');
define('NONCE_KEY',        '0+2mzU(j$kYtDS,W;UJ0%iQyrTB2q%IDsf61U70NjWb7=*YO&Rtemqb7H$+$/o)O');
define('AUTH_SALT',        '.LBK}1BG=5RIb1G6uZ,yJ%<jj./-,~g1;~biJh~dVs#4N3G$9d4,e[C xV~Mc%n3');
define('SECURE_AUTH_SALT', 'M4KaG^JWo4>RV0l{{]_ }<8=+D#ME?sUp]F*t:~7rlu772s7Nck`<)afnz{SRTZ9');
define('LOGGED_IN_SALT',   '<rX:dG71H,w|h[pz6m(7_yBbhyE]|0Y%{N.GxS]+&qyfG?= u7dPJ<dS>HvhSCy4');
define('NONCE_SALT',       '/[~/V1wq6tc_jsj>Ct]Y4y)& pKoN6rm8}$kb!,r1`^5k_GD8Zci:+q+PNpOPi+z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
