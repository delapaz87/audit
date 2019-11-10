<?php
namespace Inventario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class ProveedoresForm extends Form
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
            'name' => 'ruc',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'RUC',
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'razon_social',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Razon Social',
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'nombre',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nombre de Contacto',
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'direccion',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Dirección',
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'telefono',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Telefono',
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
            'type' => 'text',
            'name' => 'ciudad',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Ciudad',
            )
        ));
        $this->add(array(
            'type' => 'text',
            'name' => 'url',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Sitio Web',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'observacion',
            'attributes' => array(
                'class' => 'form-control',
                'row'   =>  '3'
            ),
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