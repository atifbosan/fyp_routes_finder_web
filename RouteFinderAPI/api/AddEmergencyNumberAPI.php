<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['en_name']) &&
        isset($_POST['en_number']) &&
        isset($_POST['fk_user_id'])
    ) {
        $sql = "INSERT INTO tbl_emergency_numbers (en_name,en_number,fk_user_id)
        VALUES (?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            'ssi',
            $_POST['en_name'],
            $_POST['en_number'],
            $_POST['fk_user_id']
        );
        if ($stmt->execute()) {
            $response['error'] = false;
            $response['code'] = 200;
            $response['message'] = "Contact Added Successfully";
        } else {
            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Contact Not Added Successfully";
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
