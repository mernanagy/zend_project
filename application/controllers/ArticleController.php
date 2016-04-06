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

        $this->view->article_id = $article_id;
        $this->view->article = $article;


    }

    public function articelPostCommentAction()
    {
        $comment_model_obj = new Application_Model_Comment();
        // action body
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if (isset($_POST['parent']))
        {

            $new_comment_id= $comment_model_obj->post_comment($_POST['id'],$_POST['parent'],$_POST['content']);

            $_POST['id']=$new_comment_id;
            $_POST['parent']= "";


            echo json_encode($_POST);
        }
    }


}





