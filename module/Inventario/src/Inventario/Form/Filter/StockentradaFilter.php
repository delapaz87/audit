<?php
namespace Inventario\Form\Filter;

use Zend\InputFilter\InputFilter;

class StockentradaFilter extends InputFilter
{

    public function __construct()
    {
        $isEmpty = \Zend\Validator\NotEmpty::IS_EMPTY;

        $this->add(array(
            'name' => 'codigo',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            $isEmpty => 'El campo no puede estar vacio.'
                        )
                    )
                )
            )
        ));
        $this->add(array(
        'name' => 'cantidad',
        'required' => true,
        'filters' => array(
            array(
                'name' => 'StripTags'
            ),
            array(
                'name' => 'StringTrim'
            )
        ),
        'validators' => array(
            array(
                'name' => 'NotEmpty',
                'options' => array(
                    'messages' => array(
                        $isEmpty => 'El campo no puede estar vacio.'
                    )
                )
            )
        )
    ));
        $this->add(array(
            'name' => 'numero_ordencompras',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            $isEmpty => 'El campo no puede estar vacio.'
                        )
                    )
                )
            )
        ));
        $this->add(array(
            'name' => 'fecha_entrada',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            $isEmpty => 'El campo no puede estar vacio.'
                        )
                    )
                )
            )
        ));
    }
}