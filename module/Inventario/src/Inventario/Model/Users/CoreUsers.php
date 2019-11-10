<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonio de la Paz
 * Date: 29/12/13
 * Time: 10:40 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Inventario\Model\Users;

use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Paginator;

class CoreUsers extends TableGateway
{

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('users', $adapter, $databaseSchema,$selectResultPrototype);
    }

    public function getUsersAll()
    {
        $datos = $this->select(function (Select $select) {
            $select->join(array('u' => 'user_role'),'users.user_id = u.user_id');
            $select->join(array('l' => 'role'),'u.role_id = l.rid');
        });
        return $datos->toArray();
    }

    public function getUser($where = null)
    {
        $datos = $this->select(function (Select $select) use ($where) {
            $select->join(array('u' => 'user_role'),'users.user_id = u.user_id');
            $select->join(array('l' => 'role'),'u.role_id = l.rid',array('role_status' => 'status'))->where(array('users.user_id' => $where));
        });
        return $datos->toArray();
    }

    public function getPlaces($id = null)
    {
        $datos = $this->select(array('id' => $id));
        return $datos->toArray();
    }

    public function setUpdates($data, $where)
    {
        $this->update($data, array('user_id' => $where));
    }

    public function addUser()
    {
        $datos = $this->select();
        return $datos->toArray();
    }

    public function delUsers()
    {
        $datos = $this->select();
        return $datos->toArray();
    }

}