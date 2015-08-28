<?php

class Directorio extends ActiveRecord {
	protected $logger = True;
	
	protected $source = "sga_directorio";
	
	protected $columns = "columns: id, nip, papellido, sapellido, pnombre, snombre, 
	                        nacionalidad, fnac_at as nacimiento, ginstruccion_id as instruccion, profesion_id as profesion, creencia_id as creencia, 
	                        direccion, correo, geonameid, geonameid1, geonameid2, genero, 
	                        telfijo, telmovil, directorio_id as representante, parentesco_id as parentesco, 
	                        grupo_id as grupo, rama_id as rama, unidad_id as unidad, pqegrupo_id as pqegrupo, fingreso_at as ingreso, fpromesa_at as promesa, 
	                        cargo_id as cargo, nivel_id as nivel, categoria_id as categoria, activo, creado_at as creacion, modificado_in as modificacion";
	                        
	protected $conditions = "activo = 1";
	
	public function fill()
	{
		return null;
	}
	
	public function fillbynip($nip) {
		$conditions = $this->conditions . " AND nip = '$nip'";
		return $this->find ( $this->columns, $conditions );
	}
	
	
}