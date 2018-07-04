<?php
namespace Form\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\ValidatorInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Between;
use Zend\Validator\Date;
use Zend\Validator\EmailAddress;
use Zend\Validator\Digits;
use Zend\Validator\GreaterThan;
use Zend\Validator\LessThan;


class ValidatorController extends AbstractActionController{
    public function stringAction(){
        //validator for string
        $validator = new StringLength(['max'=>6]);
        //$var = "test";
        $var = "fdsa fweq";
        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;
    }
    public function numberAction(){
        $validator = new Between([
            'min'=>5,
            'max'=>10,
            'inclusive'=>false
        ]);

        $var = 5;
        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;
    }

    public function dateAction(){
        // $validator= new Date([
        //     'format'=>'d-m-Y'
        // ]);
        $validator= new Date([
            'format'=>'m'
        ]);
        
        $var = 4;
        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;
    }

    public function emailAction(){
        $validator = new EmailAddress();
        $var = 'minh@gmail.com';
        //$var = 'minh+abc@gmail.com';//true
        //$var = 'minh@abc@gmail.com';//false
        //$var = '"minh@abc"@gmail.com';//true
        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;

    }
    
    public function digitsAction(){
        $validator = new Digits();
        $var=1;
        //$var="5";//true
        //$var=1.2;//false
        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;
    }

    public function greaterThanAction(){
        $validator = new GreaterThan([
            'min'=>10,
            'inclusive'=>false,
        ]);
        $var=10;

        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;

    }

    public function lessThanAction(){
        $validator = new LessThan([
            'max'=>10,
            'inclusive'=>false,
        ]);
        $var=10;

        if ($validator->isValid($var)){
            echo $var;
        }
        else 
        {
            $messages = $validator->getMessages();
            foreach($messages as $message){
                echo $message.'<br>';
            }
        }

        return false;

    }
}



