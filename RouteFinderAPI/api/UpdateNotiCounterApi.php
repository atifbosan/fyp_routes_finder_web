<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();
$taskerPreviousAmount;
$taskAmount;
$taskID;
$upatedTaskerAmount;
$taskerID;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['noti_forUserID']) &&
        isset($_POST['noti_for'])
    ) {
        $sql = "UPDATE tbl_notifications SET noti_status='1' 
            WHERE noti_forUserID=? AND noti_for=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('is', $_POST['noti_forUserID'], $_POST['noti_for']);
        if ($stmt->execute()) {
            $response['error'] = false;
            $response['code'] = 200;
            $response['message'] = "Notifications Read";
        } else {
            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Try Again";
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
