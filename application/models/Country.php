<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name='country';
    /****** parent for city table **********/
    protected $_dependentTables= array('Application_Model_City');
    
    function listCountries()
    {

    	return $this->fetchAll()->toArray();
    }


    function list_All_Countries()
    {
        return $this->fetchAll(null,"rate DESC",6)->toArray();
    }
    function insertNewCountry($countrydata)
    {
        $row=$this->createRow();
        $row->name=$countrydata['name'];
        $row->rate=$countrydata['rate'];
        $row->image_path=$countrydata['image_path'];
        $row->save();
    }


}

