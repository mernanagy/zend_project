<?php

class Application_Form_UserEdit extends Zend_Form
{

    public function init()
    {
        
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        //$id = new Zend_Form_Element_Hidden('id');
        $Fname=new Zend_Form_Element_Text('name');
        $Fname->setLabel('User Name: ');
        $Fname->setAttribs(Array(
'placeholder'=>'Example: Mohamed',
'class'=>'form-control'
));
        $Fname->setRequired();
        $Fname->addValidator('StringLength', false, Array(4,20));
        $Fname->addFilter('StringTrim');


        
        

        $Email=new Zend_Form_Element_Text('email');
        $Email->setLabel('Email: ');
        $Email->setAttribs(Array(
'placeholder'=>'Example: Email@Examble.com',
'class'=>'form-control'
));
        $Email->setRequired();
        $Email->addValidator('StringLength', false, Array(10,30));
        $Email->addFilter('StringTrim');
        
        $Email->addValidator('EmailAddress');

        $Email->addValidator('Db_NoRecordExists',true,array('user','email'));
        $Password=new Zend_Form_Element_Text('password');
        $Password->setLabel('Password: ');
        $Password->setRequired();
        $Password->addValidator('StringLength', false, Array(5,20));
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setvalue('Save');
        $submit->setAttrib('class','btn btn-success');

        $this->addElements(array($Fname,$Email,$Password,$submit));


    }


}

