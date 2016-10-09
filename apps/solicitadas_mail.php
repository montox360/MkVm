<?php
require '../PHPClass/PHPMailerAutoload.php';


function createMail($marca, $cliente, $contactos, $idioma, $archivo, $vencimiento, $boletin){
$mail = new PHPMailer;
$archivo = "http://mkgalena.puntoip.info/docs_ma/".$archivo;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mkmarcas.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;   			// Enable SMTP authentication
$mail->SMTPDebug = 0;       
$mail->Debugoutput = 'html';                    
$mail->Username = 'publicaciones_boletin@mkmarcas.com';                 // SMTP username
$mail->Password = 'Nightfire123!';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;  
$mail->CharSet = 'UTF-8';                                  // TCP port to connect to

$mail->setFrom('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$arr = explode(',',str_replace(' ', '', $cliente['ClienteMail']));
if($idioma==1)
{$mail->addStringAttachment(file_get_contents($archivo), "M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).".pdf");}
else
{$mail->addStringAttachment(file_get_contents($archivo), "M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).".pdf");}
//$mail->addAddress("montox360@gmail.com");

foreach ($arr as $value)
{
	if($value != '' || $value != ' ')
    $mail->addAddress($value); 
}

$conarr = explode(',', str_replace(' ', '', $contactos[$marca['Codigo']]));

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
$mail->Subject = "OFFICIAL PUBLICATION Bulletin No ".$boletin.", Trademark: ".$marca['NombreMarca']." - Appln No. ".$marca['Solicitud']." in Class ".$marca['ClaseInt'].", in Venezuela o/ref: ".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}else{
	$mail->Subject = "PUBLICACIÓN OFICIAL Boletín No. ".$boletin.", Marca: ".$marca['NombreMarca']." - Inscripción No. ".$marca['Solicitud']." , en Clase ".$marca['ClaseInt']."
 en Venezuela, n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}

if($idioma==2)
{

$mail->Body ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, August 22, 2016.</p>
Messrs<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Phone(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Re: ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Trademark:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Application No. ".$marca['Solicitud'].", in Int Class&nbsp;".$marca['ClaseInt'].",(local class ".$marca['ClaseLocal'].") in&nbsp;Venezuela<br>
&nbsp; &nbsp; &nbsp; o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>
<br>
Status:&nbsp;<b>OFFICIAL PUBLICATION</b><br>
<br>
<b>Important:&nbsp;</b>OFFICIAL PUBLICATION<br>
<br>
Dear Sirs:<br>
<div align=\"justify\">
Please  be  advised  that  this  application  has  been  published for
opposition purposes in the above-identified Official Bulletin.<br>
<br>
In  absence  of  timely  oppositions before ".$vencimiento.",  further
examination  will  proceed.  Once  the examination  is completed the applied 
for registration trademark will be granted or denied.<br>
<br>
If  you  find  any  discrepancy  and/or  omission  in  relation to the
attached document, please let us know so we can have the corresponding
corrections made.<br>
<br>
We will keep you advised on the development of this case.
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
$mail->Body    ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, Agosto 22, 2016.</p> 
Se&ntilde;ores<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Tlf(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Ref:  ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Marca:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Inscripci&oacute;n No. ".$marca['Solicitud']."; en Clase Internacional&nbsp;".$marca['ClaseInt'].", en Venezuela<br>
&nbsp; &nbsp; &nbsp; n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>  
<br>
Estado actual: &nbsp;<b>PUBLICACION OFICIAL</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">
Por  medio  de  la  presente,  les  informamos  que  la  solicitud  en
referencia  fue  publicada  en  el Boletín Oficial arriba identificado
para efectos de oposición.<br>
<br>
Las  oposiciones  de terceros podrán presentarse antes del ".$vencimiento."<br>
<br>
De  no  haber  oposición  dentro  del  lapso permitido, este caso será
evaluado   y  cuando  se  produzca  alguna  decisión  sobre  el  mismo
volveremos a informarles.<br>
<br>
Si  encuentra  alguna discrepancia u omisión en los documentos anexos,
agradecemos nos hagan llegar sus observaciones a los fines de realizar
las correcciones pertinentes.<br>
<br>
Sin más a que hacer mención, les saludamos,<br>
<br>
Atentamente,<br>
<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div></body>";}


$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    return "Error";
} else {
	return "Ok";
    //echo 'e No.: M'.str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).' has been sent to '.$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."</br>";
}
}
 
function sendMail($mail){
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}