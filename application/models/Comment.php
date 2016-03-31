<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract
{
    protected $_name='comment';
    /************ forgein key for userexperience and user ************************/
    protected $_referenceMap = array('userexperience'=>array(
        'columns'=>array('user_posts_id'),
        'refTableClass'=>'Application_Model_UserExperience',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'),
        'user'=>array(
            'columns'=>array('user_id'),
            'refTableClass'=>'Application_Model_User',
            'refColumns'=>array('id'),
            'onDelete'=>'cascade'
        ));

}

