<?php
//include 'nav.php';
/*
    Download PhpMailer from the following link:
    https://github.com/Synchro/PHPMailer (CLick on Download zip on the right side)
    Extract the PHPMailer-master folder into your xampp->htdocs folder
    Make changes in the following code and its done :-)

    You will receive the mail with the name Root User.
    To change the name, go to class.phpmailer.php file in your PHPMailer-master folder,
    And change the name here: 
    public $FromName = 'Root User';
*/
$email = $_POST['email'];
echo "test 0 ";
require("PHPMailer/class.phpmailer.php"); //or select the proper destination for this file if your page is in some   //other folder
echo "test 1 ";
ini_set("SMTP","ssl://smtp.gmail.com"); 
echo "test 2 ";
ini_set("smtp_port","465"); //No further need to edit your configuration files.
$mail = new PHPMailer();
$mail->SMTPAuth = true;
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
}
?>
