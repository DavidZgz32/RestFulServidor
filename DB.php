<?php

/**
 * @author David Marco Garcia
 * @version 1.0 date(20/12/2018)
 *
 * Description of DB esta clase permitira la conexion entre el login.php y la base de datos
 * para poder validar el usuario y la contraseña ingresada.
 */
require_once './Producto.php';

class DB {

    /**
     *
     * @var type
     */
    private $host;

    /**
     *
     * @var type
     */
    private $base;

    /**
     *
     * @var type
     */
    private $user;

    /**
     *
     * @var type
     */
    private $pass;

    /**
     *
     * @var type
     */
    private $conexion;

    /**
     *
     */
    function __construct() {
        $this->host = "localhost";
        $this->base = "dwes";
        $this->user = "root";
        $this->pass = "root";
        $this->conexion = new PDO("mysql:host=$this->host;charset=UTF8;dbname=$this->base", $this->user, $this->pass);
    }

    /**
     *
     * @param type $usuario
     * @param type $password
     * @return type
     */
    public function verificarCliente($usuario, $password) {
        try {
            $valores = [];
            $consulta = "SELECT nombre FROM usuario WHERE nombre=? AND contraseña=?";
            $valores[] = $usuario;
            $valores[] = md5($password);
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute($valores);
            $filas = ($stmt->rowCount() == 1) ? TRUE : FALSE;
        } catch (Exception $ex) {
            $msj = ("No se ha podido conectar a la BD" . $ex->getMessage());
        }
        return $filas;
    }

    /**
     *
     * @return \Producto
     */
    public function obtenerProductos() {
//        require_once './Producto.php';
        //$listaProductos = new ArrayObject();
        $consulta = "select * from producto";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $listaProductos[] = $fila;
            //$listaProductos->append($p);
        }

        return $listaProductos;
    }

    /**
     *
     * @param string $cod código de un producto
     * @return \Producto objeto de tipo producto
     */
    public function obtenerProducto($cod) {
        //$listaProductos = new ArrayObject();
        $valores = [];
        $consulta = "select * from producto where cod=?";
        $stmt = $this->conexion->prepare($consulta);
        $valores[] = $cod;
        $stmt->execute($valores);
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $producto = $fila;
            //$listaProductos->append($p);
        }
        return $producto;
    }

    /**
     *
     * @param type $cod
     * @return type
     */
    public function obtenerOrdena($cod) {
        $valores = [];
        $consulta = "SELECT * FROM `ordenador` where cod=?";
        $valores[] = $cod;
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute($valores);
        $listaOrdenador = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listaOrdenador[] = $fila;
        }
        return $listaOrdenador;
    }

    public function actualizarProducto($producto) {
        $respuesta = false;
        $sentencia = "UPDATE `producto` SET `nombre`=?,`nombre_corto`=?,`descripcion`=?,`PVP`=?,`familia`=? WHERE cod=?";

        $stmt = $this->conexion->prepare($sentencia);
        $stmt->execute($producto);
        if ($stmt->rowCount() > 0) {
            $respuesta = true;
        }
        return $respuesta;
    }

    public function borrarProducto($codigo) {
//        $sentencia = "select * from stock where producto=?";
//        $stmt = $this->conexion->prepare($sentencia);
//        $stmt->execute($codigo);
//        if ($stmt->rowCount() > 1) {
//            $senteciaStock = "DELETE FROM `stock` WHERE producto=?";
//            $stmt = $this->conexion->prepare($senteciaStock);
//            $stmt->execute($codigo);
//            if ($stmt->rowCount() > 1) {
//                $senteciaProducto = "DELETE FROM `producto` WHERE cod=?";
//                $stmt = $this->conexion->prepare($senteciaProducto);
//                $stmt->execute($codigo);
//                if ($stmt->rowCount() > 1) {
//                    
//                    return true;
//                } else {
//                    return false;
//                }
//            }
//        } else {
            $senteciaProducto = "DELETE FROM `producto` WHERE cod=?";
          
            $stmt = $this->conexion->prepare($senteciaProducto);
            $stmt->execute($codigo);
            if ($stmt->rowCount()) {
                return true;
            } else {
                return false;
            }
        }
    
        public function insertarProducto($producto){
            $setencia="INSERT INTO `producto`(`cod`, `nombre`, `nombre_corto`, `descripcion`, `PVP`, `familia`) VALUES (?,?,?,?,?,?)";
            $stmt= $this->conexion->prepare($setencia);
            
            if($stmt->execute($producto)){
                return true;
            }else{
                return FALSE;
            }
            
        }
    /**
     *
     */
    public function cerrarDB() {
        $this->conexion->close();
    }

}
