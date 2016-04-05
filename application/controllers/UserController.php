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


}













