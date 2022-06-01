<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['user_email']) 
        && isset($_POST['otp_account'])
    ) {
        $sql = "UPDATE tbl_users SET otp_account=? 
            WHERE user_email=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ss', $_POST['otp_account'],
         $_POST['user_email']);
        if ($stmt->execute()) {

        $query = "SELECT user_contactNo,otp_account FROM `tbl_users` 
        WHERE user_email=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $_POST['user_email']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $user_contactNo,
            $otp_account
        );
        while ($row = $stmt->fetch()) {
            $response['user_contactNo'] =  $user_contactNo;
            $response['otp_account'] = $otp_account;
        }


            $response['error'] = false;
            $response['code'] = 200;
            $response['message'] = "Otp Send on Contact Number";
        } else {
            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Otp Not Send Try Again";
        }
    } else {
        $response['error'] = true;
        $response['code'] = 404;
        $response['message'] = "required fields are missing";
    }
} else {
    $response['error'] = true;
    $response['code'] = 500;
    $response['message'] = "Something went wrong try again later";
}
echo json_encode($response);
