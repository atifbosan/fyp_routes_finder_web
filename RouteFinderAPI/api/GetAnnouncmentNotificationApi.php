<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$db = new DbConnect();
$con = $db->connect();
$data = array();
$response = array();
$resultSet = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        isset($_POST['noti_forUserID'])
        && isset($_POST['noti_for'])
    ) {

        $query = "SELECT noti_id,noti_title,noti_fk_id, createdDate 
        FROM tbl_notifications WHERE noti_for=? AND noti_forUserID=? 
        AND noti_type='A' ORDER BY createdDate DESC";
        $stmt = $con->prepare($query);
        $stmt->bind_param('si', $_POST['noti_for'], $_POST['noti_forUserID']);
        $stmt->execute();
        $stmt->store_result();
        $row = $stmt->num_rows() > 0;
        if ($row == 1) {
            $stmt->bind_result(
                $noti_id,
                $noti_title,
                $noti_fk_id,
                $createdDate
            );
            while ($row = $stmt->fetch()) {
                $data = array(
                    'noti_id' => $noti_id,
                    'noti_title' => $noti_title,
                    'noti_fk_id' => $noti_fk_id,
                    'createdDate' => $createdDate
                );
                array_push($resultSet, $data);
            }
            $response['error'] = false;
            $response['code'] = 200;
            $response['message'] = "record found";
            $response['records']   = $resultSet;
        } else if ($row == 0) {
            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Record not found";
        }
    } else {
        $response['error'] = true;
        $response['code'] = 404;
        $response['message'] = "Required field missing";
    }
} else {
    $response['error'] = true;
    $response['code'] = 404;
    $response['message'] = "Server Error";
}
echo json_encode($response);
