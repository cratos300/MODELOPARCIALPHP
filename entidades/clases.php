<?php

class clases  
{   
    public static function Guardar($obj,$donde)
    {
        $bandera = false;
        $array = clases::listarTodos($donde);
        $archivo = fopen("./entidades/".$donde,"w");
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
    public static function listarTodos($donde)
    {
        $archivo = fopen("./entidades/".$donde,"r");
        $dato = fread($archivo,filesize("./entidades/".$donde));
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
    public static function SubirStock($usuario,$foto)
    {
        $azar = rand(0,200);
        $origen = $_FILES['foto']['tmp_name'];
        $explode = explode('.',$_FILES['foto']['name']);
        $destino = "./entidades/img/".$explode[0].$azar.".".$explode[1];
        move_uploaded_file($origen,$destino);
        clases::Guardar($usuario,"stock.json");
    }
}
