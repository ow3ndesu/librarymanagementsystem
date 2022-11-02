<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{
    public function LoadBorrowals()
    {
        $borrowals = [];
        $sql = "SELECT b.borrow_id, bo.book_id, bo.title, s.student_id, s.lastname, b.status, b.filed, b.due FROM ((borrowals b LEFT JOIN books bo ON b.book_id = bo.book_id) LEFT JOIN students s ON b.student_id = s.student_id) WHERE b.status != 'RETURNING' AND b.status != 'RETURNED' AND b.status != 'CANCELED' ORDER BY b.id DESC;";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();

                while ($row = $result->fetch_assoc()) {
                    $borrowals[] = $row;
                }

                echo json_encode(array(
                    "MESSAGE" => "BORROWALS_LOADED",
                    "BORROWALS" => $borrowals
                ));
            } else {
                echo json_encode(array(
                    "MESSAGE" => "NO_BORROWALS",
                ));
            }
        } else {
            echo 'EXECUTION_ERROR';
        }
    }

    public function LoadBorrowal($data)
    {
        $borrowal = [];
        $sanitize = new Sanitize();
        $borrow_id = $sanitize->sanitizeForEmail($data["borrow_id"]);
        $borrowalloaded = "BORROWAL_LOADED";
        $nodata = "NO_DATA";

        $stmt = $this->conn->prepare("SELECT b.*, bo.*, s.*, u.* FROM (((borrowals b LEFT JOIN books bo ON b.book_id = bo.book_id) LEFT JOIN students s ON b.student_id = s.student_id) LEFT JOIN users u ON s.user_id = u.user_id) WHERE b.borrow_id = ? ORDER BY b.id DESC;");
        $stmt->bind_param("s", $borrow_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if ($res->num_rows > 0) {

            while ($rows = $res->fetch_array()) {
                $borrowal[] = $rows;
            }

            unset($borrowal[0][30]);

            echo json_encode(array(
                "MESSAGE" => $borrowalloaded,
                "BORROWAL" => $borrowal,
            ));
        } else {
            echo $nodata;
        }
    }

    public function EditBorrowalStatus($data)
    {
        $sanitize = new Sanitize();
        $borrow_id = $sanitize->sanitizeForEmail($data["borrow_id"]);
        $status = $sanitize->sanitizeForEmail($data["status"]);
        $modified_at = date('m/d/Y');
        $admin_id = $_SESSION['admin_id'];

        $stmt = $this->conn->prepare("UPDATE borrowals SET status = ?, modified_at = ?, modified_by = ? WHERE borrow_id = ?;");
        $stmt->bind_param("ssss", $status, $modified_at, $admin_id, $borrow_id);

        $stmt1 = $this->conn->prepare("SELECT book_id FROM borrowals WHERE borrow_id = ?;");
        $stmt1->bind_param("s", $borrow_id);

        if ($stmt->execute()) {
            $stmt->close();

            $stmt1->execute();
            $res1 = $stmt1->get_result();
            $stmt1->close();
            $row = $res1->fetch_array();
            $book_id = $row[0];

            if ($status = 'APPROVED') {
                $stmt = $this->conn->prepare("UPDATE books SET quantity = quantity - 1 WHERE book_id = ?;");
                $stmt->bind_param("s", $book_id);
                $stmt->execute();
                $result = $stmt->get_result();

                echo 'UPDATE_SUCCESSFUL';
            }
        } else {
            $stmt->close();
            echo 'UPDATE_ERROR';
        }
    }

    public function DeleteBorrowal($data)
    {
        $sanitize = new Sanitize();
        $borrow_id = $sanitize->sanitizeForEmail($data["borrow_id"]);

        $stmt = $this->conn->prepare("DELETE FROM borrowals WHERE borrow_id = ?;");
        $stmt->bind_param("s", $borrow_id);

        if ($stmt->execute()) {
            $stmt->close();
            echo 'DELETE_SUCCESSFUL';
        } else {
            $stmt->close();
            echo 'DELETE_ERROR';
        }
    }
}
