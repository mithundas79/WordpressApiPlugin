<?php

App::uses('AppController', 'Controller');

class WordpressManagerAppController extends AppController {
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        ClassRegistry::init('ConnectionManager');
    }

}
