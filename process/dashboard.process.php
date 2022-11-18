<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{
    public function LoadDashboard()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(books.id) AS books, (SELECT COUNT(borrowals.id) FROM borrowals WHERE borrowals.status = 'BORROWED' OR borrowals.status = 'RETURNED' OR borrowals.status = 'RETURNING') AS borrowed, (SELECT COUNT(borrowals.id) FROM borrowals WHERE borrowals.status = 'RETURNED') AS returned, (SELECT COUNT(students.id) FROM students) AS students FROM books;");

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();
                
                $row = $result->fetch_assoc();
                
                echo json_encode(array(
                    "MESSAGE" => "DASHBOARD_LOADED",
                    "BOOKS" => $row['books'],
                    "BORROWED" => $row['borrowed'],
                    "RETURNED" => $row['returned'],
                    "STUDENTS" => $row['students'],

                ));
            } else {
                echo json_encode(array(
                    "MESSAGE" => "NOTHING_RETURNED",
                ));
            }
        } else {
            echo 'EXECUTION_ERROR';
        }
    }
}
