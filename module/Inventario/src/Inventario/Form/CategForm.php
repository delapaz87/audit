<?php
namespace Inventario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class CategForm extends Form
{
    public $dbadapter;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setAttributes(array(
                                    'method' =>'post',
                                    'class' => 'form-horizontal',
                                    'role' => 'form'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'categoria',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Categoria',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
        ));

        $this->add(array(
            'name' => 'reset',
            'attributes' => array(
                'data-dismiss' => 'modal',
                'type' => 'reset',
                'value' => 'Cancelar',
                'class' => 'btn btn-default'
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