<?php
class Distrito extends Estructura {
	protected $source = "sga_distritos";
	protected $columns = "columns: id, codigo, nombre, region_id as region";
	public function fillbyowner($id) {
		$conditions = $this->conditions . " AND region_id = " . $id;
		return $this->find ( $this->columns, $conditions );
	}
}
