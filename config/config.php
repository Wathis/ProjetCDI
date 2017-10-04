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
define('BDD_TYPE',"mysql");
<<<<<<< HEAD
define('BDD_HOST', '127.0.0.1');
define('BDD_NAME','projetCDI');
define('BDD_USER', 'root');
define('BDD_PASS', '');
=======
define('BDD_HOST', 'localhost');
<<<<<<< HEAD
define('BDD_NAME','projet_php');
define('BDD_USER', 'root');
define('BDD_PASS', '');
=======
define('BDD_NAME','projetCDI');
define('BDD_USER', 'root');
define('BDD_PASS', 'root');
>>>>>>> 81f671efd808123024b26f2f0d6a5df5c16cfd10
