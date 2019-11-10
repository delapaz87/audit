<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonio de la Paz
 * Date: 29/12/13
 * Time: 10:40 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Inventario\Model\Categorias;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Paginator;

class CoreCategorias extends TableGateway
{

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('categorias', $adapter, $databaseSchema,$selectResultPrototype);
    }

    public function getCategAll()
    {
        $datos = $this->select(function (Select $select) {
            $select->order(array('categoria ASC'));
        });
        return $datos->toArray();
    }

    public function getCate($where = null)
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

    public function addCateg($datos = null)
    {
        $this->insert($datos);
    }

    public function delCateg($id)
    {
        $this->delete(array('id' => $id));
    }

}