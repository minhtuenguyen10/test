<?php
include_once("E_Student.php");

class Model_Student {

    private $db;

    public function __construct() {
        $this->db = mysqli_connect("localhost", "root", "", "dulieu");
        if (!$this->db) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getAllStudent() {
        $sql = "SELECT * FROM sinhvien ORDER BY id";
        $rs = mysqli_query($this->db, $sql);
        $students = [];
        while ($row = mysqli_fetch_array($rs)) {
            $id = $row['id'];
            $name = $row['name'];
            $age = $row['age'];
            $university = $row['university'];
            $students[] = new E_Student($id, $name, $age, $university);
        }
        return $students;
    }

    public function getStudentDetail($stid) {
        $students = $this->getAllStudent();
        foreach ($students as $student) {
            if ($student->getId() == $stid) {
                return $student;
            }
        }
        return null;
    }

    public function addStudent($name, $age, $university) {
        $sql = "SELECT id FROM sinhvien ORDER BY id";
        $rs = mysqli_query($this->db, $sql);
        $ids = [];
        while ($row = mysqli_fetch_assoc($rs)) {
            $ids[] = $row['id'];
        }

        $newId = 1;
        foreach ($ids as $id) {
            if ($id != $newId) break;
            $newId++;
        }
        $sql = "INSERT INTO sinhvien (id, name, age, university) VALUES ($newId, '$name', $age, '$university')";
        return mysqli_query($this->db, $sql);
    }

    public function updateStudent($id, $name, $age, $university) {
        $sql = "UPDATE sinhvien SET name = ?, age = ?, university = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "sisi", $name, $age, $university, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function deleteStudent($id) {
        $sql = "DELETE FROM sinhvien WHERE id=$id";
        $result = mysqli_query($this->db, $sql);
        if ($result) {
            $this->reorderIds();
        }
        return $result;
    }

    public function reorderIds() {
        $sql = "SELECT * FROM sinhvien ORDER BY id";
        $rs = mysqli_query($this->db, $sql);

        $currentId = 1;
        while ($row = mysqli_fetch_array($rs)) {
            $originalId = $row['id'];
            if ($originalId != $currentId) {
                $updateSql = "UPDATE sinhvien SET id=$currentId WHERE id=$originalId";
                mysqli_query($this->db, $updateSql);
            }
            $currentId++;
        }
    }

    public function searchStudent($field, $value) {
        $sql = "";

        switch ($field) {
            case 'name':
                $sql = "SELECT * FROM sinhvien WHERE name LIKE ?";
                break;
            case 'age':
                $sql = "SELECT * FROM sinhvien WHERE age = ?";
                break;
            case 'university':
                $sql = "SELECT * FROM sinhvien WHERE university LIKE ?";
                break;
            default:
                return [];
        }

        $stmt = mysqli_prepare($this->db, $sql);

        if ($field == 'age') {
            mysqli_stmt_bind_param($stmt, "i", $value);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $value);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = new E_Student($row['id'], $row['name'], $row['age'], $row['university']);
        }

        return $students;
    }
}
?>
