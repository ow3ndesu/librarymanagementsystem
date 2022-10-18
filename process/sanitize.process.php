<?php
class Sanitize extends Database
{
    public function sanitizeForString($data)
    {
        $this->data = filter_var(mysqli_real_escape_string($this->conn, $data), FILTER_SANITIZE_STRING);
        return $this->data;
    }

    public function sanitizeForInput($data)
    {
        $this->data = filter_var($data, FILTER_SANITIZE_STRING);
        return $this->data;
    }

    public function sanitizeForEmail($data)
    {
        $this->data = filter_var(mysqli_real_escape_string($this->conn, $data), FILTER_SANITIZE_EMAIL);
        return $this->data;
    }

    public function generateUID()
    {
        $str_result = '0123456789abcdefghijklmnopqrstuvwxyz';
        return 'SPA%ID' . substr(str_shuffle($str_result), 0, 6);
    }
}
