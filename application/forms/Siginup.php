<?php

class Application_Form_Siginup extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $id = new Zend_Form_Element_Hidden('id');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('User Name: ');
        $name->setAttrib('class','form-control');
        $name->setRequired();
        $name->addValidator('StringLength', false, Array(4,20));







        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email : ');
        $email->setAttrib('class','form-control');
        $email->addValidator( 'Db_NoRecordExists', true, array(
            'table' => 'user',
            'field' => 'email',
            'messages' => array( 'recordFound' => 'Email already taken' )));

        $pswd = new Zend_Form_Element_Password('pswd');
        $pswd->setLabel('Password:');
        $pswd->setAttrib('class','form-control');
        $pswd->setAttrib('size', 35);
        $pswd->setRequired(true);
        //$pswd->removeDecorator('label');
        //$pswd->removeDecorator('htmlTag');
        //$pswd->removeDecorator('Errors');
        $pswd->addValidator('StringLength', false, array(4,15));
        $pswd->addErrorMessage('Please choose a password between 4-15 characters');

        $confirmPswd = new Zend_Form_Element_Password('confirm_pswd');
        $confirmPswd->setLabel('Confirm Password:');
        $confirmPswd->setAttrib('size', 35);
        $confirmPswd->setAttrib('class','form-control');
        $confirmPswd->setRequired(true);
        $confirmPswd->addValidator('Identical', false, array('token' => 'pswd'));
        $confirmPswd->addErrorMessage('The passwords do not match');



        $submit = new Zend_Form_Element_Submit('Submit');
        $submit->setValue('Submit');
        $submit->setAttrib('class', 'btn btn-success');


        $reset = new Zend_Form_Element_Reset('reset');
        $reset->setValue('reset');
        $reset->setAttrib('class', 'btn btn-danger');



        $this->addElements(array(
            $id,
            $name,
            $email,
            $pswd,
            $confirmPswd,
            $submit,
            $reset


        ));



    }


}

