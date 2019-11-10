<?php
namespace Inventario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class PasswordForm extends Form
{
    public $dbadapter;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setAttributes(array(
                                    'name' => 'passwordForm',
                                    'method' =>'post',
                                    'class' => 'form-horizontal',
                                    'role' => 'form',
        ));


        $this->add(array(
            'type' => 'password',
            'name' => 'password',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Contraseña',
            )
        ));

        $this->add(array(
            'type' => 'password',
            'name' => 'password_repeat',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Repetir contraseña',
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'class' => 'btn btn-primary'
            )
        ));
    }
}