<?php
class E_Student {
    private $id;
    private $name;
    private $age;
    private $university;

    public function __construct($id, $name, $age, $university) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->university = $university;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getUniversity() {
        return $this->university;
    }
}

?>
