<?php

App::uses('WordpressManagerAppController', 'WordpressManager.Controller');


/**
 * Description of WpCommentsController
 *
 * 
 */
class WpCommentsController  extends WordpressManagerAppController{
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

        $wp_comments = $this->WP->getComments(array(
            'number' => 50
        ));
        $nested_comments = array();
        $parent_index = 0;
        if(!empty($wp_comments)){
            foreach ($wp_comments as $comnt){
                if($comnt['parent'] == 0){
                    $nested_comments[$parent_index] = $comnt;
                    
                    $parent_index++;
                }else{
                    $nested_comments['children'][$comnt['parent']][] = $comnt;
                }
                
            }
        }
        //pr($nested_comments);die;
        $this->set(compact('wp_comments', 'nested_comments'));
    }
   
    

    public function edit($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        $this->WP->resetIXRClint();
        
       
        if ($this->request->is('post')) {
            $status = $this->request->data['status'];
            $author = $this->request->data['author'];
            $content = $this->request->data['content'];

            $author_url = $this->request->data['author_url'];
            $author_email = $this->request->data['author_email'];

            
            //validate file type
            $validate = true;
            if ($validate) {
                 $postData = array(                    
                    'status' => $status,
                    //'date_created_gmt'=>date('Y-m-d H:i:s'),
                    'content' => $content,
                    'author' => $author,
                    'author_url' => $author_url,
                    'author_email' => $author_email
                );
                
                $stat = $this->WP->editComment($id, $postData);
                if ($stat) {
                    $this->Session->setFlash(__('The comment has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        }

        $wp_comment = $this->WP->getComment($id);
        $this->request->data['status'] = $wp_comment['status'];
        $this->request->data['content'] = $wp_comment['content'];
        $this->request->data['author'] = $wp_comment['author'];
        $this->request->data['author_url'] = $wp_comment['author_url'];
        $this->request->data['author_email'] = $wp_comment['author_email'];
        //pr($wp_comment);die;
        $statusList = array('hold'=>'Hold', 'approve'=>'Approve', 'spam'=>'Spam');
        $this->set(compact('wp_comment', 'statusList'));

        
    }
    
    
    public function reply($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        $this->WP->resetIXRClint();
        $wp_comment = $this->WP->getComment($id);
        $post_id = $wp_comment['post_id'];
       
        if ($this->request->is('post')) {
            //$post_id = $this->request->data['post_id'];
            $author = $this->request->data['author'];
            $content = $this->request->data['content'];

            $author_url = $this->request->data['author_url'];
            $author_email = $this->request->data['author_email'];

            
            //validate file type
            $validate = true;
            if ($validate) {
                 $postData = array(                    
                    'comment_parent' => $id,
                    //'date_created_gmt'=>date('Y-m-d H:i:s'),
                    'content' => $content,
                    'author' => $author,
                    'author_url' => $author_url,
                    'author_email' => $author_email
                );
                
                $stat = $this->WP->newComment($post_id, $postData);
                if ($stat) {
                    $this->Session->setFlash(__('The comment has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        }

        
        
        $this->request->data['author'] = $wp_comment['author'];
        $this->request->data['author_url'] = $wp_comment['author_url'];
        $this->request->data['author_email'] = $wp_comment['author_email'];
        //pr($wp_comment);die;
        $statusList = array('hold'=>'Hold', 'approve'=>'Approve', 'spam'=>'Spam');
        $this->set(compact('wp_comment', 'statusList'));

        
    }
    
    
    public function delete($id) {
        $this->WP = ConnectionManager::getDataSource('wp');
        
        $this->WP->resetIXRClint();

        $this->WP->deleteComment($id);

        $this->redirect(array('action' => 'index'));
    }
    
}

?>
