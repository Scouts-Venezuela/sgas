<?php
class Estructura extends ActiveRecord {
	protected $logger = True;
	protected $columns = "columns: id, codigo, nombre";
	protected $conditions = "activo = 1";
	public function fill() {
		return $this->find ( $this->columns, $this->conditions );
	}
	public function fillby($id) {
		//$conditions = $this->conditions . " AND id = " . $id;
		
		return $this->find_first($id);
		
// 		$field = "id";
// 		$value = $id;
// 		return $this->find_all_by ( $field, $value );
	}
}
