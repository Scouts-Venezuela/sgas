<?php

class Region extends Estructura
{
	
	public function fill() {
		return $this->find($this->columns, $this->conditions);
	}

}
