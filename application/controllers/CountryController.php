<?php

class CountryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listCitiesAction()
    {
        // action body
        $id = $this->_getParam('id');
        $city_model=new Application_Model_City();
        
        $this->view->allcities=$city_model->get_cities_by_country_id($id);
        $country_model=new Application_Model_Country();
        $this->view->country=$country_model->getCountryById($id);


    }

    public function listCountryAction()
    {
        // action body
        $country_model=new Application_Model_Country();
        //$this->layout()->Country=$country_model;

        Zend_Layout::getMvcInstance()->assign('Country', $country_model);
    }


}





