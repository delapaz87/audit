<?php
namespace Inventario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class UsersForm extends Form
{
    public $dbadapter;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setAttributes(array(
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
            'name' => 'email',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Email',
            )
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
            'type' => 'text',
            'name' => 'celular',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Celular',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Activo',
                'value_options' => array(
                    '' => 'Selecionar',
                    'Y' => 'Activo',
                    'N' => 'Desactivado',
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'rol',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Rol',
                'value_options' => array(
                    '' => 'Selecionar',
                    '3' => 'Register',
                    '2' => 'Inventariador',
                    '1' => 'Administrador'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'created_on',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'modified_on',
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
        ));
        
        $this->add(array(
            'name' => 'reset',
            'attributes' => array(
                'type' => 'reset',
                'value' => 'Cancelar',
                'class' => 'btn btn-default',
                'data-dismiss' => 'modal'
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