<?php
    include("../CapaDatos/DataBase.php");
    //localhost/www/ApiBForntuna/api/Cuenta.php

    //Recibir Peticiones del Usuario
    //echo 'Información: ' . file_get_contents('php://input');
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':

            //Metodo get que sirve para retornar uno o todos los registros

            if(isset($_GET['id'])){
                echo json_encode(getCuenta($_GET['id']));
            }else{
                echo json_encode(getCuentas());
            }
            break;
        case 'POST':
            //echo "Metodo POST";

            //Metodo _POST para Registrar Cuentas

            $_POST = json_decode(file_get_contents('php://input'), true);
            if(Insertar($_POST['FechaCreacion'], $_POST['NumeroCuenta'], $_POST['TipoCuenta'], $_POST['Estado'])){
                echo'true';
            }else{
                echo'false';
            }
            break;
        case 'PUT':

            //Metodo para actualizar los datos

            $_PUT = json_decode(file_get_contents('php://input'), true);
            if(isset($_GET['id'])){
                echo json_encode(Actualizar($_GET['id'], $_PUT['FechaCreacion'], $_PUT['NumeroCuenta'], $_PUT['TipoCuenta'], $_PUT['Estado']));
            }else{
                echo 'false';
            }
            break;
        case 'DELETE':

            //Metodo para eliminar los datos

            if(isset($_GET['id'])){
                echo json_encode(Eliminar($_GET['id']));
            }else{
                echo 'false';
            }
            break;
    }

    //Crear

    //Obtener una cuenta

    //Obtener todas las cuentas

    //Actualizar Cuenta

    //Eliminar una cuenta

?>