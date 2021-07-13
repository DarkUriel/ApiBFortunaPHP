<?php

    function getDB(){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "DBBancoFortuna";
        $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        return $db;
    }

    function getCuentas(){
        $query = "SELECT * FROM Cuenta";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            die('Error '. mysqli_error(getDB()));
        }else{
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'Id_Cuenta' => $row['Id_Cuenta'],
                    'FechaCreacion' => $row['FechaCreacion'],
                    'NumeroCuenta' => $row['NumeroCuenta'],
                    'TipoCuenta' => $row['TipoCuenta'],
                    'Estado' => $row['Estado']
                );
            }
            return $json;
        }
    }
    function getCuenta($id) {
        $query = "SELECT * FROM Cuenta WHERE Id_Cuenta = '$id'";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            die("Error de Consulta". mysqli_error(getDB()));
            }else {
                $json = array();
                while ($row = mysqli_fetch_array($result)) {
                    $json[] = array(
                        'Id_Cuenta' => $row['Id_Cuenta'],
                        'FechaCreacion' => $row['FechaCreacion'],
                        'NumeroCuenta' => $row['NumeroCuenta'],
                        'TipoCuenta' => $row['TipoCuenta'],
                        'Estado' => $row['Estado']
                    );
                }
                return $json[0];
        }
    }

    function Insertar($FechaCreacion, $NumeroCuenta, $TipoCuenta, $Estado){
        $query = "INSERT INTO Cuenta(FechaCreacion, NumeroCuenta, TipoCuenta, Estado) VALUES ('$FechaCreacion', '$NumeroCuenta', '$TipoCuenta', '$Estado')";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
        mysqli_close(getDB());
    }

    function Eliminar($id){
        $query = "Delete FROM Cuenta WHERE Id_Cuenta = '$id'";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }

    function Actualizar($Id_Cuenta, $FechaCreacion, $NumeroCuenta, $TipoCuenta, $Estado){
        $query = "UPDATE Cuenta SET FechaCreacion = '$FechaCreacion', NumeroCuenta = '$NumeroCuenta', TipoCuenta = '$TipoCuenta', Estado = '$Estado' WHERE Id_Cuenta = '$Id_Cuenta'";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }

    // Funciones para el registro de planilla
    function InsertPlanilla($TipoPlanilla, $DescripcionPlanilla, $CodigoCliente, $CodigoUsuario, $CuentaDebito, $FechaCreacion){
        $query = "INSERT INTO Planilla (TipoPlanilla, DescripcionPlanilla, CodigoCliente, CodigoUsuario, CuentaDebito, FechaCreacion) VALUES ('$TipoPlanilla', '$DescripcionPlanilla', '$CodigoCliente', '$CodigoUsuario', '$CuentaDebito', '$FechaCreacion')";
        $result = mysqli_query(getDB(), $query);
        if(!$result){
            return false;
        }else{
            $query = "SELECT * FROM Planilla ORDER BY Id_Planilla DESC LIMIT 1";
            $result2 = mysqli_query(getDB(), $query);
            if(!$result2){
                die("Error de consulta ". mysqli_error(getDB()));
            }else{
                $json = array();
                while ($row = mysqli_fetch_array($result2)) {
                    $json[] = array(
                        'Id_Planilla' => $row['Id_Planilla'],
                        'TipoPlanilla' => $row['TipoPlanilla'],
                        'DescripcionPlanilla' => $row['DescripcionPlanilla'],
                        'CodigoCliente' => $row['CodigoCliente'],
                        'CodigoUsuario' => $row['CodigoUsuario'],
                        'CuentaDebito' => $row['CuentaDebito'],
                        'FechaCreacion' => $row['FechaCreacion']
                    );
                }
                return $json[0];
            }
        }
    }
    function getPlanillas(){
        $query = "SELECT * FROM Planilla";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            die("Error de Consulta". mysqli_error(getDB()));
            }else {
                $json = array();
                while ($row = mysqli_fetch_array($result)) {
                    $json[] = array(
                        'Id_Planilla' => $row['Id_Planilla'],
                        'TipoPlanilla' => $row['TipoPlanilla'],
                        'DescripcionPlanilla' => $row['DescripcionPlanilla'],
                        'CodigoCliente' => $row['CodigoCliente'],
                        'CodigoUsuario' => $row['CodigoUsuario'],
                        'CuentaDebito' => $row['CuentaDebito'],
                        'FechaCreacion' => $row['FechaCreacion']
                    );
                }
                return $json;
        }
    }
    function getPlannilla($id){
        $query = "SELECT * FROM Planilla WHERE Id_Planilla = " . $id;
        $result = mysqli_query(getDB(), $query);
        if (!$result){
            die("Error de consulta". mysqli_error(getDB()));
        }else{
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] =array(
                    'Id_Planilla' => $row['Id_Planilla'],
                    'TipoPlanilla' => $row['TipoPlanilla'],
                    'DescripcionPlanilla' => $row['DescripcionPlanilla'],
                    'CodigoCliente' => $row['CodigoCliente'],
                    'CodigoUsuario' => $row['CodigoUsuario'],
                    'CuentaDebito' => $row['CuentaDebito'],
                    'FechaCreacion' => $row['FechaCreacion']
                );
            }
            return $json[0];
        }
    }
    function UpdatePlanilla($Id_Planilla, $TipoPlanilla, $DescripcionPlanilla, $CodigoCliente, $CodigoUsuario, $CuentaDebito, $FechaCreacion){
        $query = "UPDATE Planilla SET TipoCuenta = '$TipoPlanilla', DescripcionPlanilla = '$DescripcionPlanilla', CodigoCliente = '$CodigoCliente', CodigoUsuario = '$CodigoUsuario', CuentaDebito = '$CuentaDebito', FechaCreacion = '$FechaCreacion' WHERE Id_Planilla = ". $Id_Planilla;
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }
    function DeletePlanilla($Id){
        $query = "DELETE FROM Planilla WHERE Id_Planilla = ".$Id;
        $result = mysqli_query(getDB(), $query);
        if (!$result){
            return false;
        }else{
            return true;
        }
    }

    /////// Funcion para administrar Detalles

    function GetDetalles(){
        $query = "SELECT * FROM Detalle";
        $result = mysqli_query(getDB(), $query);
        if (!$result){
            die("Error de consulta". mysqli_error(getDB()));
        }else{
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] =array(
                    'Id_Detalle' => $row['Id_Detalle'],
                    'CuentaBeneficiario' => $row['CuentaBeneficiario'],
                    'Importe' => $row['Importe'],
                    'Glosa' => $row['Glosa'],
                    'NumCelular' => $row['NumCelular'],
                    'CorreoElectronico' => $row['CorreoElectronico'],
                    'OrigenFondos' => $row['OrigenFondos'],
                    'DestinoFondos' => $row['DestinoFondos'],
                    'MotivoTransaccion' => $row['MotivoTransaccion'],
                    'Id_Planilla' => $row['Id_Planilla']
                );
            }
            return $json;
        }
    }

    function GetDetalle($Id){
        $query = "SELECT * FROM Detalle WHERE Id_Detalle = '$Id'";
        $result = mysqli_query(getDB(), $query);
        if (!$result){
            die("Error de consulta". mysqli_error(getDB()));
        }else{
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] =array(
                    'Id_Detalle' => $row['Id_Detalle'],
                    'CuentaBeneficiario' => $row['CuentaBeneficiario'],
                    'Importe' => $row['Importe'],
                    'Glosa' => $row['Glosa'],
                    'NumCelular' => $row['NumCelular'],
                    'CorreoElectronico' => $row['CorreoElectronico'],
                    'OrigenFondos' => $row['OrigenFondos'],
                    'DestinoFondos' => $row['DestinoFondos'],
                    'MotivoTransaccion' => $row['MotivoTransaccion'],
                    'Id_Planilla' => $row['Id_Planilla']
                );
            }
            return $json[0];
        }
    }

    function InsertDetalle($CuentaBeneficiario, $Importe, $Glosa, $NumCelular, $CorreoElectronico, $OrigenFondos, $DestinoFondos, $MotivoTransaccion, $Id_Planilla){
        $query = "INSERT INTO Detalle (CuentaBeneficiario, Importe, Glosa, NumCelular, CorreoElectronico, OrigenFondos, DestinoFondos,MotivoTransaccion, Id_Planilla) VALUES ('$CuentaBeneficiario', '$Importe', '$Glosa', '$NumCelular', '$CorreoElectronico', '$OrigenFondos', '$DestinoFondos', '$MotivoTransaccion', '$Id_Planilla')";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }
    function UpdateDetalle($Id_Detalle, $CuentaBeneficiario, $Importe, $Glosa, $NumCelular, $CorreoElectronico, $OrigenFondos, $DestinoFondos, $MotivoTransaccion, $Id_Planilla){
        $query = "UPDATE Detalle SET CuentaBeneficiario = '$CuentaBeneficiario', Importe = '$Importe', Glosa = '$Glosa', NumCelular = '$NumCelular', CorreoElectronico = '$CorreoElectronico', OrigenFondos = '$OrigenFondos', DestinoFondos = '$DestinoFondos', MotivoTransaccion = '$MotivoTransaccion', Id_Planilla = '$Id_Planilla' WHERE Id_Detalle = '$Id_Detalle'";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }
    function DeleteDetalle($id_Detalle){
        $query = "DELETE FROM Detalle WHERE Id_Detalle = '$id_Detalle'";
        $result = mysqli_query(getDB(), $query);
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }
?>