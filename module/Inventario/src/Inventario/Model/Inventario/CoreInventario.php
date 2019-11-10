<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonio de la Paz
 * Date: 29/12/13
 * Time: 10:40 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Inventario\Model\Inventario;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Paginator;

class CoreInventario extends TableGateway
{

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('inventario', $adapter, $databaseSchema,$selectResultPrototype);
    }

    public function getInvAll()
    {
        $datos = $this->select(function (Select $select) {
            $select->join(array('l' => 'categorias'),'inventario.id_categoria = l.id');
            $select->join(array('p' => 'proveedores'),'inventario.id_proveedor = p.id');
        });
        return $datos->toArray();
    }

    public function getStockMinAll()
    {
        $datos = $this->select(function (Select $select) {
            $select->join(array('l' => 'categorias'),'inventario.id_categoria = l.id');
            $select->join(array('p' => 'proveedores'),'inventario.id_proveedor = p.id');
            $select->where(array('stock <= 5'));
        });
        return $datos->toArray();
    }

    public function getInv($where = null)
    {
        $datos = $this->select(array('id_inventario' => $where));

        return $datos->toArray();
    }

    public function getPlaces($id = null)
    {
        $datos = $this->select(array('id' => $id));
        return $datos->toArray();
    }

    public function setUpdates($data, $where)
    {
        $this->update($data, array('id_inventario' => $where));
    }

    public function addInv($datos)
    {
        $this->insert($datos);

        return $this->getLastInsertValue();
    }

    public function delInv($id)
    {
        $this->delete(array('id' => $id));
    }

}