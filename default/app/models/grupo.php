<?php

class Grupo extends Estructura
{

	protected $source = "sga_grupos";
	protected $columns = "columns: id, codigo, nombre, distrito_id as distrito, descripcion, horario, colores, afiliaciones, geonameid";

	public function fillbyowner($id) {
		$conditions = $this->conditions . " AND distrito_id = ".$id;
		return $this->find ( $this->columns, $conditions );
	}
		
}
