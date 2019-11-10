<?php
namespace Inventario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class StockForm extends Form
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
            'name' => 'codigo',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Codigo de Barra',
            )
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'productos',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Productos',
            )
        ));
        

        $this->add(array(
            'type' => 'text',
            'name' => 'cantidad',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cantidad',
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tipo_moneda',
            'attributes' => array(

            ),
            'options' => array(
                'label' => 'Tipo de Moneda',
                'disable_inarray_validator' => true,
                'value_options' => array(
                    '' => 'Selecionar',
                    'SOL' => 'SOL',
                    'USD' => 'USD'
                ),
            )
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'precio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Precio',
            )
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'fecha_entrada',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'datetimepicker1',
            ),
            'options' => array(
                'label' => 'Fecha de Entrada',
            )
        ));
        $this->add(array(
            'type' => 'text',
            'name' => 'fecha_salida',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'datetimepicker1',
            ),
            'options' => array(
                'label' => 'Fecha de Salida',
            )
        ));
        $this->add(array(
            'type' => 'text',
            'name' => 'numero_ordencompras',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'No Orden de Compras',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'descripcion',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Descripcion',
                
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
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