<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{
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
                        $url = "admin/";
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

    public function LoadUsers()
    {
        $users = [];
        $sql = "SELECT * FROM users WHERE user_type != 'ADMIN';";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();

                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }

                echo json_encode(array(
                    "MESSAGE" => "USERS_LOADED",
                    "USERS" => $users
                ));
            } else {
                echo json_encode(array(
                    "MESSAGE" => "NO_USER",
                ));
            }
        } else {
            echo 'EXECUTION_ERROR';
        }
    }
}
