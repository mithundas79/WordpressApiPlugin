<?php

App::uses('WordpressManagerAppModel', 'WordpressManager.Model');

/**
 * WpAccount Model
 *
 * @property User $User
 */
class WpAccount extends WordpressManagerAppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'user_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'User is required.'
            ),
        ),
        'host' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Host is required.'
            ),
        ),
        'path' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Path is required.'
            ),
        ),
        'wp_username' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Username is required.'
            ),
            'unique' => array(
                'rule' => array('unique'),
                'message' => 'User already in use.'
            ),
        ),
        'wp_password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Password is required'
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    
}
