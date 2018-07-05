<?php

namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\ValidatorChain;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;

class ValidatorChainController extends AbstractActionController{
    public function indexAction(){

        $validatorChain = new ValidatorChain();
        //true:break if error; 1,2,3: priority
        $validatorChain->attach(new StringLength(['min'=>6,'max'=>20]),true,1);
        $validatorChain->attach(new Regex('/[a-zA-Z0-9]/'),true,2);
        $validatorChain->attach(new Regex('/[!@#$%^&*;:]/'),true,3);

        $value = "12345@";
        if ($validatorChain->isValid($value))
        {
            echo "Right data";
        }
        else 
        {
            $messages= $validatorChain->getMessages();
            foreach($messages as $message)
            {
                echo $message."<br>";
            }

        }
        return false;

    }
}