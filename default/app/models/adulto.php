<?php
class Adulto extends Directorio {
		
	protected $conditions = "activo = 1 AND categoria_id = 2 ";
	
	public function fill() {
		return $this->find ( $this->columns, $this->conditions );
	}
}
