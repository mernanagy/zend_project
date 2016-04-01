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
        $all_countries=$country_obj->listAllClients();
        $this->view->all_countries=$all_countries;
    }


}



