<?php
echo "test0 ";
$email = $_POST['email'];
require_once("./PHPMailer/class.phpmailer.php");
//ini_set("SMTP","ssl://smtp.gmail.com"); 
//ini_set("smtp_port","465"); //No further need to edit your configuration files.
echo "test1 ";
$mail = new PHPMailer();

$body = file_get_contents('../emailContent.html');
$body = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                          // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "calpolyiot@gmail.com";  // GMAIL username
$mail->Password   = "cloud1platform";            // GMAIL password

$mail->AddReplyTo("calpolyiot@gmail.com","Ar Me");
$mail->SetFrom('calpolyiot@gmail.com', 'First Last');
$address = "calpolyiot@gmail.com";
$mail->AddAddress($address);
$mail->Subject    = "PHPMailer Test Subject via mail(), basic";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

/*$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com"; // SMTP server
$mail->SMTPSecure = "ssl";
$mail->Username = "calpolyiot@gmail.com"; //account with which you want to send mail. Or use this account. i dont care :-P
$mail->Password = "cloud1platform"; //this account's password.
$mail->Port = "465";
$mail->IsSMTP();  // telling the class to use SMTP
$rec1="amendira@calpoly.edu"; //receiver. email addresses to which u want to send the mail.
$mail->AddAddress($rec1);
$mail->Subject  = "Eventbook";
$mail->Body     = "Hello hi, testing";
$mail->WordWrap = 200;
if(!$mail->Send()) {
echo 'Message was not sent!.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo  //Fill in the document.location thing
'<script type="text/javascript">
                        if(confirm("Your mail has been sent"))
                        document.location = "/";
        </script>';
}*/
?>
