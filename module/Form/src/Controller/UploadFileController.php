<?php 

namespace Form\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Form\Form;
use Form\Form\UploadFile;
use Zend\File\Transfer\Adapter\Http;
use Zend\Filter\File\Rename;
use Zend\Validator\File\Size;
class UploadFileController extends AbstractActionController{

    public  function indexAction(){
        $form = new UploadFile();

        if ($this->getRequest()->isPost())
        {
            $file = $this->getRequest()->getFiles()->toArray();
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // $fileUpload = new Http();
            // $fileInfo = $fileUpload-> getFileInfo();
            // echo "<pre>";
            // print_r($fileInfo);
            // echo "</pre>";
            //echo $fileUpload->getFileSize();
            //echo $fileUpload->getFileName();

            // $fileUpload->setDestination(FILE_PATH.'/file-upload');
            // $fileUpload->receive();
            $form->setData($file);

            if ($form->isValid())
            {
                $fileFilter = new Rename([
                    'target'=>FILE_PATH.'/file-upload/'.$file['file-upload']['name'],
                    'randomize'=>true,
                ]);
    
                $fileFilter->filter($file['file-upload']);
                echo "Uploaded";
            }
            // else 
            // {
            //     $messages = $form->getMessages();
            //     foreach ($messages as $message){
            //         print_r($message);
            //         echo "<br>";
            //     }
            // }
        }
        $view= new ViewModel([
            'form'=>$form,            
        ]);
        $view->setTemplate('form/upload-file/index');
        return $view;
    }

    public function uploadMultipleFilesAction(){
        $form = new UploadFile;

        if ($this->getRequest()->isPost())
        {
            $file = $this->getRequest()->getFiles()->toArray();
            $form->setData($file);

            if ($form->isValid())
            {
                $data = $form->getData();
                $checkImage = true;
                $errorMsg =[];
                foreach($data['file-upload'] as $image)
                {
                    $thisCheck = $this->checkSize($image,$errorMsg);
                    if ($thisCheck[0]==false)
                    {
                        $checkImage=false;
                    }
                }
                if ($checkImage)
                {
                    foreach($data['file-upload'] as $image)
                    {
                        $fileFilter = new Rename([
                            'target'=>FILE_PATH.'/file-upload/'.$image['name'],
                            'randomize'=>true,
                        ]);
            
                        $fileFilter->filter($image);
                    }
                    echo "Uploaded";
                }
                else 
                {
                    foreach ($errorMsg as $error)
                    {
                        echo $error ."<br>";
                    }
                }
            }
        }
        $view= new ViewModel([
            'form'=>$form,            
        ]);
        $view->setTemplate('form/upload-file/multiple');
        return $view;
    }

    public function checkSize($file, &$errorMsg){
        $check = true;
        $validator = new Size([
            'max'=>200,
        ]);
        $validator->setMessages([
            Size::TOO_BIG=>'File exceeds %max%',
        ]);

        if ($validator->isValid($file)){
            $check=true;
        }
        else 
        {
            $check = false;
            $messages = $validator->getMessages();
            foreach($messages as $message){
                array_push($errorMsg,$message);
            }
        }
        $a = 100;
        return $check;

    }

}
