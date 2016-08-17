<?php 

$conn = new COM("ADODB.Connection") or die("Cannot start ADO");
$conn->Open("Provider=SQLOLEDB.1;Password=A*123456;Persist Security Info=True;User ID=tw_mk;Initial Catalog=TW_MK;Data Source=mkmarcas.puntoip.info");

$rs = $conn->Execute("SELECT * FROM sometable");

?>