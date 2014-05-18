<?php

App::uses('WordpressManagerAppController', 'WordpressManager.Controller');

/**
 * WpAccounts Controller
 *
 */
class WpAccountsController extends WordpressManagerAppController {
    
    /**
     * Components
     * @var type 
     */
    public $components = array('RequestHandler');

    /**
     * Helpers
     * @var array 
     */
    public $helpers = array(
        'Time',
        'Js',
        'Paginator',
        'Number',
        'Text'
    );

    

    /**
     * Constructer callback
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(
                    'index', 
                    'add', 
                    'edit', 
                    'view', 
                    'delete'
                );
        
        
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        if ($this->request->isAjax()) {
            $this->layout = null;
        }
        $this->WpAccount->recursive = 0;

        if ($this->request->isGet()) {
            if (!empty($this->request->named['filter'])) {
                $filter = array();
                $filter['WpAccount']['filter'] = $this->request->named['filter'];
                if (!empty($this->request->params['named']['page'])) {
                    $filter['WpAccount']['page'] = $this->request->named['page'];
                } else {
                    $filter['WpAccount']['page'] = 1;
                }
                $this->request->data = am($this->request->data, $filter);
            } else {
                $filter = array();
                $filter['WpAccount'] = $this->Cookie->read('srcPassArg');
                if (!empty($filter['WpAccount'])) {
                    $this->request->data = am($this->request->data, $filter);
                }
            }
        }


        $passArg = array();
        $conditions = array();
        if (!empty($this->data['WpAccount']) && !empty($this->data['WpAccount']['filter'])) {
            $conditions = array(' name LIKE ' => '%' . trim($this->data['WpAccount']['filter']) . '%');
            $passArg = $this->data['WpAccount'];
        }
        if (!empty($this->request->params['named']['page'])) {
            $passArg['page'] = $this->request->params['named']['page'];
        } else {
            if (!empty($this->request->data['WpAccount']['page'])) {
                $this->request->params['named']['page'] = $this->request->data['WpAccount']['page'];
            }
        }

        //$paginate = array('limit' => 2);
        $paginate = array();

        if (!empty($conditions)) {
            $paginate['conditions'] = $conditions;
        }

        //print_r($this->data);

        $this->paginate = $paginate;

        $this->set('passArg', $passArg);

        if (!empty($passArg)) {
            $this->Cookie->write('srcPassArg', $passArg);
        }

        $this->set('wp_accounts', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->WpAccount->id = $id;
        if (!$this->WpAccount->exists()) {
            throw new NotFoundException(__('Invalid Entry'));
        }
        $this->set('user_email', $this->WpAccount->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $errors = array();
        if ($this->request->is('post')) {
            $this->WpAccount->create();
            $this->request->data['WpAccount']['user_id'] = $this->Auth->user('id');
            if ($this->WpAccount->save($this->request->data)) {
                $this->Cookie->delete('srcPassArg');
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->WpAccount->validationErrors;
            }
        }

        $this->set('errors', $errors);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $errors = array();
        $this->WpAccount->id = $id;
        if (!$this->WpAccount->exists()) {
            throw new NotFoundException(__('Invalid Entry'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['WpAccount']['user_id'] = $this->Auth->user('id');
            if ($this->WpAccount->save($this->request->data)) {
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->WpAccount->validationErrors;
            }
        } else {
            $this->request->data = am($this->request->data, $this->WpAccount->read(null, $id));
        }
        $this->set('errors', $errors);
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->autoRender = false;
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->WpAccount->id = $id;
        if (!$this->WpAccount->exists()) {
            throw new NotFoundException(__('Invalid Entry'));
        }
        if ($this->WpAccount->delete()) {
            //$this->Session->setFlash(__('WpAccount deleted'));
            //$this->redirect(array('action' => 'index'));
        }
    }

}

?>