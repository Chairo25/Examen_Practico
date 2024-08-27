<?php

class Router {
    public static function route($url) {
        // Eliminar barras al final de la URL y descomponerla en partes
        $url = rtrim($url, '/');
        $url = explode('/', $url);
    
        // Registro para depurar
        error_log("Routing: " . print_r($url, true));
    
        // Determinar el controlador, método y parámetros
        $controller = isset($url[0]) && $url[0] !== '' ? ucfirst($url[0]) . 'Controller' : 'LibroController';
        $method = isset($url[1]) && $url[1] !== '' ? $url[1] : 'index';
        $params = array_slice($url, 2);
    
        // Comprobar si el archivo del controlador existe
        $controllerFile = '../app/controllers/' . $controller . '.php';
    
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
    
            if (class_exists($controller)) {
                $controllerInstance = new $controller();
    
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $params);
                } else {
                    self::handleError("404 - Método '$method' no encontrado en el controlador '$controller'.");
                }
            } else {
                self::handleError("404 - Clase del controlador '$controller' no encontrada.");
            }
        } else {
            self::handleError("404 - Controlador '$controller' no encontrado.");
        }
    }

    // Método para manejar errores
    private static function handleError($errorMessage) {
        // Puedes personalizar esto para mostrar una página de error, redirigir, etc.
        die($errorMessage);
    }
}
