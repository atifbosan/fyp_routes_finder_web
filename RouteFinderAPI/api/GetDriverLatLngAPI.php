<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['tracking_fk_user_id'])) {
        $query = "SELECT tracking_lat,tracking_lng FROM `tbl_tracking` 
        WHERE tracking_fk_user_id=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $_POST['tracking_fk_user_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $tracking_lat,
            $tracking_lng
        );
        while ($row = $stmt->fetch()) {
            $response['tracking_lat'] =  $tracking_lat;
            $response['tracking_lng'] =  $tracking_lng;
        }
        $response['error'] = false;
        $response['code'] = 200;
        $response['message'] = "Record not successful";
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
