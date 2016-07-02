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
define('DB_NAME', 'CDC');

/** MySQL database username */
define('DB_USER', 'CDC');

/** MySQL database password */
define('DB_PASSWORD', 'chalokedotcom');

/** MySQL hostname */
define('DB_HOST', 'cdc.c1lzs9xai3ul.ap-southeast-1.rds.amazonaws.com');

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
define('AUTH_KEY',         'z+X {WGJ L6)cJHfh,E)=`XJ0Vf3vba82es,KQu<behgtK>0CF0Rws{Y&sO_Usf@');
define('SECURE_AUTH_KEY',  '9:T4V[`naJ?KC>S)3u<?4;8Mw7.XE|~LdFBJKFO+IFl<w&B[=633SHp@P4xO<U(H');
define('LOGGED_IN_KEY',    '+TGIw|8oROdU]RT?-0==SKAMf*qmLu+BqAl1VbL2WgkwxMl[d9oh3>(k|diohdKv');
define('NONCE_KEY',        '6%vAKO=)VpQ`cPs2Pkgsoi58IwF(Hb<_@:0;u1ACRVU)DVmg260bLnMPz%1dM=TL');
define('AUTH_SALT',        'K1*Fzaf?5w)A8n.9+<e-^#zpnbBuL4s3qR2Xe.s&3V-as=hbVgF%[SYh/Vyvx7{c');
define('SECURE_AUTH_SALT', '=ABsOO<tO$Xcw>csgDS56G jjjYL6L%x7nz/zHu5GX06E)~bQZjjdjPgLJ/,9yc4');
define('LOGGED_IN_SALT',   't#;f}0BhnUpxcY!T+Ii:5s 2G &Qk/upkH`/u9vfEO>u3>[zQ|Q;s};2YiKat~PA');
define('NONCE_SALT',       'L?$s*1EfZ/3JpP>ZaETQd+Z0D$|sniayaRhzZTx$9.CH^oV:-{y3Yd>-BwLIac?4');

/**#@-*/

/** Define AWS Access Key **/

/* Define REDIS node endpoint */
define('WP_REDIS_HOST', 'cdc.ywsccw.0001.apse1.cache.amazonaws.com');

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
