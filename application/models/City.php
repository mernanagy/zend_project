<?php

class Application_Model_City extends Zend_Db_Table_Abstract
{
    protected $_name='city';
    /********* parent for locations,hotels,userexperience tables ********************/
    protected $_dependentTables= array(
                            'Application_Model_Locations',
                            'Application_Model_Hotels',
                            'Application_Model_UserExperience');
    /********* forgein key for country *********************************************/
    protected $_referenceMap = array('country'=>array(
        'columns'=>array('country_id'),
        'refTableClass'=>'Application_Model_Country',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));


    function listcities()
    {
        return $this->fetchAll(null,"rate DESC",6)->toArray();
        

    }

    function list_All_Cities()
    {

        return $this->fetchAll()->toArray();
    }

    function insertNewCity($citydata)
    {
        $row=$this->createRow();
        $row->name=$citydata['name'];
        $row->rate=$citydata['rate'];
        $row->imag_path=$citydata['imag_path'];
        $row->description=$citydata['description'];
        $row->latitude=$citydata['latitude'];
        $row->longitude=$citydata['longitude'];
        $row->country_id=$citydata['country_id'];
        $row->save();
    }

    function editcity($citydata){

        $edit_city['name'] = $citydata['name'];
        $edit_city['rate'] = $citydata['rate'];
        if ($citydata['imag_path'] != "")
        {
            $edit_city['imag_path'] = $citydata['imag_path'];
        }


        $edit_city['description']=$citydata['description'];
        $edit_city['latitude']=$citydata['latitude'];
        $edit_city['longitude']=$citydata['longitude'];
        $edit_city['country_id']=$citydata['country_id'];
        $cid = $citydata['id'];
        $this->update($edit_city, "id=$cid");
    }

    function deletecity($city_id){

        $this->delete("id=$city_id");
    }

    public function get_city_experiences ($city_id)
    {
        $city = $this->find("$city_id")->current();

        return $city->findDependentRowset('Application_Model_UserExperience');

    }

    public function get_city_by_id ($city_id)
    {
        return $this->find("$city_id")->current();
    }
    // 3alashan elpopulate lazem ta5od array
    public function get_city_by_id_Array ($city_id)
    {
        return $this->find($city_id)->toArray();
    }

    public function get_city_locations ($city_id)
    {
        $city = $this->find("$city_id")->current();
        return $city->findDependentRowset('Application_Model_Locations');

    }

    public function get_cities_by_country_id($country_id)
    {
    
       return $this->fetchAll("country_id=$country_id",null,null)->toArray();
    }

    function getHotelByCityId($city_id){

        $city_obj =$this->find($city_id)->current();

        //return a row set of objects
        $hotelByCity=$city_obj->findDependentRowset('Application_Model_Hotels');

        return $hotelByCity;
    }
}

