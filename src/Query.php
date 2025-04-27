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
        try {
            $this->conn = new PDO("mysql:host=$mysql[host];dbname=$mysql[dbname]", $mysql['user'], $mysql['password']) or die("Problema di connessione al DB");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo "Errore nella connessione con il DB, controlla la configurazione <br /> " . $e->getMessage();
        }
        
        
    }
    public function query($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($query, $params = []): array|bool  {
        $res = $this->query($query, $params);

        return $res == null ? false : $res[0];
    }

    public function queryAll($query): array|bool  {
        $res = $this->query($query);
        return $res == null ? false : $res;
    }

    public function update($table, $fields, $conditions) {
        $ret[] = "UPDATE $table SET ";
        $ret[] = $this->genFields($fields);
        $ret[] = $this->genWhere($conditions);
        return implode(" ", $ret);
    }

    private function genFields($fields) {
        $newFields = [];
        if (is_array($fields)) {
            foreach ($fields as $key => $value) {
                $value = is_object($value) ? 1 : 0; //$value->__toString() : $value;
                $newFields[] = "$key = $value"; 
            }
            return implode(", ", $newFields);
        }
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