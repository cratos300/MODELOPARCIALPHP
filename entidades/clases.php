<?php

class clases  
{   
    public static function Guardar($obj)
    {
        $bandera = false;
        $array = clases::listarTodos();
        $archivo = fopen("./entidades/archivos.json","w");
        array_push($array,$obj);
        $json_string = json_encode($array);
        //$cant = fwrite($archivo,$nombre. "-". $apellido. "-" .$legajo. PHP_EOL);
         $cant = fwrite($archivo,$json_string);
        if($cant>0)
        {
            $bandera = true;
        }
        fclose($archivo);

        return $bandera;
    }
    public static function listarTodos()
    {
        $archivo = fopen("./entidades/archivos.json","r");
        $dato = fread($archivo,filesize("./entidades/archivos.json"));
        fclose($archivo);
        return json_decode($dato);
    }
    public static function BuscarUsuario($nombre,$clave){
        $Nuevo_Usuario = null;
        $lista = clases::listarTodos();
        foreach ($lista as $key => $value) {
            if($value->nombre ==  $nombre &&  $value->clave == $clave){
                $Nuevo_Usuario = new usuario($value->nombre,$value->dni,$value->obra_social,$value->clave,$value->tipo,$value->id);
            }
        }
        return $Nuevo_Usuario;
    }
}
