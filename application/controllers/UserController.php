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

       $authAdapter = new Zend_Auth_Adapter_DbTable($db,'user','name','password');

        if (!empty($_POST['user_name'])) {
            $authAdapter->setIdentity($_POST['user_name']);
            $authAdapter->setCredential($_POST['password']);

            $result = $authAdapter->authenticate();


            if ($result->isValid()){
                $row = $authAdapter->getResultRowObject('is_active');

                if ($row->is_active == '1') {

                    //authenticating user
                    $auth = Zend_Auth::getInstance();
                    $storage= $auth->getStorage();

                    $storage->write($authAdapter->getResultRowObject(array('id', 'name')));

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


}





