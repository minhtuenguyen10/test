<?php
include_once("../Model/M_Student.php");

class Ctrl_Student {
    public function invoke() {
        $modelStudent = new Model_Student();

        if (isset($_GET['stid'])) {
            $student = $modelStudent->getStudentDetail($_GET['stid']);
            include_once("../View/StudentDetail.html");
        } elseif (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action == 'Add') {
                $name = $_POST['name'];
                $age = $_POST['age'];
                $university = $_POST['university'];
                $modelStudent->addStudent($name, $age, $university);
                header('Location: ../Controller/C_Student.php');
                exit();
            } elseif ($action == 'Delete') {
                $ids = $_POST['delete_ids'] ?? [];
                foreach ($ids as $id) {
                    $modelStudent->deleteStudent($id);
                }
                $modelStudent->reorderIds();
                header('Location: ../Controller/C_Student.php');
                exit();
            } elseif ($action == 'Update') {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $age = $_POST['age'];
                $university = $_POST['university'];
                $modelStudent->updateStudent($id, $name, $age, $university);
                header('Location: ../Controller/C_Student.php');
                exit();
            }
        } elseif (isset($_GET['search'])) {
            $field = $_GET['field'] ?? '';
            $value = $_GET['value'] ?? '';

            if (empty($value)) {
                $studentList = [];
                $error = "Vui lòng nhập giá trị tìm kiếm.";
            } else {
                $studentList = $modelStudent->searchStudent($field, $value);
                $error = empty($studentList) ? "Không tìm thấy kết quả phù hợp." : "";
            }

            include_once("../View/StudentSearch.html");
        } else {
            $studentList = $modelStudent->getAllStudent();
            include_once("../View/StudentList.html");
        }

        if (isset($_GET['update_id'])) {
            $student = $modelStudent->getStudentDetail($_GET['update_id']);
            header("Location: ../View/StudentUpdate.html?id=" . $student->getId() .
                "&name=" . urlencode($student->getName()) .
                "&age=" . $student->getAge() .
                "&university=" . urlencode($student->getUniversity()));
        }
    }
}

$C_Student = new Ctrl_Student();
$C_Student->invoke();
?>
