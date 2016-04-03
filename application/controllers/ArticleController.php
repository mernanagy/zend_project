<?php

class ArticleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function showAction()
    {
        $article_obj = new Application_Model_UserExperience();
        $article_id = $this->_request->getUserParam('article_id');

        $article = $article_obj->get_post_by_id($article_id);


        $this->view->article = $article;


    }


}



