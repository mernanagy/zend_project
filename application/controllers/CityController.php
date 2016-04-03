<?php

class CityController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body




    }

    public function listExperienceAction()
    {
        // action body
        $UserExperience_obj = new Application_Model_City();

        $city_id = $this->_request->getUserParam('city_id');


        $city_data = $UserExperience_obj->get_city_by_id($city_id);
        $city_locations = $UserExperience_obj->get_city_locations($city_id);

        $user_experiences = $UserExperience_obj->get_city_experiences($city_id);


        /******** pagination ************/

        Zend_View_Helper_PaginationControl::setDefaultViewPartial('city/paginate.phtml');


        $paginator = Zend_Paginator::factory($user_experiences);

        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->setItemCountPerPage(2);



        $this->view->paginator = $paginator;

        $this->view->city_data = $city_data;
        $this->view->city_locations=$city_locations;
    }


}



