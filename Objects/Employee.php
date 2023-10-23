<?php 
 class Employee {
  private $id, $firstName, $lastName, $birthDate, $position, $gender, $mobileNumber, $salaryRate, $password, $departmentId, $department, $email, $image;

  
  public function setId($id){
    $this-> id = $id;
  }

  public function setName($firstName, $lastName){
    $this -> firstName = $firstName;
    $this -> lastName = $lastName;
  }
  
  public function setFirstName($firstName){
    $this -> firstName = $firstName;
  }
  public function setLastName($lastName){
    $this -> lastName = $lastName;
  }

  public function setBirthDate($birthDate){
    $this -> birthDate = $birthDate;
  }
  public function setPosition($position){
    $this-> position = $position;
  }
  public function setGender($gender){
    $this-> gender = $gender;
  }
  public function setMobileNumber($mobileNumber){
    $this -> mobileNumber = $mobileNumber;
  }
  public function setSalaryRate($salaryRate){
    $this -> salaryRate = $salaryRate;
  }
  
  public function setDepartmentId($id){
    $this -> departmentId = $id;
  }
  public function setDepartment($department){
    $this->department = $department;
  }
  public function setEmail($email){
    $this->email = $email;
  }
  public function setPassword($password){
    $this->password = $password;
  }
  public function setImage($image){
    $this->image =$image;
  }

  public function getId(){
    return $this->id;
  }
  public function getFirstName(){
    return strtoupper($this -> firstName);
  }
  public function getLastName(){
    return strtoupper($this-> lastName);
  }
  public function getName() {
    return $this->getFirstName() .' '.$this->getLastName();
  }
  public function getBirthDate(){
    
    return strtoupper(strval($this->birthDate));
  }
  public function getPosition(){
    return strtoupper($this->position);
  }
  public function getGender(){
    return strtoupper($this->gender);
  }
  public function getMobileNumber(){
    return $this->mobileNumber;
  }
  public function getSalaryRate(){
    return $this->salaryRate;
  }
  
  public function getDepartmentId(){
    return $this->departmentId;
  }
  public function getDepartment(){
    return strtoupper($this->department);
  }
  public function getEmail(){
    return $this->email;
  }
  public function getImage(){
    return $this->image;
  }
  public function getPassword(){
    return $this->password;
  }
  
 }
 ?>