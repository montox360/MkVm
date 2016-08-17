<?php

//funcion para conectarse a la base de datos ADODB.
function ConectToDatabase() {
	$conexion = new COM("ADODB.Connection") or die("Cannot start ADO");
	$conexion->Open("Provider=SQLOLEDB.1;Password=A*123456;Persist Security Info=True;User ID=tw_mk;Initial Catalog=GALENA_MK;Data Source=mkmarcas.puntoip.info"); 
	return $conexion;
}

//funcion para marcas con eventos pendientes de aviso de renovacion en los proximos 6 meses de exterior y habla inglesa.
function Consulta_Renovaciones($conexion, $idioma){
$results = $conexion->Execute("SELECT E.IdCliente, E.Codigo, C.Nombre, A.Descripcion, C.InfoContactoEmail, Co.InfoContactoEmail as EInfoContacto 
	FROM ExpedientesPrimarios as E, Tareas as T, Agendas as A, Clientes as C, Contactos as Co
	WHERE E.Tipo = 'MARCA' AND E.Inactivo = 0 AND E.Id = A.IdExpediente AND A.Id = T.IdAgenda AND T.Completada = 0
	AND T.Vencimiento < DATEADD(month, 1, GETDATE()) AND T.Vencimiento > DATEADD(month, -1, GETDATE()) AND E.IdCliente = C.Id AND C.IdPais != 434
	AND A.Descripcion LIKE 'RENOVACI% (10%' AND C.Codigo != '3932-0' AND C.Codigo != '4457-0' AND C.Codigo != '8233-0' AND Co.Id = E.IdContacto  
	AND C.IdIdioma = ".$idioma." GROUP BY C.Nombre, C.InfoContactoEmail, E.Codigo, E.IdCliente, A.Descripcion, Co.InfoContactoEmail ORDER BY C.Nombre;");
	//OR E.IdContacto IS NULL) 
return $results;
}

function concedidas_onscreen($conexion, $idioma, $boletin){
	
	$results = $conexion->Execute("SELECT B.Numero, P.IdBoletin, E.Codigo, M.Nombre, D.Archivo
FROM Boletines as B,  Publicaciones as P,  ExpedientesPrimarios as E, Clientes as C, Marcas as M, Documentos as D
WHERE E.Tipo LIKE 'MARCA' AND E.Inactivo = 0 AND B.Numero = '".$boletin."' AND B.Id = P.IdBoletin AND P.IdTipoPublicacion = 2 AND P.IdExpedientePrincipal = E.Id AND E.IdCliente = C.Id AND C.IdPais != 434 AND C.IdIdioma = ".$idioma." AND M.IdExpediente = E.Id AND E.IdEstado = 1456 AND E.Id = D.IdExpediente AND D.Descripcion LIKE 'CONCEDIDA%' Order By E.Codigo");/*SELECT B.Numero, P.IdBoletin, E.Codigo
FROM Boletines as B,  Publicaciones as P,  ExpedientesPrimarios as E
WHERE E.Tipo LIKE 'MARCA' AND E.Inactivo = 0 AND B.Numero = '564' AND B.Id = P.IdBoletin AND P.IdTipoPublicacion = 1 AND P.IdExpedientePrincipal = E.Id*/
echo "<div><table id =\"tabla_reporte\" class=\" col-lg-12 table table-bordered table-hover table-striped tablesorter renewals_onscreen;\">"; 

echo "<thead>
        <tr>
        	<th class=\"header\">Referencia<i class=\"fa fa-sort\"></i></th>
        	<th class=\"header\">Marca<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Id Boletin<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Boletin No<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Archivo URL<i class=\"fa fa-sort\"></i></th>      
        </tr>
      </thead>";
while (!$results->EOF) {  
		echo "<tr>";
		$fv = $results->Fields("Codigo");
	    echo "<td id=\"Codigo\" code=\"".$fv->value."\">M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)."</td>
	    <td>".$results->Fields("Nombre")->value."</td>
	    <td>".$results->Fields("IdBoletin")->value."</td><td>".$results->Fields("Numero")->value."</td>
	    <td><a href=\"http://mkgalena.puntoip.info/docs_ma/".$results->Fields("Archivo")->value."\" target=\"_blank\">http://mkgalena.puntoip.info/docs_ma/".$results->Fields("Archivo")->value."</a></td>";
	    $results->MoveNext(); 
	    echo "</tr>";    
} 
echo"</table></div>";

cerrar_conexiones($conexion, $results);
}

function Consulta_Concedidas_Json($conexion, $codigos){
	$query ='';
	$len = count($codigos);
	$i = 0;
	foreach($codigos as $item){
		if($i===0)
			$query = "(E.Codigo =".$item;
			else{
				$query = $query." OR E.Codigo =".$item;
			}
		if($i===($len-1)){
			$query = $query.") ";
		}
		$i++;
	}

	$results = $conexion->Execute("SELECT E.IdCliente, E.Codigo, C.Nombre, C.InfoContactoEmail, Co.InfoContactoEmail as EInfoContacto, D.Archivo FROM ExpedientesPrimarios as E, Clientes as C, Contactos as Co, Documentos as D WHERE ".$query." AND E.IdCliente = C.Id AND Co.Id = E.IdContacto AND E.Id = D.IdExpediente AND D.Descripcion LIKE '%CONCED%' GROUP BY E.Codigo, E.IdCliente, D.Archivo, C.Nombre, C.InfoContactoEmail, Co.InfoContactoEmail"
		 );
	return $results;
}

function Consulta_Renovaciones_Json($conexion, $codigos, $idioma){

$query='';
$len = count($codigos);
$i = 0;
foreach ($codigos as $item){
  if($i===0)
  {
        $query = "(E.Codigo = ".$item;
      }   
    else{
      $query = $query." OR E.Codigo = ".$item;
    }

  if($i===($len-1)){
      $query = $query.") ";
    }
    $i++;
  }

$results = $conexion->Execute("SELECT E.IdCliente, E.Codigo, C.Nombre, A.Descripcion, C.InfoContactoEmail, Co.InfoContactoEmail as EInfoContacto 
	FROM ExpedientesPrimarios as E, Tareas as T, Agendas as A, Clientes as C, Contactos as Co
	WHERE ".$query."AND E.Tipo = 'MARCA' AND E.Inactivo = 0 AND E.Id = A.IdExpediente AND A.Id = T.IdAgenda AND T.Completada = 0
	AND T.Vencimiento < DATEADD(month, 1, GETDATE()) AND T.Vencimiento > DATEADD(month, -1, GETDATE()) AND E.IdCliente = C.Id AND C.IdPais != 434
	AND A.Descripcion LIKE 'RENOVACI% (10%' AND C.Codigo != '3932-0' AND C.Codigo != '4457-0' AND C.Codigo != '8233-0' AND Co.Id = E.IdContacto  
	AND C.IdIdioma = ".$idioma." GROUP BY C.Nombre, C.InfoContactoEmail, E.Codigo, E.IdCliente, A.Descripcion, Co.InfoContactoEmail ORDER BY C.Nombre;");

/*echo "SELECT E.IdCliente, E.Codigo, C.Nombre, A.Descripcion, C.InfoContactoEmail, Co.InfoContactoEmail as EInfoContacto 
	FROM ExpedientesPrimarios as E, Tareas as T, Agendas as A, Clientes as C, Contactos as Co
	WHERE ".$query."AND E.Tipo = 'MARCA' AND E.Inactivo = 0 AND E.Id = A.IdExpediente AND A.Id = T.IdAgenda AND T.Completada = 0
	AND T.Vencimiento < DATEADD(month, 1, GETDATE()) AND T.Vencimiento > DATEADD(month, -1, GETDATE()) AND E.IdCliente = C.Id AND C.IdPais != 434
	AND A.Descripcion LIKE 'RENOVACI% (10%' AND C.Codigo != '3932-0' AND C.Codigo != '4457-0' AND C.Codigo != '8233-0' AND Co.Id = E.IdContacto  
	AND C.IdIdioma = ".$idioma." GROUP BY C.Nombre, C.InfoContactoEmail, E.Codigo, E.IdCliente, A.Descripcion, Co.InfoContactoEmail ORDER BY C.Nombre;";
	//OR E.IdContacto IS NULL) */
/*
$query = "SELECT E.IdCliente, E.Codigo, C.Nombre, A.Descripcion, C.InfoContactoEmail, Co.InfoContactoEmail as EInfoContacto 
	FROM ExpedientesPrimarios as E, Tareas as T, Agendas as A, Clientes as C, Contactos as Co
	WHERE ".$query."AND E.Tipo = 'MARCA' AND E.Inactivo = 0 AND E.Id = A.IdExpediente AND A.Id = T.IdAgenda AND T.Completada = 0
	AND T.Vencimiento < DATEADD(month, 1, GETDATE()) AND T.Vencimiento > DATEADD(month, -1, GETDATE()) AND E.IdCliente = C.Id AND C.IdPais != 434
	AND A.Descripcion LIKE 'RENOVACI% (10%' AND C.Codigo != '3932-0' AND C.Codigo != '4457-0' AND Co.Id = E.IdContacto  
	AND C.IdIdioma = ".$idioma." GROUP BY C.Nombre, C.InfoContactoEmail, E.Codigo, E.IdCliente, A.Descripcion, Co.InfoContactoEmail ORDER BY C.Nombre;";*/
return $results;
}

function Consulta_Negadas ($conexion)
{
	$results = $conexion->Execute("SELECT E.Codigo, E.NroSolicitud, B.Numero, P.Id FROM 
	ExpedientesPrimarios as E, Boletines as B, Clientes as C, Publicaciones as P
	WHERE P.IdTipoPublicacion = 13 AND P.Materia LIKE 'Marca' AND P.IdExpedientePrincipal = E.Id AND P.IdBoletin = B.Id AND B.Numero <= 508 AND E.NroSolicitud != ''
	AND E.IdCliente = C.Id AND C.IdPais != 434	
	GROUP BY E.Codigo, E.NroSolicitud, B.Numero, P.Id, P.Fecha ORDER BY P.Fecha;");
	echo "<div><table class=\" col-lg-12 table table-bordered table-hover table-striped tablesorter renewals_onscreen;\">"; 
	echo "<thead>
    	  <tr>
        	<th class=\"header\">Ref<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Solicitud No.<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Boletin No.<i class=\"fa fa-sort\"></i></th>
        </tr>
      </thead>";
while (!$results->EOF) {  
		echo "<tr>";
		$fv = $results->Fields("Codigo");
	    echo "<td>M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)."</td><td>".$results->Fields("NroSolicitud")->value."</td><td>".$results->Fields("Numero")->value."</td>"; 
	    $results->MoveNext(); 
	    echo "</tr>";    
} 
echo"</table></div>";

cerrar_conexiones($conexion, $results);
}

function Consulta_Extinguidas ($conexion)
{
	$results = $conexion->Execute("SELECT E.Codigo, E.NroSolicitud, B.Numero, P.Id FROM 
	ExpedientesPrimarios as E, Boletines as B, Clientes as C, Publicaciones as P
	WHERE P.Materia LIKE 'Marca' AND P.IdExpedientePrincipal = E.Id AND P.IdBoletin = B.Id AND B.Numero <= 453 AND E.NroSolicitud != ''
	AND E.IdCliente = C.Id AND C.IdPais != 434	AND E.IdEstado = 1469
	GROUP BY E.Codigo, E.NroSolicitud, B.Numero, P.Id, P.Fecha ORDER BY P.Fecha;");
	echo "<div><table class=\" col-lg-12 table table-bordered table-hover table-striped tablesorter renewals_onscreen;\">"; 
	echo "<thead>
    	  <tr>
        	<th class=\"header\">Ref<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Solicitud No.<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Boletin No.<i class=\"fa fa-sort\"></i></th>
        </tr>
      </thead>";
while (!$results->EOF) {  
		echo "<tr>";
		$fv = $results->Fields("Codigo");
	    echo "<td>M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)."</td><td>".$results->Fields("NroSolicitud")->value."</td><td>".$results->Fields("Numero")->value."</td>"; 
	    $results->MoveNext(); 
	    echo "</tr>";    
} 
echo"</table></div>";

cerrar_conexiones($conexion, $results);
}


//funcion para cerrar conexiones y eliminar variable de resultados.
function cerrar_conexiones($conexion, $results){
$results->Close(); 
$results = null;
$conexion->Close(); 
$conexion = null;
}

function borrar_results($results){
$results = null;
}

function Consulta_Clientes($conexion, $idCliente){
$results = $conexion->Execute("SELECT C.Nombre as CN, C.DireccionLinea1, C.DireccionLinea2, C.DireccionLinea3, C.DireccionLinea4, 
C.DireccionCiudad, C.DireccionEstado, C.DireccionCodigoPostal, C.InfoContactoTelefono, C.InfoContactoFax, C.Codigo, P.Nombre as PN
FROM Clientes as C, Paises as P
WHERE C.Id = ".$idCliente." AND P.Id = C.IdPais");
return $results;
}

function Consulta_Boletines($conexion){
	
	$results = $conexion->Execute("SELECT Numero
	FROM Boletines ORDER BY Numero DESC");
	return $results;

}

function obtener_codigos($results, $expedientes){
$i = 0;
	while (!$results->EOF) {  
		$fv = $results->Fields("Codigo");
		$expedientes[$i] = array ('Codigo' => $fv->value, 'ClienteMail' => $results->Fields("InfoContactoEmail")->value, 'IdCliente' => $results->Fields("IdCliente")->value, 'contactoMail' => $results->Fields("EInfoContacto")); 
		$results->MoveNext(); 
	    $i++;
	}
borrar_results($results);
return $expedientes;
}

function obtener_clientes($conexion, $expedientes, $clientes){

for ($i = 0; $i<count($expedientes); $i++) {
	if ($i==0) {
		$results = Consulta_Clientes($conexion, $expedientes[$i]['IdCliente']);
		$clientes[$results->Fields('Codigo')->value] = array (
		'ClienteNombre' => $results->Fields("CN")->value, 
		'ClienteDireccion' => $results->Fields("DireccionLinea1")->value.' '.$results->Fields("DireccionLinea2")->value.' '.
		$results->Fields("DireccionLinea3")->value.' '.$results->Fields("DireccionLinea4")->value.' '.$results->Fields("DireccionCiudad")->value.' '.
		$results->Fields("DireccionEstado")->value.' '.$results->Fields("DireccionCodigoPostal")->value,
	    'ClientePais' => $results->Fields("PN")->value, 
	    'ClienteTelefono'=>$results->Fields("InfoContactoTelefono")->value, 
	    'ClienteFax' => $results->Fields("InfoContactoFax")->value,
	    'ClienteMail' => $expedientes[$i]['ClienteMail'],
	    'ClienteCodigo' => $expedientes[$i]['Codigo']);
	}else if($expedientes[$i]['IdCliente'] != $expedientes[$i-1]['IdCliente']){
		$results = Consulta_Clientes($conexion, $expedientes[$i]['IdCliente']);
		$clientes[$results->Fields('Codigo')->value] = array (
		'ClienteNombre' => $results->Fields("CN")->value, 
		'ClienteDireccion' => $results->Fields("DireccionLinea1")->value.' '.$results->Fields("DireccionLinea2")->value.' '.
		$results->Fields("DireccionLinea3")->value.' '.$results->Fields("DireccionLinea4")->value.' '.$results->Fields("DireccionCiudad")->value.' '.
		$results->Fields("DireccionEstado")->value.' '.$results->Fields("DireccionCodigoPostal")->value,
	    'ClientePais' => $results->Fields("PN")->value, 
	    'ClienteTelefono'=>$results->Fields("InfoContactoTelefono")->value, 
	    'ClienteFax' => $results->Fields("InfoContactoFax")->value,
	    'ClienteMail' => $expedientes[$i]['ClienteMail'],
	    'ClienteCodigo' => $expedientes[$i]['Codigo']);
		}
	}
	return $clientes;
}

function obtener_datos_marcas($conexion, $marcas, $expedientes)
{
	for($i=0; $i<count($expedientes); $i++){
	$results = $conexion->Execute("SELECT OwnerName, TrademarkName, AppNo, RegNumber, IntClass, LocalClass, Status, ClientContact, ClientId, RenewalDate
	FROM Web_ViewTrademarks 
	WHERE CaseNumber = ". $expedientes[$i]['Codigo'].";");	
	$marcas[$i] = array('Propietario'=>$results->Fields('OwnerName')->value, 'NombreMarca'=> $results->Fields('TrademarkName')->value, 'Solicitud'=>$results->Fields('AppNo')->value,
	'Registro'=>$results->Fields('RegNumber')->value, 'ClaseInt'=>$results->Fields('IntClass')->value, 'ClaseLocal'=>$results->Fields('LocalClass')->value, 
	'Estado' => $results->Fields('Status')->value, 'ClienteContacto' => $results->Fields('ClientId')->value,'IdCliente' => $results->Fields('ClientId')->value, 'FechaVencimiento' => $results->Fields('RenewalDate')->value,'Codigo' => $expedientes[$i]['Codigo']);
	}
	return $marcas;
}

function obtener_datos_concedidas($conexion, $marcas, $expedientes)
{
	
	for($i=0; $i<count($expedientes); $i++){
	$results = $conexion->Execute("SELECT OwnerName, TrademarkName, AppNo, IntClass, LocalClass, Status, ClientContact, ClientId
	FROM Web_ViewTrademarks 
	WHERE CaseNumber = ". $expedientes[$i]['Codigo'].";");	
	$marcas[$i] = array('Propietario'=>$results->Fields('OwnerName')->value, 'NombreMarca'=> $results->Fields('TrademarkName')->value, 'Solicitud'=>$results->Fields('AppNo')->value,
	 'ClaseInt'=>$results->Fields('IntClass')->value, 'ClaseLocal'=>$results->Fields('LocalClass')->value, 
	'Estado' => $results->Fields('Status')->value, 'ClienteContacto' => $results->Fields('ClientId')->value,'IdCliente' => $results->Fields('ClientId')->value,'Codigo' => $expedientes[$i]['Codigo']);
	}
	return $marcas;
}

function renovaciones_onscreen($idioma)
{
$conexion = ConectToDatabase();
$results = Consulta_Renovaciones($conexion, $idioma);  

echo "<div><table id =\"tabla_reporte\" class=\" col-lg-12 table table-bordered table-hover table-striped tablesorter renewals_onscreen;\">"; 

echo "<thead>
        <tr>
        	<th class=\"header\">Referencia<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Nombre<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Main Mail<i class=\"fa fa-sort\"></i></th>
            <th class=\"header\">Contacto Mail<i class=\"fa fa-sort\"></i></th>
        </tr>
      </thead>";
while (!$results->EOF) {  
		echo "<tr>";
		$fv = $results->Fields("Codigo");
	    echo "<td id=\"Codigo\" code=\"".$fv->value."\">M".str_pad($fv->value, "6", "0", STR_PAD_LEFT)."</td><td>".$results->Fields("Nombre")->value."</td><td>".$results->Fields("InfoContactoEmail")->value."</td><td>".$results->Fields("EInfoContacto")->value."</td>"; 
	    $results->MoveNext(); 
	    echo "</tr>";    
} 
echo"</table></div>";

cerrar_conexiones($conexion, $results);
}
?>