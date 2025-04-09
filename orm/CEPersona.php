<?php
    namespace Orm;
    use Base\Query;
	use Orm\RepCity;
    class CEPersona {
        const TABLE_NAME = 'CE_Persona';
        const PRIMARY_KEY = ["id_persona"];

        public $fields = [
            'id_persona' => null,
			'nome' => null,
			'cognome' => null,
			'nascita_date' => null,
			'id_city_birth_fk' => null,
			'creation_date' => null,
			'mod_date' => null,
			'hidden' => null,
			'deleted' => null
        ];
        
        
        public function __construct($id_persona = false) {
            if(!$id_persona) {
                return;
            }
            $qBase = $this->queryBase(['id_persona' => $id_persona]);
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
        
        public function setIdPersona(int $val){
            $this->fields['id_persona'] = $val;
            return $this;
        }
        public function setNome(string $val){
            $this->fields['nome'] = $val;
            return $this;
        }
        public function setCognome(string $val){
            $this->fields['cognome'] = $val;
            return $this;
        }
        public function setNascitaDate(string $val){
            $this->fields['nascita_date'] = $val;
            return $this;
        }
        public function setIdCityBirthFk(int $val){
            $this->fields['id_city_birth_fk'] = $val;
            return $this;
        }
        public function setCreationDate(\DateTime $val){
            $this->fields['creation_date'] = $val;
            return $this;
        }
        public function setModDate(\DateTime $val){
            $this->fields['mod_date'] = $val;
            return $this;
        }
        public function setHidden(int $val){
            $this->fields['hidden'] = $val;
            return $this;
        }
        public function setDeleted(int $val){
            $this->fields['deleted'] = $val;
            return $this;
        }
        
        public function getIdPersona() : int {
            return $this->fields['id_persona'];
        }
        public function getNome() : string {
            return $this->fields['nome'];
        }
        public function getCognome() : string {
            return $this->fields['cognome'];
        }
        public function getNascitaDate() : string {
            return $this->fields['nascita_date'];
        }
        public function getIdCityBirthFk() : int {
            return $this->fields['id_city_birth_fk'];
        }
        public function getCreationDate() : \DateTime {
            $date = new \DateTime($this->fields['creation_date']);
            return $date;
        }
        public function getModDate() : \DateTime {
            return $this->fields['mod_date'];
        }
        public function getHidden() : int {
            return $this->fields['hidden'];
        }
        public function getDeleted() : int {
            return $this->fields['deleted'];
        }
        public function getCity(){
            $elem = new RepCity($this->fields['id_city_birth_fk']);
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
            ->from('CE_Persona')
            ->limit(10);
            return $query->genQuery();
        }
    }
