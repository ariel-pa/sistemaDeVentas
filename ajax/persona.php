<?php
require_once "../models/Persona.php";

//Instanciar el modelo Persona.
$persona = new Persona();

$idpersona = isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$tipo_persona = isset($_POST["tipo_persona"])? limpiarCadena($_POST["tipo_persona"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento = isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

switch( $_GET["op"]){

    case 'guardaryeditar':
        if(empty($idpersona)){
            $rspta = $persona->insertar($tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email);
            echo $rspta ? "Persona registrada" : "Persona no se pudo registrar";
        }else{
            $rspta = $persona->editar($idpersona, $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email);
            echo $rspta ? "Persona actualizada" : "Persona no se pudo actualizar"; 
        }
    break;
 
    case 'eliminar':
        $rspta = $persona->eliminar($idpersona);
        echo $rspta ? "Persona eliminada" : "Persona no se puede eliminar";
    break;

    case 'mostrar':
        $rspta = $persona->mostrar($idpersona);
        
        echo json_encode($rspta);
    break;

    case 'listarProveedores':
        $rspta = $persona->listarProveedores();

        //declaramos un array para almacenar los registros
        $data = Array();

        //Todo: Recorremos y almacenamos en el array
        while($reg = $rspta->fetch_object()){
            $data[] = array( 
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpersona.')"> <i class="fa fa-pencil"></i> </button>'.' <button class="btn btn-trash" onclick="eliminar('.$reg->idpersona.')"><i class="fa fa-close"></i> </button>',
                // "1"=>$reg->tipo_persona,
                "1"=>$reg->nombre,
                "2"=>($reg->tipo_documento),
                "3"=>($reg->num_documento),
                // "4"=>($reg->direccion),  
                "4"=>($reg->telefono),
                "5"=>($reg->email)
            );
        }

        //TODO: Esta funcion devuelbe un json con los datos para ser listados
        $results = array(
            "sEcho"=>1, //Informacion para el datatables
            "iTotalRecords"=>count($data),//enviamos el total registro al datatable
            "iTotalDisplayRecords"=>count($data),//enviamos el total registro a visualizar.
            "aaData"=>$data);
        echo json_encode($results);

    break;

    case 'listarClientes':
        $rspta = $persona->listarClientes();

        //declaramos un array para almacenar los registros
        $data = Array();

        //Todo: Recorremos y almacenamos en el array
        while($reg = $rspta->fetch_object()){
            $data[] = array( 
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpersona.')"> <i class="fa fa-pencil"></i> </button>'.' <button class="btn btn-trash" onclick="eliminar('.$reg->idpersona.')"><i class="fa fa-close"></i> </button>',
                // "1"=>$reg->tipo_persona,
                "1"=>$reg->nombre,
                "2"=>($reg->tipo_documento),
                "3"=>($reg->num_documento),
                // "5"=>($reg->direccion),  
                "4"=>($reg->telefono),
                "5"=>($reg->email)
            );
        }

        //TODO: Esta funcion devuelbe un json con los datos para ser listados
        $results = array(
            "sEcho"=>1, //Informacion para el datatables
            "iTotalRecords"=>count($data),//enviamos el total registro al datatable
            "iTotalDisplayRecords"=>count($data),//enviamos el total registro a visualizar.
            "aaData"=>$data);
        echo json_encode($results);

    break;

}
?>