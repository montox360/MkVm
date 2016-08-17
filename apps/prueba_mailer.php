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
$connTest = new COM("ADODB.Connection") or die("Cannot start ADO");
$connTest->Open("Provider=SQLOLEDB.1;Password=A*123456;Persist Security Info=True;User ID=tw_mk;Initial Catalog=GALENA_MK;Data Source=mkmarcas.puntoip.info"); 
$rsTest = $connTest->Execute("SELECT E.IdCliente, E.Codigo, C.Nombre, A.Descripcion, C.InfoContactoEmail FROM 
ExpedientesPrimarios as E, Tareas as T, Agendas as A, Clientes as C
WHERE E.Tipo = 'MARCA' AND E.Inactivo = 0 AND E.Id = A.IdExpediente AND A.Id = T.IdAgenda AND T.Completada = 0
AND T.Vencimiento < DATEADD(month, 6, GETDATE()) AND T.Vencimiento > (GETDATE()) AND E.IdCliente = C.Id AND C.IdPais != 434
AND A.Descripcion LIKE 'RENOVACI% (10%' GROUP BY C.Nombre, C.InfoContactoEmail, E.Codigo, E.IdCliente, A.Descripcion ORDER BY C.Nombre;"); 

echo "<table style=\"width:100%;\">"; 
$cont = 0;
while (!$rsTest->EOF) {  
	if($cont==9){
		echo "</tr>";
		echo "<tr>";
		$cont = 0;
	}
	else{
	    $fv = $rsTest->Fields("Codigo"); 
	    echo "<td style=\" border:1px solid #ccc;\">O/ref: M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)." </br> ".$rsTest->Fields("Nombre")->value."</td>"; 
	    $rsTest->MoveNext(); 
	    $cont++;
    }
} 
echo "Hola";
$rsTest->Close(); 
$rsTest = null;
$connTest->Close(); 
$connTest = null;
?>
</body>
</html>