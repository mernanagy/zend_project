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


    function userByid($id)
    {
       return $this->find("$id")->toArray();

    }
    function updateuser($id,$userdata)
    {
       $user_data['email']=$userdata['email'];
       $user_data['name']=$userdata['name'];
       $user_data['password']=$userdata['password'];
       $user_data['imag_path']=$userdata['imag_path'];
       $this->update($user_data,"id=$id");
    }

    function getPostByUserId($uid)
    {
        $userrow_object=$this->find($uid)->current();

        //return a row set of objects
        $posts=$userrow_object->findDependentRowset('Application_Model_UserExperience');

        return $posts;
    }

    function get_user_by_id($user_id){
        return $this->find($user_id)->current();
    }


    function addNewUser($post)
    {
        $row = $this->createRow();
        $row->name =  $post['name'];
        $row->email =  $post['email'];
        $row->password = $post['pswd'];
        if ($post['imag_path'] != "")
        {
            $row->imag_path=$post['imag_path'];
        }

        $row->save();

    }




    function getHotelByUserId($uid)
    {
        $userrow_object=$this->find($uid)->current();
        $hotelReserve=$userrow_object->findDependentRowset('Application_Model_HotelReservation');
        return $hotelReserve;

    }

}

