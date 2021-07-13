<?php

    include("../CapaDatos/DataBase.php");

    switch ($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if (isset($_GET['id'])){
                echo json_encode(getDetalle($_GET['id']));
            }else{
                echo json_encode(getDetalles());
            }
        break;
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'), true);
            if(InsertDetalle($_POST['CuentaBeneficiario'], $_POST['Importe'], $_POST['Glosa'], $_POST['NumCelular'], $_POST['CorreoElectronico'], $_POST['OrigenFondos'], $_POST['DestinoFondos'], $_POST['MotivoTransaccion'], $_POST['Id_Planilla'])){
                echo 'true';
            }else{
                echo 'false';
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            if(isset($_GET['id'])){
                echo json_encode(UpdateDetalle($_GET['id'], $_PUT['CuentaBeneficiario'], $_PUT['Importe'], $_PUT['Glosa'], $_PUT['NumCelular'], $_PUT['CorreoElectronico'], $_PUT['OrigenFondos'], $_PUT['DestinoFondos'], $_PUT['MotivoTransaccion'], $_PUT['Id_Planilla']));
            }else{
                echo 'false';
            }
        break;
        case 'DELETE':
            if(isset($_GET['id'])){
                echo json_encode(DeleteDetalle($_GET['id']));
            }else{
                echo 'false';
            }
        break;
    }

?>