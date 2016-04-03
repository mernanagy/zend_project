<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name = 'country';
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
        $row = $this->createRow();
        $row->name = $countrydata['name'];
        $row->rate = $countrydata['rate'];
        $row->image_path = $countrydata['image_path'];
        $row->save();
    }

    function getCountryById($cid)
    {
        return $this->find($cid)->toArray();
    }

    function editCountry($countrydata)
    {

            $edit_country['name'] = $countrydata['name'];
            $edit_country['rate'] = $countrydata['rate'];
            if ($countrydata['image_path'] != "")
            $edit_country['image_path'] = $countrydata['image_path'];

            $cid = $countrydata['id'];
            $this->update($edit_country, "id=$cid");




    }
    function deletecountry($country_id)
    {
        $this->delete("id=$country_id");
    }

}
