<?php
require '../PHPClass/PHPMailerAutoload.php';


function createMail($marca, $cliente, $contactos, $idioma, $archivo, $vencimiento){
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
                                  // TCP port to connect to

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
//$mail->addAddress('lmontoya@mkmarcas.com');
// Add a recipient
//$mail->addAddress('lmontoya@mkmarcas.com');
	//$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]);
$mail->addReplyTo('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$mail->addBCC('publicaciones_boletin@mkmarcas.com');

$mail->isHTML(true);                                  // Set email format to HTML


if($idioma==2){
$mail->Subject = "NEWSPAPER PUBLICATION ORDER! Trademark: ".$marca['NombreMarca'].", Application No. ".$marca['Solicitud'].", in Int Class ".$marca['ClaseInt']." in Official Bulletin: 572, in Venezuela, o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}else{
	$mail->Subject = "ORDEN DE PUBLICACION EN PRENSA! Marca: ".$marca['NombreMarca'].", Inscripcion No. ".$marca['Solicitud'].", en Clase ".$marca['ClaseInt'].", en Boletin Oficial 572, en Venezuela, n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}

if($idioma==2)
{

$mail->Body    ="<p align=\"right\">Caracas, February 28, 2017.</p>
Messrs<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Phone(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Re: ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Trademark:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Application No. ".$marca['Solicitud'].", in Int Class&nbsp;".$marca['ClaseInt'].",(local class ".$marca['ClaseLocal'].")&nbsp;in&nbsp;Official Bulletin: 572, in&nbsp;Venezuela<br>
&nbsp; &nbsp; &nbsp; o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>
<br>
Status:&nbsp;<b>NEWSPAPER PUBLICATION ORDER.</b><br>
<br>
<b>Important:&nbsp;</b>NEWSPAPER PUBLICATION ORDER, Deadline: <b>".$vencimiento."</b> <br>
<br>
Dear Sirs:<br>
<br>
<div align=\"justify\">
Due to the recent change of IP Law, in our country, the publication of
trademarks  must be first effected in a daily newspaper and afterwards
published in the Official Bulletin.<br>
<br>
The  cost of the publication in a Sapi digital newspaper is US$ 106.00
plus US$ 110.00 for our service charges. In case you have already paid in advance for this service or if we have
a special agreement between our offices, please omit the charges informed
in this e-mail.<br>
<br>
The  publication  must  be  effected  as soon as possible, immediately
after  the  publication  notice  appears  in the Official Bulletin. We
would  therefore  need  your  immediate  response,  if  the  client is
interested in following the registration procedure.<br>
<br>
Please  respond  by return mail, if we are allowed to proceed with the
publication and that our estimated costs will be paid.<br>
<br>
Your prompt attention to this message is appreciated.<br>
<br>
Very truly yours,<br>
<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div>
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
$mail->Body    ="<p align=\"right\">Caracas, Febrero 28, 2017.</p> 
Se&ntilde;ores<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Tlf(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Ref:  ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Marca:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Inscripci&oacute;n No. ".$marca['Solicitud']."; en Clase Internacional&nbsp;".$marca['ClaseInt'].", en Boletin Oficial: 572, en Venezuela<br>
&nbsp; &nbsp; &nbsp; n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>  
<br>
Estado actual: &nbsp;<b>".$marca['Estado']."</b><br>
<br>
Vencimiento: <b>".$vencimiento."</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">

En  vista  de  los  cambios  de  ley  de  la  Propiedad Industrial, en
Venezuela,  las solicitudes de registro de marcas deben ser publicadas
en  un  peri&oacute;dico de circulaci&oacute;n diaria y posteriormente en el Bolet&iacute;n
de la Propiedad Industrial.<br>
<br>
El  costo  de la publicaci&oacute;n arriba mencionada en el Peri&oacute;dico Digital
del SAPI es de US$ 106.00 m&aacute;s US$ 110.00 por nuestros servicios. En caso de que hayan pagado por adelantado o se haya llegado a un acuerdo especial
entre nuestras oficinas, por favor omita las tarifas informadas en este correo.<br>
<br>
La  publicaci&oacute;n  en  prensa  debe ser efectuada en el peri&oacute;dico lo mas
pronto  posible  una  vez  sea  ordenada en el Bolet&iacute;n Oficial. Por lo
tanto agradecemos recibir una pronta respuesta manifestando su inter&eacute;s
en  la  continuaci&oacute;n  del  tr&aacute;mite.  El no cumplimiento del mencionado
requisito  dentro  del  lapso  previsto  traer&aacute;  como  consecuencia el
abandono de la solicitud.<br>
<br>
Quedamos a la espera de sus instrucciones.<br>
<br>
Atentamente,<br>
<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div>";
}


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