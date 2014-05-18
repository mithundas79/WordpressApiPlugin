<?php

App::uses('WordpressManagerAppController', 'WordpressManager.Controller');

/**
 * WpReaders Controller
 *
 */
class WpReadersController extends WordpressManagerAppController {

    public $WP;

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

    public function index($post_status = 'publish') {

        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */

        $this->WP->resetIXRClint();

        $wp_posts = $this->WP->getPosts(array(
            'post_status' => $post_status,
            'post_type' => 'post',
            'number' => 50,
            'orderby' => 'post_modified',
            'order' => 'desc',
                ), array(
            'post_title',
            'post_date',
            'post_modified'
        ));
        //pr($wp_posts);die;
        $this->set(compact('wp_posts'));
    }

    public function categories() {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */

        $this->WP->resetIXRClint();
        //debug($wp_posts);

        $wp_categories = $this->WP->getTerms('category');

        //pr($wp_categories); die;
        $this->set(compact('wp_categories'));
    }

    public function testcategories() {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */

        $this->WP->resetIXRClint();
        //debug($wp_posts);

        $wp_categories = $this->WP->getTerms('category');
        pr($wp_categories);
        //$this->set(compact('wp_categories'));
    }

    public function menus() {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */

        $this->WP->resetIXRClint();
        //debug($wp_posts);

        $wp_categories = $this->WP->getTerms('category');

        $this->set(compact('wp_categories'));
    }

    public function view($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */

        $this->WP->resetIXRClint();

        $wp_post = $this->WP->getPost($id);
        //pr($wp_post);die;
        $this->set(compact('wp_post'));
    }

    public function delete($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */
        $this->WP->resetIXRClint();

        $this->WP->deletePost($id);

        $this->redirect(array('action' => 'index'));
    }

    public function add() {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */
        $this->WP->resetIXRClint();

        if ($this->request->is('post')) {
            $category = $this->request->data['category'];
            $title = $this->request->data['title'];
            $content = $this->request->data['content'];
            
            
            $user_id = 1;
            //validate file type
            $validate = true;
            if ($validate) {
                $postData = array(
                    'post_content' => $content,
                    'post_type' => 'post',
                    'post_title' => $title,
                    'post_status' => 'publish',
                    'post_author' => $user_id,
                    'post_date_gmt | post_date' => date('Y-m-d H:i:s'),
                    //'post_date_gmt' => date('Y-m-d H:i:s'),
                    'comment_status' => 'open',
                    'terms' => array('category' => $category ),
                    //'post_excerpt' => $content,
                    'post_name' => Inflector::slug($title),
                    
                );
                $stat = $this->WP->newPost($postData);
                if ($stat) {
                    $this->Session->setFlash(__('The post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }
        }


        $wp_categories = $this->WP->getTerms('category');
        $categories = array();
        if (!empty($wp_categories)) {
            foreach ($wp_categories as $k => $v) {
                $categories[$v['term_id']] = $v['name'];
            }
        }
        //pr($wp_categories);die;
        //pr($wp_post);die;
        $this->set(compact('categories'));
    }

    public function edit($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */
        $this->WP->resetIXRClint();

        if ($this->request->is('post')) {
            $category = $this->request->data['category'];
            $title = $this->request->data['title'];
            $content = $this->request->data['content'];

            $user_id = 1;
            //validate file type
            $validate = true;
            if ($validate) {
                $postData = array(
                    'post_content' => $content,
                    //'post_type' => 'post',
                    'post_title' => $title,
                    'post_status' => 'publish',
                    //'post_author' => $user_id,
                    'post_modified' => date('Y-m-d H:i:s'),
                    //'post_modified_gmt' => date('Y-m-d H:i:s'),
                    'comment_status' => 'open',
                    'terms' => array('category' => $category ),
                    'post_excerpt' => $content,
                    'post_name' => Inflector::slug($title),
                    'tax_input' => array(
                    ),
                    'tags_input' => array(
                    ),
                );
                $stat = $this->WP->editPost($id, $postData);
                if ($stat) {
                    $this->Session->setFlash(__('The post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }
        }

        $wp_post = $this->WP->getPost($id);
        $this->request->data['category'] = $wp_post['terms'];
        $this->request->data['title'] = $wp_post['post_title'];
        $this->request->data['content'] = $wp_post['post_content'];
        //pr($wp_post);die;
        $this->set(compact('wp_post'));

        $wp_categories = $this->WP->getTerms('category');
        $categories = array();
        if (!empty($wp_categories)) {
            foreach ($wp_categories as $k => $v) {
                $categories[$v['term_id']] = $v['name'];
            }
        }
        //pr($wp_categories);die;
        //pr($wp_post);die;
        $this->set(compact('categories'));
    }

    public function category_add() {
        $this->WP = ConnectionManager::getDataSource('wp');
        $this->WP->resetIXRClint();

        if ($this->request->is('post')) {
            $category = $this->request->data['category'];
            $name = $this->request->data['name'];
            $content = $this->request->data['content'];
            //pr($this->request->data);die;
            $user_id = 1;
            //validate file type
            $validate = true;
            if ($validate) {
                $postData = array(
                    'description' => $content,
                    'taxonomy' => 'category',
                    'name' => $name,
                    'parent' => array($category)
                );
                $stat = $this->WP->newTerm($postData);
                if ($stat) {
                    $this->Session->setFlash(__('The category has been saved.'));
                    return $this->redirect(array('action' => 'categories'));
                } else {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }


        $wp_categories = $this->WP->getTerms('category');
        $categories = array();
        if (!empty($wp_categories)) {
            foreach ($wp_categories as $k => $v) {
                $categories[$v['term_id']] = $v['name'];
            }
        }
        //pr($wp_categories);die;
        //pr($wp_post);die;
        $this->set(compact('categories'));
    }

    public function category_edit($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        $this->WP->resetIXRClint();

        if ($this->request->is('post')) {
            $category = $this->request->data['category'];
            $name = $this->request->data['name'];
            $content = $this->request->data['content'];

            $user_id = 1;
            //validate file type
            $validate = true;
            if ($validate) {
                $postData = array(
                    'description' => $content,
                    'taxonomy' => 'category',
                    'name' => $name,
                    'parent' => array($category)
                );
                $stat = $this->WP->editTerm($id, $postData);
                if ($stat) {
                    $this->Session->setFlash(__('The category has been saved.'));
                    return $this->redirect(array('action' => 'categories'));
                } else {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }
        $wp_category = $this->WP->getTerm('category', $id);
        //pr($wp_category);die;
        $this->request->data['category'] = $wp_category['parent'];
        $this->request->data['name'] = $wp_category['name'];
        $this->request->data['content'] = $wp_category['description'];

        $wp_categories = $this->WP->getTerms('category');
        $categories = array();
        if (!empty($wp_categories)) {
            foreach ($wp_categories as $k => $v) {
                $categories[$v['term_id']] = $v['name'];
            }
        }
        //pr($wp_categories);die;
        //pr($wp_post);die;
        $this->set(compact('categories'));
    }

    public function category_delete($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */
        $this->WP->resetIXRClint();

        $this->WP->deleteTerm('category', $id);

        $this->redirect(array('action' => 'categories'));
    }
    
    public function category_view($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        //pr($_SESSION); exit;
        //set the wp config
        /* $this->WP->config['host'] = "wpmulti.sum";
          $this->WP->config['username'] = "admin";
          $this->WP->config['password'] = "admin";
          $this->WP->config['path'] = '/xmlrpc.php'; //$this->Session->read('WpAccount.path');
          $this->WP->config['blog_id'] = 0;
         */

        $this->WP->resetIXRClint();

        $wp_term = $this->WP->getTerm('category', $id);
        //pr($wp_post);die;
        $this->set(compact('wp_term'));
    }

}
