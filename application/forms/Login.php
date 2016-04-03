<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {

        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');


        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Your Name: ');
        $name->setAttrib('class', 'form-control');
        /**$email->setAttribs(Array(
            'placeholder'=>'Ex : mariam@gmail.com',
            'class'=>'form-control'
        ));**/
        //$email->addValidator( 'Db_NoRecordExists', true, array(
        //  'table' => 'clients',
        //'field' => 'email',
        //'messages' => array( 'recordFound' => 'Email already taken' )));

        $pswd = new Zend_Form_Element_Password('password');
        $pswd->setLabel('Password:');
        $pswd->setAttrib('class', 'form-control');


        $submit = new Zend_Form_Element_Submit('login');
        $submit->setValue('Submit');
        $submit->setAttrib('class', 'btn btn-info');

        $this->addElements(array(

            $name,
            $pswd,
            $submit,



        ));



    }


}

