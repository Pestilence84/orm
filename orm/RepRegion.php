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
        
        
        public function __construct($id_region = false) {
            if(!$id_region) {
                return;
            }
            $qBase = $this->queryBase(['id_region' => $id_region]);
            foreach($qBase as $key => $value) {
                $key = ucfirst(implode('',array_map(function($v){ return ucfirst($v); }, explode('_', $key))));
                $this->{'set' . $key}($value);
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
        public function setRegionCodeNum(int $val){
            $this->fields['RegionCode_Num'] = $val;
            return $this;
        }
        public function setName(string $val){
            $this->fields['Name'] = $val;
            return $this;
        }
        public function setCode(string $val){
            $this->fields['Code'] = $val;
            return $this;
        }
        
        public function getIdRegion() : int {
            return $this->fields['id_region'];
        }
        public function getRegionCodeNum() : int {
            return $this->fields['RegionCode_Num'];
        }
        public function getName() : string {
            return $this->fields['Name'];
        }
        public function getCode() : string {
            return $this->fields['Code'];
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
