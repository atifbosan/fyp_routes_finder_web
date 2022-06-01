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

    if (isset($_POST['user_routeID'])) {

        $query = "SELECT user_id,user_fullName,user_cnic,user_contactNo,user_gender,user_profileImage,
        tbl_tracking.tracking_id,tbl_tracking.tracking_lat,tbl_tracking.tracking_lng,
        tbl_vehicles.vehicle_title        
        FROM `tbl_users` JOIN tbl_tracking ON tbl_users.user_id=tbl_tracking.tracking_fk_user_id
        JOIN tbl_vehicles ON tbl_users.user_vehicleID=tbl_vehicles.vehicle_id
        WHERE tbl_tracking.tracking_status='ON' AND tbl_users.user_routeID=?";

        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $_POST['user_routeID']);
        $stmt->execute();
        $stmt->store_result();
        $row = $stmt->num_rows() > 0;
        if ($row == 1) {
            $stmt->bind_result(
                $user_id,
                $user_fullName,
                $user_cnic,
                $user_contactNo,
                $user_gender,
                $user_profileImage,
                $tracking_id,
                $tracking_lat,
                $tracking_lng,
                $vehicle_title
            );
            while ($row = $stmt->fetch()) {
                $data = array(
                    'user_id' => $user_id,
                    'user_fullName' => $user_fullName,
                    'user_cnic' => $user_cnic,
                    'user_contactNo' => $user_contactNo,
                    'user_gender' => $user_gender,
                    'user_profileImage' => $user_profileImage,
                    'tracking_id' => $tracking_id,
                    'tracking_lat' => $tracking_lat,
                    'tracking_lng' => $tracking_lng,
                    'vehicle_title' => $vehicle_title
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
    $response['code'] = 500;
    $response['message'] = "Server Error";
}
echo json_encode($response);
