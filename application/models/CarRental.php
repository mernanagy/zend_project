<?php

class Application_Model_CarRental extends Zend_Db_Table_Abstract
{
    protected $_name='car_rental';
    /************ forgein key for user ************************/
    protected $_referenceMap = array('user'=>array(
        'columns'=>array('user_id'),
        'refTableClass'=>'Application_Model_User',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));
   
   function addCarRental($user_id,$date1,$date2,$from_time,$to_time,$location)
   {
     $row=$this->createRow();
     $row->pick_up_location=$location;
     $row->user_id=$user_id;
     
     $row->Time_from=$from_time;
     $row->Time_to=$to_time;
     
     $row->Date_from=$date1;
     $row->Date_to=$date2;
     $row->save();


   }
   function selectallRental($Uid)
   {
    return $this->fetchAll("user_id=$Uid",null,null)->toArray();

   }

}

