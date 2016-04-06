<?php

class Application_Model_UserExperience extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_posts';
    /********** parent for comment table *******************************/
    protected $_dependentTables = array('Application_Model_Comment');
    /************ forgein key for city and user ************************/
    protected $_referenceMap = array('city' => array(
        'columns' => array('city_id'),
        'refTableClass' => 'Application_Model_City',
        'refColumns' => array('id'),
        'onDelete' => 'cascade'),
        'user' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'Application_Model_User',
            'refColumns' => array('id'),
            'onDelete' => 'cascade'

        ));

    public function get_post_by_id($post_id)
    {
        return $this->find($post_id)->current();
    }

    function insertNewPost($postdata, $uid)
    {

        $row = $this->createRow();
        $row->title = $postdata['title'];
        $row->content = $postdata['content'];
        $row->image_path = $postdata['image_path'];
        $row->city_id = $postdata['city_id'];
        $row->user_id = $uid;
        $row->save();
    }

    function getPostById($post_id)
    {

        return $this->find($post_id)->toArray();
    }

    function editPost($postdata)
    {
        $edit_post['title'] = $postdata['title'];
        $edit_post['content'] = $postdata['content'];
        if ($postdata['image_path'] != "") {
            $edit_post['image_path'] = $postdata['image_path'];
        }
            $pid = $postdata['id'];
            $this->update($edit_post, "id=$pid");

    }

    function deletePost($post_id)
    {
        $this->delete("id=$post_id");
    }
}

