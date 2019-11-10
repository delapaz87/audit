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

class ReportesController extends AbstractActionController
{
    public $dbadapter;

    public function rptinventarioxlsAction(){

        $this->layout('layout/core');
        $view = new ViewModel();
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $invgeneral = new CoreInventario($this->dbadapter);
        $result = $invgeneral->getInvAll();
        
        $view->setVariable('row',$result);

        return $view->setTerminal(true);
    }

    public function rptstockminixlsAction(){

        $this->layout('layout/core');
        $view = new ViewModel();
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $invgeneral = new CoreInventario($this->dbadapter);
        $result = $invgeneral->getStockMinAll();

        $view->setVariable('row',$result);

        return $view->setTerminal(true);
    }

    public function rptproveedoresxlsAction(){

        $this->layout('layout/core');
        $view = new ViewModel();
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        //Base de Datos
        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $proveedores = new CoreProveedores($this->dbadapter);
        $result = $proveedores->getProveedoresAll();

        $view->setVariable('row',$result);

        return $view->setTerminal(true);
    }

    public function rptsalidasxlsAction(){

        $this->layout('layout/core');
        $view = new ViewModel();
        $session = new Container('User');
        $data['userID'] = $session->offsetGet('userId');

        $this->dbadapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $kardex = new CoreKardex($this->dbadapter);
        $result = $kardex->getSalidaKardex();

        $view->setVariable('row',$result);

        return $view->setTerminal(true);
    }

}
