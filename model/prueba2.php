<?php
$correo=$_REQUEST['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'eddiejesus1197@gmail.com';                     // SMTP username
    $mail->Password   = '54asd4asd4as5da1d5s4ada54d5asd4a5sda51ds41a15d4a1sd54adas5d';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients  
    $mail->setFrom('eddiejesus1197@gmail.com', 'Notinews');
    $mail->addAddress($correo);     // Add a recipient
    
    // Content
    $mail->isHTML(true); 
                // Set email format to HTML
    $mail->Subject = 'Gracias por la compra';
    $mail->Body    = 'Notinews les da Bienvenida a su portal 		<br><br>
			Su usuario o cuenta es : '.$correo.' <br>
    		Su clave de Acceso es : <p>es su cuenta de banca</p><br><br>
    		Gracias por su Preferencia ';
    $mail->send();
    echo 'Correo se envio correctamente';
    $conexion=mysqli_connect("localhost", "root", "", "proyecto") or die("error");	
	$sql="update usuarios set tipo=0 where email='$correo'";
	$query = mysqli_query($conexion,$sql);
} catch (Exception $e) {
    echo "error en direccion de correo";
}
?>
