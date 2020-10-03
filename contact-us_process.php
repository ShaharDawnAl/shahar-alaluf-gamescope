<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/siteicon.png">
    <title>Game Scope - Loading...</title>
</head>

<body style="width: 80%; background: url(images/loading.gif) no-repeat center center fixed; 
	background-size: 50%;">
</body>

</html>

<?php
require 'email/PHPMailer/PHPMailerAutoload.php';

if (!isset($_POST['btnContactUs']))
	header("Location: index.php");

if(isset($_POST['userFullName']) && isset($_POST['userEmail']) && isset($_POST['userMessage'])) {
    
    

$mail = new PHPMailer();

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'gamescope2017@gmail.com';                 // SMTP username
$mail->Password = 'gamescope123';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$email_from = $_POST["userEmail"];  
$full_name = $_POST["userFullName"];
$message = $_POST['userMessage'];
    
    
$mail->setFrom( $email_from, $full_name); 
    
$mail->addAddress('gamescope2017@gmail.com', 'gamescope');     // Add a recipient
$mail->addAddress('shahar.al2013@gmail.com', 'Shahar');     // Add a recipient
$mail->addAddress('aviadkatav@gmail.com', 'Aviad');     // Add a recipient

//$mail->addAddress('gamescope@gmail.com');               // Name is optional

//$mail->addReplyTo( $email_from, $full_name);
//$mail->addCC($email_from);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'GameScope - Message from '.$full_name;
$mail->Body    = 'Sent from: '.$email_from.'<br><br>'.$message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.\n';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$full_name)) {
    $error_message .= 'The Full Name you entered does not appear to be valid.\n';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The Message you entered do not appear to be valid.\n';
  }
 
    
    if($error_message != ""){     
        echo '<script type="text/javascript">alert("Mail could not be sent, follow the instructions:\n\n' . $error_message . '"); </script>';
        echo("<script>window.location = 'contact-us.php';</script>");
     }				
     else{
         $mail->send();
         echo("<script>alert('Mail sent successfully!')</script>");
         echo("<script>window.location = 'contact-us.php';</script>");
     }
     
?>

    <?php
 
}
?>
