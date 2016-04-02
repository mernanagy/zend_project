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

        return $this->fetchAll()->toArray();
    }

}

