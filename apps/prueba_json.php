<?php
include "../funciones/funciones_base.php";

if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "send mail": test_function(); break;
    }
  }
}

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function(){
  $return = $_POST;
  $codigos = explode(", ", $return['codigo']);
  
  $idioma = $return['idioma'];
 
  $conexion = ConectToDatabase();
  $results = Consulta_Renovaciones_Json($conexion, $codigos, $idioma);
  
 $contactos = array();
  while (!$results->EOF) {  
    $fv = $results->Fields("Codigo");
    $contactos[$fv->value] = $results->Fields("EInfoContacto")->value;
    $results->MoveNext(); 
  }

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

for ($i=0; $i<count($marcas); $i++)
{
    $mail = null;
    $mail = createMail($marcas[$i], $clientes[$marcas[$i]['IdCliente']], $contactos, $idioma);
}
  
/* 
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
*/
  $return["json"] = $contactos;
  
 
  echo json_encode($return);
}

?>