<?php

class Application_Model_UserExperience extends Zend_Db_Table_Abstract
{

    protected $_name='user_posts';
    /********** parent for comment table *******************************/
    protected $_dependentTables= array('Application_Model_Comment');
    /************ forgein key for city and user ************************/
    protected $_referenceMap = array('city'=>array(
            'columns'=>array('city_id'),
            'refTableClass'=>'Application_Model_City',
            'refColumns'=>array('id'),
            'onDelete'=>'cascade'),
        'user'=>array(
            'columns'=>array('user_id'),
            'refTableClass'=>'Application_Model_User',
            'refColumns'=>array('id'),
            'onDelete'=>'cascade'

    ));

    public function get_post_by_id ($post_id){
        return $this->find($post_id)->current();
    }
}

