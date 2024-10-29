<?php
namespace models;
use DBConection;

class BaseModel extends DBConection
{
    public $tableName;
    public $primaryKey = 'id';
    public $columns = '';
    public $query = null;
    public $where = null;
    public $select = '';
    public $connection = null;
    public $innerJoin;
    public $insertDataColumn = '';
    public $insertDataValue = '';
    public $upDataReady = '';

    public $orderBy = null;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->connection = $this->conaction();
    }

    public function select($columns = '*')
    {
        $this->select = "SELECT $columns ";
        return $this;
    }

    public function where($column, $value = '', $operator = '=')
    {
        $perWhere = $this->where != null ? 'AND' : 'WHERE';
        $this->where .= " $perWhere ($column $operator '$value')";
        return $this;
    }
    public function radyForUpdate($targetUpData = [] )
    {
        $i = 1;
        foreach ($targetUpData as $col => $value ){
            $comma = (($i > 1) ? "," : '');
            $this->upDataReady .= "$comma $col = '$value' ";
            $i++;
        }
        return $this;
    }
    public function update( $targetCol = 'id' ,$targetValue = '')
    {
        $query = "UPDATE $this->tableName SET  $this->upDataReady WHERE $targetCol = $targetValue";
        $stmt = $this->prepareStatement($query, []);
        if (!$stmt) {
            return null;
        }

        $exe = $stmt->execute();
        if ($exe) {
            return $this->select()->where($targetCol, $targetValue)->first();
        }
        return false;
    }




    public function innerJoin($table, $firstColumn, $operator, $secondColumn)
    {
        $this->innerJoin = "INNER JOIN $table ON $firstColumn $operator $secondColumn";
        return $this;
    }

    public function orWhere($column, $value = '')
    {
        $this->where .= " OR $column = '$value'";
        return $this;
    }
    public function orderBy($column, $value = '')
    {
        $perWhere = $this->orderBy == null ? 'Order by' : ' ';
        $this->orderBy .= " $perWhere $column $value";
        return $this;
    }

    public function readyForInsert($values = [])
    {
        $i = 1;
        foreach ($values as $key => $value) {
            $comma = (($i > 1) ? "," : '');
            $this->insertDataColumn .= "$comma$key";
            $this->insertDataValue .= "$comma'$value'";
            $i++;
        }
        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO $this->tableName ($this->insertDataColumn) VALUES ($this->insertDataValue)";



//        problem
        $stmt = $this->prepareStatement($query, []);

        if (!$stmt) {
            return null;
        }

        $exe = $stmt->execute();
        if ($exe) {
            return $this->select()->orderBy('id', 'DESC')->first();
        }
        return false;
    }

    public function get()
    {
        $query = "$this->select $this->columns FROM $this->tableName $this->innerJoin $this->where $this->orderBy";
        $stmt = $this->prepareStatement($query, []);
//        problem

        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];

        while ($row = $result->fetch_object()) {
            $rows[] = (object)$row;
        }

        return (object)$rows;
    }

    public function first($params = [])
    {
        $query = "$this->select FROM $this->tableName $this->innerJoin $this->where $this->orderBy LIMIT 1";
        $stmt = $this->prepareStatement($query, $params);

        if (!$stmt) {
            return null;
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_object()) {
            return (object)$row;
        }

        return null;
    }

    public function getSqlQuery($type = 'select')
    {
        if ($type == 'select') {
            return "$this->select $this->columns FROM $this->tableName $this->innerJoin $this->where  $this->orderBy";
        }

        if ($type == 'insert') {
            return "INSERT INTO $this->tableName ($this->insertDataColumn) VALUES ($this->insertDataValue)";
        }

        return '';
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->tableName WHERE $this->primaryKey = '$id'";
        $stmt = $this->prepareStatement($query, []);

        if (!$stmt) {
            return null;
        }

        $exe = $stmt->execute();
        if ($exe) {
            return true;
        }
        return false;
    }

    private function prepareStatement($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        if (!$stmt) {
            echo "SQL Error: " . $this->connection->error . "<br>";
            return false;
        }

        if ($params) {
            $this->bindParams($stmt, $params);
        }

        return $stmt;
    }

    private function bindParams($stmt, $params)
    {
        $types = '';
        foreach ($params as $param) {
            $types .= is_int($param) ? 'i' : 's';
        }
        $stmt->bind_param($types, ...$params);
    }
}
