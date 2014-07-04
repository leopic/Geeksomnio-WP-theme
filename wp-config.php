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
define('DB_NAME', 'name');

/** MySQL database username */
define('DB_USER', 'user');

/** MySQL database password */
define('DB_PASSWORD', 'pass');

/** MySQL hostname */
define('DB_HOST', 'host');

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
define('AUTH_KEY',         'xOyYCTBd?jU`JT|pGa(vwRXaX8$3zBftSU|ztZC8$r``>^fo:}{<&N6a!!N4Fp`r');
define('SECURE_AUTH_KEY',  's8?wVJ%56Txol[k<hb>Oc:->dF*/2U6(5o.o4A;E$(UfL+|(P 8pyDq^g=t,v<uz');
define('LOGGED_IN_KEY',    'Eo<S,aHp<7GM]SN$G>T<}fu2Xxo!^p:F]->0!SCO?XCtiUeA@B2~X$?-YQhf: 4O');
define('NONCE_KEY',        'o]/a{+pc]/,:C~rqs^PK{1f?QPmDCv]^&y/cAh(8x+.&1|>/<5+ j5t,ErAXnL|n');
define('AUTH_SALT',        'xB N1{14U{%(0LM=sbi<fYlS!ntj%7{?.^.V3{<?,Q<@LbkpID|itW!jQ7rj3~sG');
define('SECURE_AUTH_SALT', 'zQbh0qLa#psdWL<rTx3KacK<_F^Y{g[S_vq)40%<{8t lxwW?_Zo%1J%O3Z{$S`X');
define('LOGGED_IN_SALT',   'PF]SQ&P5woh6%iZg@Fi!eJ]dw-Rl&eo7!%(22R,g0;SlPM8~2/9t4[*asx=eGN7r');
define('NONCE_SALT',       'T^B#F_e&quug7Su23+<4{pl}#ko??MUKzuG-])OaXO9gL4olRG10ff5Q`ii1&c@M');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
