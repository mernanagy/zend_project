<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function allcountriesAction()
    {
        // action body
        $country_obj=new Application_Model_Country();
        $all_countries=$country_obj->list_All_Countries();
        $this->view->all_countries=$all_countries;
    }

    public function allcitiesAction()
    {
        // action body
        $city_obj=new Application_Model_City();
        $all_cities=$city_obj->list_All_Cities();
        $this->view->all_cities=$all_cities;
    }

    public function alllocationsAction()
    {
        // action body
        $location_obj=new Application_Model_Locations();
        $all_locations=$location_obj->list_All_Locations();
        $this->view->all_locations=$all_locations;
    }

    public function allhotelsAction()
    {
        // action body
        $hotels_obj=new Application_Model_Hotels();
        $all_hotels=$hotels_obj->list_All_Hotels();
        $this->view->all_hotels=$all_hotels;
    }

    public function addcountryAction()
    {
        // action body
        $addcountry_form=new Application_Form_Addcountry();
        $country_obj=new Application_Model_Country();
        $this->view->addcountry_form=$addcountry_form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($addcountry_form->isValid($request->getPost()))
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
//                $fname = $_FILES['image_path']['name'];
//                $fsize = $_FILES['browse']['size'];
//                $ferror = $_FILES['browse']['error'];

                //$image_path->addFilter('Rename','/var/www/html/zend_project/public/images/users/');
                $upload->addFilter('Rename',"/var/www/html/zend_project/public/images/countries/".$_POST['name'].".jpeg");
                $upload->receive();
               // $path="/images/countries/".$_POST['name'].".jpeg";
                $_POST['image_path']="/images/countries/".$_POST['name'].".jpeg";
                $country_obj->insertNewCountry($_POST);
                $this->redirect('/admin/allcountries');
            }
        }

    }

    public function addcityAction()
    {
        // action body
        $addcity_form=new Application_Form_Addcity();
        $city_obj=new Application_Model_City();
        $this->view->addcity_form=$addcity_form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($addcity_form->isValid($request->getPost()))
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
//                $fname = $_FILES['image_path']['name'];
//                $fsize = $_FILES['browse']['size'];
//                $ferror = $_FILES['browse']['error'];
                $upload->addFilter('Rename',"/var/www/html/zend_project/public/images/cities/".$_POST['name'].".jpeg");
                $upload->receive();
                // $path="/images/countries/".$_POST['name'].".jpeg";
                $_POST['imag_path']="/images/cities/".$_POST['name'].".jpeg";
                $city_obj->insertNewCity($_POST);
                $this->redirect('/admin/allcities');
            }
        }
    }


}















