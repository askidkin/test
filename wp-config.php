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
define('DB_NAME', 'test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'yR3xyL4]IUYiZ]vi1W=V?kp6lFZ}cAf`tW/uqkV*4)>/MZO+D>&daP71b3onWk[5');
define('SECURE_AUTH_KEY',  '_3YR|C-g03|kIdGL%L=X*gB}Xh{$vRB(L-F1-,_P!szF B>$/T*I]-&x_/^FCEk[');
define('LOGGED_IN_KEY',    '!rAFQDB0;6@W$4>(0vQ2V1H,6,&@I!cDtXC{4a$#K@;*!Mc<LSM}eciKG%*xPlQF');
define('NONCE_KEY',        '^g{L+h!rc!r*rE>D8t/&x[41ty~  tZ;VmGJ1<lAEfcu;gYdN)WUaf}S99;=QKAQ');
define('AUTH_SALT',        ':68ZQ/d,=9+};v+OPlH7c59|$m|9O(Swjow-;PBH{rfHob%a3vb4MgJ!O$LDg w6');
define('SECURE_AUTH_SALT', 'aYQY  w&hIj0gDefd}+|!}KqqIPI]6w38p^@t$LM_Uxwkzz_x)4@{*6gw!o&pD9O');
define('LOGGED_IN_SALT',   '#a[2]AdqP1<J$!Ephpxp ibY69s+4!~MU]s2,m-{R&96`6#X>?bXwc*7C,] ,kmL');
define('NONCE_SALT',       '3qNd7/5n*h/%s|p#^l(*bTEm8(E>X%~Rr}~x >%Dgn3<O,wZbHNj+.+:SK3vyZBI');

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
