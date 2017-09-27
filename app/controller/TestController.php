<?php

class TestController extends Controller {

    public function indexAction()  {
        echo Form::verifierLesBackSlashs("qqqqq");
    }
}
