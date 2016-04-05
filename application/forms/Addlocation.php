<?php

class Application_Form_Addlocation extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttribs(array(
            'class'=>'form-horizontal',
            'id'=>'newlocation'
        ));
        $id=new Zend_Form_Element_Hidden('id');

        $name=new Zend_Form_Element_Text('name');
        $name->setLabel('Location Name:');
        $name->setAttribs(array(
            'placeholder'=>'SAN STEFANO',
            'class'=>'form-control '
        ));
        $name->setRequired();

        $imag_path = new Zend_Form_Element_File('imag_path');
        $imag_path->setLabel('Upload an image:');
        $imag_path->addValidator('Count', false, 1);
        $imag_path->addValidator('Extension',false, 'jpg,jpeg,png,gif');

        $city_id=new Zend_Form_Element_Select('city_id');
        $city_id->setLabel('Select City');
        $city_id->setAttrib('class','form-contol');
        $city_obj=new Application_Model_City();
        $all_cites=$city_obj->list_All_Cities();
        foreach($all_cites as $key=>$value)
        {
            $city_id->addMultiOption($value['id'],$value['name']);
        }
        $city_id->setRequired();

        $sumbit=new Zend_Form_Element_Submit('submit');
        $sumbit->setValue('Add Location');
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
            $imag_path,
            $city_id,
            $sumbit,
            $reset
        ));

    }


}

