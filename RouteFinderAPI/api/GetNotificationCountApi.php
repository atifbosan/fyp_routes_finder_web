<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        isset($_POST['noti_forUserID'])
        && isset($_POST['noti_for'])
    ) {
        $query = "SELECT * FROM `tbl_notifications` 
            WHERE noti_forUserID=? AND noti_for=? AND noti_status='0' AND noti_type='A'";
        $stmt = $con->prepare($query);
        $stmt->bind_param('is', $_POST['noti_forUserID'], $_POST['noti_for']);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows();
        $response['error'] = false;
        $response['code'] = 200;
        $response['message'] = "Notification";
        $response['count'] = $rows;
    } else {
        $response['error'] = true;
        $response['code'] = 404;
        $response['message'] = "Required Field Missing";
    }
} else {
    $response['error'] = true;
    $response['code'] = 500;
    $response['message'] = "Server connection";
}
echo json_encode($response);
