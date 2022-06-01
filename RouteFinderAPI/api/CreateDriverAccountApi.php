<?php
header("Content-Type: application/json; charset=UTF-8");
//$destination_path = getcwd().DIRECTORY_SEPARATOR;
//$upload_dir =  'uploads/';

$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/routesFinder/uploads/';
//die;
//$upload_dir =  '/uploads';
include_once '../operations/DbOperations.php';
include_once '../includes/DbConnect.php';

$response  = array();
$db = new DbConnect();
$con = $db->connect();
$resultSet=array();
$data=array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        isset($_POST['user_fullName'])
        && isset($_POST['user_email'])
        && isset($_POST['user_password'])
        && isset($_POST['user_cnic'])
        && isset($_POST['user_contactNo'])
        && isset($_POST['user_address'])
        && isset($_POST['user_cityID'])
        && isset($_POST['user_lat'])
        && isset($_POST['user_lng'])
        && isset($_POST['user_end_lat'])
        && isset($_POST['user_end_lng'])
        && isset($_POST['user_gender'])
        && isset($_POST['user_routeID'])
        && isset($_POST['user_vehicleID'])
        && $_FILES['user_profileImage']
    ) {

        $db = new DbOperations();

        $result = $db->CreateDriverAccount(
            $_POST['user_fullName'],
            $_POST['user_email'],
            $_POST['user_password'],
            $_POST['user_cnic'],
            $_POST['user_contactNo'],
            $_POST['user_address'],
            $_POST['user_cityID'],
            $_POST['user_lat'],
            $_POST['user_lng'],
            $_POST['user_end_lat'],
            $_POST['user_end_lng'],
            $_POST['user_gender'],
            $_POST['user_routeID'],
            $_POST['user_vehicleID']
        );


        if ($result == 1) {

            $avatar_name = $_FILES["user_profileImage"]["name"];
            $avatar_tmp_name = $_FILES["user_profileImage"]["tmp_name"];
            $error = $_FILES["user_profileImage"]["error"];


            if ($error > 0) {
                $response = array(
                    "status" => "error",
                    "error" => true,
                    "message" => "Error uploading the file!"
                );
            } else {
                $random_name = rand(1000, 1000000) . "-" . $avatar_name;
                $upload_name = $upload_dir . strtolower($random_name);
                $upload_name = preg_replace('/\s+/', '-', $upload_name);

                if (move_uploaded_file($avatar_tmp_name, $upload_name)) {
                    $dbRandomFilePath = "uploads/" . $random_name;
                    // $url = "/" . $upload_name;
                    $url = $upload_name;

                    $stmt = $con->prepare("UPDATE tbl_users 
                    SET user_profileImage = ?
                    WHERE user_email = ?");
                    $stmt->bind_param('ss', $dbRandomFilePath, $_POST['user_email']);
                    $stmt->execute();
                }
            }
            $query = "SELECT user_id FROM tbl_users ORDER BY user_id";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $row = $stmt->num_rows > 0;
            $stmt->bind_result($id);
            //$stmt->fetch();
            while ($row = $stmt->fetch()) {
                $data = array(
                    'user_id' => $id
                );
                array_push($resultSet, $data);
            }
            $getID = end($data);
            $title = $_POST['user_email'] . " request for registration";
            $notiType = 1;
            $db->SendNotification($title, $notiType, $getID);

            $response['error'] = false;
            $response['status'] = http_response_code(200);
            $response['message'] = "Account Registration Request Send to Admin";
        } else if ($result == 2) {
            $response['error'] = true;
            $response['code'] = http_response_code(404);
            $response['message'] = "Registration failed!!";
        } else if ($result == 0) {

            $response['error'] = true;
            $response['code'] = 404;
            $response['message'] = "Email already exist choose another";
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
