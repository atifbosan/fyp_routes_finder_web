<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$db = new DbConnect();
$con = $db->connect();
$data = array();
$response = array();
$resultSet = array();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $query = "SELECT route_id,route_title FROM tbl_routes WHERE route_status='A'";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $row = $stmt->num_rows() > 0;
    if ($row == 1) {
        $stmt->bind_result($route_id, $route_title);

        while ($row = $stmt->fetch()) {
            $data = array(
                'route_id' => $route_id,
                'route_title' => $route_title
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
    $response['message'] = "Server Error";
}
echo json_encode($response);
