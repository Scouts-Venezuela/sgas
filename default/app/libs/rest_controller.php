<?php

/**
 * Controlador para manejar peticiones REST
 *
 * Por defecto cada acción se llama como el método usado por el cliente
 * (GET, POST, PUT, DELETE, OPTIONS, HEADERS, PURGE...)
 * ademas se puede añadir mas acciones colocando delante el nombre del método
 * seguido del nombre de la acción put_cancel, post_reset...
 *
 * @category Kumbia
 * @package Controller
 * @author kumbiaPHP Team
 */
require_once CORE_PATH . 'kumbia/kumbia_rest.php';
class RestController extends KumbiaRest {

    /**
     * Inicialización de la petición
     * ****************************************
     * Aqui debe ir la autenticación de la API
     * ****************************************
     */
    final protected function initialize() {
        // Habilitando CORS para hacer funcional el RESTful
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');

        // Habilitar todos los headers que recibe (Authorization sobre todo para manejar JWT)
        $requestHeaders = apache_request_headers();
        $request = array_keys($requestHeaders);
        header("Access-Control-Allow-Headers: ".implode(',', $request).',authorization');

        $publicView = [
            'test'
        ];

        // Verificar los accesos y validez de token
        if($this->control($publicView)){

            // Precendia del Token
            if (isset($requestHeaders['Authorization'])) {
                $token = $requestHeaders['Authorization'];
                $this->me = JWT::decode(str_replace('Bearer ', '', $token), TOKEN);
                $now = time();

                // Verificamos que este activo
                if ($now >= $this->me->exp){
                    $this->setCode(403);
                    die('Error 403 - Acceso Denegado');
                }
            } else {
                $this->setCode(403);
                die('Error 403 - Acceso Denegado');
            }
        }
    }

    final protected function finalize() {

    }

    // Funcion para Atender a todos las solicitudes de seguridad
    // que se hacen con el método options
    //
    // FIXME: con más tiempo hacer una solución contundente para este método
    //
    public function options() {
        $rest_method = array('GET', 'POST', 'PUT', 'DELETE');
        $class_method = get_class_methods($this);
        $exist_method = array();
        foreach ($class_method as $method) {
            $method = strtoupper($method);
            if ($method == 'GETALL'){
                array_push($exist_method, 'GET');
            }
            if ( in_array($method, $rest_method) ){
                array_push($exist_method, $method);
            }
        }
        header('Access-Control-Allow-Methods: '.implode(',', array_unique($exist_method)));
        $this->setCode(200);
        die();
    }

    //
    // TODO: Implimentar un limit a la consultas de getAll() por seguridad
    //
    final function control($publicView){
        $granted = False;
        if (!is_array($publicView)) { throw new KumbiaException("Parámetro inesperado, se esperaba un array"); }
        $router = Router::get();
        if (in_array($router['controller'], $publicView) && $router['method'] == 'GET') {
            $granted = True;
        }

        return !$granted;
    }

}