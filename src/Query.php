<?php

namespace Base;
use PDO;
class Query {
    private $conn;
    public $select;
    public $from;
    public $where;
    private $limit = 0;
    public function __construct( ) {
        $config = $GLOBALS['config'];
        $mysql = $config['database']['mysql'];
        $this->conn = new PDO("mysql:host=$mysql[host];dbname=$mysql[dbname]", $mysql['user'], $mysql['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function query($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($query): array|bool  {
        $res = $this->query($query);
        return $res == null ? false : $res[0];
    }

    public function genQuery() {
        return $this->genSelect($this->select) . $this->genFrom($this->from) . $this->genWhere($this->where) . $this->genLimit($this->limit);
    }
    public function select($fields) {
        $this->select = $fields;
        return $this;
    }
    public function from($table) {
        $this->from = $table;
        return $this;
    }

    public function where($conditions) {
        $this->where = $conditions;
        return $this;
    }
    public function limit(int $limit) {
        $this->limit = $limit;
        return $this;
    }

    private function genWhere($conditions) {
        $newWhere = [];
        if (is_array($conditions)) {
            foreach ($conditions as $key => $value) {
                $value = $this->conn->quote($value);
                $newWhere[] = "$key = $value"; 
            }
            return " WHERE " . implode(" AND ", $newWhere);
        }
    }

    private function genLimit(int $limit) {
        return $limit > 0 ? "LIMIT " . $limit : "";
    }
    public function genSelect($fields){
        if(is_array($fields)){
            foreach($fields as $k => $field){
                $return[] = is_int($k) ? "`$field`" : "$field AS `$k`";
            }
            $return = implode(", ", $return);
        } else {
            $return = "`$fields`";
        }
        return "SELECT $return ";
    }

    public function genFrom($table) {
        return "FROM $table ";
    }
}