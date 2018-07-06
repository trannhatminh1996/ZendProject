<?php

namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Form\Form;
use Form\Form\Login;

class InputFilterController extends AbstractActionController{

    public function indexAction(){
        $form = new Login();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()){
                $data = $form->getData();
                print_r($data);
            }
            // else 
            // {
            //     $messages = $form->getMessages();
            //     foreach($messages as $message)
            //     {
            //         print_r($message);
            //         echo "<br>";
            //     }
            // }
        }
        $view = new ViewModel(['form'=>$form]);
        $view->setTemplate('form/input-filter/login');
        return $view;

    }
}