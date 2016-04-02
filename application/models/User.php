<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name='user';
    /********* parent for userexperience,comment,carrental,hotelreservation tables **************/
    protected $_dependentTables= array(
                        'Application_Model_UserExperience',
                        'Application_Model_Comment',
                        'Application_Model_CarRental',
                        'Application_Model_HotelReservation');

}

