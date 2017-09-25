<?php

/**
 * Définition de constantes utiles
*/
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
/**
 * Configuration de la base de donnée
*/

define('DB_TYPE', 'mysql');
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'php_');
// define('DB_USER', 'root');
// define('DB_PASS', 'root');
// define('DB_CHARSET', 'utf8');
define('DB_HOST', 'spartacus.iutc3.unicaen.fr');
define('DB_NAME', 'mathis_delaunay');
define('DB_USER', 'mathis_delaunay');
define('DB_PASS', 'kunounoo');
define('DB_CHARSET', 'utf8');