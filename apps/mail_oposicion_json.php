<?php
require '../PHPClass/PHPMailerAutoload.php';


function createMail($codigo, $cliente, $incidenciaOpuesta, $incidenciaBase, $contacto, $idioma, $vencimiento, $boletin){
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mkmarcas.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;             // Enable SMTP authentication
$mail->SMTPDebug = 0;       
$mail->Debugoutput = 'html';                    
$mail->Username = 'publicaciones_boletin@mkmarcas.com';                 // SMTP username
$mail->Password = 'Nightfire123!';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;  
$mail->CharSet = 'UTF-8';                                  // TCP port to connect to

$mail->setFrom('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');

$arr = explode(',',str_replace(' ', '', $cliente->Fields("InfoContactoEmail")->value));

//$mail->addAddress("montox360@gmail.com");

foreach ($arr as $value)
{
    if($value != '' || $value != ' ')
    $mail->addAddress($value); 
}

$conarr = explode(',', str_replace(' ', '', $contacto->Fields("InfoContactoEmail")->value));

foreach($conarr as $contac){
   $mail->addAddress($contac);
}
$mail->addReplyTo('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$mail->addBCC('publicaciones_boletin@mkmarcas.com');
// Add a recipient
//$mail->addAddress('lmontoya@mkmarcas.com');
    //$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]);

$mail->isHTML(true);                                  // Set email format to HTML


if($idioma==2){
$mail->Subject = "OFFICIAL NOTIFICATION FOR OPPOSITION RATIFICATION Bulletin No ".$boletin.", Trademark: ".$incidenciaBase->Fields('Marca')->value." - Appln No. ".$incidenciaBase->Fields('Solicitud')->value." in Class ".$incidenciaBase->Fields('Clase')->value.", in ".$incidenciaBase->Fields('Pais')->value." o/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT);
}else{
    $mail->Subject = "RATIFICACION DE OPOSICION. Boletín No. ".$boletin.", Marca: ".$incidenciaBase->Fields('Marca')->value." - Inscripción No. ".$incidenciaBase->Fields('Solicitud')->value." , Clase ".$incidenciaBase->Fields('Clase')->value." en ".$incidenciaBase->Fields('Pais')->value.", n/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT);
}

if($idioma==2)
{

$mail->Body ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, October 04, 2016.</p>
Messrs<br>
<b>".$cliente->Fields('Nombre')->value."</b><br>
".$cliente->Fields('DireccionLinea1')->value.",".$cliente->Fields('DireccionLinea2')->value.",".$cliente->Fields('DireccionLinea3')->value.",".$cliente->Fields('DireccionLinea4')->value."<br>
".$cliente->Fields('Pais')->value."<br>
Phone(s): ".$cliente->Fields('InfoContactoTelefono')->value."<br>
e-mail: ".$cliente->Fields('InfoContactoEmail')->value.", ".$contacto->Fields('InfoContactoEmail')->value."<br>
<br>
Re: Third party trademark applicant:".$incidenciaOpuesta->Fields('PropietarioNombre')->value."<br>
&nbsp; &nbsp; &nbsp; Trademark:&nbsp;<b>".$incidenciaOpuesta->Fields('Marca')->value."</b><br>
&nbsp; &nbsp; &nbsp; Application No. ".$incidenciaOpuesta->Fields('Solicitud')->value.", in Int Class&nbsp;".$incidenciaOpuesta->Fields('Clase')->value.", in&nbsp;".$incidenciaOpuesta->Fields('Pais')->value."<br>
&nbsp; &nbsp; &nbsp; o/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT)."<br>
<br>
Re: Base Trademark: ".$incidenciaBase->Fields('PropietarioNombre')->value."<br>
&nbsp; &nbsp; &nbsp; Trademark:&nbsp;<b>".$incidenciaBase->Fields('Marca')->value."</b><br>
&nbsp; &nbsp; &nbsp; Application No. ".$incidenciaBase->Fields('Solicitud')->value."; en International Class ".$incidenciaBase->Fields('Clase')->value.", in ".$incidenciaBase->Fields('Pais')->value."<br>
<br>

Status:&nbsp;<b>OFFICIAL NOTIFICATION FOR OPPOSITION RATIFICATION in Bulletin: ".$boletin." - Deadline: ".$vencimiento."</b><br>
<br>
Dear Sirs:<br>
<div align=\"justify\">
On August 22, 2016, there was an official notification of the Venezuelan Trademark Office, published in the Official Gazette No. 566, dated September 11, 2016, where \"is made with the knowledge of users, agents and general public, and especially those interested in observing procedures and / or opposition that had attempted against applications submitted before this office, that based on articles 30 and 53 of the organic law on administrative procedures; in order to debug the administrative procedures pending and with a view to expediting, the interested must ratify by written brief their interest in continuing with the procedure and objections filed to this date, that have been reported (in the automated system of our database it is referred as internal status 120 and 124), without involving the filing of the required documents again concerning these matters. For these purposes, they are granted two (2) months from the effective date of this publication in the bulletin of industrial property, for ratification of the interest to continue the processing of such proceedings (...). Not ratifying the observation and / or opposition filed, it is understood that there is no administrative procedural interest in continuing the process, and therefore proceed to declare the lapsing of the procedure, in accordance with Article 64 of the Organic Law of administrative procedures.\"<br>
<br>
Based on the above resolution, we have a period of two (2) months to submit a letter of ratification of the opposition filed. This new stage of the process imposes an additional expenditure not provided when submitting the application, which amounts to a total of USD 90.00 including our fees.<br>
<br>
In order to proceed with such ratification it is necessary that the base trademark is in force.<br>
<br>
Please have in mind that your instructions must be received 7 days before the deadline<br>
<br>
Best regards,<br>
<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div></body>
";}

/*Dear Sirs:<br>
<div align=\"justify\">Please be advised that, the renewal of the registration stated in the reference should be effected before the deadline mentioned above.<br>
<br>
In case you wish to proceed with the renewal of the trademark, the costs for this service are as follows:<br>
<br>
1.- US$ 2412.86 (Renewal Tax + Bank charges). *<br>
&nbsp;&nbsp;&nbsp;* This amount should be wired at least 30 days before the deadline directly to the PTO account.<br>
2.- US$ 385.00 (Service Charges + Official Fees)<br>
<br>
The information to proceed with the Renewal Tax wire-transfer is as follows:<br>
<br>
Beneficiary: Banco Bicentenario del Pueblo de la Clase Obrera, Mujer y Comunas, Banco Universal C.A<br>
Account No.: 36252699<br>
Beneficiary Physical Address:<br>
Av. Venezuela, Urb. El Rosal, Edificio Banco Bicentenario, Caracas - Venezuela<br>
Beneficiary Bank: CITIBANK<br>
ABA No.: 021000089&nbsp;/&nbsp;SWIFT: CITIUS33XXX<br>
Address of the bank: NEW YORK, USA<br>
Beneficiary Instructions:<br>
Credit to SAPI account. Foreign Currency. No. 0175-0473-81-0073423-544. Renewal - Registration. No. ".$marca['Registro']."<br> 
<br>
Once the Renewal Tax amount has been transfered to the PTO's Account, you must send us the transfer receipt, 
so we can file it at the PTO in order for the trademark Office to confirm the payment and emit the official invoice.<br>
<br>
Should we not receive an explicit answer ordering said renewal, we will consider that you are not interested
in the trademark and we will proceed to eliminate this case from our files.<br>
<br>
Best regards.<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div>";
*/
else{
$mail->Body    ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, Octubre 03, 2016.</p> 
Se&ntilde;ores<br>
<b>".$cliente->Fields('Nombre')->value."</b><br>
".$cliente->Fields('DireccionLinea1')->value.",".$cliente->Fields('DireccionLinea2')->value.",".$cliente->Fields('DireccionLinea3')->value.",".$cliente->Fields('DireccionLinea4')->value."<br>
".$cliente->Fields('Pais')->value."<br>
Tlf(s): ".$cliente->Fields('InfoContactoTelefono')->value."<br>
e-mail: ".$cliente->Fields('InfoContactoEmail')->value.", ".$contacto->Fields('InfoContactoEmail')->value."<br>
<br>
Ref:  Solicitante de Marca Opuesta: ".$incidenciaOpuesta->Fields('PropietarioNombre')->value."<br>
&nbsp; &nbsp; &nbsp; Marca:&nbsp;<b>".$incidenciaOpuesta->Fields('Marca')->value."</b><br>
&nbsp; &nbsp; &nbsp; Inscripci&oacute;n No. ".$incidenciaOpuesta->Fields('Solicitud')->value."; en Clase Internacional&nbsp;".$incidenciaOpuesta->Fields('Clase')->value.", en ".$incidenciaOpuesta->Fields('Pais')->value."<br>
&nbsp; &nbsp; &nbsp; n/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT)."<br> 
<br>
Ref:  Datos de Marca Base: ".$incidenciaBase->Fields('PropietarioNombre')->value."<br>
&nbsp; &nbsp; &nbsp; Marca:&nbsp;<b>".$incidenciaBase->Fields('Marca')->value."</b><br>
&nbsp; &nbsp; &nbsp; Inscripci&oacute;n No. ".$incidenciaBase->Fields('Solicitud')->value."; en Clase Internacional&nbsp;".$incidenciaBase->Fields('Clase')->value.", en ".$incidenciaBase->Fields('Pais')->value."<br>
<br>
Estado actual: &nbsp;<b>RATIFICACION DE OPOSICION</b> - Vencimiento: <b>Noviembre 11, 2016</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">
El  22 de agosto de 2016,  hubo una notificación oficial del Servicio Autónomo de la Propiedad idustrial SAPI, publicada en el Boletín Oficial No. 566, de fecha 8 de septiembre de 2016, donde \"se hace del conocimiento de los usuarios, tramitantes y público en general, y en especial de los interesados en los procedimientos de observación y/o oposición que hubieran intentado contra solicitudes que cursen por ante este despacho de registro, que con fundamento en los artículos 30 y 53 de la ley orgánica de  procedimientos administrativos; a los fines de depurar los procedimientos administrativos en trámite y con miras a su agilización, deben ratificar por escrito su interés en continuar con la tramitación de las observaciones y/o oposiciones presentadas hasta la presente fecha, que hayan sido notificadas (en el sistema automatizado de nuestra base datos, se refieren a los estatus internos 120 y 124), sin que ello implique la consignación nuevamente de los recaudos concernientes a dichos asuntos. A tales fines, se les otorgan dos (2) meses contados a partir de la vigencia de esta publicación en el boletín de la propiedad industrial, para la ratificación del interés de continuar con la tramitación de dichos procedimientos (…). De no ratificar la observación y/o oposición presentada, se entenderá que no existe interés procesal administrativo en continuar el trámite, y en consecuencia se procederá a declararles la perención del procedimiento, de conformidad con lo dispuesto en el artículo 64 de la ley orgánica de procedimientos administrativos.\"<br>
<br>
En base a la resolución anterior,  disponemos de un lapso de dos (2) meses para presentar un escrito de ratificación de la oposición presentada. Esta nueva etapa del trámite nos impone, un gasto adicional no previsto al momento de presentar la solicitud, el cual asciende a US D 90,00  por concepto de nuestros honorarios.<br>
<br>
Para hacer dicha ratificación es necesario que la base de la oposición este vigente.<br>
<br>
Favor tomar en cuenta que sus instrucciones deberán ser recibidas con treinta (7) días de anticipación a la fecha de vencimiento indicada.<br>
<br>
Atentamente,<br>
<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div></body>";
}


$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    return "Error";
} else {
    return "Ok";
    //echo 'e No.: M'.str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).' has been sent to '.$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."</br>";
}

}

 
