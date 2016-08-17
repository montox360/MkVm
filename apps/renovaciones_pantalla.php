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


echo "<table class=\" col-lg-12 table table-bordered table-hover table-striped tablesorter;\">"; 
echo "<thead>
        <tr>
        	<th class=\"header\">No.<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">O/ref<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Nombre<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Main Mail<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Contacto Mail<i class=\"fa fa-sort\"></i></th>
        </tr>
      </thead>";
$cont = 1;
$i = 0;

//Array para guardar informacion a extraer de la vista web a la hora de generar el correo
$expedientes = array();
echo "<tbody>";
while (!$results->EOF) {  
	echo "<tr>";
	$fv = $results->Fields("Codigo");
	$expedientes[$i] = array ('Codigo' => $fv->value, 'ClienteMail' => $results->Fields("InfoContactoEmail")->value); 
	echo "<td>".$cont."</td><td>M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)."</td><td>".$results->Fields("Nombre")->value."</td><td>".$results->Fields("InfoContactoEmail")->value."</td><td>".$results->Fields("EInfoContacto")->value."</td>"; 
	$results->MoveNext(); 
	$i++; 
	$cont++;
	}
echo"</tbody></table>";
cerrar_conexiones($conexion, $results);
?>
</body>
</html>