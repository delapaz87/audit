<?php
return array(
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ZF2AuthAcl\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                )
            ),
            'logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ZF2AuthAcl\Controller',
                        'controller' => 'Index',
                        'action' => 'logout'
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'ZF2AuthAcl\Controller\Index' => 'ZF2AuthAcl\Controller\IndexController'
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/login'           => __DIR__ . '/../view/layout/login.phtml',
            'layout/core'           => __DIR__ . '/../view/layout/core.phtml',
            'zf2-auth-acl/index/index' => __DIR__ . '/../view/zf2-auth-acl/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'layout' => 'layout/login',
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    )
);
