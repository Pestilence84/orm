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
    $table = "";
    $nameSpace = $config['namespace'];
    $query = new Query();
    $res = $query->query("SELECT DISTINCT TABLE_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$tableSchema' ORDER BY TABLE_NAME");
    $path = $config['output_path']; 
    $dataType = new OrmType();
    foreach ($res as $row) {
        $usedUse = [];
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

        
        
        $primaryType = explode("|",$type['type'])[0];
        
        $getReturn = str_starts_with($type['type'], '\\') 
            ? "return \$this->fields['$val[COLUMN_NAME]'] == null ? new $type[new] : \$this->fields['$val[COLUMN_NAME]'];"
            :  "return ($primaryType) \$this->fields['$val[COLUMN_NAME]'];";
         
        $gets[] = "
        public function get$field() : $type[type] {
            " .
            $getReturn
            ."
        }";
        $privates[] = "'$val[COLUMN_NAME]' => null";
        $types[] = "'$val[COLUMN_NAME]' => '$type[type]'";

        if(preg_match("[fk$]", strtolower($val['COLUMN_NAME'])) && substr(strtolower($val['COLUMN_NAME']), 0, 2) == 'id' ){
            $expTable = explode("_", $val['COLUMN_NAME']);
            //DA VEDERE PER I MUL 
            $tableFk = strtolower($expTable[1]) != 'mul' ? ucfirst($expTable[1]) : ucfirst($expTable[2]);
            $query = new Query;
            $res = $query->queryOne( "SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$tableSchema' AND ( TABLE_NAME LIKE '%Rep$tableFk%' OR TABLE_NAME LIKE '%Cfg$tableFk%' ) ");
            if($res !== false) {
                if(!in_array($tableFk, $usedUse)){
                    $usedUse[] = $tableFk;
                    $use[] = str_ireplace("_", "", $res["TABLE_NAME"]);
                }
                array_pop($expTable);
                unset($expTable[0]);
                $tableFk = ucfirst(implode("", array_map('ucfirst', $expTable)));
                $getRel[] = "public function get$tableFk(){
            \$elem = new $res[TABLE_NAME](\$this->fields['$val[COLUMN_NAME]']);
            return \$elem;
        }";
            }
            $sets[] = "
        public function set$field($type[type] \$val){
            \$this->fields['$val[COLUMN_NAME]'] = \$val;
            \$this->fields['$tableFk'] = \$this->get$tableFk();
            return \$this;
        }";
        } else {
            $sets[] = "
        public function set$field($type[type] \$val){
            \$this->fields['$val[COLUMN_NAME]'] = \$val;
            return \$this;
        }";
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
                    \$dataType = (explode('|', \$dataType))[0];
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
    namespace Orm\\Models;
    $use
    class Base$baseName {
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

if(!file_exists($path . "Models/")) {
    mkdir($path . "Models");
    chmod($path . "Models", 0775);
}
$basePath = $path . "Models/";
$model = $basePath . "Base" . $baseName . ".php";
file_put_contents($model , $testo);
chmod($model, 0664);
$users = "<?php 
    namespace $nameSpace;
    use $nameSpace\\Models\\Base$baseName;
    class $baseName extends Base$baseName {
    }
?>";
$fullFileName = $path . $baseName . ".php";
//if(!file_exists($fullFileName)){
file_put_contents($fullFileName, $users);
chmod($fullFileName, 0664);
//}

}
}
}