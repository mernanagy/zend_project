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

    function insertNewHotelReserve($hotelreserve_data,$uid)
    {

        $row=$this->createRow();
        $row->name=$hotelreserve_data['name'];
        $row->time_from=$hotelreserve_data['time_from'];
        $row->time_to=$hotelreserve_data['time_to'];
        $row->number_of_adults=$hotelreserve_data['number_of_adults'];
        $row->user_id=$uid;
        $row->save();
    }

}

