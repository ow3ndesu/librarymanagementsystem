<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Email Extends Database
{
    public function SendAccountStatusEmailNotification($useremail, $status){
        // Load Composer's autoloader
        require '../assets/PHPMailer-master/vendor/autoload.php';
        require_once("../includes/constants.php");
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_EMAILER;
            $mail->Password = EMAIL_EMAILERPASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; #COMMENTED/REMOVED TO ENSURE THIS FUNCTION DOES NOT RETURN ANY VALUE WHICH IS NOT A JSON FILE
            $mail->Port = 465;
            $mail->SetFrom('librarymanagementsystem63@gmail.com','LIBRARY MANAGEMENT SYSTEM NOTIFICATION');
            $mail->addAddress($useremail);
            $mail->addReplyTo('no-reply@gmail.com','NO-REPLY');
            $mail->isHTML(true);
            $mail->Subject = 'Account Status Notification';
            $mail->Body    = ($status == 'ENABLED') ? 'Congratulations, your account is now <b>enabled</b>! Please check and complete your account now.' : 'Unfortunately, the Administration decided to <b>disable</b> your account. Please be advised.';
            $mail->send();
        } catch (Exception $e) {
            echo $e->getMessage(); //error messages from anything else!
        }
    }

    public function SendBorrowalStatusEmailNotification($useremail, $status){
        // Load Composer's autoloader
        require '../assets/PHPMailer-master/vendor/autoload.php';
        require_once("../includes/constants.php");
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_EMAILER;
            $mail->Password = EMAIL_EMAILERPASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; #COMMENTED/REMOVED TO ENSURE THIS FUNCTION DOES NOT RETURN ANY VALUE WHICH IS NOT A JSON FILE
            $mail->Port = 465;
            $mail->SetFrom('librarymanagementsystem63@gmail.com','LIBRARY MANAGEMENT SYSTEM NOTIFICATION');
            $mail->addAddress($useremail);
            $mail->addReplyTo('no-reply@gmail.com','NO-REPLY');
            $mail->isHTML(true);
            $mail->Subject = 'Borrowal Status Notification';
            $mail->Body    = ($status == 'BORROWED') ? 'Congratulations, your borrowal is now <b>approved</b>! Please check your book now.' : 'Unfortunately, the Administration decided to <b>disapprove</b> your borrowal. Please be advised.';
            $mail->send();
        } catch (Exception $e) {
            echo $e->getMessage(); //error messages from anything else!
        }
    }

    public function SendReturnStatusEmailNotification($useremail, $status){
        // Load Composer's autoloader
        require '../assets/PHPMailer-master/vendor/autoload.php';
        require_once("../includes/constants.php");
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_EMAILER;
            $mail->Password = EMAIL_EMAILERPASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; #COMMENTED/REMOVED TO ENSURE THIS FUNCTION DOES NOT RETURN ANY VALUE WHICH IS NOT A JSON FILE
            $mail->Port = 465;
            $mail->SetFrom('librarymanagementsystem63@gmail.com','LIBRARY MANAGEMENT SYSTEM NOTIFICATION');
            $mail->addAddress($useremail);
            $mail->addReplyTo('no-reply@gmail.com','NO-REPLY');
            $mail->isHTML(true);
            $mail->Subject = 'Return Status Notification';
            $mail->Body    = ($status == 'RETURNED') ? 'Congratulations, your successfully <b>returned</b> a book! Please browse our library now.' : 'Unfortunately, the Administration decided to <b>disapprove</b> your return. Please be advised.';
            $mail->send();
        } catch (Exception $e) {
            echo $e->getMessage(); //error messages from anything else!
        }
    }
}