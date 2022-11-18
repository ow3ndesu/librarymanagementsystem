<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{
    // public function LoadUsers()
    // {
    //     $users = [];
    //     $sql = "SELECT * FROM users WHERE user_type != 'ADMIN';";
    //     $stmt = $this->conn->prepare($sql);

    //     if ($stmt->execute()) {
    //         $result = $stmt->get_result();

    //         if ($result->num_rows > 0) {
    //             $stmt->close();

    //             while ($row = $result->fetch_assoc()) {
    //                 $users[] = $row;
    //             }

    //             echo json_encode(array(
    //                 "MESSAGE" => "USERS_LOADED",
    //                 "USERS" => $users
    //             ));
    //         } else {
    //             echo json_encode(array(
    //                 "MESSAGE" => "NO_USER",
    //             ));
    //         }
    //     } else {
    //         echo 'EXECUTION_ERROR';
    //     }
    // }

    // public function LoadNonEnabledUsers()
    // {
    //     $users = [];
    //     $sql = "SELECT * FROM users WHERE user_type != 'ADMIN' AND status != 'ENABLED';";
    //     $stmt = $this->conn->prepare($sql);

    //     if ($stmt->execute()) {
    //         $result = $stmt->get_result();

    //         if ($result->num_rows > 0) {
    //             $stmt->close();

    //             while ($row = $result->fetch_assoc()) {
    //                 $users[] = $row;
    //             }

    //             echo json_encode(array(
    //                 "MESSAGE" => "USERS_LOADED",
    //                 "USERS" => $users
    //             ));
    //         } else {
    //             echo json_encode(array(
    //                 "MESSAGE" => "NO_USER",
    //             ));
    //         }
    //     } else {
    //         echo 'EXECUTION_ERROR';
    //     }
    // }

    public function LoadProfile()
    {
        $profile = [];
        if (isset($_SESSION['admin_id'])) {
            $id = $_SESSION['admin_id'];
            $query = "SELECT admin_id, user_id, firstname, middlename, lastname, address, contact_no, is_completed FROM admins WHERE admin_id = ?;";
        } else {
            $id = $_SESSION['student_id'];
            $query = "SELECT s.student_id, s.user_id, s.firstname, s.middlename, s.lastname, s.address, s.contact_no, s.is_completed, SUM(case when b.status = 'BORROWED' then 1 when b.status = 'RETURNING' then 1 when b.status = 'RETURNED' then 1 else 0 end) AS borrowedcount, SUM(case when b.status = 'RETURNED' then 1 else 0 end) AS returnedcount FROM students s INNER JOIN borrowals b ON b.student_id = s.student_id WHERE s.student_id = ?;";
        }

        $profileloaded = "PROFILE_LOADED";
        $nodata = "NO_DATA";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if ($res->num_rows > 0) {

            while ($rows = $res->fetch_assoc()) {
                $profile[] = $rows;
            }

            echo json_encode(array(
                "MESSAGE" => $profileloaded,
                "PROFILE" => $profile,
            ));
        } else {
            echo $nodata;
        }
    }

    public function UpdateProfile($data)
    {
        $sanitize = new Sanitize();
        $student_id = $sanitize->sanitizeForEmail($data["student_id"]);
        $firstname = $sanitize->sanitizeForEmail($data["firstname"]);
        $middlename = $sanitize->sanitizeForEmail($data["middlename"]);
        $lastname = $sanitize->sanitizeForEmail($data["lastname"]);
        $address = $sanitize->sanitizeForEmail($data["address"]);
        $contact_no = $sanitize->sanitizeForEmail($data["contact_no"]);
        $is_completed = 1;

        $stmt = $this->conn->prepare("UPDATE students SET firstname = ?, middlename = ?, lastname = ?, address = ?, contact_no = ?, is_completed = ? WHERE student_id = ?;");
        $stmt->bind_param("sssssss", $firstname, $middlename, $lastname, $address, $contact_no, $is_completed, $student_id);

        if ($stmt->execute()) {
            $stmt->close();

            echo 'UPDATE_SUCCESSFUL';
        } else {
            $stmt->close();
            echo 'UPDATE_ERROR';
        }
    }

    // public function DeleteUserAccount($data)
    // {
    //     $sanitize = new Sanitize();
    //     $user_id = $sanitize->sanitizeForEmail($data["user_id"]);

    //     $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?;");
    //     $stmt->bind_param("s", $user_id);

    //     if ($stmt->execute()) {
    //         $stmt->close();
    //         echo 'DELETE_SUCCESSFUL';
    //     } else {
    //         $stmt->close();
    //         echo 'DELETE_ERROR';
    //     }
    // }
}