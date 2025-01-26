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

 * @link https://wordpress.org/documentation/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'cityacad_shop' );



/** Database username */

define( 'DB_USER', 'cityacad_shop' );



/** Database password */

define( 'DB_PASSWORD', 'NAZ4ADPHOAAI4TKJTL' );



/** Database hostname */

define( 'DB_HOST', '70.32.23.75' );



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

define( 'AUTH_KEY',         '3sjXZ^#: HSt:U)0+yqY9[zB]bh4zxq&$6f<XS[vj>nQCJJ7WtP{R4~:TJ#8/+b:' );

define( 'SECURE_AUTH_KEY',  'U[)_+FlTg6<l>D$e&>O>sY8Dkh6[1Ekbduhd*D`Nf/}6U=71B6&v?-P;8W-(N8kL' );

define( 'LOGGED_IN_KEY',    '[L*=~c)}$&r5_Y{Km+wON&_<s[mxrO50aq]*>80u&+rG}L2NgBZdwcduseXf:4k`' );

define( 'NONCE_KEY',        'qf*<[6V9T[`,t.Q1?>IGtk5<o_neA?K^2W|8GB_-:J8[4~[DURBRM#LH@4:li=I(' );

define( 'AUTH_SALT',        'v_i0`r_Wwn,FuJgogj2S^R$.E(Pjt+z/yCjT^jx|ghXKg86XU.BG:R9l^e}}n^R!' );

define( 'SECURE_AUTH_SALT', '$+nZ&pB)oc<D71TTcG2FO,Eo,I#Lt> %AkS3n.S`IjhZ%LQ^|Qbxe+S[Z~4M{F,0' );

define( 'LOGGED_IN_SALT',   'G6pDa3@`s1kB-;JA`^(;K|IfmQTjmF%gHc/wT(gEljNlD4VNHIALEn?8sJlw,U_c' );

define( 'NONCE_SALT',       'gqE|?Px9vPmD.y( >Bt?PA[Yf*58.@bAH0ctz8W!y!TkF/udoDel9,xd->MWny71' );



/**#@-*/



/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wps_psicoguiarte';



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

 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/

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

