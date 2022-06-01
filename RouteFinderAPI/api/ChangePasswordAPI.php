<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        $_POST['current_pass']
        && $_POST['new_password']
        && $_POST['user_id']
    ) {

        $db = new DbOperations();

        if ($db->CheckUserPassword($_POST['current_pass'], $_POST['user_id'])) {
            $pass = md5($_POST['new_password']);
            $stmt = $con->prepare("UPDATE tbl_users 
            SET user_password = ? WHERE user_id = ?");
            $stmt->bind_param(
                'si',
                $pass,
                $_POST['user_id']
            );
            if ($stmt->execute()) {
                $response['error'] = false;
                $response['status'] = http_response_code(200);
                $response['message'] = "Password Updated";
            } else {
                $response['error'] = true;
                $response['status'] = http_response_code(404);
                $response['message'] = "Password not Updated";
            }
        } else {
            $response['error'] = true;
            $response['status'] = http_response_code(404);
            $response['message'] = "Password not Matched";
        }
    } else {
        $response['error'] = true;
        $response['code'] = 404;
        $response['message'] = "Require fields are missing";
    }
} else {
    $response['error'] = true;
    $response['code'] = 500;
    $response['message'] = "Invalid request method!";
}
echo json_encode($response);
