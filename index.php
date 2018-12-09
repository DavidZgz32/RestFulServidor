<?php

require_once './DB.php';
require_once './Producto.php';
$metodo = $_SERVER['REQUEST_METHOD'];
$db = new DB;
switch ($metodo) {
    case GET:
        if (isset($_GET['cod'])) {
            $cod = $_GET['cod'];
            $productos = $db->obtenerProducto($cod);
            $respuesta = json_encode($productos);
        } else {
            $productos = $db->obtenerProductos();
            $respuesta = json_encode($productos);
        }
        break;
    case POST:
        $codigo = $_POST;
        //$cod = $codigo['cod'];
        if ($db->actualizarProducto($codigo)) {
            $respuesta = "El producto a sido actualizado correctamente";
        } else {
            $respuesta = "Error al actualizar el producto compruebe que el codigo y la familia sean las mismas";
        }

        break;

    case PUT:
        parse_str(file_get_contents('php://input'), $put_vars);
        if($db->insertarProducto($put_vars)){
            $respuesta="Se ha creado correctamente el producto";
        }else{
            $respuesta="Error al insertar el producto";
        }
        break;

    case DELETE:
        //s$del=parse_str(file_get_contents('php://input'), $cod);
        parse_str(file_get_contents('php://input'), $delete_vars);
        //var_dump($delete_vars);
        if ($db->borrarProducto($delete_vars)) {
            $respuesta = "El producto ha sido eliminado";
        } else {
            $respuesta = "Error al eliminar producto";
        }
        //$respuesta="Codigo a elminar es: " .$delete_vars[0];

        break;
}

//https://www.uno-de-piera.com/curl-peticiones-post-put-get-y-delete/
echo $respuesta;
?>