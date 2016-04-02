<?php

class Application_Form_Addcountry extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
       // $this->setAttrib('id','addcountry');

        $this->setAttribs(array(
            'class'=>'form-horizontal',
            'id'=>'newcountry'
        ));
        $id=new Zend_Form_Element_Hidden('id');
        $name=new Zend_Form_Element_Text('name');
        $name->setLabel('Country Name:');
        $name->setAttribs(array(
            'placeholder'=>'EGYPT',
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

        //$image_path=new Zend_Form_Element_Image('image_path');
        //$image_path->setLabel('Image Path');
        $image_path = new Zend_Form_Element_File('image_path');
        $image_path->setLabel('Upload an image:');
        //$image_path->setMaxFileSize(52428800);
        $image_path->addValidator('Count', false, 1);
        //$image_path->addValidator('Size', false, 52428800);
        $image_path->addValidator('Extension',false, 'jpg,jpeg,png,gif');


        $sumbit=new Zend_Form_Element_Submit('submit');
        $sumbit->setValue('Add Country');
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
            //$image_path,
            $sumbit,
            $reset
        ));
    }


}

