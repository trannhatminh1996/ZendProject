<?php
namespace Form\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class FormElement extends Form
{
    public function __construct(){
        parent::__construct();
        //create new form
        $fullname = new Element\Text('fullname');
        $fullname->setLabel('Full name: ');//set label
        $fullname->setLabelAttributes([
            'id'=>'fullname',
            'class'=>'control-lable'
        ]);
        $fullname->setAttributes(array(
            'class' =>'form-control',//set class
            'id'=>'fullname',//set id
            'placeholder'=>"Insert full name: ",//set place holder
        ));
        //add form 
        $this->add($fullname);

        //hidden form
        $hidden = new Element('hidden_input');
        $hidden->setAttributes([
            'type'=>'hidden',
            'value'=>'Tran Nhat Minh',
        ]);

        $this->add($hidden);
        //age
        $age = new Element\Number('age');
        $age->setLabel('Input age:');
        $age->setLabelAttributes([
            'id'=>'age',
            'class'=>'control-lable',
        ]);
        $age->setAttributes([
            'min'=>10,
            'max'=>50,
            'class'=>'form-control',
            'id'=>'age'
        ]);

        $this->add($age);
        //email
        $email = new Element\Email('my_email'); //element with email type
        $email->setLabel('Input email:');
        $email->setLabelAttributes([
            'id'=>'my_email',
            'class'=>'control-label',
        ]);
        $email->setAttributes([
            'id'=>'my_email',
            'class'=>'form-control',
            'placeholder'=>'Enter email',
            'required'=>true
        ]);
        $this->add($email);

        //password
        $password = new Element\Password('my_password');
        $password->setLabel('Input password: ');
        $password->setLabelAttributes([
            'id'=>'password',
            'class'=>'control-label',
        ]);
        $password->setAttributes([
            'id'=>'password',
            'class'=>'form-control',
            'placeholder'=>'Enter password',
            'minlength'=>8,
            'required'=>true
        ]);

        $this->add($password);

        //gender
        $gender = new Element\Radio('gender');
        $gender->setLabel('Choose gender:');
        $gender->setLabelAttributes([
            'id'=>'gender',
            'class'=>'control-label'
        ]);
        $gender->setAttributes([
            'id'=>'gender',
            'value'=>'male',
            'style'=>'margin-left:20px;'
        ]);

        $gender->setValueOptions([
            'male'=>'Male',
            'female'=>'Female',
            'other'=>'Other'
        ]);
        $this->add($gender);

        //select
        $select = new Element\Select('my_select');
        $select->setLabel('Choose subjects:');
        $select->setLabelAttributes([
            'id'=>'select',
            'class'=>'control-label',
        ]);
        $select->setAttributes([
            'class'=>'form-control',
            'id'=>'select',
            'multiple'=>true
        ]);

        $select->setValueOptions([
            'php'=>'PHP',
            'python'=>'PYTHON',
            'ruby'=>'RUBY',
            'c#'=>'C#'
        ]);

        $this->add($select);
        
        //textarea
        $textarea = new Element\Textarea('message');
        $textarea->setLabel('Input message:');
        $textarea->setLabelAttributes([
            'id'=>'message',
            'class'=>'control-label'
        ]);
        $textarea->setAttributes([
            'id'=>'message',
            'class'=>'form-control',
            'rows'=>8,
            'style'=>'resize:none;'
        ]);
        $this->add($textarea);

        //file
        $file = new Element\File('my_file');
        $file->setLabel('Input profile picture: ');
        $file->setLabelAttributes([
            'id'=>'image',
            'class'=>'control-label',
        ]);
        $file->setAttributes([
            'id'=>'image',
            'class'=>'form-control'
        ]);

        $this->add($file);

        //checkbox
        $checkbox = new Element\Checkbox('my_checkbox');
        $checkbox->setLabel('Remember me: ');
        $checkbox->setLabelAttributes([
            'id'=>'remember',
            'class'=>'control-label'
        ]);
        $checkbox->setAttributes([
            'id'=>'remember',
            'checked'=>true
        ]);
        $this->add($checkbox);

        //multicheckbox
        $multiCheckbox = new Element\MultiCheckbox('my_multiCheckbox');
        $multiCheckbox->setLabel('Choose your hobbies:');
        $multiCheckbox->setLabelAttributes([
            'id'=>'multicheck',
            'class'=>'control-label',
        ]);
        $multiCheckbox->setAttributes([
            'id'=>'multicheck',
        ]);
        $multiCheckbox->setValueOptions([
            'football'=>'Football',
            'guitar'=>'Guitar',
            'swimming'=>'Swimming',
            'games'=>'Games'
        ]);
        $this->add($multiCheckbox);

        //color
        $this->add([
            'name'=>'my_color',
            'type'=> Element\Color::class,
            'options'=>[
                'id'=>'color',
                'label'=>'Choose color: '
            ],
            'attributes'=>[
                'id'=>'color',
                'value'=>'#ABC123'
            ]
        ]);

        //date
        $this->add([
            'name'=>'date',
            'type'=>'Date',
            'attributes'=>[
                'class'=>'form-control',
                'id'=>'birthday',
            ],
            'options'=>[
                'label'=>'Choose birthday:',
                'label_attributes'=>[
                    'id'=>'birthday',
                    'class'=>'control-label',
                ]
            ]
        ]);

        //range
        $this->add([
            'name'=>'my_range',
            'type'=>'range',
            'attributes'=>[
                'min'=>5,
                'max'=>20,
                'value'=>15,
                'class'=>'form-control',
                'id'=>'my_range'
            ],
            'options'=>[
                'label'=>'Choose a number: ',
                'label_attributes'=>[
                    'id'=>'my_range',
                    'class'=>'control-label',
                ]
            ],

        ]);

        //reset button
        $this->add([
            'name'=>'btnReset',
            'type'=>'button',
            'attributes'=>[
                'id'=>'btnReset',
                'class'=>'btn btn-primary',
                'type'=>'reset'
            ],
            'options'=>[
                'label'=>'Reset'
            ]
        ]);


        //submit button
        $this->add([
            'name'=>'btnSubmit',
            'type'=>'submit',
            'attributes'=>[
                'id'=>'btnSubmit',
                'class'=>'btn btn-success',
                'value'=>'Send',
            ],
        ]);

        //captcha image
        $this->add([
            'name'=>'captchaImage',
            'type'=>'captcha',
            'options'=>[
                'label'=>' Enter the string: ',
                'captcha'=>[
                    'class'=>'Image',
                    'imgDir'=>'public/img/captcha',
                    'imgUrl'=>'/img/captcha',
                    'suffix'=>'.png',
                    'font'=>APPLICATION_PATH."/data/font/Pacifico-Regular.ttf",
                    'fsize'=>50,
                    'width'=>400,
                    'height'=>150,
                    'dotNoiseLevel'=>200,
                    'lineNoiseLevel'=>5,
                    'expiration'=>120
                ]
            ]
        ]);
    }
}

?>