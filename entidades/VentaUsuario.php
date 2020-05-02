<?php

class VentaUsuario
{
    public $id;
    public $cantidadProductos;
    public $usuario;
    public $precioUnidad;
    public $precioTOTALLLLLL;
    function __construct($id,$cantidadProductos,$usuario,$precioUnidad,$precioTOTAL)
    {   
        $this->id = $id;
        $this->cantidadProductos = $cantidadProductos;
        $this->usuario = $usuario;
        $this->precioUnidad = $precioUnidad;
        $this->precioTOTALLLLLL = $precioTOTAL;
    }
}