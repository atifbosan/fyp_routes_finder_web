<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['tracking_lat']) &&
        isset($_POST['tracking_lng']) &&
        isset($_POST['tracking_fk_user_id'])
    ) {

        $db = new DbOperations();

        if ($db->checkTracking($_POST['tracking_fk_user_id'])) {

            $sql = "UPDATE tbl_tracking SET tracking_lat=? ,
             tracking_lng=? WHERE tracking_fk_user_id=?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('ddi', $_POST['tracking_lat'], $_POST['tracking_lng']
            , $_POST['tracking_fk_user_id']);
            if ($stmt->execute()) {
                $response['error'] = false;
                $response['code'] = 200;
                $response['message'] = "Location Updated";
            } else {
                $response['error'] = true;
                $response['code'] = 404;
                $response['message'] = "Try Again";
            }
        } else {
            $sql = "INSERT INTO tbl_tracking (tracking_lat,tracking_lng,tracking_fk_user_id)
                VALUES (?,?,?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('ddi', $_POST['tracking_lat'], $_POST['tracking_lng']
            , $_POST['tracking_fk_user_id']);
            if ($stmt->execute()) {
                $response['error'] = false;
                $response['code'] = 200;
                $response['message'] = "Location Updated";
            } else {
                $response['error'] = true;
                $response['code'] = 404;
                $response['message'] = "Try Again";
            }
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
