<?php

    include("../CapaDatos/DataBase.php");

    switch ($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if (isset($_GET['id'])){
                echo json_encode(getPlannilla($_GET['id']));
            }else{
                echo json_encode(getPlanillas());
            }
        break;
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'), true);
            echo json_encode(InsertPlanilla($_POST['TipoPlanilla'], $_POST['DescripcionPlanilla'], $_POST['CodigoCliente'], $_POST['CodigoUsuario'], $_POST['CuentaDebito'], $_POST['FechaCreacion']));
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            if(isset($_GET['id'])){
                echo json_encode(UpdatePlanilla($_GET['id'], $_PUT['TipoPlanilla'], $_PUT['DescripcionPlanilla'], $_PUT['CodigoCliente'], $_PUT['CodigoUsuario'], $_PUT['CuentaDebito'], $_PUT['FechaCreacion']));
            }else{
                echo 'false';
            }
        break;
        case 'DELETE':
            if(isset($_GET['id'])){
                echo json_encode(DeletePlanilla($_GET['id']));
            }else{
                echo 'false';
            }
        break;
    }

?>