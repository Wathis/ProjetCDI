<?php

//Definition de constantes utiles
define('RACINE', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', RACINE . 'app' . DIRECTORY_SEPARATOR);
define('CONFIG',RACINE . 'config' . DIRECTORY_SEPARATOR);
define('CORE',RACINE . 'core' . DIRECTORY_SEPARATOR);

//Charger les configurations (PDO etc..)
require_once CONFIG . 'config.php';

// Charger des classes maitres
require_once CORE . 'Router.php';
require_once APP . 'App.php';
require_once CORE . 'Controller.php';
require_once CORE . 'Model.php';
require_once CORE . 'Form.php';

//salut
$app = new App();
$app->run();