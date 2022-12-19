<?php
//incluimos inicialmente la conexion a la base de datos.
require '../config/Conexion.php';

class Articulo{

    //implementamos nuestro constructor 
    public function __construct(){

    }

    //metodo para insertar un registro
    public function insertar($idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen){ 
        $sql = "INSERT INTO articulo(idcategoria, codigo, nombre, stock, descripcion, imagen, condicion) 
        VALUES ('$idcategoria', '$codigo', '$nombre', '$stock', '$descripcion', '$imagen', '1') ";//valor en condicion por defecto se introduce 1

        return ejecutarConsulta($sql);//devuelbe 1 o 0 para ver si se ejecuto la consulta
    }

    //metodo para editar un registro
    public function editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen){
        $sql = "UPDATE articulo SET idcategoria='$idcategoria', codigo='$codigo', nombre='$nombre', stock='$stock', descripcion ='$descripcion',imagen='$imagen' 
        WHERE idarticulo = '$idarticulo'";

        return ejecutarConsulta($sql);
    }

    //implemnetamos metodo para desactivar un articulo
    public function desactivar($idarticulo){
        $sql = "UPDATE articulo SET condicion = '0' WHERE idarticulo = '$idarticulo'";

        return ejecutarConsulta($sql);
    }

    //implemnetamos metodo para activar un articulo
     public function activar($idarticulo){
        $sql = "UPDATE articulo SET condicion = '1' WHERE idarticulo = '$idarticulo'";

        return ejecutarConsulta($sql);
    }

    //implementar un metodo para mostrar los datos de un registro a modificar
    public function mostrar($idarticulo){
        $sql = "SELECT * FROM articulo WHERE idarticulo = '$idarticulo'";
        
        return ejecutarConsultaSimpleFila($sql);
    }

    //implementar un metodo para listar los  registros
    public function listar(){
        $sql = "SELECT a.idarticulo, a.idcategoria, c.nombre as categoria, a.codigo, a.nombre, a.stock, a.descripcion, a.imagen, a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria = c.idcategoria";

        return ejecutarConsulta($sql);
    }
}
?>