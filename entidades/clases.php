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
    public static function BuscarUsuario($nombre,$clave,$path){
        $Nuevo_Usuario = null;
        $lista = clases::listarTodos($path);
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
    public static function BuscarID($id,$path)
    {
        $productos = clases::listarTodos($path);
        $encontrado = null;
        for($i=0;$i<count($productos);$i++)
        {
            if($productos[$i]->id == $id)
            {
                $encontrado = $productos[$i];
                break;
            }
        }
        return $encontrado;
    }
    public static  function Serializarr($obj,$path)
    {
        //serializar
        $objetos = array();
        $objetos = clases::Deserializarr($path);
        if($objetos == null)
        {
            $objetos[0] = $obj;
            $serializado = serialize($objetos);
            $file = fopen("./entidades/".$path,"w");
            $rsta = fwrite($file,$serializado);
        }
        else
        {
            array_push($objetos,$obj);
            $serializado = serialize($objetos);
            $file = fopen("./entidades/".$path,"w");
            $rsta = fwrite($file,$serializado);
            fclose($file);
        }
            
        
    }
    public static function Deserializarr($path)
    {
        $listadoVentas = null;
        $file = fopen("./entidades/".$path,"r");
        if(filesize("./entidades/".$path) > 0)
        {
            $rsta = fread($file,filesize("./entidades/".$path));
            $listadoVentas = unserialize($rsta);
        }
         
        return $listadoVentas;
    }
    public static function ModificarStock($path,$id,$cantidad)
    {
        $flag = -1;
        $objetos = clases::listarTodos($path);
     for($i=0;$i<count($objetos);$i++)
     {
        if($objetos[$i]->id == $id)
        {
            $objetos[$i]->stock = $objetos[$i]->stock - $cantidad;
        break;
        }
     }
    
     $archivo = fopen("./entidades/".$path,"w");
     $json_string = json_encode($objetos);
        //$cant = fwrite($archivo,$nombre. "-". $apellido. "-" .$legajo. PHP_EOL);
         $cant = fwrite($archivo,$json_string);
         if($cant > 0)
         {
             $flag = 1;
         }
        return $flag;
    }

}
