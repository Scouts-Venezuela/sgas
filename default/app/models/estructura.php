<?php

class Estructura extends ActiveRecord
{
	protected $logger =  True;
	
	protected $columns = "columns: id, nombre, codigo";
	protected $conditions = "activo = 1";
}




