<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail()
{
    global $connection;

    if(isset($_POST['send_message']))
    {

        $title = mysqli_real_escape_string($connection,$_POST['title']) ;
        $content = mysqli_real_escape_string($connection,$_POST['content']);
        $category = mysqli_real_escape_string($connection,$_POST['category']);
        $date = date("Y-m-d");

        $query = "INSERT INTO support_msg (title, content, category, date_created, solved) 
        VALUES ('$title', '$content', '$category', '$date', 0)";
        $result = mysqli_query($connection, $query);

        if($result)
        {

            //Load Composer's autoloader
            require ("vendor/autoload.php");

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP(false);                                            //Send using SMTP
                $mail->Host       = '192.168.2.8';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
                $mail->Username   = 'jgomez@martechmedical.com';                     //SMTP username
                $mail->Password   = 'joseLuis15!';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                $mail->SMTPOptions = array(
                    'ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                        'allow_self_signed'=>true
                    )
                );

                //Recipients
                $mail->setFrom('mailer@martechmedical.com', 'Mailer');
                $mail->addAddress('jgomez@martechmedical.com', 'JGomez');     //Add a recipient
                $mail->addAddress('slandis2@martechmedical.com');               //Name is optional
                $mail->addAddress('avalle@martechmedical.com');
                $mail->addAddress('jvargas@martechmedical.com');
                $mail->addAddress('jbrzyski@martechmedical.com');
                $mail->addReplyTo('info@martechmedical.com', 'Information');
                $mail->addCC('jmorimoto@martechmedical.com');
                //$mail->addBCC('bcc@example.com');


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Production tracker error: ' . $category;
                $mail->Body    = "Error type <b>$category</b><br>$title<br>$content";
                $mail->AltBody = "Description: $title------$content---------$category";

                $mail->send();
                echo "
            <script>
                    Swal.fire({
                      title: 'Message',
                      text: 'Your message was sent.',
                      icon: 'success',
                    })
            </script>
            ";
            } catch (Exception $e) {
                echo "
            <script>
                    Swal.fire({
                      title: 'Message',
                      text: 'Message could not be delivered, but it was saved.',
                      icon: 'error',
                    })
            </script>
            ";
            }
        }
    }
}
