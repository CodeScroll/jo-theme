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
define( 'DB_NAME', 'theme' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         's}N]Xx p$tpy&LT7m^ypsGL*}i{NBSh>?np%C^GWxO5:@?3U~O#xY?i[fcM3LP&m' );
define( 'SECURE_AUTH_KEY',  '8;-1%?t`?)-5b{W#FWV~Fw3@!.4eOdm-}!*7TigdkMQ^00o4>qhMNA0c:Pj=u<sT' );
define( 'LOGGED_IN_KEY',    'L1*,OW]d>@J,2{{|LXY)8CNwQp,N=:w%3EM7ON|1?]`Gi.FO*#_7X>4_lk<hcKH5' );
define( 'NONCE_KEY',        'NR{X+Km6pbA|)?n}&3(M4c*8v?bJq.HC,8=v%ra+-o.9YTx$5i}j,PE*q}_*T;EU' );
define( 'AUTH_SALT',        'K#pOM]Tz@lcfQ|*0y@F+:T5&&0.p,-n]+4<gUUu&~L6]u{:#v,,G^}xw2Zg,9dGr' );
define( 'SECURE_AUTH_SALT', '*r7?NRk6^nwwkOUdND.H1@!~d_5>Q}acI=UbX?`o$d?&E rBo^?2knAL]kkE~pU,' );
define( 'LOGGED_IN_SALT',   '|Pd!)+)diXxVnlDi59jz8AK_}pl@:,Cbb?/5KAC[: _aPO7`zL.a>P%)W^7A#v4`' );
define( 'NONCE_SALT',       'E0&iq3v+2E2pr1k<M& DYjGPaWyr.4e.L]d;7WyaU1sT!>s1`X6@X]QgKMA/VD,9' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
