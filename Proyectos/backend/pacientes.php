<?php

    require_once 'clases/respuestas.class.php';
    require_once 'clases/pacientes.class.php';

    $_respuestas =  new respuestas;
    $_pacientes = new pacientes;
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if(isset($_GET["page"])){
                $pagina = $_GET["page"];
                $listaPacientes = $_pacientes->listaPacientes($pagina);
                header("Content-Type: application/json");
                echo json_encode($listaPacientes);
                http_response_code(200);
            } else if(isset($_GET['id'])){
                $pacienteid = $_GET['id'];
                $datosPaciente = $_pacientes->obtenerPaciente($pacienteid);
                header("Content-Type: application/json");
                echo json_encode($datosPaciente);
                http_response_code(200);
            }           
            break;
        case "POST":
            // Recepcion de data
            $postBody = file_get_contents("php://input");
            // Enviamos los datos al manejador o frontend
            $datosArray = $_pacientes->post($postBody);
            // print_r($resp);
            // Devolvemos una respuesta
            header('Content-Type: application/json');
            if (isset($datosArray["result"]["error_id"])){
                $responseCode = $datosArray["result"]["error_id"];
                http_response_code($responseCode);
            } else {
                http_response_code(200);
            }
            echo json_encode($datosArray);
            break;
        case "PUT":
            // Recepcion de data
            $postBody = file_get_contents("php://input");
            // Enviamos datos al manejador
            $datosArray = $_pacientes->put($postBody);
            // print_r($postBody);
            // Devolvemos una respuesta
            header('Content-Type: application/json');
            if (isset($datosArray["result"]["error_id"])){
                $responseCode = $datosArray["result"]["error_id"];
                http_response_code($responseCode);
            } else {
                http_response_code(200);
            }
            echo json_encode($datosArray);
            break;

        case "DELETE":

            // Recepcion de data
            $postBody = file_get_contents("php://input");
            // Enviamos datos al manejador
            $datosArray = $_pacientes->delete($postBody);
            // print_r($postBody);
            // Devolvemos una respuesta
            header('Content-Type: application/json');
            if (isset($datosArray["result"]["error_id"])){
                $responseCode = $datosArray["result"]["error_id"];
                http_response_code($responseCode);
            } else {
                http_response_code(200);
            }
            echo json_encode($datosArray);

            break;
        default: 
            header('Content-Type: application/json');
            $datosArray = $_respuestas->error_405();
            echo json_encode($datosArray);
            break;
    }

?>