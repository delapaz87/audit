<?php
namespace Inventario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class UserseditForm extends Form
{
    public $dbadapter;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setAttributes(array(
                                    'name' => 'usereditForm',
                                    'method' =>'post',
                                    'class' => 'form-horizontal',
                                    'role' => 'form',
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'dni',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'DNI',
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nombre/Apellidos',
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'celular',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Celular',
            )));

       
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