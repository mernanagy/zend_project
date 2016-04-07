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


        $message = array('type' => 'failed', 'message' => "Invalid username or password");


        $db = Zend_Db_Table::getDefaultAdapter();

        $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', 'email', 'password');

        if (!empty($_POST['user_email'])) {
            $authAdapter->setIdentity($_POST['user_email']);
            $authAdapter->setCredential($_POST['password']);

            $result = $authAdapter->authenticate();


            if ($result->isValid()) {
                $row = $authAdapter->getResultRowObject('is_active');

                if ($row->is_active == '1') {

                    //authenticating user
                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();

                    $storage->write($authAdapter->getResultRowObject(array('id', 'name', 'imag_path', 'is_admin')));

                    $message['type'] = 'success';
                    $message['message'] = 'http://travel.com/index/list-countary-a-city';
                } else {
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
        Zend_Session::namespaceUnset('facebook');
        $auth->clearIdentity();

        $this->redirect('/index/list-countary-a-city');
    }

    public function postsAction()
    {
        // action body

        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam('user_id');
        $postByUserId = $user_obj->getPostByUserId($user_id);
        foreach ($postByUserId as $key => $value) {
            $posts[$key]['id'] = $value->id;
            $posts[$key]['title'] = $value->title;
            $posts[$key]['content'] = $value->content;
        }
        $this->view->user_id = $user_id;
        $this->view->postByUserId = $posts;
    }

    public function hotelAction()
    {
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        // action body
        $user_id = $this->_request->getParam('user_id');
        $city_id = $this->_request->getParam('city_id');
        $hotelreservation_form = new Application_Form_Hotelreservation();
        $hotelreservation_obj = new Application_Model_HotelReservation();
        $city_obj = new Application_Model_City();
        $hotelByCityID = $city_obj->getHotelByCityId($city_id);
        foreach ($hotelByCityID as $key => $value) {
            $hotelreservation_form->name->addMultiOption($value['name'], $value['name']);
        }

        $this->view->hotelreservation_form = $hotelreservation_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($hotelreservation_form->isValid($request->getPost())) {

                $hotelreservation_obj->insertNewHotelReserve($_POST, $user_id);
                $this->redirect('/user/allhotelreservation/user_id/' . $user_id);
            }
        }


    }

    public function carAction()
    {
        // action body
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        $location_model = new Application_Model_Locations ();
        $cityid = $this->_request->getParam('city_id');
        $listlocation = $location_model->listlocationbycityId($cityid);
        $locationdown = new Application_Form_Listlocation();
        $userid = $this->_request->getParam('user_id');
        $this->view->listlocation = $listlocation;
        $this->view->datalocation = $locationdown;

        $request = $this->getRequest();
        if ($this->_request->isPost()) {
            if ($locationdown->isValid($_POST)) {
                $car_rental_model = new Application_Model_CarRental();
                $_POST['user_id'] = $userid;
                $this->view->post = $_POST;
                $car_rental_model->addCarRental($_POST['user_id'], $_POST['date_field'], $_POST['date_field2'], $_POST['fromTime'], $_POST['ToTime'], $_POST['location']);
                // $this->redirect('/index/index');

            }

        }
    }

    public function updateprofileAction()
    {
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        // action body
        $form = new Application_Form_UserEdit();
        $user_model = new Application_Model_User();
        $id = $this->_request->getParam('user_id');
        $dataUser = $user_model->userByid($id);
        $form->populate($dataUser[0]);
        $this->view->dataUser = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {

                $uploadImage = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['imag_path']['name'];
                if ($name != "") {
                    $uploadImage->addFilter('Rename', array('target' => "/var/www/zend_project/public/images/users/" . $name, 'overwrite' => true));
                    $_POST['imag_path'] = '/images/users/' . $name;
                    $_SESSION['Zend_Auth']['storage']->imag_path=$_POST['imag_path'];

                } else {
                    $_POST['imag_path'] = "";

                }

                $user_model->updateuser($id, $_POST);
                $_SESSION['Zend_Auth']['storage']->name=$_POST['name'];
                $uploadImage->receive();


                $this->redirect('/index/list-countary-a-city');
            }


        }
        $car_rental_model = new Application_Model_CarRental();
        $data = $car_rental_model->selectallRental($id);
        $this->view->datacar = $data;

        $hotel_reserver_model = new Application_Model_HotelReservation();
        $dataHotel = $hotel_reserver_model->listallhotelreserve($id);
        $this->view->dathotel = $dataHotel;


    }

    public function addpostAction()
    {
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        // action body
        $addpost_form = new Application_Form_Post();
        $addpost_form->image_path->setRequired();
        //$addpost_form->removeElement("city_id");

        $post_obj = new Application_Model_UserExperience();
        $this->view->addpost_form = $addpost_form;

        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($addpost_form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename',"/var/www/html/zend_project/public/images/cites/".$_POST['name'].".jpeg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/zend_project/public/images/posts/" . $_POST['title'] . ".jpeg",
                        'overwrite' => true));
                $upload->receive();
                // $path="/images/countries/".$_POST['name'].".jpeg";
                $_POST['image_path'] = "/images/posts/" . $_POST['title'] . ".jpeg";
                $user_id = $this->_request->getParam('user_id');
                $post_obj->insertNewPost($_POST, $user_id);
                $this->redirect('/user/posts/user_id/' . $user_id);
            }
        }


    }

    public function editpostAction()
    {
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        // action body
        $editpost_form = new Application_Form_Post();
        $post_obj = new Application_Model_UserExperience();
        $editpost_form->removeElement("city_id");

        $post_id = $this->_request->getParam('pid');
        $user_id = $this->_request->getParam('user_id');

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
                $this->redirect('/user/posts/user_id/' . $user_id);
            }
        }


    }

    public function deletepostAction()
    {
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        // action body
        $post_id = $this->_request->getParam('pid');
        $user_id = $this->_request->getParam('user_id');
        $post_obj = new Application_Model_UserExperience();
        $post_obj->deletePost($post_id);
        $this->redirect('/user/posts/user_id/' . $user_id);
    }


    public function siginupAction()
    {
        // action body

        $form = new Application_Form_Siginup();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['imag_path']['name'];
                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/zend_project/public/images/users/" . $name,
                            'overwrite' => true));

                    $_POST['imag_path'] = "/images/users/" . $name;
                } else {
                    $_POST['image_path'] = "";
                }

                $upload->receive();
                $user_model = new Application_Model_User();
                $user_model->addNewUser($_POST);
                $this->redirect('/index/list-countary-a-city');
            }
        }
        $this->view->signUp_form = $form;
    }

    public function allhotelreservationAction()
    {
        if (!isset($_SESSION['Zend_Auth']['storage']))
            $this->redirect('/');
        // action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam('user_id');
        $hotelByUserId = $user_obj->getHotelByUserId($user_id);
        foreach ($hotelByUserId as $key => $value) {
            $hotel[$key]['id'] = $value->id;
            $hotel[$key]['name'] = $value->name;
            $hotel[$key]['time_from'] = $value->time_from;
            $hotel[$key]['time_to'] = $value->time_to;
            $hotel[$key]['number_of_adults'] = $value->number_of_adults;

//        }
//        $this->view->user_id=$user_id;
            $this->view->hotelByUserId = $hotel;
        }

    }

    public function fbauthAction()
    {
        // action body

        $fb = new Facebook\Facebook([
            'app_id' => '1677264832540895', // Replace {app-id} with your app id
            'app_secret' => 'e6ba08afab0e709d64aa6b826e1e6be4',
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        var_dump($helper);
        try {
            $accessToken = $helper->getAccessToken();

        } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error (headers link)
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }


        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() .
                    "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            Exit;
        }

        $oAuth2Client = $fb->getOAuth2Client();
//check if access token expired
        if (!$accessToken->isLongLived()) {
// Exchanges a short-lived access token for a long-lived one
            try {
// try to get another access token
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                Exit;
            }
        }

        //Sets the default fallback access token so we don't have to pass it to each request
        $fb->setDefaultAccessToken($accessToken);
        try {
            $response = $fb->get('/me');
            $userNode = $response->getGraphUser();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }
        $fpsession = new Zend_Session_Namespace('facebook');
// write in session email & id & first_name
        $fpsession->first_name = $userNode->getName();
        $this->redirect('/index/index');
    }

    public function fbloginformAction()
    {
        // action body
        $fb = new Facebook\Facebook([
            'app_id' => '1677264832540895', // Replace {app-id} with your app id
            'app_secret' => 'e6ba08afab0e709d64aa6b826e1e6be4',
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();



        $loginUrl = $helper->getLoginUrl( $this->view->serverUrl().'/user/fbauth');
 
       

        $this->view->facebook_url = $loginUrl;
    }
}































