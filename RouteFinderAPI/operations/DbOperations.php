<?php

use function PHPSTORM_META\type;

class DbOperations
{

    function __construct()
    {
        require_once '../includes/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }


    public function SendNotification($title, $noti_type, $user_id)
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $createdDateTime = $date->format('Y-m-d H:i:s');
        $noti_for = 'A';
        $sql = "INSERT INTO tbl_notifications (noti_title,noti_type,noti_for,noti_fk_id,
        createdDate)
                VALUES (?,?,?,?,?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sssis', $title, $noti_type, $noti_for, $user_id,$createdDateTime);
        if ($stmt->execute()) {
            return 1;
        } else {
            return 2;
        }
    }

    public function loginUser($email, $password)
    {
        $query = "SELECT * FROM tbl_users WHERE user_email = ? AND user_password = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function CreateDriverAccount(
        $user_fullName,
        $user_email,
        $user_password,
        $user_cnic,
        $user_contactNo,
        $user_address,
        $user_cityID,
        $user_lat,
        $user_lng,
        $user_end_lat,
        $user_end_lng,
        $user_gender,
        $user_routeID,
        $user_vehicleID

    ) {
        $p_password = md5($user_password);
        $date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $createdDateTime = $date->format('Y-m-d H:i:s');
        $user_type = "D";

        if ($this->checkEmail($user_email)) {
            return 0;
        } else {
            $sql = "INSERT INTO tbl_users (user_fullName,user_email,user_password,
            user_cnic,user_contactNo,user_address,user_cityID,user_lat,user_lng,
            user_end_lat,user_end_lng,
            user_gender,user_type,user_routeID,user_vehicleID,createdDate) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param(
                'ssssssiddddisiis',
                $user_fullName,
                $user_email,
                $p_password,
                $user_cnic,
                $user_contactNo,
                $user_address,
                $user_cityID,
                $user_lat,
                $user_lng,
                $user_end_lat,
                $user_end_lng,
                $user_gender,
                $user_type,
                $user_routeID,
                $user_vehicleID,
                $createdDateTime
            );
            if ($stmt->execute()) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function createUserAccount(
        $user_fullName,
        $user_email,
        $user_password,
        $user_cnic,
        $user_contactNo,
        $user_address,
        $user_cityID,
        $user_lat,
        $user_lng,
        $user_gender
    ) {
        $p_password = md5($user_password);
        $date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $createdDateTime = $date->format('Y-m-d H:i:s');
        $user_type = "U";


        if ($this->checkEmail($user_email)) {
            return 0;
        } else {
            $sql = "INSERT INTO tbl_users (user_fullName,user_email,user_password,
            user_cnic,user_contactNo,user_address,user_cityID,user_lat,user_lng,
            user_gender,user_type,createdDate) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param(
                'ssssssiddiss',
                $user_fullName,
                $user_email,
                $p_password,
                $user_cnic,
                $user_contactNo,
                $user_address,
                $user_cityID,
                $user_lat,
                $user_lng,
                $user_gender,
                $user_type,
                $createdDateTime
            );
            if ($stmt->execute()) {
                return 1;
            } else {
                return 2;
            }
        }
    }


    private  function checkEmail($email)
    {
        $sql = "SELECT * FROM tbl_users WHERE user_email = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function CheckAlreadyBooking($R_id, $W_id, $Currentdate)
    {
        $sql = "SELECT * FROM tbl_bookings WHERE booking_residentID = ?
                AND booking_workerID=? AND booking_startDate=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iis", $R_id, $W_id, $Currentdate);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function InsertNewBooking(
        $booking_residentID,
        $booking_workerID,
        $booking_title,
        $booking_description,
        $booking_amount,
        $booking_txrID
    ) {

        $date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $Currentdate = $date->format('Y-m-d');
        $createdDateTime = $date->format('Y-m-d h:i:s');
        $bookingNum = $this->generate_number(6);


        if ($this->CheckAlreadyBooking(
            $booking_residentID,
            $booking_workerID,
            $Currentdate
        )) {
            return 0;
        } else {

            $sql = "INSERT INTO tbl_bookings (booking_no,booking_residentID,booking_workerID,
            booking_startDate,booking_endDate,booking_title,booking_description,
            booking_amount,booking_txrID,createdDate) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param(
                'siissssiss',
                $bookingNum,
                $booking_residentID,
                $booking_workerID,
                $Currentdate,
                $Currentdate,
                $booking_title,
                $booking_description,
                $booking_amount,
                $booking_txrID,
                $createdDateTime
            );
            if ($stmt->execute()) {
                return 1;
            } else {
                return 2;
            }
        }
    }


    public function generate_number($size)
    {
        $alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $alpha_key . $key;
    }

    public function InsertNewComplaint(
        $comp_bookingID,
        $comp_byUserID,
        $comp_againstUserID,
        $comp_title,
        $comp_description
    ) {
        if ($this->CheckComplaintExists($comp_bookingID)) {
            return 0;
        } else {
            $date = new DateTime('now', new DateTimeZone('Asia/Karachi'));
            $createdDateTime = $date->format('Y-m-d h:i:s');

            $comp_no = $this->generate_number(5);
            $comp_by = "R";
            $comp_against = "W";

            $sql = "INSERT INTO tbl_complaints(comp_no,comp_bookingID,comp_by,comp_byUserID,
            comp_against,comp_againstUserID,comp_title,comp_description,createdDate) 
            VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param(
                'sisisisss',
                $comp_no,
                $comp_bookingID,
                $comp_by,
                $comp_byUserID,
                $comp_against,
                $comp_againstUserID,
                $comp_title,
                $comp_description,
                $createdDateTime
            );
            if ($stmt->execute()) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function CheckComplaintExists($booking_id)
    {
        $sql = "SELECT * FROM tbl_complaints WHERE comp_bookingID=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $booking_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    public function UpdatePassword($email, $number)
    {
        $pass=md5($number);
        $sql = "UPDATE tbl_users SET user_password=? WHERE user_email=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ss', $pass, $email);
        if ($stmt->execute()) {
            return 1;
        } else {
            return 2;
        }
    }
}
