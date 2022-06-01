<?php
header("Content-Type: application/json; charset=UTF-8");
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['user_email'])) {
        $db = new DbOperations();
        $number = $db->generate_number(8);
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.googlemail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'atifbosan63@gmail.com';
        $mail->Password = '786012345678'; //Argument true in constructor enables exceptions

        $mail->From = "atifbosan63@gmail.com";
        $mail->FromName = "Route Finder APP";
        $dbEmail = $_POST['user_email'];
        $mail->addAddress($dbEmail, '');

        $mail->isHTML(true);
        $subject = "New Password From Alpha Tracker";
        $final_msg = "Your new Password is " . $number;

        $mail->Subject = $subject;
        $mail->Body = $final_msg;
        $mail->AltBody = "This is the plain text version of the email content";
        try {
            $mail->send();
            $db->UpdatePassword($dbEmail, $number);
            $response['error'] = false;
            $response['code'] = 200;
            $response['message'] = "Check your email for Password";

            //            $_SESSION['successMessage'] = "NGO Profile Status has been updated successfully";
            //            header("location:../viewNGODetails.php?NgoID=" . $NgoID);
        } catch (Exception $e) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        $response['error'] = true;
        $response['code'] = 404;
        $response['message'] = "Required field missing";
    }
} else {
    $response['error'] = true;
    $response['code'] = 404;
    $response['message'] = "Server connection";
}
echo json_encode($response);
