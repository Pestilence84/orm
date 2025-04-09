<?php
    namespace Orm;
    use Base\Query;
    class RepGender {
        const TABLE_NAME = 'RepGender';
        const PRIMARY_KEY = ["id_gender"];

        public $fields = [
            'id_gender' => null,
			'gender' => null
        ];
        
        private $dataType = [
            'id_gender' => 'int',
			'gender' => 'string|null'
        ];
        
        public function __construct($id_gender = false) {
            if(!$id_gender) {
                return;
            }
            $qBase = $this->queryBase(['id_gender' => $id_gender]);
            foreach($qBase as $key => $value) {
                $dataType = $this->dataType[$key];
                $key = ucfirst(implode('',array_map(function($v){ return ucfirst($v); }, explode('_', $key))));
                if( str_starts_with($dataType, '\\') ) {
                    $this->{'set' . $key}( new $dataType($value));
                } else {
                    $this->{'set' . $key}($value);
                }
            }
        }
        public function queryBase(array $id) {
            $query = new Query();
            $query->select(array_keys($this->fields))
            ->from(self::TABLE_NAME)
            ->where($id);
            $q = $query->genQuery();
            $res = $query->query($q);
            return $res[0];
        }
        
        public function setIdGender(int $val){
            $this->fields['id_gender'] = $val;
            return $this;
        }
        public function setGender(string|null $val){
            $this->fields['gender'] = $val;
            return $this;
        }
        
        public function getIdGender() : int {
            return (int) $this->fields['id_gender'];
        }
        public function getGender() : string|null {
            return (string) $this->fields['gender'];
        }
        
        public function getConstants(){
            $refl = new \ReflectionClass($this);
            $const = $refl->getConstants();
            unset($const['TABLE_NAME']);
            return $const;
        }
        public function fullQuery(){
            $query = new Query;
            $query->select(array_keys($this->fields))
            ->from('RepGender')
            ->limit(10);
            return $query->genQuery();
        }
    }
