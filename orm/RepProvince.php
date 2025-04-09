<?php
    namespace Orm;
    use Base\Query;
    class RepProvince {
        const TABLE_NAME = 'RepProvince';
        const PRIMARY_KEY = ["id_province"];

        public $fields = [
            'id_province' => null,
			'ProvinceCode_Num' => null,
			'RegionCode_Num' => null,
			'VehicleCityCode' => null,
			'Name' => null
        ];
        
        
        public function __construct($id_province = false) {
            if(!$id_province) {
                return;
            }
            $qBase = $this->queryBase(['id_province' => $id_province]);
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
        
        public function setIdProvince(int $val){
            $this->fields['id_province'] = $val;
            return $this;
        }
        public function setProvinceCodeNum(int $val){
            $this->fields['ProvinceCode_Num'] = $val;
            return $this;
        }
        public function setRegionCodeNum(int $val){
            $this->fields['RegionCode_Num'] = $val;
            return $this;
        }
        public function setVehicleCityCode(string $val){
            $this->fields['VehicleCityCode'] = $val;
            return $this;
        }
        public function setName(string $val){
            $this->fields['Name'] = $val;
            return $this;
        }
        
        public function getIdProvince() : int {
            return $this->fields['id_province'];
        }
        public function getProvinceCodeNum() : int {
            return $this->fields['ProvinceCode_Num'];
        }
        public function getRegionCodeNum() : int {
            return $this->fields['RegionCode_Num'];
        }
        public function getVehicleCityCode() : string {
            return $this->fields['VehicleCityCode'];
        }
        public function getName() : string {
            return $this->fields['Name'];
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
            ->from('RepProvince')
            ->limit(10);
            return $query->genQuery();
        }
    }
