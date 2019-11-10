<?php
namespace Inventario\Form\Filter;

use Zend\InputFilter\InputFilter;

class ProveedoresFilter extends InputFilter
{

    public function __construct()
    {
        $isEmpty = \Zend\Validator\NotEmpty::IS_EMPTY;
        $isEMAIL = \Zend\Validator\EmailAddress::INVALID_FORMAT;

        $this->add(array(
            'name' => 'ruc',
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
                            $isEmpty => 'El campo RUC es de caracter obligatorio.'
                        )
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'email',
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
                            $isEmpty => 'El campo email es de caracter obligatorio.'
                        )
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'razon_social',
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