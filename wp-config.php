<?php
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpdatabase' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'ndtHVcUi:pd5s,_S3?IjgqdG0S}bDoJ0XogYFF]K30jvcgZ58mDOKDfoRgfnS-%p' );
define( 'SECURE_AUTH_KEY',  ')2qL.%1${%{~%2?$MC3MQsQ8PVfv2OOqN/OU *ne!fK*o3^#v{;O0)I.(iNG~Cgl' );
define( 'LOGGED_IN_KEY',    '?yTSzDwF9=_S-QOWw<`2GmInM}t%IzDb^D{PONIBs6,CI=M0hK:(oQ;!04*>Tp)0' );
define( 'NONCE_KEY',        'kn`%Qh1>4>B`;LzW)qX$cE6BZ#>(~aN=p?NOv{r+Cw*%<6-^@Ya=>Bl@]0;[Kb/c' );
define( 'AUTH_SALT',        'Qo-jHR}h0Jf1s{#+3P4ap2J@+wNwmx4SPEwvpd6Bhf307cYo{L&.]IM}8;m45!0o' );
define( 'SECURE_AUTH_SALT', '!kR`rWo6<CR${C%)DFsQ827OMM@_k%jW$UIsayN%JcR52}VB+PN?=;<vru;geEbX' );
define( 'LOGGED_IN_SALT',   '|6V=-mh*C>{^_(|/U<0BMXEmhm[~%C YCL5mdvsf;;m3$Pe<KgI}9f9`B.`^6q&l' );
define( 'NONCE_SALT',       'w4cv.cv#<R=s][cr[*`4s_iMMYXe:Uz=8E_~Y9>_=2sKWYP9h$kF[ja?q7YsfVAr' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
