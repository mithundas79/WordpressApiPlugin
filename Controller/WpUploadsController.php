<?php
App::uses('WordpressManagerAppController', 'WordpressManager.Controller');

/**
 * Description of WpUploadsController
 *
 * 
 */
class WpUploadsController extends WordpressManagerAppController{
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
    
    public function index() {

        $this->WP = ConnectionManager::getDataSource('wp');
        

        $this->WP->resetIXRClint();

        $wp_files = $this->WP->getMediaLibrary(array(
            'number' => 50,
            //'offset' => 10,
            //'parent_id' => 0
            //'mime_type'=> 'image/png'
        ));
        //pr($wp_files);die;
        $this->set(compact('wp_files'));
    }
    
    public function view($id) {
        $this->WP = ConnectionManager::getDataSource('wp');

        $this->WP->resetIXRClint();

        $wp_file = $this->WP->getMediaItem($id);
        //pr($wp_file);die;
        $this->set(compact('wp_file'));
    }
    
    
    public function add() {
        $this->WP = ConnectionManager::getDataSource('wp');
       
        $this->WP->resetIXRClint();

        if ($this->request->is('post')) {
            //pr($this->request->data);die;
            if (isset($this->request->data['file']['name']) && is_uploaded_file($this->data['file']['tmp_name'])) {
                $name = $this->request->data['file']['name'];
                $tmp_name = $this->request->data['file']['tmp_name'];
                $file_content = $this->WP->getUploadEncodeObject(file_get_contents($tmp_name));
                
                $type = $this->data['file']['type'];
                //$size = $this->data['file']['size'];
                
                $post_id = $this->request->data['post_id'];   
                $postData = array(
                    'name' => $name,
                    'type' => $type,
                    'bits' => $file_content,                    
                    'overwrite' => FALSE,//Optional
                    'post_id' => $post_id//Optional
                );
                $stat = $this->WP->uploadFile($postData);
                if ($stat) {
                    $this->Session->setFlash(__('The file has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The file could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The file could not be saved. Please, try again.'));
            }
        }


        $wp_posts = $this->WP->getPosts(array(
            'post_status' => 'publish',
            'post_type' => 'post',
            'orderby' => 'post_title',
            'order' => 'asc',
                ), array(
            'post_title',
            'post_date',
            'post_modified'
        ));
        //pr($wp_posts);die;
        $posts = array('0'=>'Select post');
        if (!empty($wp_posts)) {
            foreach ($wp_posts as $k => $v) {
                $posts[$v['post_id']] = $v['post_title'];
            }
        }
        $this->set(compact('posts'));
    }
    
}

?>
