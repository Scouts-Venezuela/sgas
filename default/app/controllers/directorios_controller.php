<?php
class DirectoriosController extends RestController {
	protected $publicView = true;
	public function get($model, $nip = null) {
		if (empty ( $model ))
			$model = "Directorio";
		
		if (empty ( $nip )) {
			$this->data = Load::model ( $model )->fill ();
		} else {
			$this->data = Load::model ( $model )->fillbynip ( $nip );
		}
	}
}