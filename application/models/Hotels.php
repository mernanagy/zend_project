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
}

