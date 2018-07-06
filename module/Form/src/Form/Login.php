<?php
namespace Form\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter;

class Login extends Form{

    public function __construct(){
        parent::__construct();
        //
        $this->loginForm();
        $this->loginInputFilter();//Filter + validate
    }

    //create textfield
    private function loginForm(){
        //email
        $email = new Element\Email('email');
        $email ->setLabel('Email: ');
        $email->setLabelAttributes([
            'for'=>'email',
            'class'=>'col-sm-3 control-label',
        ]);
        $email->setAttributes([
            'id'=>'email',
            'class'=> 'form-control',
            'placeholder'=>'example@domain.com'
        ]);
        $this->add($email);

        //password
        $password = new Element\Password('password');
        $password->setLabel('Password: ');
        $password->setLabelAttributes([
            'for'=>'password',
            'class'=>'col-sm-3 control-label',
        ]);
        $password->setAttributes([
            'id'=>'password',
            'class'=>'form-control',
            'placeholder'=>'Enter your password'
        ]);
        $this->add($password);

        //Remember me
        $rememberme = new Element\Checkbox('rememberme');
        $rememberme->setLabel('Remember me: ');
        $rememberme->setLabelAttributes([
            'for' =>'rememberme',
        ]);
        $rememberme->setAttributes([
            'id'=>'rememberme',
            'value'=>1,
            'required'=>false,
        ]);
        $this->add($rememberme);

        //Submit button 
        $submitbutton = new Element\Submit('submitbutton');
        $submitbutton->setAttributes([
            'id'=>'submitbutton',
            'value'=>'Login',
            'class'=>'btn btn-success'
        ]);
        $this->add($submitbutton);
    }
    //create input filter
    private function loginInputFilter(){
        $inputFilter = new InputFilter\InputFilter();
        $this->setInputFilter($inputFilter);
        $inputFilter ->add([
            'name'=>'email',
            'required'=>true,
            'filters'=>[
                //strim//newline/lowercase/uppercase
                ['name'=>'StringToLower'],
                ['name'=>'StringTrim']
            ],
            'validators'=>[
                [
                    'name'=>'EmailAddress',
                    'options'=>[
                    'messages'=>[
                        \Zend\Validator\EmailAddress::INVALID_FORMAT=>"EMail is not in the right style",
                        \Zend\Validator\EmailAddress::INVALID_HOSTNAME=>'Invalid hostname',
                        ]
                    ],
                ]
            ],
        ]);
        $inputFilter ->add([
            'name'=>'password',
            'required'=>true,
            'filters'=>[
                //strim//newline/lowercase/uppercase
                ['name'=>'StringToLower'],
                ['name'=>'StringTrim'],
                ['name'=>'StripTags'],
                ['name'=>'StripNewlines'],
            ],
            'validators'=>[
                [
                    'name'=>'StringLength',
                    'options'=>[
                    'min'=>6,
                    'max'=>20,
                    'messages'=>[
                        \Zend\Validator\StringLength::TOO_SHORT=>"Password must have at least %min% characters",
                        \Zend\Validator\StringLength::TOO_LONG=>"Password can't surpass %max% characters",
                        ],
                    ],
                ],
                [
                    'name'=>'Regex',
                    'options'=>[
                        'pattern'=>'/^[a-zA-z0-9]*$/',
                        'messages'=>[
                            \Zend\Validator\Regex::NOT_MATCH=>"Password must contains at least 1 lowercase char, 1 uppcase char and 1 digit",
                            \Zend\Validator\Regex::INVALID=>'Password is not in the right data',
                        ],
                    ],
                ],
            ],
        ]);
    }

}

