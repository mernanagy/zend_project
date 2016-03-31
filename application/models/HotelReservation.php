<?php

class Application_Model_HotelReservation extends Zend_Db_Table_Abstract
{
    protected $_name='hotel_reservation';
    /************ forgein key for user ************************/
    protected $_referenceMap = array('user'=>array(
        'columns'=>array('user_id'),
        'refTableClass'=>'Application_Model_User',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));

}

