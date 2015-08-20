<?php

/**
*
*/
class TestController extends RestController
{
    protected $publicView = True;

    public function getAll(){
        // Token para probar el área con seguridad
        $test = array(
            'iat' => time(),
            'exp' => time() + LIFETIME,
            'security' => 'Security Test'
        );
        $jwt = JWT::encode($test, TOKEN);
        $this->data = array('mensaje' => 'Hola mundo!!!', 'token' => $jwt);
    }

    public function post() {
        $this->data = array('mensaje' => 'Hola solo algunos!!!');
    }
}

?>