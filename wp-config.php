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
// For local development - make sure to add wp-config.local.php to your .gitignore file - this file should NOT be on the production server
if ( file_exists( dirname( __FILE__ ) . '/wp-config.local.php' ) ) {
  include( dirname( __FILE__ ) . '/wp-config.local.php' );
  define( 'WP_LOCAL_DEV', true ); 
} 
else {

  // ** MySQL settings - You can get this info from your web host ** //
  /** The name of the database for WordPress */
  define('DB_NAME', '');

  /** MySQL database username */
  define('DB_USER', '');

  /** MySQL database password */
  define('DB_PASSWORD', '');

  /** MySQL hostname */
  define('DB_HOST', '');
  
  define('WP_CACHE', true);


  /**
   * For developers: WordPress debugging mode.
   *
   * Change this to true to enable the display of notices during development.
   * It is strongly recommended that plugin and theme developers use WP_DEBUG
   * in their development environments.
   */
  define('WP_DEBUG', false);

  define('SAVEQUERIES', true);

  /**
   * WordPress Database Table prefix.
   *
   * You can have multiple installations in one database if you give each a unique
   * prefix. Only numbers, letters, and underscores please!
   */
  $table_prefix  = 'wp__'; 

}


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@-*/

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

 
define('AUTH_KEY',         '7n*-4Av3[fc>[um09zsEC8KSff|/;`R!V5`e1O_pb&tDhjO!Wi).T9dC:LDcrWpV');
define('SECURE_AUTH_KEY',  '-B.Dg!x<|g{Oy+?FW0xu(y6$`tjpAuyPtMEd0Bb~PB.EO4Y_}!^R|+o29%*0{=+A');
define('LOGGED_IN_KEY',    'I:@zM5-t5xTHl>tn,Af{g0b|myjd-Fs.}-`0-16]GC%kEq-?Hv7=54B+<qqATsXi');
define('NONCE_KEY',        'p6S_Kw:Sgy8lpeJ93-S,T(3WhM$VT?Ms]UKOt2gXeB?s.|YomeAWlb[u.OQSDI5;');
define('AUTH_SALT',        'hDy%|K+y^w=pK=W9[nx|t~~t,b(m,ze0k}pWiNu;<pl0]|MYiVd?4Q7Ma|tS;%K+');
define('SECURE_AUTH_SALT', '&guxA:##&bY)E./`|07we+,,t!11}Je.Y(d=TRyZygCpT2$I)e/3/5+,>Yu-L7}#');
define('LOGGED_IN_SALT',   '*mEQ*;Ot0w4n_aN9au&}rRC{w*4|A++NDiQT$VzMW+o|tAN >1:(dL-m|2cl69[V');
define('NONCE_SALT',       'YmGS+0ZcM|ycfEl*f&ps Z5XL_: WV8NeelKWykIY 1w}1?m[M&AJ9G-+!mM.4qU');


/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
