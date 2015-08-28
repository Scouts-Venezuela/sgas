<?php
class Joven extends Directorio {
		
	protected $conditions = "activo = 1 AND categoria_id = 1 ";
	
	public function fill() {
		return $this->find ( $this->columns, $this->conditions );
	}
}
