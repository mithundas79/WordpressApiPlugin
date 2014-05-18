<?php

App::uses('WordpressManagerAppModel', 'WordpressManager.Model');
App::uses('CakeSession', 'Model/Datasource');

/**
 * WpReader Model
 *
 * @property WpReader $WpReader
 */
class WpReader extends WordpressManagerAppModel {
    // Important:
    public $useDbConfig = 'wp';
    public $useTable = false;
    // Whatever:
    public $displayField = 'post';
    
    protected $db = false;
    protected $_userId = 0;
    protected $_server = "";
    protected $_connectStr = "";
    protected $_connectStrm = "";
    protected $_folders = "";
    protected $_port = "";
    
    
    /**
     * Semi-important:
     * You want to use the datasource schema, and still be able to set
     * $useTable to false. So we override Cake's schema with that exception:
     * @param mixed $field
     * @return (conditional) null:mixed
     * @access public
     */
    public function schema($field = false) {
        if (!is_array($this->_schema) || $field === true) {
            $db = ConnectionManager::getDataSource($this->useDbConfig);
            $db->cacheSources = ($this->cacheSources && $db->cacheSources);
            $this->_schema = $db->describe($this, $field);
        }
        if (is_string($field)) {
            if (isset($this->_schema[$field])) {
                return $this->_schema[$field];
            } else {
                return null;
            }
        }
        return $this->_schema;
    }
    
    
    
    /**
     * Get all accounts from wp_accounts table
     * @return array
     * @access public
     */
    public function getAllAccounts(){
        $this->_userId = AuthComponent::user('id');
        $WpAccountModel = ClassRegistry::init('WpAccount');
        $options = array(
            'conditions' => array(
                'OR' => array(
                    'WpAccount.user_id' => $this->_userId,
                    'WpAccount.is_public' => 1,
                ),
                'WpAccount.is_active' => 1,
            ),
            'order' => array(
                'WpAccount.id' => 'ASC'
            )
        );
        //load the user data
        $user_data = $WpAccountModel->find('all', $options);
        return $user_data;
    }
    
    /**
     * get the rest of the accounts set by users other than the one selected.
     * @param int $id
     * @return array
     * @access public
     */
    public function getRestAccounts($id){
        $this->_userId = AuthComponent::user('id');
        $WpAccountModel = ClassRegistry::init('WpAccount');
        $options = array(
            'conditions' => array(
                'OR' => array(
                    'WpAccount.user_id' => $this->_userId,
                    'WpAccount.is_public' => 1,
                ),
                'WpAccount.id <>' => $id,
                'WpAccount.is_active' => 1,
            ),
            'order' => array(
                'WpAccount.id' => 'ASC'
            )
        );
        //load the user data
        $user_data = $WpAccountModel->find('all', $options);
        return $user_data;
    }
    
    /**
     * get the default account from wp_accounts table
     * @return array
     */
    public function getDefaultAccount(){
        $this->_userId = AuthComponent::user('id');
        $WpAccountModel = ClassRegistry::init('WpAccount');
        $options = array(
            'conditions' => array(
                'WpAccount.user_id' => $this->_userId,
                'WpAccount.is_active' => 1,
            ),
            'order' => array(
                'WpAccount.id' => 'ASC'
            )
        );
        //load the user data
        $user_data = $WpAccountModel->find('first', $options);
        return $user_data;
    }
    /**
     * gewt the account details for the passed id
     * @param int $id
     * @return array
     * @access public
     */
    public function getAccountDetails($id){
        $WpAccountModel = ClassRegistry::init('WpAccount');
        $options = array(
            'conditions' => array(
                'WpAccount.id' => $id,
            )
        );
        //load the user data
        $user_data = $WpAccountModel->find('first', $options);
        return $user_data;
    }
    
    /**
     * get the account, which has been selected by the user to load the mail box
     * @return array
     * @access public
     */
    public function getSelectedAccount(){
        $account = CakeSession::read('WpAccount.username');
        $WpAccountModel = ClassRegistry::init('WpAccount');
        $options = array(
            'conditions' => array(
                'WpAccount.wp_username' => $account,
            ),
            'order' => array(
                'WpAccount.id' => 'ASC'
            )
        );
        //load the user data
        $user_data = $WpAccountModel->find('first', $options);
        return $user_data;
    }
    
    /**
     * set all the server variables
     * @return boolean
     * @access public
     */
    public function setSession(){
        //$this->_userId = AuthComponent::user('id');
        //check if session exists
        if(AuthComponent::user('id')){
            if (!CakeSession::check('WpAccount')) {
                //load the user data
                $user_data = $this->getDefaultAccount();
                //pr($user_data); exit;
                //set up the session data
                CakeSession::write('WpAccount.accountId', $user_data['WpAccount']['id']);
                CakeSession::write('WpAccount.host', $user_data['WpAccount']['host']);
                CakeSession::write('WpAccount.path', $user_data['WpAccount']['path']);
                CakeSession::write('WpAccount.username', $user_data['WpAccount']['wp_username']);
                CakeSession::write('WpAccount.password', $user_data['WpAccount']['wp_password']);
                CakeSession::write('WpAccount.blog_id', $user_data['WpAccount']['blog_id']); 
            }else{
                $host = CakeSession::read('WpAccount.host');
                $path = CakeSession::read('WpAccount.path');

                //echo $imap_server;
                if(empty($host) || empty($path)){
                    //load the user data
                    $user_data = $this->getDefaultAccount();
                    //pr($user_data); exit;
                    //set up the session data
                    CakeSession::write('WpAccount.accountId', $user_data['WpAccount']['id']);
                    CakeSession::write('WpAccount.host', $user_data['WpAccount']['host']);
                    CakeSession::write('WpAccount.path', $user_data['WpAccount']['path']);
                    CakeSession::write('WpAccount.username', $user_data['WpAccount']['wp_username']);
                    CakeSession::write('WpAccount.password', $user_data['WpAccount']['wp_password']);
                    CakeSession::write('WpAccount.blog_id', $user_data['WpAccount']['blog_id']); 
                }
            }

            return true;    
        }else{
            return false;
        }
        
    }
}

?>
