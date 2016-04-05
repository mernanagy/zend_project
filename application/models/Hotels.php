<?php

class Application_Model_Hotels extends Zend_Db_Table_Abstract
{
    protected $_name='hotels';
    /************ forgein key for city ************************/
    protected $_referenceMap = array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));
    function list_All_Hotels()
    {
        return $this->fetchAll()->toArray();
    }

    function insertNewHotel($hoteldata)
    {
        $row=$this->createRow();
        $row->name=$hoteldata['name'];
        $row->city_id=$hoteldata['city_id'];
        $row->save();
    }

    function getHotelById($hotel_id)
    {
        return $this->find($hotel_id)->toArray();
    }

    function edithotel($hoteldata)
    {
        $edit_hotel['name'] = $hoteldata['name'];
        $edit_hotel['city_id']=$hoteldata['city_id'];
        $hid = $hoteldata['id'];
        $this->update($edit_hotel, "id=$hid");
    }

    function deletehotel($hote_id)
    {
        $this->delete("id=$hote_id");
    }
}

