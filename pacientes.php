<?php 

require_once 'clases/respuestas.class.php';
require_once 'clases/pacientes.class.php';

$_respuestas = new respuestas;
$_pacientes = new pacientes;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (isset($_GET['page'])) {
        $pagina = $_GET['page'];
        $listaPacientes = $_pacientes->listaPacientes($pagina);
        header('Content-Type: application/json');
        echo json_encode($listaPacientes);
        http_response_code(200);
    }elseif(isset($_GET['id'])){
        $pacienteid = $_GET['id'];
        $datosPaciente = $_pacientes->obtenerPacientes($pacienteid);
        header('Content-Type: application/json');
        echo json_encode($datosPaciente);
        http_response_code(200);
    }
    
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // recibimos datoa enviados
    $postBody = file_get_contents("php://input");
    // enviamos al manejador
    $datosArray = $_pacientes->post($postBody);
    // devolvemos una respuesta
    header('Content-Type: application/json');
    if (isset($datosArray['result']['error_id'])) {
        $responseCode = $datosArray['result']['error_id'];
        http_response_code($responseCode);
    }else {
        http_response_code(200);
    }
    echo json_encode($datosArray);

}elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // recibimos datoa enviados
    $postBody = file_get_contents("php://input");
    // enviamos al manejador
    $datosArray = $_pacientes->put($postBody);
    // devolvemos una respuesta
    header('Content-Type: application/json');
    if (isset($datosArray['result']['error_id'])) {
        $responseCode = $datosArray['result']['error_id'];
        http_response_code($responseCode);
    }else {
        http_response_code(200);
    }
    echo json_encode($datosArray);


}elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

        // recibimos datoa enviados
        $postBody = file_get_contents("php://input");
        // enviamos al manejador
        $datosArray = $_pacientes->delete($postBody);
        // devolvemos una respuesta
        //header('Content-Type: application/json');
        //if (isset($datosArray['result']['error_id'])) {
        //    $responseCode = $datosArray['result']['error_id'];
        //    http_response_code($responseCode);
        //}else {
        //    http_response_code(200);
        //}
        //echo json_encode($datosArray);
    
}else{
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}