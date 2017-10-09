<?php

class App {

    public function __construct() {
        //Constructeur de l'application
    }

    //Lancer l'application 
    public function run() {
        $router = new Router();
        $router->get();
    }
}
