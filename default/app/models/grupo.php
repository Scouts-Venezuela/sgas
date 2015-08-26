<?php

class Grupo extends Estructura
{

	protected $source = "sga_grupos";
	protected $columns = "columns: id, codigo, nombre, distrito_id as distrito, descripcion, horario, colores, afiliaciones, geonameid";
		
}
