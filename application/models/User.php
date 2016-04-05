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

    function list_All_users()
    {
        return $this->fetchAll()->toArray();
    }

    function blockuser($uid)
    {

        $blockuser['is_active']=0;
        $this->update($blockuser, "id=$uid");
    }

    function unblockuser($uid)
    {
        $unblockuser['is_active']=1;
        $this->update($unblockuser, "id=$uid");
    }

    function deleteuser($uid)
    {
        $this->delete("id=$uid");
    }
    function usertoadmin($uid)
    {
        $admin['is_admin']=1;
        $this->update($admin, "id=$uid");
    }


}

