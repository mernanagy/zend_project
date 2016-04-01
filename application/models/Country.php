<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name='country';
    /****** parent for city table **********/
    protected $_dependentTables= array('Application_Model_City');


    function listAllClients()
    {
        return $this->fetchAll()->toArray();
    }

}

