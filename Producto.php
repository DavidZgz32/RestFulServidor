<?php

class Producto {

    /**
     *
     * @var type
     */
    private $cod;

    /**
     *
     * @var type
     */
    private $nombre;

    /**
     *
     * @var type
     */
    private $nombre_corto;

    /**
     *
     * @var type
     */
    private $descripcion;

    /**
     *
     * @var type
     */
    private $pvp;

    /**
     *
     * @var type
     */
    private $familia;

    /**
     *
     * @param type $fila
     */
    function __construct($fila) {

        $this->cod = $fila['cod'];
        $this->nombre = $fila['nombre'];
        $this->nombre_corto = $fila['nombre_corto'];
        $this->descripcion = $fila['descripcion'];
        $this->pvp = $fila['PVP'];
        $this->familia = $fila['familia'];
    }

    /**
     *
     * @return type
     */
    function getCod() {
        return $this->cod;
    }

    /**
     *
     * @return type
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     *
     * @return type
     */
    function getNombre_corto() {
        return $this->nombre_corto;
    }

    /**
     *
     * @return type
     */
    function getDescripcion() {
        return $this->descripcion;
    }

    /**
     *
     * @return type
     */
    function getPvp() {
        return $this->pvp;
    }

    /**
     *
     * @return type
     */
    function getFamilia() {
        return $this->familia;
    }

    /**
     *
     * @param type $cod
     */
    function setCod($cod) {
        $this->cod = $cod;
    }

    /**
     *
     * @param type $nombre
     */
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     *
     * @param type $nombre_corto
     */
    function setNombre_corto($nombre_corto) {
        $this->nombre_corto = $nombre_corto;
    }

    /**
     *
     * @param type $descripcion
     */
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    /**
     *
     * @param type $pvp
     */
    function setPvp($pvp) {
        $this->pvp = $pvp;
    }

    /**
     *
     * @param type $familia
     */
    function setFamilia($familia) {
        $this->familia = $familia;
    }

}
