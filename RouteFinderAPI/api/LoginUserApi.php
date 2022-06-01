<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['user_email']) && isset($_POST['user_password'])) {

        $password = md5($_POST['user_password']);
        $db = new DbOperations();
        $result = $db->loginUser(($_POST['user_email']), $password);
        if ($result == 0) {
            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Wrong Email or Password";
        } else if ($result == 1) {
            $query = "SELECT user_id,user_fullName,user_email,user_cnic,user_contactNo,user_type,
            user_status,user_profileImage FROM `tbl_users` WHERE user_email=?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('s', $_POST['user_email']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id, $user_fullName, $user_email, $user_cnic, $user_contactNo, $user_type, 
            $user_status,$user_profileImage);
            while ($row = $stmt->fetch()) {
                $response['user_id'] =  $user_id;
                $response['user_fullName'] =  $user_fullName;
                $response['user_email'] =  $user_email;
                $response['user_cnic'] =  $user_cnic;
                $response['user_contactNo'] = $user_contactNo;
                $response['user_type'] = $user_type;
                $response['user_status'] = $user_status;
                $response['user_profileImage'] = $user_profileImage;
            }
            $response['error'] = false;
            $response['code'] = 200;
            $response['message'] = "Login successful";
        }else{
            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Try Again";
        }
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
