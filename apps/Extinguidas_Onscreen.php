<!DOCTYPE html>
<html>
<head>
	<title>CONSULTA DE PRIORIDAD EXTINGUIDA CON No. DE BOLETIN</title>
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
include '../funciones/funciones_base.php';
$conexion = ConectToDatabase();
$results = Consulta_Extinguidas($conexion);  
?>
</body>
</html>