<?php
require '../PHPClass/PHPMailerAutoload.php';


function createMail($codigo, $cliente, $incidenciaOpuesta, $incidenciaBase, $contacto, $idioma, $escritodoc){
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

//$mail->addAddress("lmontoya@mkmarcas.com");

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

//http://mkgalena.puntoip.info/docs_at/
if($idioma==2){
$mail->Subject = "OPPOSITION RATIFICATION BRIEF FILED, Trademark: ".$incidenciaBase->Fields('Marca')->value." - Appln No. ".$incidenciaBase->Fields('Solicitud')->value." in Class ".$incidenciaBase->Fields('Clase')->value.", in ".$incidenciaBase->Fields('Pais')->value." o/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT);
}else{
    $mail->Subject = "RATIFICACION DE OPOSICION. Marca: ".$incidenciaBase->Fields('Marca')->value." - Inscripción No. ".$incidenciaBase->Fields('Solicitud')->value." , Clase ".$incidenciaBase->Fields('Clase')->value." en ".$incidenciaBase->Fields('Pais')->value.", n/ref: AT".str_pad($codigo, "6", "0", STR_PAD_LEFT);
}

$mail->addStringAttachment(file_get_contents("http://mkgalena.puntoip.info/docs_at/".$escritodoc), "AT".str_pad($codigo, "6", "0", STR_PAD_LEFT).".pdf");

if($idioma==2)
{

$mail->Body ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, December 21, 2016.</p>
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

Status:&nbsp;<b>OPPOSITION RATIFICATION BRIEF FILED: </b><br>
<br>
Dear Sirs:<br>
<div align=\"justify\">
<br>
For the case quoted in the reference, we would like to inform you that the opposition ratification brief has been filed.<br>
<br>
Find attached a copy of the filed brief and the debit note for the services rendered.<br>
<br>
We will keep you informed on the development of this case.<br>
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
$mail->Body    ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, Diciembre 21, 2016.</p> 
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
Estado actual: &nbsp;<b>ESCRITO DE RATIFICACION DE OPOSICION PRESENTADO</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">
<br>
Nos complace informarle que para el caso citado en la referencia el escrito de ratificacion de oposición ha sido presentado ante la oficina de marcas en su debido momento.<br>
<br>
Encuentre anexo:<br>
<br>
- Copia del escrito de ratificación<br>
<br>
De acuerdo con lo conversado con el ingeniero Montoya, la factura se emitirá previa aprobación y pago del cliente, por el monto acordado. De ustedes no recibir el pago por parte del cliente en un periodo de 3 meses o en el periodo que ustedes propongan, el caso será abandonado. <br>
Les informaremos inmediatamente tan pronto recibamos noticias sobre el desarrollo de este caso.<br>
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

 
