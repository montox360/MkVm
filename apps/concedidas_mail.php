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

// Add a recipient
//$mail->addAddress('lmontoya@mkmarcas.com');
	//$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]);
$mail->addReplyTo('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$mail->addBCC('publicaciones_boletin@mkmarcas.com');

$mail->isHTML(true);                                  // Set email format to HTML


if($idioma==2){
$mail->Subject = "OFFICIALLY GRANTED! Trademark: ".$marca['NombreMarca'].", Application No. ".$marca['Solicitud'].", in Int Class ".$marca['ClaseInt']." Official Bulletin: 572
 in Venezuela, o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}else{
	$mail->Subject = "CONCESION OFICIAL! Marca: ".$marca['NombreMarca'].", Inscripcion No. ".$marca['Solicitud'].", en Clase ".$marca['ClaseInt'].", Boletin Oficial: 572, en Venezuela, n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}

if($idioma==2)
{

$mail->Body    ="<p align=\"right\">Caracas, February 21, 2017.</p>
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
Status:&nbsp;<b>OFFICIALLY GRANTED</b><br>
<br>
<b>Important:&nbsp;</b>OFFICIALLY GRANTED, Deadline: <b>".$vencimiento."</b> <br>
<br>
Dear Sirs:<br>
<div align=\"justify\">
Please  be  advised  that, the case of trademark application quoted in
the  reference has been granted. It is necessary to pay the final fees
in  order  to  obtain  the  registration  number.  The  cost  for this
procedure is as follows:<br>
<br>
1.- US$ 1250.00 (Final Fees + Bank charges).<br>
2.- US$ 200.00 (Service charges).<br>
<br>
Given  the inconvenients we have had with our clients at the moment of
executing  the  wire-transfer directly to the bank account of the PTO,
we are suggesting to execute the transfer directly to our bank account
at least 10 days before the deadline.<br>
<br>
In case we have a special agreement with you regarding the payment of the registration fees, please omit the last paragraph. <br>
<br>
The  total  amount  to pay for the final fees and our services is: US$
1,450.00.  If  you require our debit note in advance for this concept,
please let us know and we will send it to you immediately.<br>
<br>
The information to proceed with this wire-transfer is as follows:<br>
Beneficiary: Montoya Kociecki & Asociados<br>
Bank       : TOTALBANK,<br>
Address    : 100 SE 2nd Street, floor 14.<br>
             Torre Downtown Miami, Florida 33131, USA<br>
Account No.: 1002027106<br>
ABA No.    : 066009155<br>
SWIFT      : TLBKUS3M<br>
<br>
Please be informed that the Venezuelan Government has issued an official notification in which they notify that the Official Taxes will be increased by 70% as of March 1st, 2017. <br> 
<br>
The costs informed in this e-mail will only be available until February 24th, since on Monday and Tuesday February 27th and 28th were declared as holidays. <br>
<br>
In case you wish to maintain the costs informed above we would need to receive your payment and instructions before February 24th.<br>
<br>
The new costs for a trademark granting are as follows: <br>
Official Fees:&nbsp;&nbsp;&nbsp;<b>USD 1,995.00 (Including Bank Expenses)</b><br>
Service Charges: <b>USD 200.00 </b><br>
<br>
Total: <b>USD 2,195.00</b><br>
<br>
We remain expecting your payment and instruction in case you wish to proceed with the trademark granting.<br>
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
$mail->Body    ="<p align=\"right\">Caracas, Febrero 13, 2016.</p> 
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
Estado actual: &nbsp;<b>".$marca['Estado']."</b><br>
<br>
Vencimiento: <b>".$vencimiento."</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">
La  presente es para informarles que la marca citada en la referencia,
ha sido concedida.<br>
<br>
El costo para atender el tramite de concesión es el siguiente:<br>
<br>
1.- US$ 1250.00 (Tasa oficial + Comisiones bancarias).<br>
2.- US$ 200.00 (Nuestros Honorarios).<br>
<br>
Dado  los  inconvenientes que han tenido nuestros clientes en realizar
el  pago  directo  a la cuenta de la Oficina de Marcas, nos permitimos
sugerirles  que realicen el pago directamente en la cuenta de Montoya,
Kociecki & Asociados, con al menos 10 dias antes del vencimiento.<br>
<br>
El  monto  total para pago de impuestos finales es: 1,450.00. Si usted
requiere  la  factura  para  este  concepto  por favor informenos para
enviarsela de inmediato.<br>
<br>
Los datos para la transacción son los siguientes:<br>
Beneficiario: Montoya Kociecki & Asociados<br>
Banco      : TOTALBANK,<br>
Direcci&oacute;n  : 100 SE 2nd Street, floor 14.<br>
             Torre Downtown Miami, Florida 33131, USA<br>
Cuenta No. : 1002027106<br>
ABA No.    : 066009155<br>
SWIFT      : TLBKUS3M<br>
<br>
Si usted tiene alg&uacute;n acuerdo especial con respecto al pago de los gastos oficiales de registro con nuestra oficina, por favor omita este &uacute;ltimo requerimiento.
<br>
Por  favor,  tomar  en  cuenta que el retiro del
certificado  de  registro  al  momento  de su emisión mas la vigilancia de la marca hasta su pr&oacute;ximo vencimiento, tendrá un costo adicional de US$ 105.00 + Courier<br>
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