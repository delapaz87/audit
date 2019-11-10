<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonio de la Paz
 * Date: 29/12/13
 * Time: 10:40 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Inventario\Model\Proveedores;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Paginator;

class CoreProveedores extends TableGateway
{

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('proveedores', $adapter, $databaseSchema,$selectResultPrototype);
    }

    public function getProveedoresAll()
    {
        $datos = $this->select(function (Select $select) {
            $select->order(array('razon_social ASC'));
        });
        return $datos->toArray();
    }

    public function getProveedores($where = null)
    {
        $datos = $this->select(array('id' => $where));

        return $datos->toArray();
    }

    public function getPlaces($id = null)
    {
        $datos = $this->select(array('id' => $id));
        return $datos->toArray();
    }

    public function setUpdates($data, $where)
    {
        $this->update($data, array('id' => $where));
    }

    public function addProveedores($data)
    {
        $this->insert($data);
    }

    public function delProveedores($id)
    {
        $this->delete(array('id' => $id));
    }

}