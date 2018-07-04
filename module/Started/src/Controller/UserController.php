<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Started\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function loginAction()
    {
        $check = $this->getRequest();
        
        //isGet() //return true if is Get Method
        //isPost() //return true if is Post Method
        //isXmlHttpRequest() //return true if is Ajax Method

        if ($check->isGet())
        {
            //echo "isGet";
            //Get parameters from route
            $action = $this->params()->fromRoute('action','Not Found');// return Not Found if couldn't find the param
            $id = $this->params()->fromRoute('id',0);
            //echo $action. ' '. $id;
        }
        else if ($check->isPost())
        {
            //echo "isPost";
            $action = $this->params()->fromPost('name','Minh');
            $id = $this->params()->fromPost('id',0);  //Get the parameter from method post, return Minh if not contain 
            echo $action.' '.$id ;
            //echo $_POST['name'];//another way to get method, return error if variable not contain
        }
        // else if ($check->isXmlHttpRequest())
        // {
        //     echo "isAjax";
        // }
        else 
        {
            $action= 'No action';
            $id = 0;
            echo "Other action";
        }
        //if id is less than 0, set error page
        if ($id<=0)
        {
            //$this->getResponse()->setStatusCode(404);//not found page
            //$this->getResponse()->setStatusCode(500);//empty page
            throw new \Exception("id $id not found");
            //return;
        }
        //echo $check->getMethod();//get the method
        //echo $check->getUriString();//Get the current url
        //pass parameters to view
        return new ViewModel([
            'id'=>$id,
            'action'=>$action,
        ]);
        //New way to render view to location wanted
        // $newView = new ViewModel([
        //     'id'=>$id,
        //     'action'=>$action,
        // ]);
        // $newView->setTemplate('started/index/index.phtml');
        // return $newView;
    }
}