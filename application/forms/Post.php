<?php

class Application_Form_Post extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttribs(array(
            'class'=>'form-horizontal',
            'id'=>'newpost'
        ));
        $id=new Zend_Form_Element_Hidden('id');

        $title=new Zend_Form_Element_Text('title');
        $title->setLabel('Post Title:');
        $title->setAttribs(array(
            'placeholder'=>'Post title',
            'class'=>'form-control '
        ));
        $title->setRequired();

        $content=new Zend_Form_Element_Textarea('content');
        $content->setLabel('Post Content');
        $content->setAttrib('class','form-control');
        $content->setAttribs(array(
            'rows'=>'15',
            'cols'=>'4'
        ));
        $content->setRequired();

        $image_path = new Zend_Form_Element_File('image_path');
        $image_path->setLabel('Upload an image:');
        $image_path->addValidator('Count', false, 1);
        $image_path->addValidator('Extension',false, 'jpg,jpeg,png,gif');

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
        $sumbit->setValue('Add Post');
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
            $title,
            $content,
            $image_path,
            $city_id,
            $sumbit,
            $reset
        ));
    }


}

