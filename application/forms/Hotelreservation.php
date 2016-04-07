<?php

class Application_Form_Hotelreservation extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttribs(array(
            'class'=>'form-horizontal',
            'id'=>'newhotelreservation'
        ));
        $id=new Zend_Form_Element_Hidden('id');

        $name=new Zend_Form_Element_Select('name');
        $name->setLabel('Select Hotel');
        $name->setAttrib('class','form-contol');
//        $city_obj=new Application_Model_City();
//        $hotelByCityID=$city_obj->getHotelByCityId($this->city_id);
//        foreach($this->hotelByCity as $key=>$value)
//        {
//            $name->addMultiOption($value['id'],$value['name']);
//        }
        $name->setRequired();

        $time_from=new Zend_Form_Element_Text('time_from');
        $time_from->setLabel('Time From:');
        $time_from->setAttribs(array(
            'placeholder'=>'SAN STEFANO',
            'class'=>'form-control ',
            'id'=>'time_form',
            'readonly'=>'true'
        ));
        $time_from->setRequired();

        $time_to=new Zend_Form_Element_Text('time_to');
        $time_to->setLabel('Time To:');
        $time_to->setAttribs(array(
            'placeholder'=>'SAN STEFANO',
            'class'=>'form-control ',
            'id'=>'time_to',
            'readonly'=>'true'
        ));
        $time_to->setRequired();

        $number_of_adults=new Zend_Form_Element_Select('number_of_adults');
        $number_of_adults->setLabel('Select Number of adults');
        $number_of_adults->setAttrib('class','form-contol');
        $number_of_adults->addMultiOptions(array(
           '1'=>'One',
            '2'=>'Two',
            '3'=>'Three',
            '4'=>'Four'
        ));
        $number_of_adults->setRequired();

        $sumbit=new Zend_Form_Element_Submit('submit');
        $sumbit->setValue('Add Hotel Reservation');
        $sumbit->setAttribs(array(
            'class'=>'btn btn-success',

        ));
        $reset=new Zend_Form_Element_Submit('reset');
        $reset->setValue('Reset');
        $reset->setAttribs(array(
            'class'=>'btn btn-danger',

        ));


        $this->addElements(array(
            $id,
            $name,
            $time_from,
            $time_to,
            $number_of_adults,
            $sumbit,
            $reset
        ));




    }


}

