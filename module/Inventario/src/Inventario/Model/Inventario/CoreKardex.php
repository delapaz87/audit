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

class CoreKardex extends TableGateway
{

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('kardex', $adapter, $databaseSchema,$selectResultPrototype);
    }
    
    public function addKardex($datos)
    {
         $this->insert($datos);
    }
    
    public function getKardex($where = null)
    {
        $datos = $this->select(function (Select $select) use ($where) {
            $select->join(array('l' => 'inventario'),'kardex.id_inventario = l.id_inventario',array('fechaentrada' => 'fecha_entrada','codigo' => 'codigo','productos' => 'productos'))->where(array('kardex.id_inventario' => $where));;
        });

        return $datos->toArray();
    }

    public function getSalidaKardex()
    {
        $datos = $this->select(function (Select $select) {
            $select->join(array('l' => 'inventario'),'kardex.id_inventario = l.id_inventario',array('fechaentrada' => 'fecha_entrada','codigo' => 'codigo','productos' => 'productos'))->where(array('kardex.tipo_operacion' => 'Salida'));;
        });

        return $datos->toArray();
    }

     public function setUpdates($data, $where)
    {
        $this->update($data, array('id_inventario' => $where));
    }

     public function delKardex($id)
    {
        $this->delete(array('id' => $id));
    }

}