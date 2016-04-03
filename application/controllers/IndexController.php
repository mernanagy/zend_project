<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listCountaryACityAction()
    {
        // action body
         
        $country_model= new Application_Model_Country();
        $this->view->countries=$country_model->list_All_Countries();
         $city_model=new Application_Model_City();
        $this->view->cities= $city_model->listcities();
    }



}






