<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{
    public function LoadStudents()
    {
        $students = [];
        $sql = "SELECT s.student_id, s.firstname, s.middlename, s.lastname, s.contact_no FROM students s INNER JOIN users u ON u.user_id = s.user_id;";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();

                while ($row = $result->fetch_assoc()) {
                    $students[] = $row;
                }

                echo json_encode(array(
                    "MESSAGE" => "STUDENTS_LOADED",
                    "STUDENTS" => $students
                ));
            } else {
                echo json_encode(array(
                    "MESSAGE" => "NO_STUDENTS",
                ));
            }
        } else {
            echo 'EXECUTION_ERROR';
        }
    }

    public function LoadStudent($data)
    {
        $student = [];
        $sanitize = new Sanitize();
        $student_id = $sanitize->sanitizeForEmail($data["student_id"]);
        $studentloaded = "STUDENT_LOADED";
        $nodata = "NO_DATA";

        $stmt = $this->conn->prepare("SELECT * FROM students WHERE student_id = ?;");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if ($res->num_rows > 0) {

            while ($rows = $res->fetch_assoc()) {
                $student[] = $rows;
            }

            echo json_encode(array(
                "MESSAGE" => $studentloaded,
                "STUDENT" => $student,
            ));
        } else {
            echo $nodata;
        }
    }

    public function AddStudent($data)
    {
        $sanitize = new Sanitize();
        $user_id = $sanitize->sanitizeForEmail($data["user_id"]);

        $stmt = $this->conn->prepare("UPDATE users SET status = 'ENABLED' WHERE user_id = ?;");
        $stmt->bind_param("s", $user_id);

        if ($stmt->execute()) {
            $stmt->close();

            $stmt = $this->conn->prepare("SELECT * FROM students WHERE user_id = ?");
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                $stmt->close();
                $student_id = $sanitize->generateSID();
                $created_at = date('m/d/Y');

                $stmt = $this->conn->prepare("INSERT INTO students (student_id, user_id, created_at) VALUES (?, ?, ?);");
                $stmt->bind_param("sss", $student_id, $user_id, $created_at);
                $stmt->execute();
                $stmt->close();

                echo 'ADD_SUCCESSFUL';
            } else {
                $stmt->close();
                echo 'ADD_SUCCESSFUL';
            }
        } else {
            $stmt->close();
            echo 'ADD_ERROR';
        }
    }

    public function DeleteStudent($data)
    {
        $sanitize = new Sanitize();
        $student_id = $sanitize->sanitizeForEmail($data["student_id"]);

        $stmt = $this->conn->prepare("DELETE FROM students WHERE student_id = ?;");
        $stmt->bind_param("s", $student_id);

        if ($stmt->execute()) {
            $stmt->close();
            echo 'DELETE_SUCCESSFUL';
        } else {
            $stmt->close();
            echo 'DELETE_ERROR';
        }
    }
}
