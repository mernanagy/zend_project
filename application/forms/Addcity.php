<?php

class Application_Form_Addcity extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttribs(array(
            'class'=>'form-horizontal',
            'id'=>'newcity'
        ));
        $id=new Zend_Form_Element_Hidden('id');
        $name=new Zend_Form_Element_Text('name');
        $name->setLabel('City Name:');
        $name->setAttribs(array(
            'placeholder'=>'CAIRO',
            'class'=>'form-control '
        ));
        $name->setRequired();

        $rate=new Zend_Form_Element_Text('rate');
        $rate->setLabel('Rate:');
        $rate->setAttribs(array(
            'placeholder'=>'From 0 to 10',
            'class'=>'form-control'
        ));
        $rate->setRequired();

        $imag_path = new Zend_Form_Element_File('imag_path');
        $imag_path->setLabel('Upload an image:');
        $imag_path->addValidator('Count', false, 1);
        $imag_path->addValidator('Extension',false, 'jpg,jpeg,png,gif');

        $description=new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description');
        $description->setAttrib('class','form-control');
        $description->setAttribs(array(
            'rows'=>'15',
            'cols'=>'4'
        ));
        $description->setRequired();

        $latitude=new Zend_Form_Element_Text('latitude');
        $latitude->setLabel('Set Latitude:');
        $latitude->setAttribs(array(
            'class'=>'form-control'
        ));
        $latitude->setRequired();

        $longitude=new Zend_Form_Element_Text('longitude');
        $longitude->setLabel('Set Longitude:');
        $longitude->setAttribs(array(
            'class'=>'form-control'
        ));
        $longitude->setRequired();

        $country_id=new Zend_Form_Element_Select('country_id');
        $country_id->setLabel('Select Country');
        $country_id->setAttrib('class','form-contol');
        $country_obj=new Application_Model_Country();
        $all_countries=$country_obj->listCountries();
        foreach($all_countries as $key=>$value)
        {
            $country_id->addMultiOption($value['id'],$value['name']);
        }
        $country_id->setRequired();


        $sumbit=new Zend_Form_Element_Submit('submit');
        $sumbit->setValue('Add City');
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
            $rate,
            $imag_path,
            $description,
            $latitude,
            $longitude,
            $country_id,
            $sumbit,
            $reset
        ));

    }


}

