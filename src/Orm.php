<?php

namespace Base;
use Base\Query;
use Base\OrmType;
class Orm {

    private function arrayForQuery($fields) {
        $parts = [];
        foreach ($fields as $field) {
            $parts[] = "'$field' => $$field";
        }
        return "[".implode(", ", $parts)."]";
    }
public function run() {
    $config = $GLOBALS['config'];
    $mysql = $config['database']['mysql'];
    $tableSchema = $mysql['dbname'];
    
    $nameSpace = $config['namespace'];
    $query = new Query();
    $res = $query->query("SELECT DISTINCT TABLE_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'test' ORDER BY TABLE_NAME");
    $path = $config['output_path']; 
    $dataType = new OrmType();
    foreach ($res as $row) {
        $sets = [];
        $gets = [];
        $privates = [];
        $primary = [];
        $use = ['Base\Query'];
        $getRel = [];
        $types = [];
        $baseName = str_ireplace("_", "", $row["TABLE_NAME"]);
        $fields = $query->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$tableSchema' AND TABLE_NAME='$row[TABLE_NAME]' ORDER BY ORDINAL_POSITION");
        foreach ($fields as $val) {
        $oriField = str_ireplace("_", "", $val["COLUMN_NAME"]);
        $field = ucfirst(implode("",array_map(function($v){ return ucfirst($v); }, explode("_", $val["COLUMN_NAME"]))));
        $type = $dataType->dataType($val['DATA_TYPE'], $val['IS_NULLABLE']);
        $primary = array_column( array_filter( $fields, function ($field) {  return $field['COLUMN_KEY'] == "PRI"; } ), 'COLUMN_NAME');

        $sets[] = "
        public function set$field($type[type] \$val){
            \$this->fields['$val[COLUMN_NAME]'] = \$val;
            return \$this;
        }";

        
        $getReturn = str_starts_with($type['type'], '\\') 
            ? "return \$this->fields['$val[COLUMN_NAME]'] == null ? new $type[type] : \$this->fields['$val[COLUMN_NAME]'];"
            :  "return \$this->fields['$val[COLUMN_NAME]'];";
         
        $gets[] = "
        public function get$field() : $type[type] {
            " .
            $getReturn
            ."
        }";
        $privates[] = "'$val[COLUMN_NAME]' => null";
        $types[] = "'$val[COLUMN_NAME]' => '$type[type]'";

        if(preg_match("[fk$]", strtolower($val['COLUMN_NAME']))){
            $tableFk = ucfirst(explode("_", $val['COLUMN_NAME'])[1]);
            $query = new Query;
            $res = $query->queryOne( "SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$tableSchema' AND ( TABLE_NAME LIKE '%Rep$tableFk%' OR TABLE_NAME LIKE '%Cfg$tableFk%' ) ");
            if($res !== false) {
                $use[] = str_ireplace("_", "", $res["TABLE_NAME"]);
                $getRel[] = "public function get$tableFk(){
            \$elem = new $res[TABLE_NAME](\$this->fields['$val[COLUMN_NAME]']);
            return \$elem;
        }";
            }
        }
    }
    $sets = implode("", $sets);
    $gets = implode("", $gets);
    $privates = implode(",\n\t\t\t", $privates);
    $types = implode(",\n\t\t\t", $types);
    
    $listQBase = $this->arrayForQuery($primary);

    
    $construct = "
        public function __construct(\$" . implode(" = false,\$", $primary) . " = false) {
            if(!\$" . implode(" && !\$", $primary ) . ") {
                return;
            }
            \$qBase = \$this->queryBase($listQBase);
            foreach(\$qBase as \$key => \$value) {
                \$dataType = \$this->dataType[\$key];
                \$key = ucfirst(implode('',array_map(function(\$v){ return ucfirst(\$v); }, explode('_', \$key))));
                if( str_starts_with(\$dataType, '\\\\') ) {
                    \$this->{'set' . \$key}( new \$dataType(\$value));
                } else {
                    \$this->{'set' . \$key}(\$value);
                }
            }
        }";
    $primary = json_encode($primary);
    $use = "use " . implode(";\n\tuse $nameSpace\\", $use) . ";";
    $getRel = implode("\n\t\t", $getRel);
    $testo = "<?php
    namespace $nameSpace;
    $use
    class $baseName {
        const TABLE_NAME = '$row[TABLE_NAME]';
        const PRIMARY_KEY = $primary;

        public \$fields = [
            $privates
        ];
        
        private \$dataType = [
            $types
        ];
        $construct
        public function queryBase(array \$id) {
            \$query = new Query();
            \$query->select(array_keys(\$this->fields))
            ->from(self::TABLE_NAME)
            ->where(\$id);
            \$q = \$query->genQuery();
            \$res = \$query->query(\$q);
            return \$res[0];
        }
        $sets
        $gets
        $getRel
        public function getConstants(){
            \$refl = new \\ReflectionClass(\$this);
            \$const = \$refl->getConstants();
            unset(\$const['TABLE_NAME']);
            return \$const;
        }
        public function fullQuery(){
            \$query = new Query;
            \$query->select(array_keys(\$this->fields))
            ->from('$row[TABLE_NAME]')
            ->limit(10);
            return \$query->genQuery();
        }
    }
";
$fullFileName = $path . $baseName . ".php";

file_put_contents($fullFileName, $testo);
chmod($fullFileName, 0664);

}
}
}