<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();

        if (!$authorization->hasIdentity()) {
            if ($this->_request->getActionName() != 'login') {
                $this->redirect("admin/login");
            }
//}

        }
    }

    public function indexAction()
    {
        // action body
    }

    public function allcountriesAction()
    {
        // action body
        $country_obj = new Application_Model_Country();
        $all_countries = $country_obj->listCountries();
        $this->view->all_countries = $all_countries;
    }

    public function allcitiesAction()
    {
        // action body
        $city_obj = new Application_Model_City();
        $all_cities = $city_obj->list_All_Cities();
        $this->view->all_cities = $all_cities;
    }

    public function alllocationsAction()
    {
        // action body
        $location_obj = new Application_Model_Locations();
        $all_locations = $location_obj->list_All_Locations();
        $this->view->all_locations = $all_locations;
    }

    public function allhotelsAction()
    {
        // action body
        $hotels_obj = new Application_Model_Hotels();
        $all_hotels = $hotels_obj->list_All_Hotels();
        $this->view->all_hotels = $all_hotels;
    }

    public function allusersAction()
    {
        // action body
        $user_obj = new Application_Model_User();
        $all_users = $user_obj->list_All_users();
        $this->view->all_users = $all_users;

    }

    public function addcountryAction()
    {
        // action body
        $addcountry_form = new Application_Form_Addcountry();
        $addcountry_form->image_path->setRequired();

        $country_obj = new Application_Model_Country();
        $this->view->addcountry_form = $addcountry_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($addcountry_form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename',"/var/www/html/zend_project/public/images/countries/".$_POST['name'].".jpeg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/zend_project/public/images/countries/" . $_POST['name'] . ".jpeg",
                        'overwrite' => true));
                $upload->receive();
                $_POST['image_path'] = "/images/countries/" . $_POST['name'] . ".jpeg";
                $country_obj->insertNewCountry($_POST);
                $this->redirect('/admin/allcountries');
            }
        }

    }

    public function addcityAction()
    {
        // action body
        $addcity_form = new Application_Form_Addcity();
        $addcity_form->imag_path->setRequired();


        $city_obj = new Application_Model_City();
        $this->view->addcity_form = $addcity_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($addcity_form->isValid($request->getPost())) {

                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename',"/var/www/html/zend_project/public/images/cites/".$_POST['name'].".jpeg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/zend_project/public/images/cites/" . $_POST['name'] . ".jpeg",
                        'overwrite' => true));
                $upload->receive();
                // $path="/images/countries/".$_POST['name'].".jpeg";
                $_POST['imag_path'] = "/images/cites/" . $_POST['name'] . ".jpeg";
                $city_obj->insertNewCity($_POST);
                $this->redirect('/admin/allcities');
            }
        }
    }

    public function addlocationAction()
    {
        // action body
        $addlocation_form = new Application_Form_Addlocation();
        $addlocation_form->imag_path->setRequired();


        $location_obj = new Application_Model_Locations();
        $this->view->addlocation_form = $addlocation_form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($addlocation_form->isValid($request->getPost())) {

                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename',"/var/www/html/zend_project/public/images/location/".$_POST['name'].".jpeg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/zend_project/public/images/location/" . $_POST['name'] . ".jpeg",
                        'overwrite' => true));

                $upload->receive();
                $_POST['imag_path'] = "/images/location/" . $_POST['name'] . ".jpeg";
                $location_obj->insertNewLocation($_POST);
                $this->redirect('/admin/alllocations');
            }
        }


    }

    public function addhotelAction()
    {
        // action body
        $addhotel_form = new Application_Form_Addhotel();
        $hotel_obj = new Application_Model_Hotels();
        $this->view->addhotel_form = $addhotel_form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($addhotel_form->isValid($request->getPost())) {
                $hotel_obj->insertNewHotel($_POST);
                $this->redirect('/admin/allhotels');
            }
        }

    }

    public function editcityAction()
    {
        // action body
        $editcity_form = new Application_Form_Addcity();
        $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam('cid');
        $cityById = $city_obj->get_city_by_id_Array($city_id);
        $editcity_form->populate($cityById[0]);
        $this->view->editcity_form = $editcity_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($editcity_form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['imag_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/zend_project/public/images/cites/" . $name,
                            'overwrite' => true));
                    $_POST['imag_path'] = "/images/cites/" . $name;
                } else {
                    $_POST['imag_path'] = "";

                }
                $upload->receive();

                $city_obj->editcity($_POST);
                $this->redirect('/admin/allcities');
            }
        }

    }

    public function editcountryAction()
    {
        // action body
        $editcountry_form = new Application_Form_Addcountry();
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam('cid');
        $countryById = $country_obj->getCountryById($country_id);
        $editcountry_form->populate($countryById[0]);
        $this->view->editcountry_form = $editcountry_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($editcountry_form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['image_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/zend_project/public/images/countries/" . $name,
                            'overwrite' => true));

                    $_POST['image_path'] = "/images/countries/" . $name;
                } else {
                    $_POST['image_path'] = "";
                }

                $upload->receive();

                $country_obj->editCountry($_POST);
                $this->redirect('/admin/allcountries');
            }
        }
    }

    public function editlocationAction()
    {
        // action body
        $editlocation_form = new Application_Form_Addlocation();
        $location_obj = new Application_Model_Locations();
        $location_id = $this->_request->getParam('lid');
        $locationById = $location_obj->getLocationById($location_id);
        $editlocation_form->populate($locationById[0]);
        $this->view->editlocation_form = $editlocation_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($editlocation_form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['imag_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/zend_project/public/images/location/" . $name,
                            'overwrite' => true));

                    $_POST['imag_path'] = "/images/location/" . $name;
                } else {
                    $_POST['imag_path'] = "";
                }

                $upload->receive();

                $location_obj->editLocation($_POST);
                $this->redirect('/admin/alllocations');
            }
        }

    }

    public function edithotelAction()
    {
        // action body
        $edithotel_form = new Application_Form_Addhotel();
        $hotel_obj = new Application_Model_Hotels();
        $hotel_id = $this->_request->getParam('hid');
        $hotelById = $hotel_obj->getHotelById($hotel_id);
        $edithotel_form->populate($hotelById[0]);
        $this->view->edithotel_form = $edithotel_form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($edithotel_form->isValid($request->getPost())) {
                $hotel_obj->edithotel($_POST);
                $this->redirect('/admin/allhotels');
            }
        }

    }

    public function deletecountryAction()
    {
        // action body

        $country_id = $this->_request->getParam('cid');
        $country_obj = new Application_Model_Country();
        $country_obj->deletecountry($country_id);
        $this->redirect('/admin/allcountries');

    }


    public function loginAction()
    {
        // action body


        $login_form = new Application_Form_Login();
        if ($this->_request->isPost()) {
            if ($login_form->isValid($this->_request->getPost())) {

                $email = $this->_request->getParam('name');
                $password = $this->_request->getParam('password');
                $db = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', "name", 'password');
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);
                $result = $authAdapter->authenticate();
                if ($result->isValid()) {
                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    $type_of_user = $authAdapter->getResultRowObject('is_admin');
                    if ($type_of_user->is_admin == '1') {
//$storage->write($authAdapter->getResultRowObject(array('id', 'email')));
//return $this->redirect('/admin/show');
//}

                        $storage->write($authAdapter->getResultRowObject(array('id',
                            'email')));
                        return $this->redirect('/admin/home');
                    }
                } else {
                    $this->view->error_message = "Invalid Emai or Password!";
                    //$this->_helper->layout->disableLayout();
                }


            }

        }
        $this->view->login_form = $login_form;
        //$this->_helper->layout->disableLayout();
    }

    public function homeAction()
    {
        // action body
        //$this->_helper->layout->disableLayout();
        $this->view->home;
    }

    public function logoutAction()
    {
        // action body
        Zend_Session::namespaceUnset('Zend_Auth');
        $this->redirect("/admin/login");

    }


    public function deletecityAction()
    {
        // action body
        $city_id = $this->_request->getParam('cid');
        $city_obj = new Application_Model_City();
        $city_obj->deletecity($city_id);
        $this->redirect('/admin/allcities');
    }

    public function deletelocationAction()
    {
        // action body
        $location_id = $this->_request->getParam('lid');
        $location_obj = new Application_Model_Locations();
        $location_obj->deletelocation($location_id);
        $this->redirect('/admin/alllocations');
    }

    public function deletehotelAction()
    {
        // action body
        $hotel_id = $this->_request->getParam('hid');
        $hotel_obj = new Application_Model_Hotels();
        $hotel_obj->deletehotel($hotel_id);
        $this->redirect('/admin/allhotels');

    }

    public function blockuserAction()
    {
        // action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam('uid');
        $user_obj->blockuser($user_id);
        $this->redirect('/admin/allusers');
    }

    public function unblockuserAction()
    {
        // action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam('uid');
        $user_obj->unblockuser($user_id);
        $this->redirect('/admin/allusers');
    }

}
