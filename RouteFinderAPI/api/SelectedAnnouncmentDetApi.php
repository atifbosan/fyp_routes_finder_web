<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['announcement_id'])) {
        $query = "SELECT announcement_title,announcement_description,
        announcement_status,createdDate FROM `tbl_announcement` WHERE announcement_id=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $_POST['announcement_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $announcement_title,
            $announcement_description,
            $announcement_status,
            $createdDate
        );
        while ($row = $stmt->fetch()) {
            $response['announcement_title'] =  $announcement_title;
            $response['announcement_description'] =  $announcement_description;
            $response['announcement_status'] =  $announcement_status;
            $response['createdDate'] =  $createdDate;
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
