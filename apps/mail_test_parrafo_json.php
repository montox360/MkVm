<?php
require '../PHPClass/PHPMailerAutoload.php';


function createMail($marca, $cliente, $contactos, $idioma){
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mkmarcas.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;   			// Enable SMTP authentication
$mail->SMTPDebug = 0;       
$mail->Debugoutput = 'html';                    
$mail->Username = 'renewals@mkmarcas.com';                 // SMTP username
$mail->Password = 'Nightfire123!';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$arr = explode(',',str_replace(' ', '', $cliente['ClienteMail']));

foreach ($arr as $value)
{
	$mail->addAddress($value); 
}
$mail->addAddress($contactos[$marca['Codigo']]);

// Add a recipient
//$mail->addAddress('montox360@gmail.com');
//$mail->addAddress('amontoya@mkmarcas.com');
	//$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]);
$mail->addReplyTo('exterior@mkmarcas.com', 'Renewals Exterior');
$mail->addBCC('renewals@mkmarcas.com');

$mail->isHTML(true);                                  // Set email format to HTML

if($idioma==2){
$mail->Subject = "RENEWAL REMINDER! Trademark: ".$marca['NombreMarca'].", Application No. ".$marca['Solicitud'].", Registration No. ".$marca['Registro'].", in Int Class ".$marca['ClaseInt']."
 in Venezuela, o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}else{
	$mail->Subject = "RECORDATORIO DE RENOVACION! Marca: ".$marca['NombreMarca'].", Inscripcion No. ".$marca['Solicitud'].", Registro No. ".$marca['Registro'].", en Clase ".$marca['ClaseInt']."
 en Venezuela, n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}
$fecha = explode('/',$marca['FechaVencimiento']);
$fecha = $fecha[1].'/'.$fecha[0].'/'.$fecha[2];
if($idioma==2)
{
$mail->Body    ="
<p align=\"right\">Caracas, Marzo 10, 2017.</p>
Messrs<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Phone(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Re: ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Trademark:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Application No. ".$marca['Solicitud'].", Registration No. ".$marca['Registro'].", in Int Class&nbsp;".$marca['ClaseInt'].",(local class ".$marca['ClaseLocal'].") in&nbsp;Venezuela<br>
&nbsp; &nbsp; &nbsp; o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>
<br>
Status:&nbsp;<b>".$marca['Estado']."</b><br>
<b>Important:&nbsp;</b>RENEWAL REMINDER, Deadline: <b>".date("F j, Y", strtotime($fecha))." UNEXTENDABLE</b> <br>
<br>
Dear Sirs:<br>
<div align=\"justify\">
We  remind  you  that,  the  renewal of the registration stated in the
reference should be effected before the deadline mentioned above.<br>
<br>
1.-  The new current cost as of March 1st, 2017, for this service is US$ 3,100.00 for Renewal Tax
+ Bank charges and US$ 55.00 for administrative expenses; for a total amount in Official Fees of US$ 3,155.00<br>
<br>
2.-  US$ 330.00 for Service Charges*<br>
<br>
For a total amount of US$ 3,485.00<br>
<br>
The  information  to  proceed with the Renewal Tax wire-transfer is as
follows:<br>
Beneficiary: Montoya Kociecki & Asociados<br>
Bank       : TOTALBANK,<br>
Address    : 100 SE 2nd Street, floor 14.<br>
             Torre Downtown Miami, Florida 33131, USA<br>
Account No.: 1002027106<br>
ABA No.    : 066009155<br>
SWIFT      : TLBKUS3M<br>
<br>
Once  the Renewal Official Fees amount has been transfered to our Account,
please send us the transfer receipt.<br>
<br>
*This  amount should be accredited to our company Bank account
once  we  have sent you our debit note for the Service Charges with our filing receipts.<br>
<br>
Taking  into account the new ruling in Venezuela, it is very important
that  before  giving  instructions  or  make transfers to renew should
consult  on possible reclassifications to local classes in Venezuela ,
if applicable.<br>
<br>
In  case we do not receive an explicit answer ordering the renewal, we
will consider that you are not interested in the trademark and we will
proceed to eliminate this case from our files.<br>
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

setlocale(LC_TIME, 'es_ES.UTF-8');
$mail->Body    ="
<p align=\"right\">Caracas, Marzo 10, 2017.</p>
Se&ntilde;ores<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Tlf(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Ref:  ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Marca:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Inscripci&oacute;n No. ".$marca['Solicitud']."; Registro No. ".$marca['Registro']." en Clase Internacional&nbsp;".$marca['ClaseInt'].", en Venezuela<br>
&nbsp; &nbsp; &nbsp; n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>  
<br>
Estado actual: &nbsp;<b>".$marca['Estado']."</b><br>
<br>
Importante: RECORDATORIO DE RENOVACI&Oacute;N. Vencimiento: <b>".strftime('%b %d, %Y', strtotime($fecha))." IMPRORROGABLE</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">
Le   recordamos  que  la  renovaci&oacute;n  del  registro  indicado  en  la
referencia debe efectuarse antes del plazo mencionado anteriormente. Es muy importante que antes de dar instrucciones 
y/o realizar los pagos por transferencia, deben consultar sobre eventuales reclasificaciones a las clases locales o nacionales en Venezuela.<br>
<br>
Por anunciio oficial a partir del Marzo 1 de 2017, la tasa actual para una renovaci&oacute;n es de US $ 3,100.00 (incluyendo gastos bancarios) mas USD $55.00 de gastos administrativos para la solicitud; para un total de gastos oficiales de USD $3,155.00<br>
<br>
Nuestros honorarios para este servicio es de USD $330.00.<br>
<br>
El monto total por renovaci&oacute;n es de: USD $3,485.00.<br>
<br>
Los  datos de nuestra cuenta bancaria se indican a continuaci&oacute;n:<br>
<br>
Beneficiario: Montoya Kociecki & Asociados<br>
Banco      : TOTALBANK,<br>
Direcci&oacute;n  : 100 SE 2nd Street, floor 14.<br>
             Torre Downtown Miami, Florida 33131, USA<br>
Cuenta No. : 1002027106<br>
ABA No.    : 066009155<br>
SWIFT      : TLBKUS3M<br>
<br>
Si ustedes tienen inter&eacute;s en este servicio nosotros podemos enviarles anticipadamente la factura por el monto total para que pueda ser pagada antes de la fecha de vencimiento de renovaci&oacute;n.<br>
<br>
De  no  tener  respuesta,  consideraremos  que no tienen inter&eacute;s en la
marca y se proceder&aacute; a eliminar este caso de nuestros archivos.<br>
<br>
Atentamente,<br>
<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div>";}


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