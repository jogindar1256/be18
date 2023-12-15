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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u557757486_OV6m5' );

/** Database username */
define( 'DB_USER', 'u557757486_gdCJd' );

/** Database password */
define( 'DB_PASSWORD', 'kgyxdzItnQ' );

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
define( 'AUTH_KEY',          'j)-q(310eqW!JYrr;@#s7uwOi%68}BP)u@qA(!eP<3{K} Aogb32EI2^)xJRi1yb' );
define( 'SECURE_AUTH_KEY',   'CqUyj5!xh4qa5xrL/H8FnL#>+,g)?%+zBocni)Hy ^hq4e3.lD7(^OXg+=?leE@x' );
define( 'LOGGED_IN_KEY',     'tbV;g;EiEREIO%&aE/ny_E}@|?HP/?G tPh#bS<|3XV<{v:I(Ui96dDMIl!+-U?,' );
define( 'NONCE_KEY',         ';]):9]ns?_[YQ1+>/NL8kJ)9~fD0^vdmTq&5Sx~ZeDkWTBSB<!0$mYzAMts>$B,C' );
define( 'AUTH_SALT',         '>.E5nNNHiv<1$Wx$&0}1vxQ`-,p-*e_?-Jj{Rth7MYM |#B*-zPx2?`,vonCzzcU' );
define( 'SECURE_AUTH_SALT',  '=um-G:Zut<Q3_M?8.GE:_YJmAZ+{+0EM<pC| /*96_oFq#CAJ2$>#0[Oa?*Pzn>a' );
define( 'LOGGED_IN_SALT',    '+3{O{%|)4B,[a@<_pG6.#KUlf6}r*9_)];QQ}7_hx)2gWf@O#56.?w8+IrR>?e~=' );
define( 'NONCE_SALT',        '[D] QOX6uq@=2Zv1RB.t+)+oYS)<2E}ZJS.dTPu%]hK8zjol%GtjE8p8b=%0SwYz' );
define( 'WP_CACHE_KEY_SALT', 'V(GS7xNA^E#<hxdN;]Se)|P!sC}NGFr&Vd}q%LsMnPvJu4FAQ `@Of_@H$E}zQ.u' );


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



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
