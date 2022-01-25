<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'optimum' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'D8]r7lOZ9;|$5z~Yu}L?cp2Q.~o]uQcI%n3Tb/T:.n#!:cdhha^U0TYvB.U|IiGv' );
define( 'SECURE_AUTH_KEY',  'ca bh+E>r-~@!;go`Tp$=S?SNR|dHuoL5k[$BN{+y,jN]w-a0p6a:GkV<-9LNes7' );
define( 'LOGGED_IN_KEY',    '!>992ng;`p>8SzI9sz[B-a|6Kfi9C,[i6}<pf-okTpm?d8+lN,STAJ*bzOBwN26#' );
define( 'NONCE_KEY',        'd{Ot{aZjAd/{SqyhgVXZec-{#?jzT3nkSUQ1osr]enKEWQKkbhHKWc@WY_sV0jtQ' );
define( 'AUTH_SALT',        '+5`TER&so$kLkKu67-9W3#2bNPq8%>Wl;ZpM9Pq&VL 5xeQ@^!>@Y{SMY7!bX`/Y' );
define( 'SECURE_AUTH_SALT', 'TIHQ,HszE@r!L^(<k/qOk3d1}cE,){J02ghG!wtf:32K^Cmz0RDz#IP#1>?>.|hY' );
define( 'LOGGED_IN_SALT',   'UVRW@_sC@h+:I^PD8$A.U=7E#iXG29dQR]RJ`>me-^(40h&|B=J/y7b7T&CUl*!O' );
define( 'NONCE_SALT',       '0$G+) Otg(Iui1txH`a#1h.jR?-5oaCs{7H?7i3UmDI 8r)W^e*g;Ll2[<=Pr&CF' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_optimum';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
