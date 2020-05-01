<?php

class productos
{   
    public $producto;
    public $marca;
    public $precio;
    public $stock;
    public $foto;
    public $id;

    function __construct($producto,$marca,$precio,$stock,$foto,$id)
    {   
        $this->producto = $producto;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->foto = $foto;
        $this->id = $id;
    }
}