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
use Zend\Validator\InArray;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;
use Zend\Validator\File\Exists;
use Zend\Validator\File\Extension;
use Zend\Validator\File\Size;
use Zend\Validator\File\ImageSize;
use Zend\Validator\File\IsImage;
use Zend\Validator\File\IsCompressed;
use Zend\Validator\File\WordCount;
use Zend\Validator\PasswordStrength;






class ValidatorController extends AbstractActionController{
    //validate string length
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
    //validate number value in range
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
    //Validate type of date
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
    //validate type of email
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
    //validate if a number has only digit 
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
    //validate if a number is greater than a given value
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
    //validate if a number is less than a given value
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
    //validate if a variable is in an array
    public function inArrayAction(){
        $validator = new InArray([
            'haystack'=>['value1','value2',100,'valueN'],
            'strict'=>InArray::COMPARE_NOT_STRICT_AND_PREVENT_STR_TO_INT_VULNERABILITY
        ]);
        $var=0;

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
    //validate if variable is in an recursize array
    public function inArrayRecursiveAction(){
        $validator = new InArray([
            'haystack'=>[
                'key1'=>[1,2,3,4,5],
                'key2'=>[6,7,8,9,10],
            ],
            'strict'=>InArray::COMPARE_NOT_STRICT_AND_PREVENT_STR_TO_INT_VULNERABILITY,
            'recursive'=>false
        ]);
        //$var=1 //False
        $var = [6,7,8,9,10];//True

        if ($validator->isValid($var)){
            print_r($var);
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
    //check if variable is empty or not
    public function notEmptyAction(){
        //use | for or, , for and
        $validator = new NotEmpty([
            NotEmpty::STRING,
        ]);

        //$var ="";//False
        $var ='fdsa';//True

        if ($validator->isValid($var)){
            print_r($var);
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
    //check if variable contains some given characters
    public function regexAction(){
        // $validator = new Regex([
        //     'pattern'=>"/^Zend/", //string with Zend at the start
        // ]);
        // $var ="aZend fdsaf";

        $validator = new Regex([
            //'pattern'=>"/^[\d]{5}$/" //d is number, 5 digits
            'pattern'=>'/^[a-zA-z]*$/' //string without number
            
        ]);

        $var = "dfsa5";

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
    //check if file exists
    public function fileExistsAction(){
        $validator = new Exists();
        $file = APPLICATION_PATH.'/public/files/check.txt';
        
        if ($validator->isValid($file)){
            echo 'File exists';
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
    //check the extension of file
    public function fileExtensionAction(){
        $validator = new Extension([
            'extension'=>['php','png','jpg'],
            'case'=>true//distinguish between Upper case and lower case
        ]);
        $file = APPLICATION_PATH.'/public/files/check.png';

        if ($validator->isValid($file)){
            echo 'file with correct extension';
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
    //check the size of file
    public function fileSizeAction(){
        $validator = new Size([
            'min'=>1024,//1kb
            'max'=>10240//10kb
        ]);
        $file = APPLICATION_PATH.'/public/files/check.txt';

        if ($validator->isValid($file)){
            echo 'file with correct size';
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
    //check the width and length of image file
    public function fileImageSizeAction(){
        // $validator = new ImageSize([
        //     'minwidth'=> 200,
        //     'maxwidth'=>1500,
        //     'minheight'=>200,
        //     'maxheight'=>1000
        // ]);
        $validator = new ImageSize(300,200,1500,1000);
        $file = APPLICATION_PATH.'/public/files/Capture.PNG';

        if ($validator->isValid($file)){
            echo 'image with correct size';
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
    //check if file is image
    public function isImageAction(){
        $validator = new IsImage();
        $file = APPLICATION_PATH.'/public/files/capture.PNG';

        if ($validator->isValid($file)){
            echo 'file is image';
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
    //check if file is a compressed file
    public function isCompressedAction(){
        $validator = new IsCompressed();
        $file = APPLICATION_PATH.'/public/files/check.zip';

        if ($validator->isValid($file)){
            echo 'file is a compressed file';
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
    //check word count in a file
    public function wordCountAction(){
        $validator = new WordCount([
            'min'=>5,
            'max'=>600,
        ]);
        $file = APPLICATION_PATH.'/public/files/check.txt';

        if ($validator->isValid($file)){
            echo 'file has enough word';
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
    //password check
    public function passwordAction(){
        $validator = new PasswordStrength();

        $pass = "fsdfwe123@A";

        if ($validator->isValid($pass)){
            echo 'Correct password';
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



