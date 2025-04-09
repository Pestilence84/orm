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
        
        
        public function __construct($id_city = false) {
            if(!$id_city) {
                return;
            }
            $qBase = $this->queryBase(['id_city' => $id_city]);
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
        
        public function setIdCity(int $val){
            $this->fields['id_city'] = $val;
            return $this;
        }
        public function setIdCountryFk(int $val){
            $this->fields['id_country_Fk'] = $val;
            return $this;
        }
        public function setIdCityISP(int $val){
            $this->fields['IdCity_ISP'] = $val;
            return $this;
        }
        public function setRegionCodeNum(int $val){
            $this->fields['RegionCode_Num'] = $val;
            return $this;
        }
        public function setMetroCityCodeNum(int $val){
            $this->fields['MetroCityCode_Num'] = $val;
            return $this;
        }
        public function setProvinceCodeNum(int $val){
            $this->fields['ProvinceCode_Num'] = $val;
            return $this;
        }
        public function setIdProvinceFk(int $val){
            $this->fields['id_province_Fk'] = $val;
            return $this;
        }
        public function setIdRegionFk(int $val){
            $this->fields['id_region_Fk'] = $val;
            return $this;
        }
        public function setIdGeographicalDivisionFk(int $val){
            $this->fields['id_geographicalDivision_Fk'] = $val;
            return $this;
        }
        public function setCitySequence(string $val){
            $this->fields['CitySequence'] = $val;
            return $this;
        }
        public function setCityCodeAlfa(string $val){
            $this->fields['CityCode_Alfa'] = $val;
            return $this;
        }
        public function setNameIT(string $val){
            $this->fields['Name_IT'] = $val;
            return $this;
        }
        public function setNameITAlt1(string $val){
            $this->fields['Name_IT_alt1'] = $val;
            return $this;
        }
        public function setNameITAlt2(string $val){
            $this->fields['Name_IT_alt2'] = $val;
            return $this;
        }
        public function setNameITAlt3(string $val){
            $this->fields['Name_IT_alt3'] = $val;
            return $this;
        }
        public function setNameITAlt4(string $val){
            $this->fields['Name_IT_alt4'] = $val;
            return $this;
        }
        public function setNameDE(string $val){
            $this->fields['Name_DE'] = $val;
            return $this;
        }
        public function setFlagCitySize(int $val){
            $this->fields['Flag_CitySize'] = $val;
            return $this;
        }
        public function setFlagCityChief(int $val){
            $this->fields['Flag_CityChief'] = $val;
            return $this;
        }
        public function setVehicleCityCode(string $val){
            $this->fields['VehicleCityCode'] = $val;
            return $this;
        }
        public function setSisterCityCode(string $val){
            $this->fields['SisterCityCode'] = $val;
            return $this;
        }
        public function setCityCodeNum(int $val){
            $this->fields['CityCode_Num'] = $val;
            return $this;
        }
        public function setCityCodeNum110(int $val){
            $this->fields['CityCode_Num110'] = $val;
            return $this;
        }
        public function setCityCodeNum107(int $val){
            $this->fields['CityCode_Num107'] = $val;
            return $this;
        }
        public function setCityCodeNum103(int $val){
            $this->fields['CityCode_Num103'] = $val;
            return $this;
        }
        public function setCadastralCode(string $val){
            $this->fields['CadastralCode'] = $val;
            return $this;
        }
        public function setLegalPopulation(int $val){
            $this->fields['LegalPopulation'] = $val;
            return $this;
        }
        public function setCodeNUTS12010(string $val){
            $this->fields['CodeNUTS1_2010'] = $val;
            return $this;
        }
        public function setCodeNUTS22010(string $val){
            $this->fields['CodeNUTS2_2010'] = $val;
            return $this;
        }
        public function setCodeNUTS32010(string $val){
            $this->fields['CodeNUTS3_2010'] = $val;
            return $this;
        }
        public function setCodeNUTS12006(string $val){
            $this->fields['CodeNUTS1_2006'] = $val;
            return $this;
        }
        public function setCodeNUTS22006(string $val){
            $this->fields['CodeNUTS2_2006'] = $val;
            return $this;
        }
        public function setCodeNUTS32006(string $val){
            $this->fields['CodeNUTS3_2006'] = $val;
            return $this;
        }
        public function setAreaKmq(float $val){
            $this->fields['Area_Kmq'] = $val;
            return $this;
        }
        public function setAltitudeMin(int $val){
            $this->fields['Altitude_Min'] = $val;
            return $this;
        }
        public function setAltitudeMax(int $val){
            $this->fields['Altitude_Max'] = $val;
            return $this;
        }
        public function setAltitudeRange(int $val){
            $this->fields['Altitude_Range'] = $val;
            return $this;
        }
        public function setAltitudeAvg(float $val){
            $this->fields['Altitude_Avg'] = $val;
            return $this;
        }
        public function setAltitudeMedian(int $val){
            $this->fields['Altitude_Median'] = $val;
            return $this;
        }
        public function setAltitudeStdDev(float $val){
            $this->fields['Altitude_StdDev'] = $val;
            return $this;
        }
        public function setIdElevationFk(int $val){
            $this->fields['IdElevation_Fk'] = $val;
            return $this;
        }
        public function setCenterAltitude(int $val){
            $this->fields['CenterAltitude'] = $val;
            return $this;
        }
        public function setCoastalCitySN(int $val){
            $this->fields['CoastalCity_SN'] = $val;
            return $this;
        }
        public function setMountainCityFk(string $val){
            $this->fields['MountainCity_Fk'] = $val;
            return $this;
        }
        public function setIdUrbanLevelFk(int $val){
            $this->fields['IdUrbanLevel_Fk'] = $val;
            return $this;
        }
        public function setSeismicGrade(string $val){
            $this->fields['SeismicGrade'] = $val;
            return $this;
        }
        public function setLatitude(float $val){
            $this->fields['Latitude'] = $val;
            return $this;
        }
        public function setLongitude(float $val){
            $this->fields['Longitude'] = $val;
            return $this;
        }
        public function setUpdatedRec(int $val){
            $this->fields['UpdatedRec'] = $val;
            return $this;
        }
        
        public function getIdCity() : int {
            return $this->fields['id_city'];
        }
        public function getIdCountryFk() : int {
            return $this->fields['id_country_Fk'];
        }
        public function getIdCityISP() : int {
            return $this->fields['IdCity_ISP'];
        }
        public function getRegionCodeNum() : int {
            return $this->fields['RegionCode_Num'];
        }
        public function getMetroCityCodeNum() : int {
            return $this->fields['MetroCityCode_Num'];
        }
        public function getProvinceCodeNum() : int {
            return $this->fields['ProvinceCode_Num'];
        }
        public function getIdProvinceFk() : int {
            return $this->fields['id_province_Fk'];
        }
        public function getIdRegionFk() : int {
            return $this->fields['id_region_Fk'];
        }
        public function getIdGeographicalDivisionFk() : int {
            return $this->fields['id_geographicalDivision_Fk'];
        }
        public function getCitySequence() : string {
            return $this->fields['CitySequence'];
        }
        public function getCityCodeAlfa() : string {
            return $this->fields['CityCode_Alfa'];
        }
        public function getNameIT() : string {
            return $this->fields['Name_IT'];
        }
        public function getNameITAlt1() : string {
            return $this->fields['Name_IT_alt1'];
        }
        public function getNameITAlt2() : string {
            return $this->fields['Name_IT_alt2'];
        }
        public function getNameITAlt3() : string {
            return $this->fields['Name_IT_alt3'];
        }
        public function getNameITAlt4() : string {
            return $this->fields['Name_IT_alt4'];
        }
        public function getNameDE() : string {
            return $this->fields['Name_DE'];
        }
        public function getFlagCitySize() : int {
            return $this->fields['Flag_CitySize'];
        }
        public function getFlagCityChief() : int {
            return $this->fields['Flag_CityChief'];
        }
        public function getVehicleCityCode() : string {
            return $this->fields['VehicleCityCode'];
        }
        public function getSisterCityCode() : string {
            return $this->fields['SisterCityCode'];
        }
        public function getCityCodeNum() : int {
            return $this->fields['CityCode_Num'];
        }
        public function getCityCodeNum110() : int {
            return $this->fields['CityCode_Num110'];
        }
        public function getCityCodeNum107() : int {
            return $this->fields['CityCode_Num107'];
        }
        public function getCityCodeNum103() : int {
            return $this->fields['CityCode_Num103'];
        }
        public function getCadastralCode() : string {
            return $this->fields['CadastralCode'];
        }
        public function getLegalPopulation() : int {
            return $this->fields['LegalPopulation'];
        }
        public function getCodeNUTS12010() : string {
            return $this->fields['CodeNUTS1_2010'];
        }
        public function getCodeNUTS22010() : string {
            return $this->fields['CodeNUTS2_2010'];
        }
        public function getCodeNUTS32010() : string {
            return $this->fields['CodeNUTS3_2010'];
        }
        public function getCodeNUTS12006() : string {
            return $this->fields['CodeNUTS1_2006'];
        }
        public function getCodeNUTS22006() : string {
            return $this->fields['CodeNUTS2_2006'];
        }
        public function getCodeNUTS32006() : string {
            return $this->fields['CodeNUTS3_2006'];
        }
        public function getAreaKmq() : float {
            return $this->fields['Area_Kmq'];
        }
        public function getAltitudeMin() : int {
            return $this->fields['Altitude_Min'];
        }
        public function getAltitudeMax() : int {
            return $this->fields['Altitude_Max'];
        }
        public function getAltitudeRange() : int {
            return $this->fields['Altitude_Range'];
        }
        public function getAltitudeAvg() : float {
            return $this->fields['Altitude_Avg'];
        }
        public function getAltitudeMedian() : int {
            return $this->fields['Altitude_Median'];
        }
        public function getAltitudeStdDev() : float {
            return $this->fields['Altitude_StdDev'];
        }
        public function getIdElevationFk() : int {
            return $this->fields['IdElevation_Fk'];
        }
        public function getCenterAltitude() : int {
            return $this->fields['CenterAltitude'];
        }
        public function getCoastalCitySN() : int {
            return $this->fields['CoastalCity_SN'];
        }
        public function getMountainCityFk() : string {
            return $this->fields['MountainCity_Fk'];
        }
        public function getIdUrbanLevelFk() : int {
            return $this->fields['IdUrbanLevel_Fk'];
        }
        public function getSeismicGrade() : string {
            return $this->fields['SeismicGrade'];
        }
        public function getLatitude() : float {
            return $this->fields['Latitude'];
        }
        public function getLongitude() : float {
            return $this->fields['Longitude'];
        }
        public function getUpdatedRec() : int {
            return $this->fields['UpdatedRec'];
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
