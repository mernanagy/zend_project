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

}

