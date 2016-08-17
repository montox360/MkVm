<!DOCTYPE html>
<html>
<head>
	<title>Obtener Expedientes</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
    table tr td{
        page-break-inside: avoid;
    }
</style>
</head>
<body style="font-size: 12px;">
<?php
include 'funciones/funciones_base.php';
include 'mail_test_parrafo.php';

//Conecta a base de datos y realiza Query obteniendo los resultados.
$conexion = ConectToDatabase();
$results = Consulta_Renovaciones($conexion);  
$contactos = array();
while (!$results->EOF) {  
		$fv = $results->Fields("Codigo");
		$contactos[$fv->value] = $results->Fields("EInfoContacto")->value;
		$results->MoveNext(); 
	}

//print_r($contactos);
$results->MoveFirst();
//Array para guardar informacion a extraer de la vista web a la hora de generar el correo
$expedientes = array();

$expedientes = obtener_codigos($results, $expedientes);

//Inicializa j para llenar array de clientes;
$j = 0;

//inicializar array de clientes.
$clientes = array();

$clientes = obtener_clientes($conexion, $expedientes, $clientes);

//print_r($clientes);

borrar_results($results);

$marcas = array();

$marcas = obtener_datos_marcas($conexion, $marcas, $expedientes);

cerrar_conexiones($conexion, $results);

$mail = createMail($marcas[0], $clientes[$marcas[0]['IdCliente']], $contactos);

sendMail($mail);
?>
</body>
</html>