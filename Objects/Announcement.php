<?php
class Announcement {
    private $id, $title, $description, $dateCreated, $employee, $employeeId;

    // Getter for $id
    public function getId() {
        return $this->id;
    }

    // Setter for $id
    public function setId($id) {
        $this->id = $id;
    }

    // Getter for $title
    public function getTitle() {
        return $this->title;
    }

    // Setter for $title
    public function setTitle($title) {
        $this->title = $title;
    }

    // Getter for $description
    public function getDescription() {
        return $this->description;
    }

    // Setter for $description
    public function setDescription($description) {
        $this->description = $description;
    }

    // Getter for $dateCreated
    public function getDateCreated() {
        return $this->dateCreated;
    }

    // Setter for $dateCreated
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    // Getter for $employee
    public function getEmployeeName() {
        return $this->employee;
    }

    // Setter for $employee
    public function setEmployeeName($employee) {
        $this->employee = $employee;
    }

    // Getter for $employeeId
    public function getEmployeeId() {
        return $this->employeeId;
    }

    // Setter for $employeeId
    public function setEmployeeId($employeeId) {
        $this->employeeId = $employeeId;
    }
}
