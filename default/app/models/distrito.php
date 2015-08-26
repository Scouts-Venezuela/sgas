<?php

class Distrito extends Estructura
{

	protected $source = "sga_distritos";
	protected $columns = "columns: id, codigo, nombre, region_id as region";
	
}
