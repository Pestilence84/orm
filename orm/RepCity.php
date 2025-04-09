<?php
    namespace Orm;
    use Base\Query;
	use Orm\RepProvince;
	use Orm\RepRegion;
    class RepCity {
        const TABLE_NAME = 'RepCity';
        const PRIMARY_KEY = ["id_city"];

        public $fields = [
            'id_city' => null,
			'id_country_Fk' => null,
			'IdCity_ISP' => null,
			'RegionCode_Num' => null,
			'MetroCityCode_Num' => null,
			'ProvinceCode_Num' => null,
			'id_province_Fk' => null,
			'id_region_Fk' => null,
			'id_geographicalDivision_Fk' => null,
			'CitySequence' => null,
			'CityCode_Alfa' => null,
			'Name_IT' => null,
			'Name_IT_alt1' => null,
			'Name_IT_alt2' => null,
			'Name_IT_alt3' => null,
			'Name_IT_alt4' => null,
			'Name_DE' => null,
			'Flag_CitySize' => null,
			'Flag_CityChief' => null,
			'VehicleCityCode' => null,
			'SisterCityCode' => null,
			'CityCode_Num' => null,
			'CityCode_Num110' => null,
			'CityCode_Num107' => null,
			'CityCode_Num103' => null,
			'CadastralCode' => null,
			'LegalPopulation' => null,
			'CodeNUTS1_2010' => null,
			'CodeNUTS2_2010' => null,
			'CodeNUTS3_2010' => null,
			'CodeNUTS1_2006' => null,
			'CodeNUTS2_2006' => null,
			'CodeNUTS3_2006' => null,
			'Area_Kmq' => null,
			'Altitude_Min' => null,
			'Altitude_Max' => null,
			'Altitude_Range' => null,
			'Altitude_Avg' => null,
			'Altitude_Median' => null,
			'Altitude_StdDev' => null,
			'IdElevation_Fk' => null,
			'CenterAltitude' => null,
			'CoastalCity_SN' => null,
			'MountainCity_Fk' => null,
			'IdUrbanLevel_Fk' => null,
			'SeismicGrade' => null,
			'Latitude' => null,
			'Longitude' => null,
			'UpdatedRec' => null
        ];
        
        private $dataType = [
            'id_city' => 'int',
			'id_country_Fk' => 'int|null',
			'IdCity_ISP' => 'int|null',
			'RegionCode_Num' => 'int|null',
			'MetroCityCode_Num' => 'int|null',
			'ProvinceCode_Num' => 'int|null',
			'id_province_Fk' => 'int|null',
			'id_region_Fk' => 'int|null',
			'id_geographicalDivision_Fk' => 'int|null',
			'CitySequence' => 'string|null',
			'CityCode_Alfa' => 'string|null',
			'Name_IT' => 'string|null',
			'Name_IT_alt1' => 'string|null',
			'Name_IT_alt2' => 'string|null',
			'Name_IT_alt3' => 'string|null',
			'Name_IT_alt4' => 'string|null',
			'Name_DE' => 'string|null',
			'Flag_CitySize' => 'int|null',
			'Flag_CityChief' => 'int|null',
			'VehicleCityCode' => 'string|null',
			'SisterCityCode' => 'string|null',
			'CityCode_Num' => 'int|null',
			'CityCode_Num110' => 'int|null',
			'CityCode_Num107' => 'int|null',
			'CityCode_Num103' => 'int|null',
			'CadastralCode' => 'string|null',
			'LegalPopulation' => 'int|null',
			'CodeNUTS1_2010' => 'string|null',
			'CodeNUTS2_2010' => 'string|null',
			'CodeNUTS3_2010' => 'string|null',
			'CodeNUTS1_2006' => 'string|null',
			'CodeNUTS2_2006' => 'string|null',
			'CodeNUTS3_2006' => 'string|null',
			'Area_Kmq' => 'float|null',
			'Altitude_Min' => 'int|null',
			'Altitude_Max' => 'int|null',
			'Altitude_Range' => 'int|null',
			'Altitude_Avg' => 'float|null',
			'Altitude_Median' => 'int|null',
			'Altitude_StdDev' => 'float|null',
			'IdElevation_Fk' => 'int|null',
			'CenterAltitude' => 'int|null',
			'CoastalCity_SN' => 'int|null',
			'MountainCity_Fk' => 'string|null',
			'IdUrbanLevel_Fk' => 'int|null',
			'SeismicGrade' => 'string|null',
			'Latitude' => 'float|null',
			'Longitude' => 'float|null',
			'UpdatedRec' => 'int|null'
        ];
        
        public function __construct($id_city = false) {
            if(!$id_city) {
                return;
            }
            $qBase = $this->queryBase(['id_city' => $id_city]);
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
        
        public function setIdCity(int $val){
            $this->fields['id_city'] = $val;
            return $this;
        }
        public function setIdCountryFk(int|null $val){
            $this->fields['id_country_Fk'] = $val;
            return $this;
        }
        public function setIdCityISP(int|null $val){
            $this->fields['IdCity_ISP'] = $val;
            return $this;
        }
        public function setRegionCodeNum(int|null $val){
            $this->fields['RegionCode_Num'] = $val;
            return $this;
        }
        public function setMetroCityCodeNum(int|null $val){
            $this->fields['MetroCityCode_Num'] = $val;
            return $this;
        }
        public function setProvinceCodeNum(int|null $val){
            $this->fields['ProvinceCode_Num'] = $val;
            return $this;
        }
        public function setIdProvinceFk(int|null $val){
            $this->fields['id_province_Fk'] = $val;
            return $this;
        }
        public function setIdRegionFk(int|null $val){
            $this->fields['id_region_Fk'] = $val;
            return $this;
        }
        public function setIdGeographicalDivisionFk(int|null $val){
            $this->fields['id_geographicalDivision_Fk'] = $val;
            return $this;
        }
        public function setCitySequence(string|null $val){
            $this->fields['CitySequence'] = $val;
            return $this;
        }
        public function setCityCodeAlfa(string|null $val){
            $this->fields['CityCode_Alfa'] = $val;
            return $this;
        }
        public function setNameIT(string|null $val){
            $this->fields['Name_IT'] = $val;
            return $this;
        }
        public function setNameITAlt1(string|null $val){
            $this->fields['Name_IT_alt1'] = $val;
            return $this;
        }
        public function setNameITAlt2(string|null $val){
            $this->fields['Name_IT_alt2'] = $val;
            return $this;
        }
        public function setNameITAlt3(string|null $val){
            $this->fields['Name_IT_alt3'] = $val;
            return $this;
        }
        public function setNameITAlt4(string|null $val){
            $this->fields['Name_IT_alt4'] = $val;
            return $this;
        }
        public function setNameDE(string|null $val){
            $this->fields['Name_DE'] = $val;
            return $this;
        }
        public function setFlagCitySize(int|null $val){
            $this->fields['Flag_CitySize'] = $val;
            return $this;
        }
        public function setFlagCityChief(int|null $val){
            $this->fields['Flag_CityChief'] = $val;
            return $this;
        }
        public function setVehicleCityCode(string|null $val){
            $this->fields['VehicleCityCode'] = $val;
            return $this;
        }
        public function setSisterCityCode(string|null $val){
            $this->fields['SisterCityCode'] = $val;
            return $this;
        }
        public function setCityCodeNum(int|null $val){
            $this->fields['CityCode_Num'] = $val;
            return $this;
        }
        public function setCityCodeNum110(int|null $val){
            $this->fields['CityCode_Num110'] = $val;
            return $this;
        }
        public function setCityCodeNum107(int|null $val){
            $this->fields['CityCode_Num107'] = $val;
            return $this;
        }
        public function setCityCodeNum103(int|null $val){
            $this->fields['CityCode_Num103'] = $val;
            return $this;
        }
        public function setCadastralCode(string|null $val){
            $this->fields['CadastralCode'] = $val;
            return $this;
        }
        public function setLegalPopulation(int|null $val){
            $this->fields['LegalPopulation'] = $val;
            return $this;
        }
        public function setCodeNUTS12010(string|null $val){
            $this->fields['CodeNUTS1_2010'] = $val;
            return $this;
        }
        public function setCodeNUTS22010(string|null $val){
            $this->fields['CodeNUTS2_2010'] = $val;
            return $this;
        }
        public function setCodeNUTS32010(string|null $val){
            $this->fields['CodeNUTS3_2010'] = $val;
            return $this;
        }
        public function setCodeNUTS12006(string|null $val){
            $this->fields['CodeNUTS1_2006'] = $val;
            return $this;
        }
        public function setCodeNUTS22006(string|null $val){
            $this->fields['CodeNUTS2_2006'] = $val;
            return $this;
        }
        public function setCodeNUTS32006(string|null $val){
            $this->fields['CodeNUTS3_2006'] = $val;
            return $this;
        }
        public function setAreaKmq(float|null $val){
            $this->fields['Area_Kmq'] = $val;
            return $this;
        }
        public function setAltitudeMin(int|null $val){
            $this->fields['Altitude_Min'] = $val;
            return $this;
        }
        public function setAltitudeMax(int|null $val){
            $this->fields['Altitude_Max'] = $val;
            return $this;
        }
        public function setAltitudeRange(int|null $val){
            $this->fields['Altitude_Range'] = $val;
            return $this;
        }
        public function setAltitudeAvg(float|null $val){
            $this->fields['Altitude_Avg'] = $val;
            return $this;
        }
        public function setAltitudeMedian(int|null $val){
            $this->fields['Altitude_Median'] = $val;
            return $this;
        }
        public function setAltitudeStdDev(float|null $val){
            $this->fields['Altitude_StdDev'] = $val;
            return $this;
        }
        public function setIdElevationFk(int|null $val){
            $this->fields['IdElevation_Fk'] = $val;
            return $this;
        }
        public function setCenterAltitude(int|null $val){
            $this->fields['CenterAltitude'] = $val;
            return $this;
        }
        public function setCoastalCitySN(int|null $val){
            $this->fields['CoastalCity_SN'] = $val;
            return $this;
        }
        public function setMountainCityFk(string|null $val){
            $this->fields['MountainCity_Fk'] = $val;
            return $this;
        }
        public function setIdUrbanLevelFk(int|null $val){
            $this->fields['IdUrbanLevel_Fk'] = $val;
            return $this;
        }
        public function setSeismicGrade(string|null $val){
            $this->fields['SeismicGrade'] = $val;
            return $this;
        }
        public function setLatitude(float|null $val){
            $this->fields['Latitude'] = $val;
            return $this;
        }
        public function setLongitude(float|null $val){
            $this->fields['Longitude'] = $val;
            return $this;
        }
        public function setUpdatedRec(int|null $val){
            $this->fields['UpdatedRec'] = $val;
            return $this;
        }
        
        public function getIdCity() : int {
            return (int) $this->fields['id_city'];
        }
        public function getIdCountryFk() : int|null {
            return (int) $this->fields['id_country_Fk'];
        }
        public function getIdCityISP() : int|null {
            return (int) $this->fields['IdCity_ISP'];
        }
        public function getRegionCodeNum() : int|null {
            return (int) $this->fields['RegionCode_Num'];
        }
        public function getMetroCityCodeNum() : int|null {
            return (int) $this->fields['MetroCityCode_Num'];
        }
        public function getProvinceCodeNum() : int|null {
            return (int) $this->fields['ProvinceCode_Num'];
        }
        public function getIdProvinceFk() : int|null {
            return (int) $this->fields['id_province_Fk'];
        }
        public function getIdRegionFk() : int|null {
            return (int) $this->fields['id_region_Fk'];
        }
        public function getIdGeographicalDivisionFk() : int|null {
            return (int) $this->fields['id_geographicalDivision_Fk'];
        }
        public function getCitySequence() : string|null {
            return (string) $this->fields['CitySequence'];
        }
        public function getCityCodeAlfa() : string|null {
            return (string) $this->fields['CityCode_Alfa'];
        }
        public function getNameIT() : string|null {
            return (string) $this->fields['Name_IT'];
        }
        public function getNameITAlt1() : string|null {
            return (string) $this->fields['Name_IT_alt1'];
        }
        public function getNameITAlt2() : string|null {
            return (string) $this->fields['Name_IT_alt2'];
        }
        public function getNameITAlt3() : string|null {
            return (string) $this->fields['Name_IT_alt3'];
        }
        public function getNameITAlt4() : string|null {
            return (string) $this->fields['Name_IT_alt4'];
        }
        public function getNameDE() : string|null {
            return (string) $this->fields['Name_DE'];
        }
        public function getFlagCitySize() : int|null {
            return (int) $this->fields['Flag_CitySize'];
        }
        public function getFlagCityChief() : int|null {
            return (int) $this->fields['Flag_CityChief'];
        }
        public function getVehicleCityCode() : string|null {
            return (string) $this->fields['VehicleCityCode'];
        }
        public function getSisterCityCode() : string|null {
            return (string) $this->fields['SisterCityCode'];
        }
        public function getCityCodeNum() : int|null {
            return (int) $this->fields['CityCode_Num'];
        }
        public function getCityCodeNum110() : int|null {
            return (int) $this->fields['CityCode_Num110'];
        }
        public function getCityCodeNum107() : int|null {
            return (int) $this->fields['CityCode_Num107'];
        }
        public function getCityCodeNum103() : int|null {
            return (int) $this->fields['CityCode_Num103'];
        }
        public function getCadastralCode() : string|null {
            return (string) $this->fields['CadastralCode'];
        }
        public function getLegalPopulation() : int|null {
            return (int) $this->fields['LegalPopulation'];
        }
        public function getCodeNUTS12010() : string|null {
            return (string) $this->fields['CodeNUTS1_2010'];
        }
        public function getCodeNUTS22010() : string|null {
            return (string) $this->fields['CodeNUTS2_2010'];
        }
        public function getCodeNUTS32010() : string|null {
            return (string) $this->fields['CodeNUTS3_2010'];
        }
        public function getCodeNUTS12006() : string|null {
            return (string) $this->fields['CodeNUTS1_2006'];
        }
        public function getCodeNUTS22006() : string|null {
            return (string) $this->fields['CodeNUTS2_2006'];
        }
        public function getCodeNUTS32006() : string|null {
            return (string) $this->fields['CodeNUTS3_2006'];
        }
        public function getAreaKmq() : float|null {
            return (float) $this->fields['Area_Kmq'];
        }
        public function getAltitudeMin() : int|null {
            return (int) $this->fields['Altitude_Min'];
        }
        public function getAltitudeMax() : int|null {
            return (int) $this->fields['Altitude_Max'];
        }
        public function getAltitudeRange() : int|null {
            return (int) $this->fields['Altitude_Range'];
        }
        public function getAltitudeAvg() : float|null {
            return (float) $this->fields['Altitude_Avg'];
        }
        public function getAltitudeMedian() : int|null {
            return (int) $this->fields['Altitude_Median'];
        }
        public function getAltitudeStdDev() : float|null {
            return (float) $this->fields['Altitude_StdDev'];
        }
        public function getIdElevationFk() : int|null {
            return (int) $this->fields['IdElevation_Fk'];
        }
        public function getCenterAltitude() : int|null {
            return (int) $this->fields['CenterAltitude'];
        }
        public function getCoastalCitySN() : int|null {
            return (int) $this->fields['CoastalCity_SN'];
        }
        public function getMountainCityFk() : string|null {
            return (string) $this->fields['MountainCity_Fk'];
        }
        public function getIdUrbanLevelFk() : int|null {
            return (int) $this->fields['IdUrbanLevel_Fk'];
        }
        public function getSeismicGrade() : string|null {
            return (string) $this->fields['SeismicGrade'];
        }
        public function getLatitude() : float|null {
            return (float) $this->fields['Latitude'];
        }
        public function getLongitude() : float|null {
            return (float) $this->fields['Longitude'];
        }
        public function getUpdatedRec() : int|null {
            return (int) $this->fields['UpdatedRec'];
        }
        public function getProvince(){
            $elem = new RepProvince($this->fields['id_province_Fk']);
            return $elem;
        }
		public function getRegion(){
            $elem = new RepRegion($this->fields['id_region_Fk']);
            return $elem;
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
            ->from('RepCity')
            ->limit(10);
            return $query->genQuery();
        }
    }
