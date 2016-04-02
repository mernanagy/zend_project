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

}

