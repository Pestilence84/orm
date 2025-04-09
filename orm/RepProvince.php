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
        
        private $dataType = [
            'id_province' => 'int',
			'ProvinceCode_Num' => 'int|null',
			'RegionCode_Num' => 'int|null',
			'VehicleCityCode' => 'string|null',
			'Name' => 'string'
        ];
        
        public function __construct($id_province = false) {
            if(!$id_province) {
                return;
            }
            $qBase = $this->queryBase(['id_province' => $id_province]);
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
        
        public function setIdProvince(int $val){
            $this->fields['id_province'] = $val;
            return $this;
        }
        public function setProvinceCodeNum(int|null $val){
            $this->fields['ProvinceCode_Num'] = $val;
            return $this;
        }
        public function setRegionCodeNum(int|null $val){
            $this->fields['RegionCode_Num'] = $val;
            return $this;
        }
        public function setVehicleCityCode(string|null $val){
            $this->fields['VehicleCityCode'] = $val;
            return $this;
        }
        public function setName(string $val){
            $this->fields['Name'] = $val;
            return $this;
        }
        
        public function getIdProvince() : int {
            return (int) $this->fields['id_province'];
        }
        public function getProvinceCodeNum() : int|null {
            return (int) $this->fields['ProvinceCode_Num'];
        }
        public function getRegionCodeNum() : int|null {
            return (int) $this->fields['RegionCode_Num'];
        }
        public function getVehicleCityCode() : string|null {
            return (string) $this->fields['VehicleCityCode'];
        }
        public function getName() : string {
            return (string) $this->fields['Name'];
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
