<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{

    public function Register($data)
    {
        $sanitize = new Sanitize();
        $email = $sanitize->sanitizeForEmail($data["email"]);
        $receiver = $sanitize->sanitizeForEmail($data["email2"]);
        $password = $sanitize->sanitizeForString($data["password"]);
        $passwordmd5 = md5($password);
        $proof = $_FILES["proof"];
        $type = "Student"; // Student, Librarian/Admin
        $status = "DISABLED"; // DISABLED/ENABLED
        $createdat = date('m/d/Y');
        $created_at = strval($createdat);

        $emailinuse = "EMAIL_ALREADY_IN_USE";
        $registered = "REGISTER_SUCCESS";

        $path = '../assets/uploaded/proofs/';
        $tmpname = $proof["tmp_name"];
        $filename = $proof["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = $email."-". rand(90, 2000) .".".$ext;

        $query = "SELECT * FROM users where email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        if ($result->num_rows == 1) {
            echo $emailinuse;
        } else {
            if (move_uploaded_file($tmpname, $path.$filename)) {
                $stmt = $this->conn->prepare("INSERT INTO users(email, receiver, password, proof, user_type, status, created_at) VALUES (?,?,?,?,?,?,?);");
                $stmt->bind_param("sssssss", $email, $receiver, $passwordmd5, $filename, $type, $status, $created_at);
    
                if ($stmt->execute()) {
                    $stmt->close();
                    echo $registered;
                } else {
                    echo "THIS IS A DB OR CONNECTION ERROR";
                }
            } else {
                echo 'UPLOAD_ERROR';
            }
        }
    }

    public function Login($data)
    {
        $sanitize = new Sanitize();
        $email = $sanitize->sanitizeForEmail($data["email"]);
        $password = $sanitize->sanitizeForString($data["password"]);
        $passwordmd5 = md5($password);

        $sql = "SELECT u.*, IF(s.is_completed IS NULL, 0, s.is_completed) AS isCompleted FROM users u LEFT JOIN students s ON s.user_id = u.user_id WHERE email = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($result->num_rows > 0) {
            if (($row["password"] == $passwordmd5)) {
                if ($row["status"] == "ENABLED") {
                    $_SESSION["authenticated"] = "1";
                    $_SESSION["userid"] = $row["user_id"];
                    $_SESSION["user_type"] = $row["user_type"];
                    $_SESSION["isCompleted"] = $row["isCompleted"];
                    $url = "pages/home.page.php";
                    $_SESSION['attempts'] = 3;

                    if ($row["user_type"] == "ADMIN") {
                        $_SESSION["admin-auth"] = "1";
                        $url = "admin/";
                    }

                    echo json_encode(array(
                        "MESSAGE" => "LOGIN_SUCCESS",
                        "URL" => $url
                    ));
                } else if ($row["status"] == "DISABLED") {
                    echo json_encode(array(
                        "MESSAGE" => "ACCOUNT_INACTIVE",
                    ));
                } else {
                    echo json_encode(array(
                        "MESSAGE" => "ACCOUNT_DEACTIVATED",
                    ));
                }
            } else {
                $_SESSION['attempts'] = $_SESSION['attempts'] - 1;
                echo json_encode(array(
                    "MESSAGE" => "INCORRECT_COMBINATION",
                    "ATTEMPTS" => $_SESSION['attempts']
                ));
            }
        } else {
            echo json_encode(array(
                "MESSAGE" => "NO_USER_FOUND",
            ));
        }
    }

    public function LoadProfile($data)
    {
        $user_type = $_SESSION["user_type"];
        $user_id = $_SESSION["userid"];

        if ($user_type == 'ADMIN') {
            $sql = "SELECT * FROM admins WHERE user_id = ?;";
        } else {
            $sql = "SELECT * FROM students WHERE user_id = ?;";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();

                while ($row = $result->fetch_assoc()) {
                    if (isset($row["admin_id"]) && $row["admin_id"]) {
                        $_SESSION['admin_id'] = $row['admin_id'];
                    } else if (isset($row["student_id"]) && $row["student_id"]) {
                        $_SESSION['student_id'] = $row['student_id'];
                    }

                    $_SESSION['fullname'] = $row['firstname'] . ' ' . $row['lastname'];
                }

                echo json_encode(array(
                    "MESSAGE" => "PROFILE_LOADED",
                ));
            } else {
                echo json_encode(array(
                    "MESSAGE" => "NO_PROFILE",
                ));
            }
        } else {
            echo 'EXECUTION_ERROR';
        }
    }

    public function Logout()
    {
        if (session_destroy()) {
            echo "LOGOUT_SUCCESS";
            session_start();
            $_SESSION['attempts'] = 3;
        } else {
            echo "LOGOUT_UNSUCCESSFUL";
        }
    }
}
