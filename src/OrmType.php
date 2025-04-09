<?php

namespace Base;

class OrmType {
    public function dataType($type) {
        $ret = [];
        switch ($type) {
            case 'tinyint':
                $ret['type'] = 'int';
                break;
            case 'smallint':
                $ret['type'] = 'int';
                break;
            case 'int':
                $ret['type'] = 'int';
                break;
            case 'bigint': 
                $ret['type'] = 'int';
                break;
            case 'double':
                $ret['type'] = 'float';
                break;
            case 'float':
                $ret['type'] = 'float';
                break;
            case 'decimal':
                $ret['type'] = 'float';
                break;
            case 'char':
                $ret['type'] = 'string';
                break;
            case 'varchar':
                $ret['type'] = 'string';
                break;
            case 'tinyblob':
                $ret['type'] = 'string';
                break;
            case 'blob':
                $ret['type'] = 'string';
                break;
            case 'mediumblob':
                $ret['type'] = 'string';
                break;
            case 'longblob':
                $ret['type'] = 'string';
                break;
            case 'tinytext':
                $ret['type'] = 'string';
                break;
            case 'text':
                $ret['type'] = 'string';
                break;
            case 'mediumtext':
                $ret['type'] = 'string';
                break;
            case 'longtext':
                $ret['type'] = 'string';
                break;
            case 'date':
                $ret['type'] = 'string';
                break;
            case 'datetime':
                $ret['type'] = '\DateTime';
                break;
            case 'timestamp':
                break;
            case 'year':
                break;
            case 'point':
                break;
            case 'polygon':
                break;
            case 'enum':
                break;
            case 'json':
                break;
            default:
                echo $type . " da gestire";
                break;
        }
        return $ret;
    }
}
