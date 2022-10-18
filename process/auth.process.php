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
        $password = $sanitize->sanitizeForString($data["password"]);
        $passwordmd5 = md5($password);
        $userid = $sanitize->generateUID();
        $type = "User"; // User, Admin, Provider
        $status = "0"; // 0 Inactive, 1 Active, 2 Deactivated
        $createdat = date('m/d/Y');
        $created_at = strval($createdat);

        $emailinuse = "EMAIL_ALREADY_IN_USE";
        $registered = "REGISTER_SUCCESS";

        $query = "SELECT * FROM users where email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        if ($result->num_rows == 1) {
            echo $emailinuse;
        } else {
            $stmt = $this->conn->prepare("INSERT INTO users(userid, email, password, type, status, created_at) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $userid, $email, $passwordmd5, $type, $status, $created_at);

            if ($stmt->execute()) {
                $stmt->close();
                echo $registered;
            } else {
                echo "THIS IS A DB OR CONNECTION ERROR";
            }
        }
    }

    public function Login($data)
    {
        $sanitize = new Sanitize();
        $email = $sanitize->sanitizeForEmail($data["email"]);
        $password = $sanitize->sanitizeForString($data["password"]);
        $passwordmd5 = md5($password);

        $sql = "SELECT * FROM users WHERE email = ? AND type = 'User'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($result->num_rows > 0) {
            if (($row["password"] == $passwordmd5)) {
                if ($row["status"] == "1") {
                    $_SESSION["authenticated"] = "1";
                    $_SESSION["userid"] = $row["userid"];

                    $url = "pages/home.page.php";
                    echo json_encode(array(
                        "MESSAGE" => "LOGIN_SUCCESS",
                        "URL" => $url
                    ));
                } else if ($row["status"] == "0") {
                    echo json_encode(array(
                        "MESSAGE" => "ACCOUNT_PENDING",
                    ));
                } else {
                    echo json_encode(array(
                        "MESSAGE" => "ACCOUNT_DEACTIVATED",
                    ));
                }
            } else {
                echo json_encode(array(
                    "MESSAGE" => "INCORRECT_PASSWORD",
                ));
            }
        } else {
            echo json_encode(array(
                "MESSAGE" => "NO_USER_FOUND",
            ));
        }
    }

    public function Logout()
    {
        if (session_destroy()) {
            echo "LOGOUT_SUCCESS";
        } else {
            echo "LOGOUT_UNSUCCESSFUL";
        }
    }
}
