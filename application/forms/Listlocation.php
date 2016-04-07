<?php

class Application_Form_Listlocation extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        
        //$location_model=new Application_Model_Locations();
        //$listalocation=$location_model->listlocationbycityId($city_id);
         $this->setMethod('POST');
             //$this->setAttrib(
            //'class','form-horizontal'
            //  );

        $locationElement=new Zend_Form_Element_Select('location');
        $locationElement->setLabel('Choice Location: ');
        $locationElement->setRegisterInArrayValidator(false);

         $dateElement = new Zend_Form_Element_Text('date_field'); 
          $dateElement->setAttrib('readonly','true');
        $dateElement->setAttrib('class','form-contol');
        $dateElement->setRequired();

         $TimeFrom=new Zend_Form_Element_Select('fromTime');
         $TimeFrom->setLabel(' From : ');
        $TimeFrom->setRegisterInArrayValidator(false);
        

         $dateElement1 = new Zend_Form_Element_Text('date_field2'); 
        $dateElement1->setAttrib('readonly','true');
        $dateElement1->setAttrib('class','form-contol');
        $TimeTo=new Zend_Form_Element_Select('ToTime');
        $TimeTo->setLabel(' To : ');
        $TimeTo->setRegisterInArrayValidator(false);
        $sumbit=new Zend_Form_Element_Submit('submit');
        $sumbit->setValue('Submit');

        $this->addElements(array($locationElement,$dateElement,$TimeFrom,$dateElement1,$TimeTo,$sumbit));

        //foreach($listalocation as $key=>$value )
        //{
           //$locationElement->addMultiOption($value['id'],$value['name']);
        //}

    }


}

