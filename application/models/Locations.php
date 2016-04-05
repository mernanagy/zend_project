<?php

class Application_Model_Locations extends Zend_Db_Table_Abstract
{
    protected $_name='location';
    /************ forgein key ************************/
    protected $_referenceMap = array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));
    function list_All_Locations()
    {
        return $this->fetchAll()->toArray();
    }

    function insertNewLocation($locdata)
    {
        $row=$this->createRow();
        $row->name=$locdata['name'];
        $row->imag_path=$locdata['imag_path'];
        $row->city_id=$locdata['city_id'];
        $row->save();
    }

    function getLocationById($loc_id)
    {
        return $this->find($loc_id)->toArray();
    }

    function editLocation($locdata)
    {
        $edit_loc['name'] = $locdata['name'];
        if ($locdata['imag_path'] != "")
        {
            $edit_loc['imag_path'] = $locdata['imag_path'];
        }
        $edit_loc['city_id']=$locdata['city_id'];
        $lid = $locdata['id'];
        $this->update($edit_loc, "id=$lid");
    }

    function deletelocation($loc_id)
    {
        $this->delete("id=$loc_id");
    }

}

