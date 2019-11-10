<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Inventario\Controller\Core',
                        'action'     => 'dashboard',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'dashboard' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/dashboard',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'dashboard',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'reportes' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/reportes/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'reportes',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'operaciones' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/operaciones/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'operaciones',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'invprincipal' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'invprincipal',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'addarticulo' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'addarticulo',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'editarticulo' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/edit/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'editarticulo',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'addarticulostock' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/addstock/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'addarticulostock',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'salidastock' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/salida/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'salidastock',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'addmercancia' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/addmercancia',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'addmercancia',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'stockmini' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/stockmini/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'stockmini',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'kardex' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/kardex/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'kardex',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'historysalida' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/salidas/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'historysalida',
                    ),
                ),
            ),
            'kardex' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/kardex/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'kardex',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'categorias' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/categorias/[page/:page]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'viewcategorias',
                        'id' => 1,
                    ),
                ),
            ),
            'addcategoria' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/categorias/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'addcategoria',
                    ),
                ),
            ),
            'editcategoria' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/categorias/edit/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'editcategoria',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'deletecategoria' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/categorias/del/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'deletecategoria',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'proveedores' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/proveedores/[page/:page]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'proveedores',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'addproveedor' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/proveedores/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'addproveedor',
                    ),
                ),
            ),
            'editproveedor' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/proveedores/edit/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'editproveedores',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'viewproveedor' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/proveedores/view/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'viewproveedores',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'deleteproveedor' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/proveedores/del/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'deleteproveedores',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'users' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/[page/:page]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'viewusers',
                        'page' => 1,
                    ),
                ),
            ),
            'addusers' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'adduser',
                    ),
                ),
            ),
            'edituser' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/edit/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'edituser',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'viewuser' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/users/view/[id/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'viewuser',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'registro_add' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/add[/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'add',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'perfil' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/perfil',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'perfil',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
            'editperfil' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/perfil/edit/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'editperfil',
                    ),
                ),
            ),
            'changerpassword' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/perfil/password/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'changerpassword',
                    ),
                ),
            ),
            'infoperfil' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/perfil/info/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Core',
                        'action'        => 'infoperfil',
                    ),
                ),
            ),
            'rptinventarioxls' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/reporte/inventario',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Reportes',
                        'action'        => 'rptinventarioxls',
                    ),
                ),
            ),
            'rptstockminixls' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/reporte/stockmini',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Reportes',
                        'action'        => 'rptstockminixls',
                    ),
                ),
            ),
            'rptproveedoresxls' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/reporte/proveedores',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Reportes',
                        'action'        => 'rptproveedoresxls',
                    ),
                ),
            ),
            'rptsalidasxls' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/inventario/reporte/salidas',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inventario\Controller',
                        'controller'    => 'Reportes',
                        'action'        => 'rptsalidasxls',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Inventario\Controller\Core' => 'Inventario\Controller\CoreController',
            'Inventario\Controller\Reportes' => 'Inventario\Controller\ReportesController'
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'status' => 'Inventario\View\Helper\Status',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'inventario/core/dashborad' => __DIR__ . '/../view/inventario/core/dashborad.phtml',
        ),
        'template_path_stack' => array(
            'core' => __DIR__ . '/../view',
        ),
    ),
);
