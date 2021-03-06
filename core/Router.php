<?php

/**
 * Toutes les routes sont du type :  wwww.site.com/controlleur/action
 */

class Router {

    // Controlleur à appeller
    private $controller = null;

    // Action à executer dans le controller
    private $action = null;

    // Parametres GET de la requete
    private $params = array();

    public function get() {
        $this->parseURL();
        $this->callController();
    }

    private function callController() {
        // Si aucun controlleur -> Retour index.php
        if (!$this->controller) {
            require APP . 'controller/HomeController.php';
            $page = new HomeController();
            $page->indexAction();

        } elseif (file_exists(APP . 'controller/' . $this->controller . '.php')) {
            //Comme le controlleur existe on le créé
            require APP . 'controller/' . $this->controller . '.php';
            $this->controller = new $this->controller();

            $this->callAction();
        } else {
            $this->cantFindRoot();
        }
    }

    private function callAction() {
        // Verification si l'action existe
        if (method_exists($this->controller, $this->action)) {
            // Si il existe des parametres get on les passe au controlleur
            if (!empty($this->params)) {
                // On appelle l'action avec ses parametres
                call_user_func_array(array($this->controller, $this->action), $this->params);
            } else {
                //Si il n'y a pas d'arguments on execute l'action
                $this->controller->{$this->action}();
            }

        } else {
            if (strlen($this->action) == 0) {
                // Si aucune action n'est definie, appelle celle par default qui est indexAction
                $this->controller->indexAction();
            } else {
                $this->cantFindRoot();
            }
        }
    }

    private function cantFindRoot() {
        header('Location: ' . URL . 'error');
    }

    private function parseURL() {
        if (isset($_GET['url'])) {
            // On parse l'url
            $url = trim($_GET['url'], '/');
            //Enlever les caracteres interdits dans une requete ( Ex : ' )
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            //On extrait le nom du controlleur et de l'action
            $this->controller = isset($url[0]) ? $url[0] . 'Controller' : null;
            $this->action = isset($url[1]) ? $url[1]  . 'Action' : null;
            $this->controller = ucfirst($this->controller);
            // On retire le controlleur et l'action
            unset($url[0], $url[1]);

            // On place les parametres restant GET dans params
            $this->params = array_values($url);
        }
    }


}