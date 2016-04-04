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
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
        $view->whatever = 'foo';
         $city_model=new Application_Model_City();
        $this->view->cities= $city_model->listcities();
    }



}

/*

class My_Layout_Plugin extends Zend_Controller_Plugin_Abstract
{
   public function preDispatch(Zend_Controller_Request_Abstract $request)
   {
      $layout = Zend_Layout::getMvcInstance();
      $view = $layout->getView();

      $view->whatever = 'foo';
   }
}



then register this plugin with the front controller, e.g.

Zend_Controller_Front::getInstance()->registerPlugin(new My_Layout_Plugin());


*/




