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
define('WPLANG', 'nb_NO'); // lagt til av Ods

define('CONCATENATE_SCRIPTS', false ); // Lagt til Ods
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'utv');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'q');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '{J53NFkq w}^WD%h,q/PjQ!EXHQ/?LM,t-jD^:.r%,RFkLDoY[=$9e=M*z;p}c1!');
define('SECURE_AUTH_KEY',  'Ozq3?1hC.Fn6={5Gwh8_wCu+FW/sU(Ya:cAQdpu=|*tH7)fC~.{K&.;HEcnyji@{');
define('LOGGED_IN_KEY',    'f 2+;afv?jF}Lq,qa|mOV7i?B*|qd%*Tywh%!g OJ~+=l-cHFUo:&D`4gD!OPx^y');
define('NONCE_KEY',        '^p~lCkJ/z?JWOvxo;Smm$V>fMj3;hE1%G-X-D%I}WnNVP7t/YGrbv++CH*+.f!!L');
define('AUTH_SALT',        'g8o@f]^t89Av{@9:WgrzOS8L$=V!G94k<3l%H_lG Q5OnKS%%JRw[9e,P}m/b6gD');
define('SECURE_AUTH_SALT', '>23$@:KQ$)LFW+o|B<pi!{[H{#3q(|:-A/d]0tlgt^ivK@9lr+@bsWUpAwdfD8RU');
define('LOGGED_IN_SALT',   ',lrf-m|z/(!VW<2%;7i9H<Lw8U,{rDM]Zgp5y5BF.#MV5p0~Xvy>>uw$p(&$-0@M');
define('NONCE_SALT',       '|jaD-N=WBm^C%DMBsf9|7_OJ`9y{+Ay||c@V.;FY+}rN|y$E#<Q+,hS8nrL)vqs9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
