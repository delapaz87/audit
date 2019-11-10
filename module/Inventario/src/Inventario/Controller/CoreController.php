<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\Controller;

use Inventario\Form\Filter\ArticuloFilter;
use Inventario\Form\Filter\PasswordFilter;
use Inventario\Form\Filter\StockentradaFilter;
use Inventario\Form\Filter\StocksalidaFilter;
use Inventario\Form\Filter\UsersFilter;
use Inventario\Form\PasswordForm;
use Inventario\Form\UserseditForm;
use Inventario\Form\UsersForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Inventario\Form\Filter\CategFilter;
use Inventario\Form\ProveedoresForm;
use Inventario\Form\Filter\ProveedoresFilter;
use Inventario\Form\CategForm;
use Inventario\Form\ArticuloForm;
use Inventario\Form\StockForm;
use Inventario\Model\Users\CoreUsers;
use Inventario\Model\Categorias\CoreCategorias;
use Inventario\Model\Proveedores\CoreProveedores;
use Inventario\Model\Inventario\CoreInventario;
use Inventario\Model\Inventario\CoreKardex;
use Zend\Session\Container;
use ZF2AuthAcl\Utility\UserPassword;

class CoreController extends AbstractActionController
{
    public $dbadapter;

    public function dashboardAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');
        
        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $proveedores = new CoreProveedores($this->dbadapter);
        $reginventario = new CoreInventario($this->dbadapter);

        $resultproveedores = $proveedores->getProveedoresAll();
        $resultinventario = $reginventario->getInvAll();
        $resultstockmini = $reginventario->getStockMinAll();

        $data['proveedores'] = $resultproveedores;
        $data['inventario'] = $resultinventario;
        $data['stockmini'] = $resultstockmini;


        return new ViewModel($data);
    }

    public function reportesAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        return new ViewModel();
    }
    public function operacionesAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        return new ViewModel();
    }
    public function invprincipalAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $invgeneral = new CoreInventario($this->dbadapter);

        $result = $invgeneral->getInvAll();

        $data['inventario']= $result;

        return new ViewModel($data);
    }
    public function addarticuloAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();

        $articuloForm = new ArticuloForm('articuloForm');
        $articuloForm->setInputFilter(new ArticuloFilter());

        //Base de Datos Inventario
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbinventario = new CoreInventario($this->dbadapter);

        //Base de Datos Categoria
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbcategoria = new CoreCategorias($this->dbadapter);

        $dbcatg = $dbcategoria->getCategAll();

        //Base de Datos Proveedores
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbproveedor = new CoreProveedores($this->dbadapter);

        $dbprovee = $dbproveedor->getProveedoresAll();

        //Base de Datos Kardex
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbkardex = new CoreKardex($this->dbadapter);

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

             $articuloForm->setData($datos);

            if ($articuloForm->isValid()) {

                $id_inventario = $dbinventario->addInv($datos);

                $dbkardex->addKardex(array('id_inventario' => $id_inventario,'cantidad' => $datos['stock'],'fecha_entrada' =>$datos['fecha_entrada'],'tipo_operacion' =>'Apertura'));

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
                return $this->redirect()->toRoute('invprincipal');
            }
        }

        $data['articuloForm'] = $articuloForm;
        $data['dbcategoria'] =  $dbcatg;
        $data['dbproveedor'] = $dbprovee;

        return new ViewModel($data);
    }
    public function editarticuloAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();
        $id = (int) $this->params()->fromRoute('id');

        $articuloForm = new ArticuloForm('articuloForm');
        $articuloForm->setInputFilter(new ArticuloFilter());

        //Base de Datos Inventario
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbinventario = new CoreInventario($this->dbadapter);

        $result = $dbinventario->getInv($id);

        //Base de Datos Categorias
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbcategoria = new CoreCategorias($this->dbadapter);

        $dbcatg = $dbcategoria->getCategAll();

        //Base de Datos Proveedor
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbproveedor = new CoreProveedores($this->dbadapter);

        $dbprovee = $dbproveedor->getProveedoresAll();

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $articuloForm->setData($datos);

            if ($articuloForm->isValid()) {

                $dbinventario->setUpdates($datos,$datos['id_inventario']);

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
                return $this->redirect()->toRoute('invprincipal');
            }
        }

        $data['articuloForm'] = $articuloForm;
        $data['dbinventario'] = $result;
        $data['dbcategoria'] =  $dbcatg;
        $data['dbproveedor'] = $dbprovee;

        return new ViewModel($data);
    }
    public function addarticulostockAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();
        $id = (int) $this->params()->fromRoute('id');

        $stockForm = new StockForm('stockForm');
        $stockForm->setInputFilter(new StockentradaFilter());

        //Base de Datos Inventario
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbinventario = new CoreInventario($this->dbadapter);

        $result = $dbinventario->getInv($id);

        //Base de Datos Categorias
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbcategoria = new CoreCategorias($this->dbadapter);

        $dbcatg = $dbcategoria->getCategAll();

        //Base de Datos Proveedor
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbproveedor = new CoreProveedores($this->dbadapter);

        $dbprovee = $dbproveedor->getProveedoresAll();

        //Base de Datos Kardex
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbkardex = new CoreKardex($this->dbadapter);

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $stockForm->setData($datos);

            if ($stockForm->isValid()) {

                    $stock_updates = $result[0]['stock'] + $datos['cantidad'];

                    $dbinventario->setUpdates(array('stock' => $stock_updates),$datos['id']);

                    $dbkardex->addKardex(array('id_inventario' => $datos['id'],'cantidad' => $datos['cantidad'],'documento' => $datos['numero_ordencompras'],'fecha_entrada' => $datos['fecha_entrada'],'tipo_operacion' =>'Entrada'));

                    $this->flashMessenger()->addMessage(array(
                        'success' => 'Entrada de Almacen con Exito.'
                    ));


                return $this->redirect()->toRoute('invprincipal');
            }
        }

        $data['stockForm'] = $stockForm;
        $data['dbinventario'] = $result;
        $data['dbcategoria'] =  $dbcatg;
        $data['dbproveedor'] = $dbprovee;

        return new ViewModel($data);
    }

    public function salidastockAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();
        $id = (int) $this->params()->fromRoute('id');

        $stockForm = new StockForm('stockForm');
        $stockForm->setInputFilter(new StocksalidaFilter());

        //Base de Datos Inventario
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbinventario = new CoreInventario($this->dbadapter);

        $result = $dbinventario->getInv($id);

        //Base de Datos Categorias
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbcategoria = new CoreCategorias($this->dbadapter);

        $dbcatg = $dbcategoria->getCategAll();

        //Base de Datos Proveedor
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbproveedor = new CoreProveedores($this->dbadapter);

        $dbprovee = $dbproveedor->getProveedoresAll();

        //Base de Datos Kardex
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbkardex = new CoreKardex($this->dbadapter);

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $stockForm->setData($datos);

            if ($stockForm->isValid()) {

                if($result[0]['stock'] >= $datos['stock']){

                    $stock_updates = $result[0]['stock'] - $datos['cantidad'];

                    $dbinventario->setUpdates(array('stock' => $stock_updates),$datos['id']);

                    $dbkardex->addKardex(array('id_inventario' => $datos['id'],'cantidad' => $datos['cantidad'],'documento' => $datos['numero_ordencompras'],'descripcion' => $datos['descripcion'],'fecha_salida' => $datos['fecha_salida'],'tipo_operacion' =>'Salida'));

                    $this->flashMessenger()->addMessage(array(
                        'success' => 'Salida de Almacen con Exito.'
                    ));

                }else{

                    $this->flashMessenger()->addMessage(array(
                        'error' => 'Nos se puede dar salida de almacen a una cantidad mayor a la que hay en existencia.'
                    ));

                }

                return $this->redirect()->toRoute('invprincipal');
            }
        }

        $data['stockForm'] = $stockForm;
        $data['dbinventario'] = $result;
        $data['dbcategoria'] =  $dbcatg;
        $data['dbproveedor'] = $dbprovee;

        return new ViewModel($data);
    }
    public function addmercanciaAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();

        $articuloForm = new ArticuloForm('articuloForm');
        $articuloForm->setInputFilter(new ArticuloFilter());

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbinventario = new CoreInventario($this->dbadapter);

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbcategoria = new CoreCategorias($this->dbadapter);

        $dbcatg = $dbcategoria->getCategAll();

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbproveedor = new CoreProveedores($this->dbadapter);

        $dbprovee = $dbproveedor->getProveedoresAll();

        $invgeneral = new CoreInventario($this->dbadapter);

        $result = $invgeneral->getInvAll();

        $data['inventario']= $result;

        //Base de Datos Kardex
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $dbkardex = new CoreKardex($this->dbadapter);

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $articuloForm->setData($datos);

            if ($articuloForm->isValid()) {

                $id_inventario = $dbinventario->addInv($datos);

                $dbkardex->addKardex(array('id_inventario' => $id_inventario,'cantidad' => $datos['stock'],'fecha_entrada' =>$datos['fecha_entrada'],'tipo_operacion' =>'Apertura'));

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
                return $this->redirect()->toRoute('addmercancia');
            }
        }

        $data['articuloForm'] = $articuloForm;
        $data['dbcategoria'] =  $dbcatg;
        $data['dbproveedor'] = $dbprovee;

        return new ViewModel($data);
    }
    
    public function stockminiAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $invgeneral = new CoreInventario($this->dbadapter);

        $result = $invgeneral->getStockMinAll();

        $data['inventario']= $result;

        return new ViewModel($data);
    }

    public function kardexAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();
        $id = (int) $this->params()->fromRoute('id');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $kardex = new CoreKardex($this->dbadapter);

        $result = $kardex->getKardex($id);

        $data['kardex']= $result;

        return new ViewModel($data);
    }

    public function historysalidaAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $kardex = new CoreKardex($this->dbadapter);

        $result = $kardex->getSalidaKardex();

        $data['kardex']= $result;

        return new ViewModel($data);
    }

    public function registroAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        return new ViewModel();
    }

    public function addAction()
    {
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        return new ViewModel();
    }
    public function viewcategoriasAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $categ = new CoreCategorias($this->dbadapter);

        $result = $categ->getCategAll();

        $data['categitems']= $result;


        $categForm = new CategForm('categForm');
        $categForm->setInputFilter(new CategFilter());

        $data['catgForm'] = $categForm;
        return new ViewModel($data);

    }

    public function addcategoriaAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $view = new ViewModel();

        $request = $this->getRequest();

        //Formulario de Usuarios
        $categForm = new CategForm('categForm');
        $categForm->setInputFilter(new CategFilter());

        if ($request->isPost()) {

                $datos = array_merge_recursive(
                    $request->getPost()->toArray()
                 );

            $categForm->setData($datos);

            if ($categForm->isValid()) {

                //Base de Datos
                $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $categ = new CoreCategorias($this->dbadapter);

                $categ->addCateg($datos);

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
                return $this->redirect()->toRoute('addcategoria');
            }else{
                $this->flashMessenger()->addMessage(array(
                    'error' => $categForm->getMessages()
                ));

            }
        }

        $view->setVariable('catgForm',$categForm);
        return $view->setTerminal(true);

    }

    public function editcategoriaAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();
        $id = (int) $this->params()->fromRoute('id');

        //Formulario de Usuarios
        $categForm = new CategForm('categForm');
        $categForm->setInputFilter(new CategFilter());


        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $categForm->setData($datos);

            if ($categForm->isValid()) {

                //Base de Datos
                $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $categ = new CoreCategorias($this->dbadapter);

                $categ->setUpdates($datos,$datos['id']);

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
                return $this->redirect()->toRoute('categorias');
            }
        }

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $categ = new CoreCategorias($this->dbadapter);
        $result = $categ->getCate($id);

        $data['categorias'] = $result;
        $data['catgForm'] = $categForm;

        return new ViewModel($data);

    }



    public function deletecategoriaAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $id = (int) $this->params()->fromRoute('id');

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $categ = new CoreCategorias($this->dbadapter);

        $categ->delCateg($id);

        $this->flashMessenger()->addMessage(array(
            'success' => 'Los datos se elimino con exito.'
        ));

        return $this->redirect()->toRoute('categorias');
        return new ViewModel();
    }

    public function viewusersAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $users = new CoreUsers($this->dbadapter);

        $result = $users->getUsersAll();

        $data['users']= $result;

        //Formulario de Usuarios
        $usersForm = new UsersForm('usersForm');
        //$usersForm->setInputFilter(new CategFilter());

        $data['usersForm'] = $usersForm;

        return new ViewModel($data);

    }
    public function adduserAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $view = new ViewModel();
        //Formulario de Usuarios
        $usersForm = new UsersForm('usersForm');
        //$usersForm->setInputFilter(new CategFilter());
        $view->setVariable('usersForm',$usersForm);
        return $view->setTerminal(true);

    }
    public function edituserAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $id = (int) $this->params()->fromRoute('id');
        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $users = new CoreUsers($this->dbadapter);
        $result = $users->getUser($id);

        //Formulario de Usuarios
        $usersForm = new UsersForm('usersForm');
        //$usersForm->setInputFilter(new CategFilter());
        
        $data['users']= $result;
        $data['usersForm'] = $usersForm;

        return new ViewModel($data);

    }
    public function viewuserAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $id = (int) $this->params()->fromRoute('id');
        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $users = new CoreUsers($this->dbadapter);
        $result = $users->getUser($id);

        //Formulario de Usuarios
        $usersForm = new UsersForm('usersForm');
        //$usersForm->setInputFilter(new CategFilter());

        $data['users']= $result;
        $data['usersForm'] = $usersForm;

        return new ViewModel($data);

    }
    public function proveedoresAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');
        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $proveedores = new CoreProveedores($this->dbadapter);
        $result = $proveedores->getProveedoresAll();

        $data['proveedoresitems']= $result;

        $proveedorForm = new ProveedoresForm('proveedorForm');
        $proveedorForm->setInputFilter(new ProveedoresFilter());

        $data['proveedorForm'] = $proveedorForm;

        return new ViewModel($data);

    }
    public function viewproveedoresAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $id = (int) $this->params()->fromRoute('id');
        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $proveedores = new CoreProveedores($this->dbadapter);
        $result = $proveedores->getProveedores($id);

        $proveedorForm = new ProveedoresForm('proveedorForm');
        $proveedorForm->setInputFilter(new ProveedoresFilter());

        $data['proveedoresitems']= $result;
        $proveedorForm->setData($result);
        
        $data['proveedorForm'] = $proveedorForm;

        return new ViewModel($data);

    }

    public function editproveedoresAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $request = $this->getRequest();
        $id = (int) $this->params()->fromRoute('id');
        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $proveedores = new CoreProveedores($this->dbadapter);
        $result = $proveedores->getProveedores($id);

        $proveedorForm = new ProveedoresForm('proveedorForm');
        $proveedorForm->setInputFilter(new ProveedoresFilter());

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $proveedorForm->setData($datos);


            if ($proveedorForm->isValid()) {

                //Base de Datos
                $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $proveedores = new CoreProveedores($this->dbadapter);

                $proveedores->setUpdates($datos,$datos['id']);

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
               return $this->redirect()->toRoute('proveedores');
            }
        }

        $data['proveedoresitems']= $result;

        $data['proveedorForm'] = $proveedorForm;

        return new ViewModel($data);

    }
    public function addproveedorAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $view = new ViewModel();
        $request = $this->getRequest();

        //Formulario de Usuarios
        $proveedorForm = new ProveedoresForm('proveedorForm');
        $proveedorForm->setInputFilter(new ProveedoresFilter());

        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $proveedorForm->setData($datos);

            if ($proveedorForm->isValid()) {

                //Base de Datos
                $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $proveedores = new CoreProveedores($this->dbadapter);

                $proveedores->addProveedores($datos);

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
                return $this->redirect()->toRoute('addproveedor');
            }
        }
        
        $view->setVariable('proveedorForm',$proveedorForm);
        return $view->setTerminal(true);

    }
    public function deleteproveedoresAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');
        
        $id = (int) $this->params()->fromRoute('id');

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $proveedores = new CoreProveedores($this->dbadapter);

        $proveedores->delProveedores($id);

        $this->flashMessenger()->addMessage(array(
            'success' => 'Los datos se elimino con exito.'
        ));

        return $this->redirect()->toRoute('proveedores');
        return new ViewModel();
    }
    
    public function perfilAction(){
        
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $users = new CoreUsers($this->dbadapter);
        $result = $users->getUser($data['userID']);
        
        $usersForm = new UsersForm('usersForm');
        
        
        $data['usersForm'] = $usersForm;
        $data['result'] = $result;
        
        return new ViewModel($data);
    }

    public function infoperfilAction(){

        $this->layout('layout/core');
        $view = new ViewModel();

        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $users = new CoreUsers($this->dbadapter);
        $result = $users->getUser($data['userID']);

        $usersForm = new UsersForm('usersForm');


        $view->setVariable('usersForm',$usersForm);
        $view->setVariable('result',$result);

        return $view->setTerminal(true);
    }

    public function editperfilAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $view = new ViewModel();
        $request = $this->getRequest();

        $formuser = new UserseditForm();
        $formuser->setInputFilter(new UsersFilter());

        //Datos de usuarios
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $users = new CoreUsers($this->dbadapter);
        $result = $users->getUser($data['userID']);


        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );
            $formuser->setData($datos);

            if ($formuser->isValid()) {

                $dateFormat = new \DateTime('now');

                $fecha = $dateFormat->format('Y-m-d h:m:s');

               $users->setUpdates(array('dni' => $datos['dni'],'name' => $datos['name'],'celular' => $datos['celular'],'modified_on' => $fecha),$data['userID']);

                $this->flashMessenger()->addMessage(array(
                    'success' => 'Los datos se actualizaron con exito.'
                ));
            }
        }

        $view->setVariable('userForm',$formuser)
             ->setVariable('user',$result);

        return $view->setTerminal(true);
    }
    public function changerpasswordAction()
    {
        $this->layout('layout/core');
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $view = new ViewModel();
        $request = $this->getRequest();

        $formpassword = new PasswordForm();
        $formpassword->setInputFilter(new PasswordFilter());

        //Datos de usuarios
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $users = new CoreUsers($this->dbadapter);
        $result = $users->getUser($data['userID']);


        if ($request->isPost()) {

            $datos = array_merge_recursive(
                $request->getPost()->toArray()
            );

            $formpassword->setData($datos);

            if ($formpassword->isValid()) {

                if($datos['password'] == $datos['password_repeat'])
                {
                    $dateFormat = new \DateTime('now');
                    $fecha = $dateFormat->format('Y-m-d h:m:s');

                    $password = new UserPassword();

                    $users->setUpdates(array('password' => $password->create($datos['password']),'modified_on' => $fecha),$data['userID']);

                    $this->flashMessenger()->addMessage(array(
                        'success' => 'Los datos se actualizaron con exito.'
                    ));
                    return $this->redirect()->toRoute('infoperfil');

                }else{

                    $this->flashMessenger()->addMessage(array(
                        'error' => 'No coinciden los campos de contraseña.'
                    ));

                    return $this->redirect()->toRoute('changerpassword');
                }


            }
        }

        $view->setVariable('passwordForm',$formpassword);

        return $view->setTerminal(true);
    }
    
}
