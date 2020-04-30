<?php

require_once __DIR__ . '/vendor/autoload.php';
include_once ("./entidades/clases.php");
include_once ("./entidades/usuario.php");
use \Firebase\JWT\JWT;


use NNV\RestCountries;
$contador = 0;
$restCountries = new RestCountries;

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    switch ($_SERVER['PATH_INFO']) {
        case '/usuario':
            //las regiones que funcionan son , ASIA OCEANIA Y AFRICA, el resto no funciona por problema del paquete.
            # code...
            break;
        case '/capital':
            
        break;
        case '/pais':   
        break; 
        default:
            # code...
            break;
    }
}
else if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    switch ($_SERVER['PATH_INFO']) {
        case '/usuario':
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $dni = isset($_POST['dni']) ? $_POST['dni'] : NULL;
            $obra_social = isset($_POST['obra_social']) ? $_POST['obra_social'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
            $user1 = new usuario($nombre,$dni,$obra_social,$clave,$tipo,rand(0,300));
            $lista = clases::Guardar($user1);
            if($lista>0)
            {
                echo "Se guardo correctamente";
            }
            //las regiones que funcionan son , ASIA OCEANIA Y AFRICA, el resto no funciona por problema del paquete.
            # code...
            break;
        case '/login':
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $user = clases::BuscarUsuario($nombre,$clave);
            if($user!= null)
            {
                try {
                    $key = "example_key";
                    $payload = array(
                    "nombre" => $user->nombre,
                    "clave" => $user->clave,
                    "albertito" => "suarez"
                );
                $jwt = JWT::encode($payload, $key);
               //$decoded = JWT::decode($payload, $key, array('HS256'));
                print_r($jwt);
                } catch (\Throwable $th) {
                   print_r($th->getMessage());
                }
            }
            else{
                echo "Usuario incorrecto";
            }
        break;
        case '/pais':   
        break; 
        case '/pa':
        break;
        default:
            # code...
            break;
    }
}