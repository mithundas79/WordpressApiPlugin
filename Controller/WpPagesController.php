<?php

App::uses('WordpressManagerAppController', 'WordpressManager.Controller');

/**
 * WpPages Controller
 *
 */
class WpPagesController  extends WordpressManagerAppController{
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
        

        $this->WP->resetIXRClint();

        $wp_pages = $this->WP->getPosts(array(
            'post_status' => $post_status,
            'post_type' => 'page',
            'number' => 50,
            'orderby' => 'post_modified',
            'order' => 'desc',
                ), array(
            'post_title',
            'post_date',
            'post_modified'
        ));
        //pr($wp_posts);die;
        $this->set(compact('wp_pages'));
    }
    
    
    
    
    public function add() {
        $this->WP = ConnectionManager::getDataSource('wp');
       
        $this->WP->resetIXRClint();

        if ($this->request->is('post')) {
            $page = $this->request->data['page'];
            $title = $this->request->data['title'];
            $content = $this->request->data['content'];
            
            
            $user_id = 1;
            //validate file type
            $validate = true;
            if ($validate) {
                $postData = array(
                    
                    
                    'title' => $title,
                    'description' => $content,
                    //'dateCreated' => date('Y-m-d H:i:s'),
                    'wp_page_template' => 'default',
                    
                    'wp_author_id' => $user_id,
                    'page_status' => 'publish',
                    //
                    //'userid'=>$user_id,
                    //'date_created_gmt' =>date('Y-m-d H:i:s'),
                    'wp_page_parent_id' => $page,
                    //'post_excerpt' => $content,
                    'wp_slug' => Inflector::slug($title),
                    
                );
                $stat = $this->WP->newPage($postData);
                if ($stat) {
                    $this->Session->setFlash(__('The page has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The page could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The page could not be saved. Please, try again.'));
            }
        }


        $wp_pages = $this->WP->getPosts(array(
            'post_status' => 'publish',
            'post_type' => 'page',
            'orderby' => 'post_title',
            'order' => 'asc',
                ), array(
            'post_title',
            'post_date',
            'post_modified'
        ));
        //pr($wp_pages);die;
        $pages = array('0'=>'Select page');
        if (!empty($wp_pages)) {
            foreach ($wp_pages as $k => $v) {
                $pages[$v['post_id']] = $v['post_title'];
            }
        }
        $this->set(compact('pages'));
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
            $page = $this->request->data['page'];
            $title = $this->request->data['title'];
            $content = $this->request->data['content'];

            $user_id = 1;
            //validate file type
            $validate = true;
            if ($validate) {
                 $postData = array(
                    'description' => $content,
                    'wp_page_template' => 'default',
                    'title' => $title,
                    'page_status' => 'publish',
                    'wp_author_id' => $user_id,
                    //'dateCreated' => date('Y-m-d H:i:s'),
                    //'userid'=>$user_id,
                    //'date_created_gmt' =>date('Y-m-d H:i:s'),
                    'wp_page_parent_id' => $page,
                    //'post_excerpt' => $content,
                    'wp_slug' => Inflector::slug($title),
                    
                );
                
                $stat = $this->WP->editPage($id, $postData);
                if ($stat) {
                    $this->Session->setFlash(__('The page has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The page could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The page could not be saved. Please, try again.'));
            }
        }

        $wp_post = $this->WP->getPost($id);
        $this->request->data['category'] = $wp_post['terms'];
        $this->request->data['title'] = $wp_post['post_title'];
        $this->request->data['content'] = $wp_post['post_content'];
        //pr($wp_post);die;
        $this->set(compact('wp_post'));

        $wp_pages = $this->WP->getPosts(array(
            'post_status' => 'publish',
            'post_type' => 'page',
            'orderby' => 'post_title',
            'order' => 'asc',
                ), array(
            'post_title',
            'post_date',
            'post_modified'
        ));
        //pr($wp_pages);die;
        $pages = array('0'=>'Select page');
        if (!empty($wp_pages)) {
            foreach ($wp_pages as $k => $v) {
                $pages[$v['post_id']] = $v['post_title'];
            }
        }
        $this->set(compact('pages'));
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

        $this->WP->deletePage($id);

        $this->redirect(array('action' => 'index'));
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

        $wp_page = $this->WP->getPage($id);
        //pr($wp_page);die;
        $this->set(compact('wp_page'));
    }
}

?>
