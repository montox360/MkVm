<!DOCTYPE html>
<html>
<head>
	<title>Prueba Mailer</title>
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
$idioma = 1;
$results = Consulta_Renovaciones($conexion, $idioma);  


echo "<table style=\"width:100%;\">"; 
$cont = 0;
$i = 0;

//Array para guardar informacion a extraer de la vista web a la hora de generar el correo
$expedientes = array();

while (!$results->EOF) {  
	if($cont==9){
		echo "</tr>";
		echo "<tr>";
		$cont = 0;
	}
	else{
	    $fv = $results->Fields("Codigo");
	    $expedientes[$i] = array ('Codigo' => $fv->value, 'ClienteMail' => $results->Fields("InfoContactoEmail")->value); 
	    echo "<td style=\" border:1px solid #ccc;\">O/ref: M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)." </br> ".$results->Fields("Nombre")->value." </br> ".$results->Fields("InfoContactoMail")->value." </br> ".$results->Fields("EInfoContacto")->value."</td>"; 
	    $results->MoveNext(); 
	    $cont++;
    }
    $i++;
} 
echo"</table>";
print_r($expedientes);
cerrar_conexiones();
?>
</body>
</html>