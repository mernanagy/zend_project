<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        // action body
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);


        $message= array('type'=>'failed' , 'message'=>"Invalid username or password");



        $db = Zend_Db_Table::getDefaultAdapter();

       $authAdapter = new Zend_Auth_Adapter_DbTable($db,'user','email','password');

        if (!empty($_POST['user_email'])) {
            $authAdapter->setIdentity($_POST['user_email']);
            $authAdapter->setCredential($_POST['password']);

            $result = $authAdapter->authenticate();


            if ($result->isValid()){
                $row = $authAdapter->getResultRowObject('is_active');

                if ($row->is_active == '1') {

                    //authenticating user
                    $auth = Zend_Auth::getInstance();
                    $storage= $auth->getStorage();

                    $storage->write($authAdapter->getResultRowObject(array('id', 'name','imag_path','is_admin')));

                    $message['type'] = 'success';
                    $message['message'] = 'http://travel.com/index/list-countary-a-city';
                }
                else{
                    $message['type'] = 'failed';
                    $message['message'] = 'You Are Banned Please Check The Admin !!!!!';
                }
                  }
        }

        echo json_encode($message);
    }

    public function signoutAction()
    {
        // action body
        $auth = Zend_Auth::getInstance();

        $auth->clearIdentity();

        $this->redirect('/index/list-countary-a-city');
    }

    public function postsAction()
    {
        // action body

        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam('user_id');
        $postByUserId = $user_obj->getPostByUserId($user_id);
        foreach ($postByUserId as $key=>$value) {
            $posts[$key]['id'] = $value->id;
            $posts[$key]['title'] = $value->title;
            $posts[$key]['content'] = $value->content;
        }
        $this->view->user_id=$user_id;
        $this->view->postByUserId=$posts;
    }

    public function hotelAction()
    {
        // action body
    }

    public function carAction()
    {
        // action body
    }

    public function updateprofileAction()
    {
        // action body
        $form=new Application_Form_UserEdit();
        $user_model= new Application_Model_User();
        $id = $this->_request->getParam('user_id');
        $dataUser = $user_model->userByid($id);
        $form->populate($dataUser[0]);
        $this->view->dataUser=$form;
        $request = $this->getRequest ();
        if($request-> isPost()){
            if($form-> isValid($request-> getPost())){
               $user_model->updateuser($id,$_POST);
               $this->redirect('/index/list-countary-a-city');
            }

        }
        

         
    }

    public function addpostAction()
    {
        // action body
        $addpost_form=new Application_Form_Post();
        $addpost_form->image_path->setRequired();
        //$addpost_form->removeElement("city_id");

        $post_obj=new Application_Model_UserExperience();
        $this->view->addpost_form=$addpost_form;

        $request=$this->getRequest();

        if($request->isPost())
        {
            if($addpost_form->isValid($request->getPost()))
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename',"/var/www/html/zend_project/public/images/cites/".$_POST['name'].".jpeg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/zend_project/public/images/posts/" . $_POST['title'] . ".jpeg",
                        'overwrite' => true));
                $upload->receive();
                // $path="/images/countries/".$_POST['name'].".jpeg";
                $_POST['image_path'] = "/images/posts/" . $_POST['title'] . ".jpeg";
                $user_id = $this->_request->getParam('user_id');
                $post_obj->insertNewPost($_POST,$user_id );
                $this->redirect('/user/posts/user_id/'.$user_id);
            }
        }


    }

    public function editpostAction()
    {
        // action body
        $editpost_form = new Application_Form_Post();
        $post_obj = new Application_Model_UserExperience();
        $editpost_form->removeElement("city_id");

        $post_id = $this->_request->getParam('pid');
        $user_id=$this->_request->getParam('user_id');

        $postById = $post_obj->getPostById($post_id);

        $editpost_form->populate($postById[0]);
        $this->view->editpost_form = $editpost_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($editpost_form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['image_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/zend_project/public/images/posts/" . $name,
                            'overwrite' => true));

                    $_POST['image_path'] = "/images/posts/" . $name;
                } else {
                    $_POST['image_path'] = "";
                }

                $upload->receive();

                $post_obj->editPost($_POST);
                $this->redirect('/user/posts/user_id/'.$user_id);
            }
        }


    }

    public function deletepostAction()
    {
        // action body
        $post_id = $this->_request->getParam('pid');
        $user_id=$this->_request->getParam('user_id');
        $post_obj = new Application_Model_UserExperience();
        $post_obj->deletePost($post_id);
        $this->redirect('/user/posts/user_id/'.$user_id);
    }


}



















