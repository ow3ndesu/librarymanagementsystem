<?php

use function PHPSTORM_META\type;

include_once("../database/connection.php");
include_once("sanitize.process.php");

class Process extends Database
{
    public function LoadBooks()
    {
        $books = [];
        (isset($_SESSION['admin_id'])) ? $sql = "SELECT * FROM books;" : $sql = "SELECT * FROM books WHERE quantity != '0';";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();

                while ($row = $result->fetch_assoc()) {
                    $books[] = $row;
                }

                echo json_encode(array(
                    "MESSAGE" => "BOOKS_LOADED",
                    "BOOKS" => $books
                ));
            } else {
                echo json_encode(array(
                    "MESSAGE" => "NO_BOOKS",
                ));
            }
        } else {
            echo 'EXECUTION_ERROR';
        }
    }

    public function LoadBook($data)
    {
        $book = [];
        $sanitize = new Sanitize();
        $book_id = $sanitize->sanitizeForEmail($data["book_id"]);
        $bookloaded = "BOOK_LOADED";
        $nodata = "NO_DATA";

        $stmt = $this->conn->prepare("SELECT * FROM books WHERE book_id = ?;");
        $stmt->bind_param("s", $book_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if ($res->num_rows > 0) {

            while ($rows = $res->fetch_assoc()) {
                $book[] = $rows;
            }

            echo json_encode(array(
                "MESSAGE" => $bookloaded,
                "BOOK" => $book,
            ));
        } else {
            echo $nodata;
        }
    }

    public function AddBook($data)
    {
        $sanitize = new Sanitize();
        $book_id = $sanitize->generateBID();
        $image = $_FILES["image"];
        $title = $sanitize->sanitizeForString($data["title"]);
        $author = $sanitize->sanitizeForString($data["author"]);
        $description = $sanitize->sanitizeForString($data["description"]);
        $quantity = $sanitize->sanitizeForString($data["quantity"]);
        $status = $sanitize->sanitizeForString($data["status"]);
        $inserted_by = $_SESSION["admin_id"];
        $inserted_at = date('m/d/Y');

        $path = '../assets/uploaded/images/';
        $tmpname = $image["tmp_name"];
        $filename = $image["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = $book_id."-". $author .".".$ext;

        $stmt = $this->conn->prepare("INSERT INTO books (book_id, image, title, author, description, quantity, status, inserted_by, inserted_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sssssssss", $book_id, $filename, $title, $author, $description, $quantity, $status, $inserted_by, $inserted_at);
        
        if (move_uploaded_file($tmpname, $path.$filename)) {
            if ($stmt->execute()) {
                $stmt->close();
                echo 'ADDING_SUCCESSFUL';
            } else {
                $stmt->close();
                echo 'EXECUTION_ERROR';
            }
        } else {
            echo 'UPLOAD_ERROR';
        }
    }

    public function UpdateBook($data)
    {
        $sanitize = new Sanitize();
        $book_id = $sanitize->sanitizeForEmail($data["book_id"]);
        $title = $sanitize->sanitizeForEmail($data["title"]);
        $author = $sanitize->sanitizeForEmail($data["author"]);
        $description = $sanitize->sanitizeForEmail($data["description"]);
        $quantity = $sanitize->sanitizeForEmail($data["quantity"]);
        $status = $sanitize->sanitizeForEmail($data["status"]);

        $stmt = $this->conn->prepare("UPDATE books SET title = ?, author = ?, description = ?, quantity = ?, status = ? WHERE book_id = ?;");
        $stmt->bind_param("ssssss", $title, $author, $description, $quantity, $status, $book_id);

        if ($stmt->execute()) {
            $stmt->close();
            echo 'UPDATE_SUCCESSFUL';
        } else {
            $stmt->close();
            echo 'UPDATE_ERROR';
        }
    }

    public function DeleteBook($data)
    {
        $sanitize = new Sanitize();
        $book_id = $sanitize->sanitizeForEmail($data["book_id"]);

        $stmt = $this->conn->prepare("DELETE FROM books WHERE book_id = ?;");
        $stmt->bind_param("s", $book_id);

        if ($stmt->execute()) {
            $stmt->close();
            echo 'DELETE_SUCCESSFUL';
        } else {
            $stmt->close();
            echo 'DELETE_ERROR';
        }
    }
}
