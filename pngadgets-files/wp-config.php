<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u424761566_5qP04' );

/** Database username */
define( 'DB_USER', 'u424761566_s7cMo' );

/** Database password */
define( 'DB_PASSWORD', 'Mb9zlSPHBW' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'A})!z`|L#z!NaT6mOp<| Ud0{oC!Y7(I/0oIH(K*K7NOUO#!vviQafiu>{FcebH2' );
define( 'SECURE_AUTH_KEY',   'GD~+7?[Z@x.40HP%3b?Js-*zxyg|P[,Wh;$wFOi!uN>*>XYuf$!E/ZR?5+<d?W5X' );
define( 'LOGGED_IN_KEY',     'p*]C5P|`iW2.3IJPQ? FtZ%3y|zDmFyK/0F?qh?.rwI `bT2iP6>8m OZ%%:H~^1' );
define( 'NONCE_KEY',         'OrD]Xj<*F=0_gNc;fEk!T6<eVDRY_%n$ITDINs<UB0jDY=fPFGM0[Iaa]A6*D+MQ' );
define( 'AUTH_SALT',         'fIEY,o*j#mIWH[L)0r}}WSOq~6k0#(RMw!Z]IJu$SpmijeQizIb_)UA}@{Lr@fUN' );
define( 'SECURE_AUTH_SALT',  '(u$qP-I@5,_!393nIk%4e9+WT?1[ifsW9Q6A+3aWJAd^#tdT$)HhH+o:@%k03d o' );
define( 'LOGGED_IN_SALT',    '`6`{X%B3s_i:*(7!xJmpg/g UwQ5oAy%_rcc}Ql`nfO71&CbU6^`s>Tz:[?sq|;o' );
define( 'NONCE_SALT',        '^s<<==4x:rk<U/ei].{;Q@qrp7|Ua6w=VeJgT#{5{!*)E4#Zkr%X0/`v<+qFa5~T' );
define( 'WP_CACHE_KEY_SALT', ':wd-XIh<.{w|IZFO*50K[P^ia1n2sAbj~4*k@hEch,aG|H{j3cx(v]>Z!&s^.tA,' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '86a916b751efce7b7fb3e70afe9bcb4f' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
