a<!DOCTYPE html>
<html>
<head>
	<title>ADO CONNECTION</title>
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
$rsTest = $connTest->Execute("SELECT
C.InfoContactoEmail AS IC, C.Nombre AS N, Co.InfoContactoEmail AS CN  FROM
Clientes as C, Facturas as F, Contactos as Co
WHERE
F.Fecha > DATEADD(year, -5, GETDATE()) AND F.IdClienteFacturacion = C.Id AND C.IdPais != 434 AND C.IdIdioma != 1 AND C.Id = Co.IdCliente AND Co.InfoContactoEmail !=''
Group By Co.InfoContactoEmail, C.InfoContactoEmail, C.Nombre
Order By C.Nombre;"); 
echo "<table style=\"width:Auto; margin: 0 auto;\" >"; 
$cont = 0;
$num_row = 0;
while (!$rsTest->EOF) {  

	$fv = $rsTest->Fields("N");
	echo"<tr>"; 
	echo "<td style=\" border:1px solid #ccc;\">".$fv->value." </td><td style=\" border:1px solid #ccc;\">".$rsTest->Fields("IC")->value."</td><td style=\" border:1px solid #ccc;\">".$rsTest->Fields("CN")->value."</td></tr>"; 
	$rsTest->MoveNext(); 
	$cont++;
	$num_row++;
} 

$rsTest->Close(); 
$rsTest = null;
$connTest->Close(); 
$connTest = null;
?>
</body>
</html>
