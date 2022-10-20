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
        $type = "Student"; // Student, Librarian/Admin
        $status = "INACTIVE"; // Inactive, Active, Deactivated
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
            $stmt = $this->conn->prepare("INSERT INTO users(email, password, user_type, status, created_at) VALUES (?,?,?,?,?);");
            $stmt->bind_param("sssss", $email, $passwordmd5, $type, $status, $created_at);

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

        $sql = "SELECT * FROM users WHERE email = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($result->num_rows > 0) {
            if (($row["password"] == $passwordmd5)) {
                if ($row["status"] == "ACTIVE") {
                    $_SESSION["authenticated"] = "1";
                    $_SESSION["userid"] = $row["user_id"];
                    $url = "pages/home.page.php";

                    if ($row["user_type"] == "ADMIN") {
                        $_SESSION["admin-auth"] = "1";
                        $url = "admin/dashboard.html";
                    }

                    echo json_encode(array(
                        "MESSAGE" => "LOGIN_SUCCESS",
                        "URL" => $url
                    ));
                } else if ($row["status"] == "INACTIVE") {
                    echo json_encode(array(
                        "MESSAGE" => "ACCOUNT_INACTIVE",
                    ));
                } else {
                    echo json_encode(array(
                        "MESSAGE" => "ACCOUNT_DEACTIVATED",
                    ));
                }
            } else {
                echo json_encode(array(
                    "MESSAGE" => "INCORRECT_COMBINATION",
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
