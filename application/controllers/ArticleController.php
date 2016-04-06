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

    public function articelGetCommentAction()
    {
        $comment_model_obj = new Application_Model_Comment();
        $user_model_obj = new Application_Model_User();

        // action body
       $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if (isset($_GET['get_comments']))
        {
        $comments = $comment_model_obj->get_comment($_GET['get_comments']);

        foreach($comments as $key=>$value)
        {
            $comments_arr[$key]['id']=$value->id;
            $comments_arr[$key]['parent']="";
            $comments_arr[$key]['created']="";
            $comments_arr[$key]['modified']="";
            $comments_arr[$key]['content']=$value->content;

            $owner_of_comment = $user_model_obj->get_user_by_id($value->user_id);
            $comments_arr[$key]['fullname']=$owner_of_comment->name;

            $comments_arr[$key]['profile_picture_url']='http://travel.com'.$owner_of_comment->imag_path;

            if ($value->user_id == $_GET['user_id'])
            $comments_arr[$key]['created_by_current_user']=true;
            else
                $comments_arr[$key]['created_by_current_user']=false;


        }

            echo json_encode($comments_arr,JSON_UNESCAPED_SLASHES);
        }
    }

    public function articelUpdateCommentAction()
    {
        $comment_model_obj = new Application_Model_Comment();
        // action body
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if (isset($_POST))
        {
            $update_arr['content'] =$_POST['content'];

            $comment_model_obj->update_comment($_POST['id'],$update_arr);
        }

        echo json_encode($_POST,JSON_UNESCAPED_SLASHES);
    }

    public function articelDeleteCommentAction()
    {
        $comment_model_obj = new Application_Model_Comment();
        // action body
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if (isset($_POST))
        {
            
            $comment_model_obj->delete_comment($_POST['id']);
        }
    }


}











