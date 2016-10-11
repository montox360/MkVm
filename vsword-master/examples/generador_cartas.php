<?php
/**
* This example demonstrates the parsing HTML string and convert it into the document.
*/
error_reporting(E_ALL ^ E_STRICT);
require_once '../vsword-master/vsword/VsWord.php'; 

function generarCarta($codigo, $cliente, $incidenciaOpuesta, $incidenciaBase, $vencimiento, $boletin){
VsWord::autoLoad();

$doc = new VsWord();  
$parser = new HtmlParser($doc);

$parser->parse("<p align='right'>Caracas, Octubre 10, 2016.</p> 
<p>Señores<br>
<b>".$cliente->Fields('Nombre')->value."</b><br>
".preg_replace('([^A-Za-z0-9[:space:]])', '', $cliente->Fields('DireccionLinea1')->value).",".preg_replace('([^A-Za-z0-9[:space:]])', '', $cliente->Fields('DireccionLinea2')->value).",".preg_replace('([^A-Za-z0-9[:space:]])', '', $cliente->Fields('DireccionLinea3')->value).",".preg_replace('([^A-Za-z0-9[:space:]])', '', $cliente->Fields('DireccionLinea4')->value)."<br>
".$cliente->Fields('Pais')->value."<br>
Tlf(s): ".$cliente->Fields('InfoContactoTelefono')->value."<br>
e-mail: ".$cliente->Fields('InfoContactoEmail')->value."<br>
<br>
Ref:  Solicitante de Marca Opuesta: ".$incidenciaOpuesta->Fields('PropietarioNombre')->value."<br>
Marca: <b>".$incidenciaOpuesta->Fields('Marca')->value."</b><br>
Inscripcion No. ".$incidenciaOpuesta->Fields('Solicitud')->value."; en Clase Internacional ".$incidenciaOpuesta->Fields('Clase')->value."<br>
    n/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT)."<br> 
<br>
Ref:  Datos de Marca Base: ".preg_replace('([^A-Za-z0-9[:space:]])', '', $incidenciaBase->Fields('PropietarioNombre')->value)."
Marca:<b>".$incidenciaBase->Fields('Marca')->value."</b>
Inscripción No. ".$incidenciaBase->Fields('Solicitud')->value."; en Clase Internacional ".$incidenciaBase->Fields('Clase')->value."<br>
<br>
Estado actual: &nbsp;<b>RATIFICACION DE OPOSICION</b> - Vencimiento: <b>".$vencimiento."</b><br>
<br>
Estimados señores:<br>
<br>
En el Boletín Oficial No. 566 del Servicio Autónomo de la Propiedad Intelectual (S.A.P.I), del 8 de septiembre de 2016, ha sido publicado un Aviso Oficial donde se les notifica a las personas que han presentado oposiciones a las solicitudes de marcas que cursan por ante ese Despacho, que deben ratificar su interés en continuar con el trámite de las oposiciones presentadas. <br>
<br>
El objeto de esta acción es depurar y agilizar los procedimientos administrativos en curso, sin que ello implique la consignación de los nuevos recaudos concernientes a dichos asuntos.<br>
<br>
A tal fin, ha sido otorgado un periodo de dos (2) meses contados desde la vigencia del Boletín Oficial, para ratificar dicha acción mediante un escrito. De no ratificar la oposición presentada se entenderá que no hay interés procesal administrativo y en consecuencia se procederá a declarar la perención del procedimiento de la oposición, de conformidad con lo dispuesto en el artículo 64 de la Ley Orgánica de Procedimientos Administrativos.<br>
<br>
Con esta nueva etapa se impone, un gasto adicional, no previsto al momento de presentar la solicitud, el cual asciende a Bs. 40.100,00 + IVA, por concepto de honorarios por preparar y presentar el escrito de ratificación de la oposición presentada. <br>
<br>
En caso de estar de acuerdo con esta acción, favor expresar su aceptación de este gasto adicional impuesto para poder emitir la factura correspondiente y proceder con la ratificación. <br>
<br>
Les agradecemos tomar en cuenta que sus instrucciones deben ser recibidas con siete (7) días de antelación a la fecha de vencimiento indicada.<br>
<br>
Cualquier otra duda relacionada con este caso, será atendida por el Dr. Jorge E.  Delgado, Director de Mercadeo y Servicios al Cliente, quien gustosamente la aclarará.<br>
<br>
Atentamente, <br>
<br>
MONTOYA, KOCIECKI y ASOCIADOS<br>
mercadeo@mkmarcas.com
");

//echo '<pre>'.($doc->getDocument()->getBody()->look()).'</pre>';

$doc->saveAs("Cartas/AT".str_pad($codigo, "6", "0", STR_PAD_LEFT).".docx");

}
