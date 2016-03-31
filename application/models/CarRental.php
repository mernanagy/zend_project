<?php

class Application_Model_CarRental extends Zend_Db_Table_Abstract
{
    protected $_name='car_rental';
    /************ forgein key for user ************************/
    protected $_referenceMap = array('user'=>array(
        'columns'=>array('user_id'),
        'refTableClass'=>'Application_Model_User',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'

    ));


}

