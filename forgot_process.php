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
require_once 'dbClass.php';

function generatePassword ($length = 8)
{
  $genpassword = "";
  $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
  $i = 0; 
  while ($i < $length) { 
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    if (!strstr($genpassword, $char)) { 
      $genpassword .= $char;
      $i++;
    }
  }
  return $genpassword;
} 

if (!isset($_POST['btnForgot']))
	header("Location: index.php");

if(isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname'])) {
    $db = new dbClass();

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'gamescope2017@gmail.com';                 // SMTP username
$mail->Password = 'gamescope123';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$email_from = $_POST["email"];  
$first_name = $_POST["fname"];
$last_name = $_POST['lname'];

    

    
$mail->setFrom( 'gamescope2017@gmail.com', 'GameScope'); 
    
$mail->addAddress($email_from, $first_name.' '.$last_name);     // Add a recipient

//$mail->addAddress('gamescope@gmail.com');               // Name is optional

//$mail->addReplyTo( $email_from, $full_name);
//$mail->addCC($email_from);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'GameScope - Reset Password';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if (gettype($db->identityValidatorMailer($email_from, $first_name, $last_name)) == "integer") {
        if($db->identityValidatorMailer($email_from, $first_name, $last_name) == 3){
            $db = null;
            echo '<script type="text/javascript">alert("Email does not exist."); </script>';
            echo("<script>window.location = 'forgot.php';</script>");
        }				
        if($db->identityValidatorMailer($email_from, $first_name, $last_name) == 2){     
            echo $db->identityValidatorMailer($email_from, $first_name, $last_name);
            $db = null;
        
            echo '<script type="text/javascript">alert("First name and Last name do not match email.");    </script>';
            echo("<script>window.location = 'forgot.php';</script>");
        }		
    } else {
         $u1 = $db->identityValidatorMailer($email_from, $first_name, $last_name);
         $newpassword = generatePassword();
         $db->passwordReset($newpassword, $u1->getUserId());
         $db = null;
         $message = "Hi, ".$u1->getUserName().".<br> Your password is: ".$newpassword;
         $mail->Body    = 'Sent from: GameScope<br><br>'.$message;
         $mail->send();
         $u1 = null;
         echo("<script>alert('Password reset mail sent successfully!')</script>");
         echo("<script>window.location = 'index.php';</script>");
     }

?>
    <?php
 
}
?>
