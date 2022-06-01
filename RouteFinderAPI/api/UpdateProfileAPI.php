<?php
header("Content-Type: application/json; charset=UTF-8");
$upload_dir = "profilepicture/";

include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        $_POST['user_id']
        && $_POST['user_fullName']
        && $_POST['user_email']
        && $_POST['user_cnic']
        && $_POST['user_contactNo']

    ) {
        $stmt = $con->prepare("UPDATE tbl_users 
                    SET user_fullName = ?, user_email=?, user_cnic=?, user_contactNo=?
                    WHERE user_id = ?");
        $stmt->bind_param('ssssi', $_POST['user_fullName'], $_POST['user_email'],
         $_POST['user_cnic'], $_POST['user_contactNo'], $_POST['user_id']);
        if ($stmt->execute()) {
            $query = "SELECT user_fullName,user_email,user_cnic,user_contactNo,
            user_profileImage FROM tbl_users WHERE user_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $_POST['user_id']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result(
                $user_fullName,
                $user_email,
                $user_cnic,
                $user_contactNo,
                $user_profileImage
            );
            while ($row = $stmt->fetch()) {
                $response['user_fullName'] =  $user_fullName;
                $response['user_email'] =  $user_email;
                $response['user_cnic'] =  $user_cnic;
                $response['user_contactNo'] =  $user_contactNo;
                $response['user_profileImage'] =  $user_profileImage;
            }
            $response['error'] = false;
            $response['status'] = http_response_code(200);
            $response['message'] = "Profile Updated";    
        }else{
            $response['error'] = false;
            $response['status'] = http_response_code(404);
            $response['message'] = "Profile not Updated";    
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
