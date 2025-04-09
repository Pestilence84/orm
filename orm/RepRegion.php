<?php
    namespace Orm;
    use Base\Query;
    class RepRegion {
        const TABLE_NAME = 'RepRegion';
        const PRIMARY_KEY = ["id_region"];

        public $fields = [
            'id_region' => null,
			'RegionCode_Num' => null,
			'Name' => null,
			'Code' => null
        ];
        
        private $dataType = [
            'id_region' => 'int',
			'RegionCode_Num' => 'int|null',
			'Name' => 'string|null',
			'Code' => 'string|null'
        ];
        
        public function __construct($id_region = false) {
            if(!$id_region) {
                return;
            }
            $qBase = $this->queryBase(['id_region' => $id_region]);
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
        
        public function setIdRegion(int $val){
            $this->fields['id_region'] = $val;
            return $this;
        }
        public function setRegionCodeNum(int|null $val){
            $this->fields['RegionCode_Num'] = $val;
            return $this;
        }
        public function setName(string|null $val){
            $this->fields['Name'] = $val;
            return $this;
        }
        public function setCode(string|null $val){
            $this->fields['Code'] = $val;
            return $this;
        }
        
        public function getIdRegion() : int {
            return (int) $this->fields['id_region'];
        }
        public function getRegionCodeNum() : int|null {
            return (int) $this->fields['RegionCode_Num'];
        }
        public function getName() : string|null {
            return (string) $this->fields['Name'];
        }
        public function getCode() : string|null {
            return (string) $this->fields['Code'];
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
            ->from('RepRegion')
            ->limit(10);
            return $query->genQuery();
        }
    }
