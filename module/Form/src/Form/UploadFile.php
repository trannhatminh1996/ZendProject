<?php
namespace Form\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;


class UploadFile extends Form{
    public function __construct(){
        parent::__construct();

        // $this->add([
        //     'name'=>'file-upload',
        //     'attributes'=>[
        //         'type'=>'file',
        //         'multiple'=>true,//can choose multiple file
        //     ],
        //     'options'=>[
        //         'label'=>'Choose File',
        //     ],
        // ]);

        $myfile = new Element('file-upload');
        $myfile->setAttributes([
            'multiple'=>true,
            'type'=>'file',
        ]);
        $myfile->setLabel('Choose File:');

        $this->add($myfile);

        $this->add([
            'name'=>'btnSubmit',
            'type'=>'submit',
            'attributes'=>[
                'id'=>'btnSubmit',
                'class'=>'btn btn-success',
                'value'=>'Upload',
            ],
        ]);
    }

    public function uploadInputFilter(){
        // $fileUpload = new InputFilter('file-upload');
        // $fileUpload->setRequired(true);

        // //filesize
        // $size = new \Zend\Validator\File\Size([
        //     'max'=>200*1024,
        // ]);

        // $size->setMessages([
        //     \Zend\Validator\File\Size::TOO_BIG=>'File exceeds %max%',
        // ]);

        // $type = new \Zend\Validator\File\MimeType('image/png','image/jpeg','image/jpg');

        // $type->setMessages([
        //     \Zend\Validator\File\MimeType::FALSE_TYPE =>" Can't choose file with type: %type%",
        //     \Zend\Validator\File\MimeType::NOT_DETECTED=>"File can't be detected",
        //     \Zend\Validator\File\MimeType::NOT_READABLE=>"File can't be read"
        // ]);

        // $fileUpload->getValidatorChain()->attach($size,true,2)->attach($type,true,1);

        // $inputFilter = new InputFilter\Inputfilter();
        // $inputFilter->add($fileUpload);
        // $this->setInputFilter($inputFilter);

        $fileUpload = new InputFilter();
        $this->setInputFilter($fileUpload);

        $fileUpload->add([
            'name'=>'file-upload',
            'required'=>true,
            'validators'=>[
                [
                    'name'=>\Zend\Validator\File\Size::class,
                    'options'=>[
                        'max'=>200*1024,
                        'messages'=>[
                            \Zend\Validator\File\Size::TOO_BIG=>'File exceeds %max%',
                        ],
                    ],
                ],
                [
                    'name'=>\Zend\Validator\File\MimeType::class,
                    'options'=>[
                        'mimeType'=>['image/png','image/jpeg','image/jpg'],
                        'messages'=>[
                            \Zend\Validator\File\MimeType::FALSE_TYPE =>" Can't choose file with type: %type%",
                            \Zend\Validator\File\MimeType::NOT_DETECTED=>"File can't be detected",
                            \Zend\Validator\File\MimeType::NOT_READABLE=>"File can't be read",
                        ],
                    ],
                ],
            ],
        ]);


    }
}